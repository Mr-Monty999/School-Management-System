<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Classes;
use App\Models\Parents;
use App\Models\Student;
use App\Models\User;
use App\Services\FileUploadService;
use App\Services\JsonService;
use App\Services\RegisterationService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('class')->orderBy("id", "desc")->paginate(5);

        return view("students.index", compact('students'));
    }


    public function table($pageNumber, $sortBy, $name = "")
    {
        /* str_replace(
            ['\\','%','_'],
            ['\\\\','\%','\_'],
            $name
        ); */

        $name = trim($name);

        $students = null;
        if ($sortBy == "last") {
            $students = Student::with('class')
                ->where('student_name', 'LIKE', "%$name%")
                ->orderBy("id", "desc")
                ->latest()->paginate(5, ['*'], 'page', $pageNumber);
        } elseif ($sortBy == "first") {
            $students = Student::with('class')
                ->where('student_name', 'LIKE', "%$name%")
                ->orderBy("id")
                ->paginate(5, ['*'], 'page', $pageNumber);
        } else {

            $students = Student::with('class')
                ->where('student_name', 'LIKE', "%$name%")
                ->orderBy("student_name")
                ->paginate(5, ['*'], 'page', $pageNumber);
        }

        return view('students.table', compact('students'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::all();
        return view('students.create', compact('classes'));
    }

    public function store(StoreStudentRequest $request)
    {
        // //Store validated arguments into data array
        $data = $request->validated();

        // Check if student's parent exists in the database or create one
        $data["parent_id"] = RegisterationService::getStudentParent($data);

        //Upload Student Image And return Image name
        $data["student_photo"] = FileUploadService::handleImage($request->file("student_photo"), 'student');

        ///Generate Student Account
        $data['user_id'] = RegisterationService::createUserAcount('student');

        // Store student data in students table
        $student = Student::create($data);

        ///Additional Data For Ajax
        $data["student_class"] = $student->class->class_name;
        $data["id"] = $student->id;

        return JsonService::responseSuccess("تم اضافة الطالب بنجاح", $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {

        //$student->load(['user', 'class', 'parent', 'parent.students' => fn($query) => $query->where('students.id','!=',$student->id)]);
        $student->load(['user', 'class', 'parent']);
        //$siblings = $student->parent?->students;
        $siblings = $student->siblings();
        return view('students.show', compact('student', 'siblings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $classes = Classes::all();

        return view("students.edit", compact("classes", "student"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {


        // //Store validated arguments into data array
        $data = $request->validated();

        //Update Parent
        $parent = Parents::find($student->parent_id);
        $parent->update($data);

        ///Get Parent Id
        $data["parent_id"] = $parent->id;


        //Upload Student Image And return Image name
        $data["student_photo"] = FileUploadService::updateImage($request->file("student_photo"), $student->student_photo, 'student');

        // Update student
        $student->update($data);


        ///Additional Data For Ajax
        $data["student_class"] = $student->class->class_name;
        $data["id"] = $student->id;

        return JsonService::responseSuccess("تم الحفظ بنجاح", $data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //FileUploadService::deleteImage($student->student_photo);

        $data = $student;
        $student->user()->delete();
        $student->delete();

        return JsonService::responseSuccess("تم حذف الطالب بنجاح", $data);
    }

    public function destroyAll(Request $request)
    {

        User::join("students", "users.id", "=", "students.user_id")->delete();

        Student::whereNotNull("id")->delete();

        return JsonService::responseSuccess("تم حذف جميع الطلاب بنجاح", null);
    }
}

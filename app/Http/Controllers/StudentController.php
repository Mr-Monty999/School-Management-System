<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Classes;
use App\Models\Parents;
use App\Models\Student;
use App\Models\User;
use App\Services\FileUploadService;
use App\Services\RegisterationService;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $classes = Classes::all();


        // Get all users have relationship with students table with their class
        // $students = User::has('student')->with('student', 'student.class')->get();

        ///Get All Students From Latest
        $students = Student::latest()->paginate(5);

        return view("students.index", compact('classes', 'students'));
    }


    public function store(StudentRequest $request, RegisterationService $registerationService, FileUploadService $fileUploadService)
    {
        // //Store validated arguments into data array
        $data = $request->validated();

        //Check If Student Exist
        if (Student::where("student_name", $request->student_name)->exists())
            return response()->json(["success" => false, "message" => "هذا الطالب موجود بالفعل"]);


        //Check If Parent Exist
        $parent = Parents::where("parent_name", $request->parent_name);

        if (!$parent->exists()) {
            //Store New Parent
            $parent = Parents::create($data);
        } else {
            ///Get Existing Parent
            $parent = $parent->first();
        }

        ///Get Parent Id
        $data["parent_id"] = $parent->id;


        //Upload Student Image And return Image name
        $data["student_photo"] = $fileUploadService->handleStudentImage($request->file("student_photo"));

        // Store student data in students table
        $student = Student::create($data);

        ///Generate Student Account
        $registerationService->createUserAcount("student", $student->id);



        ///Additional Data For Ajax
        $data["student_class"] = $student->class->class_name;
        $data["id"] = $student->id;

        return response()->json(["success" => true, "message" => "تم اضافة الطالب بنجاح", "data" => $data]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        // Load student relationships
        $student->load('user', 'class', 'parent');

        return view('students.show', compact('student'));
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
    public function update(StudentRequest $request, Student $student, RegisterationService $registerationService, FileUploadService $fileUploadService)
    {


        /////////////////Not Finished Yet ! /////////////////////////


        // //Store validated arguments into data array
        $data = $request->validated();

        //Check If Student Exist
        $existStudent = Student::where("student_name", $request->student_name);
        if ($existStudent->exists() && $data["student_name"] == $student->student_name)
            return response()->json(["success" => false, "message" => "اسم هذا الطالب موجود بالفعل"]);


        //Update Parent
        $parent = Parent::where("parent_name", $student->parent_name)->first();

        $parent->update($data);


        ///Get Parent Id
        $data["parent_id"] = $parent->id;


        //Upload Student Image And return Image name
        $data["student_photo"] = $fileUploadService->handleStudentImage($request->file("student_photo"));

        // Update student
        $student->update($data);




        ///Additional Data For Ajax
        $data["student_class"] = $student->class->class_name;
        $data["id"] = $student->id;

        return response()->json(["success" => true, "message" => "تم الحفظ بنجاح", "data" => $data]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return back()->with("success", "تم حذف الطالب بنجاح");
    }
}

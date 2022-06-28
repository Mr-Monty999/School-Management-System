<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Classes;
use App\Models\Parents;
use App\Models\Student;
use App\Models\User;
use App\Services\FileUploadService;
use App\Services\RegisterationService;
use Illuminate\Http\Request;

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
        $students = Student::latest()->paginate(1);

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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}

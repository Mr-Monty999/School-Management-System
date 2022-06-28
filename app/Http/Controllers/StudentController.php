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
        $students = User::has('student')->with('student','student.class')->get();

        return view("students.index",compact('classes','students'));
    }


    public function store(StudentRequest $request , RegisterationService $registerationService , FileUploadService $fileUploadService)
    {
        //Store validated arguments into data array
        $data = $request->validated();

        // Store student's parent data in Parents table
        $parent = Parents::create($request->validated());
        // Add parent_id foreign key to data array
        $data['parent_id'] = $parent->id;
        // Add image path to data array

        /*
            Note:
                Follow the service class (FileUploadService) to fix student image issues
        */
        $data['student_photo'] = $fileUploadService->handleStudentImage($request->student_photo);

        // Store student data in students table
        $student = Student::create($data);
        // Create username and password for student
        $registerationService->createUserAcount('student',$student->id);

        return redirect()->route('students.index')->with(['success' => 'تم حفظ بيانات الطالب بنجاح']);
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
        $student->load('user','class','parent');

        return view('students.show',compact('student'));
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

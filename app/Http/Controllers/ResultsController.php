<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Result;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->hasRole('student')) {
            return redirect()->route('results.getStudentResult');
        }
        $classes = Classes::all();

        if(auth()->user()->hasRole('teacher')) {
            $teacher = Teacher::find(auth()->user()->teacher_id);
            $classes = $teacher->classes;
        }

        return view('results.index',compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $result)
    {
        $result->load('students.results.subject');

        return view('results.show',['class' => $result]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Result $result)
    {
        $result->delete();
        return back();
    }


    public function showResult(Student $student)
    {
        if(auth()->user()->hasRole('teacher')) {
            $teacher = Teacher::find(auth()->user()->teacher_id);
            $ids = $teacher->subjects()->pluck('id')->toArray();
            $student->load(['results','results.subject','results.teacher:id,teacher_name','class.subjects' => fn($q) => $q->findMany($ids)]);
        } else {
            $student->load('results','results.subject','results.teacher:id,teacher_name','class.subjects');
        }

        return view('results.results',compact('student'));
    }


    public function assignResult(Request $request , Student $student) {
        Result::updateOrCreate(['subject_id' => $request->subject_id],[
            'student_id' => $student->id,
            'subject_id' => $request->subject_id,
            'result' => $request->result,
            'full_mark' => $request->full_mark,
        ]);
        return back();
    }


    public function getStudentResults() {
        $student_id = auth()->user()->student_id;
        $results = Result::with('subject.teachers')->where('student_id',$student_id)->get();
        $student = Student::find($student_id);

        return view('results.studentResult',compact('results','student'));
    }
}

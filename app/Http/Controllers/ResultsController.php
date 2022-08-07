<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Result;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResultsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->type == 'student') {
            return redirect()->route('results.getStudentResult');
        }

        if(Auth::user()->type == 'teacher') {
            $classes = Auth::user()->teacher->classes;
        }
        else {
            $classes = Classes::all();
        }
        return view('results.index',compact('classes'));
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
        if(Auth::user()->type == 'teacher') {

            $teacher = Auth::user()->teacher;
            $ids = $teacher->subjects()->pluck('id')->toArray();
            $student->load(['results.subject','results.teacher:id,teacher_name','class.subjects' => fn($q) => $q->findMany($ids)]);
        }
        else {
            $student->load('results.subject','results.teacher:id,teacher_name','class.subjects');
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

        $student = Student::where('user_id',Auth::id())->first();

        $results = Result::with('subject.teachers')->where('student_id',$student->id)->get();

        return view('results.studentResult',compact('results','student'));
    }
}

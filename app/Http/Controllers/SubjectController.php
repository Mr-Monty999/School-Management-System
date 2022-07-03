<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::with('teachers','class')->get();
        $classes = Classes::all();
        $teachers = Teacher::all();
        return view("subjects.index",compact('subjects','classes','teachers'));
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
    public function store(StoreSubjectRequest $request)
    {
        $subject = Subject::create($request->validated());

        if($request->teachers) {
            $teachers = explode(',',$request->teachers);

            foreach($teachers as $teacher) {
                $subject->teachers()->attach($teacher);
            }
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        $subject->load('class','teachers');
        $teachers = Teacher::all()->except($subject->teachers->pluck('id')->toArray());

        return view('subjects.show',compact('subject','teachers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $subject->load('teachers','class');
        $classes = Classes::all();
        $teachers = Teacher::all();

        return view('subjects.edit',compact('subject','classes','teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSubjectRequest $request, Subject $subject)
    {
        $subject->update($request->validated());

        if($request->teachers) {
            $teachers = explode(',',$request->teachers);

            foreach($teachers as $teacher) {
                $subject->teachers()->sync($teacher);
            }
        }
        return redirect()->route('subjects.show',$subject);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return back();
    }


    public function detachTeacher(Request $request , Subject $subject) {
        $ids = explode(',',$request->teachers);

        $subject->teachers()->detach($ids);

        return back();
    }

    public function attachTeacher(Request $request , Subject $subject) {
        $ids = explode(',',$request->teachers);

        $subject->teachers()->attach($ids);

        return back();
    }
}

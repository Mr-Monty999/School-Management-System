<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Teacher;
use App\Services\JsonService;
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
        $subjects = Subject::with('teachers', 'class')->latest()->paginate(5);
        $classes = Classes::all();
        $teachers = Teacher::all();
        return view("subjects.index", compact('subjects', 'classes', 'teachers'));
    }

    public function table($pageNumber)
    {
        $subjects = Subject::with('teachers', 'class')->latest()->paginate(5, ['*'], 'page', $pageNumber);
        $classes = Classes::all();
        $teachers = Teacher::all();
        return view("subjects.table", compact('subjects', 'classes', 'teachers'));
    }


    public function search($pageNumber, $name)
    {
        /* str_replace(
            ['\\','%','_'],
            ['\\\\','\%','\_'],
            $name
        ); */

        $subjects = Subject::with('teachers', 'class')->where("subject_name", "LIKE", "%$name%")->latest()->paginate(5, ['*'], 'page', $pageNumber);
        $classes = Classes::all();
        $teachers = Teacher::all();
        return view("subjects.table", compact('subjects', 'classes', 'teachers'));
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

        if ($request->teachers) {
            $teachers = explode(',', $request->teachers);

            foreach ($teachers as $teacher) {
                $subject->teachers()->attach($teacher);
            }
        }
        return JsonService::responseSuccess("تم الاضافة بنجاح !", $request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        $subject->load('class', 'teachers');
        $teachers = Teacher::all()->except($subject->teachers->pluck('id')->toArray());

        return view('subjects.show', compact('subject', 'teachers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {

        $subject->load('teachers', 'class');



        ///Get Teachers Ids Related To Subject
        $teacherIds = [];
        foreach ($subject->teachers as $key => $value) {
            $teacherIds[] = $value["id"];
        }

        $classes = Classes::all();
        $teachers = Teacher::all();

        return view('subjects.edit', compact('subject', 'classes', 'teachers', 'teacherIds'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectRequest $request, Subject $subject)
    {



        $subject->update($request->validated());
        $tempArr = [];

        if ($request->teachers) {
            $teachers = explode(',', $request->teachers);


            foreach ($teachers as $teacher)
                $tempArr[] = $teacher;


            $subject->teachers()->sync($tempArr);
        }

        if (count($tempArr) < 1)
            $subject->teachers()->detach();

        return JsonService::responseSuccess("تم التعديل بنجاح !", $tempArr);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $data = $subject;
        $subject->delete();

        return JsonService::responseSuccess('تم الحذف بنجاح', $data);
    }


    public function detachTeacher(Request $request, Subject $subject)
    {
        $ids = explode(',', $request->teachers);

        $subject->teachers()->detach($ids);

        return back();
    }

    public function attachTeacher(Request $request, Subject $subject)
    {
        $ids = explode(',', $request->teachers);

        $subject->teachers()->attach($ids);

        return back();
    }
}

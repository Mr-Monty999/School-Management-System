<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSubjectRequest;
use App\Http\Requests\UpdateSubjectRequest;
use App\Models\Classes;
use App\Models\Subject;
use App\Models\Teacher;
use App\Services\JsonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::with('class')->withCount('teachers')->orderBy("id", "desc")->paginate(5);
        return view("subjects.index", compact('subjects'));
    }




    public function table($pageNumber, $sortBy, $name = "")
    {

        /* str_replace(
            ['\\','%','_'],
            ['\\\\','\%','\_'],
            $name
        ); */

        $name = trim($name);
        $subjects = null;

        if ($sortBy == "last") {
            $subjects = Subject::with('class')->withCount('teachers')->where("subject_name", "LIKE", "%$name%")->orderBy("id", "desc")
                ->paginate(5, ['*'], 'page', $pageNumber);
        } elseif ($sortBy == "first") {
            $subjects = Subject::with('class')->withCount('teachers')->where("subject_name", "LIKE", "%$name%")->orderBy("id")
                ->paginate(5, ['*'], 'page', $pageNumber);
        } else {
            $subjects = Subject::with('class')->withCount('teachers')->where("subject_name", "LIKE", "%$name%")->orderBy("subject_name")->paginate(5, ['*'], 'page', $pageNumber);
        }
        return view("subjects.table", compact('subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $classes = Classes::all();
        $teachers = Teacher::all();

        return view('subjects.create', compact('classes', 'teachers'));
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
            $subject->teachers()->attach($teachers);
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
        if ($request->teachers) {
            $teachers = is_array($request->teachers) ? $request->teachers :  explode(',', $request->teachers);
            $subject->teachers()->sync($teachers);
        }
        return JsonService::responseSuccess("تم التعديل بنجاح !", $subject);
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
        $teachers =  is_array($request->teachers) ? $request->teachers :  explode(',', $request->teachers);

        $subject->teachers()->detach($teachers);

        return back();
    }

    public function attachTeacher(Request $request, Subject $subject)
    {
        $teachers = is_array($request->teachers) ? $request->teachers :  explode(',', $request->teachers);

        $subject->teachers()->attach($teachers);

        return back();
    }
}

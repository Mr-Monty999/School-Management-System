<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSubjectToClassRequest;
use App\Http\Requests\StoreClassRequest;
use App\Http\Requests\UpdateClassRequest;
use App\Models\Classes;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Services\JsonService;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $classes = Classes::paginate(5);
        return view("classes.index", compact('classes'));
    }



    public function table($pageNumber, $sortBy, $name = "")
    {
        /* str_replace(
            ['\\','%','_'],
            ['\\\\','\%','\_'],
            $name
        ); */

        $name = trim($name);
        $classes = null;

        if ($sortBy == "last") {
            $classes = Classes::where("class_name", "LIKE", "%$name%")->orderBy("id", "desc")->paginate(5, ['*'], 'page', $pageNumber);
        } elseif ($sortBy == "first") {
            $classes = Classes::where("class_name", "LIKE", "%$name%")->orderBy("id")->paginate(5, ['*'], 'page', $pageNumber);
        } else {
            $classes = Classes::where("class_name", "LIKE", "%$name%")->orderBy("class_name")->paginate(5, ['*'], 'page', $pageNumber);
        }
        return view("classes.table", compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreClassRequest $request)
    {
        $data = $request->validated();
        Classes::create($data);
        return JsonService::responseSuccess('تم اضافة الفصل بنجاح', $data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function show(Classes $class)
    {
        $class->load('subjects.teachers', 'students');
        $classes = Classes::all()->except($class->id);
        $teachers = Teacher::all();
        return view('classes.show', compact('class', 'classes', 'teachers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function edit(Classes $class)
    {
        return view('classes.edit', compact('class'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateClassRequest $request, Classes $class)
    {
        $data = $request->validated();
        $class->update($data);
        return JsonService::responseSuccess('تم الحفظ بنجاح', $class);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classes  $classes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $class)
    {
        $data = $class;
        $class->delete();

        return JsonService::responseSuccess('تم حذف الفصل بنجاح', $data);
    }


    public function changeStudentClass(Request $request)
    {
        $ids = is_array($request->ids) ? $request->ids : explode(',', $request->ids);
        $students = Student::findMany($ids);

        foreach ($students as $student) {
            $student->update(['class_id' => $request->class_id]);
        }
        return back();
    }

    public function addSubjectToClass(AddSubjectToClassRequest $request)
    {
        $subject = Subject::firstOrCreate([
            'subject_name'  => $request->subject_name,
            'class_id'      => $request->class_id
        ]);

        if ($request->teachers) {
            $teachers = is_array($request->teachers) ? $request->teachers : explode(',', $request->teachers);
            $subject->teachers()->sync($teachers);
        }

        return back();
    }
}

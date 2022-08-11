<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Models\Teacher;
use App\Models\User;
use App\Services\FileUploadService;
use App\Services\JsonService;
use App\Services\RegisterationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::with("subjects")->orderBy("id", "desc")->paginate(5);
        return view("teachers.index", compact('teachers'));
    }



    public function table($pageNumber, $sortBy, $name = "")
    {

        $name = trim($name);
        $teachers = null;

        if ($sortBy == "last") {
            $teachers = Teacher::with("subjects")->where("teacher_name", "LIKE", "%$name%")->orderBy("id", "desc")
                ->paginate(5, ['*'], 'page', $pageNumber);
        } elseif ($sortBy == "first") {
            $teachers = Teacher::with("subjects")->where("teacher_name", "LIKE", "%$name%")->orderBy("id")
                ->paginate(5, ['*'], 'page', $pageNumber);
        } else {
            $teachers = Teacher::with("subjects")->where("teacher_name", "LIKE", "%$name%")->orderBy("teacher_name")->paginate(5, ['*'], 'page', $pageNumber);
        }
        return view("teachers.table", compact('teachers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTeacherRequest $request)
    {
        $data = $request->validated();

        $data['teacher_photo'] = FileUploadService::handleImage($request->file('teacher_photo'), 'teacher');

        $data['user_id'] = RegisterationService::createUserAcount("teacher");

        $teacher = Teacher::create($data);

        return JsonService::responseSuccess("تم اضافة المعلم بنجاح", $teacher);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function show(Teacher $teacher)
    {
        $teacher->load('subjects.class', 'user');
        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTeacherRequest $request, Teacher $teacher)
    {
        //dd(time() . "." . $request->file('teacher_photo')->getClientOriginalExtension();
        //return JsonService::responseSuccess(public_path("images/teacher/"), $teacher);

        $data = $request->validated();
        // Replace old image with uploaded one if any
        $data['teacher_photo'] = FileUploadService::updateImage($request->file('teacher_photo'), $teacher->teacher_image, 'teacher');

        $teacher->update($data);

        return JsonService::responseSuccess("تم حذف المعلم بنجاح", $teacher);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Teacher  $teacher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Teacher $teacher)
    {
        //FileUploadService::deleteImage($teacher->teacher_photo);

        $data = $teacher;
        $teacher->user()->delete();
        $teacher->delete();

        return JsonService::responseSuccess("تم حذف المعلم بنجاح", $data);
    }

    public function destroyAll(Request $request)
    {

        User::join("teachers", "users.id", "=", "teachers.user_id")->delete();

        Teacher::whereNotNull("id")->delete();

        return JsonService::responseSuccess("تم حذف جميع المعلمين بنجاح", null);
    }
}

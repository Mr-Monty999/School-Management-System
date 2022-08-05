<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employe;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Services\FileUploadService;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with(['employe' => fn($q) => $q->withTrashed('employe')])->onlyTrashed()->get();
        return view('archive.index');
    }

    public function showEmployees()
    {
        $employees = Employe::onlyTrashed()->paginate(5);

        //dd($employees);

        return view('archive.employees',compact('employees'));
    }

    public function showTeachers()
    {
        $teachers = Teacher::onlyTrashed()->paginate(5);

        return view('teachers.index',compact('teachers'));
    }

    public function showStudents()
    {
        $students = Student::onlyTrashed()->paginate(5);

        return view('students.index',compact('students'));
    }

    public function destroyEmploye(Employe $employe) {

        FileUploadService::deleteImage(public_path($employe["employe_photo"]));

        $employe->user()->forceDelete();
        $employe->forceDelete();

        return back();

    }
}

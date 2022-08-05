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
        $users = User::with(['employe' => fn($q) => $q->withTrashed('employe'),
        'teacher' => fn($q) => $q->withTrashed('teacher'),
        'student' => fn($q) => $q->withTrashed('student')
        ])
        ->onlyTrashed()
        ->paginate(5);

        return view('archive.index',compact('users'));
    }


    public function destroy(User $user) {

        if($user->type == 'employe') {
            $employe = $user->employe()->withTrashed()->first();
            FileUploadService::deleteImage(public_path($employe->employe_photo));
            $employe->forceDelete();
        }
        elseif($user->type == 'teacher') {
            $teacher = $user->teacher()->withTrashed()->first();
            FileUploadService::deleteImage(public_path($teacher->teacher_photo));
            $teacher->forceDelete();
        }
        else {
            $student = $user->student()->withTrashed()->first();
            FileUploadService::deleteImage(public_path($student->student_photo));
            $student->forceDelete();
        }
        $user->forceDelete();

        return back();
    }
}

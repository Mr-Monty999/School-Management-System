<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Employe;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Services\FileUploadService;
use App\Services\JsonService;

class ArchiveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with("employe", "teacher", "student")
        ->onlyTrashed()
        ->paginate(5);

        //$users = User::with("employe", "teacher", "student")->onlyTrashed()->paginate(5);
        return view('archive.index', compact('users'));
    }

    public function table($pageNumber)
    {

        $users = User::with("employe", "teacher", "student")
        ->onlyTrashed()
        ->paginate(5, ['*'], 'page', $pageNumber);

        //$users = User::with("employe", "teacher", "student")->onlyTrashed()->paginate(5, ['*'], 'page', $pageNumber);

        return view('archive.table', compact('users'));
    }
    public function search($pageNumber, $name)
    {
        $users = User::with("employe", "teacher", "student")
        ->onlyTrashed()
        ->where("username", "LIKE", "%$name%")
        ->paginate(5);

        //$users = User::with("employe", "teacher", "student")->where("username", "LIKE", "%$name%")->onlyTrashed()->paginate(5);

        return view('archive.table', compact('users'));
    }

    public function restore(User $user)
    {
        if ($user->type == 'employe') {
            $user->employe->restore();

        } elseif ($user->type == 'teacher') {
            $user->teacher->restore();

        } elseif($user->type == 'student') {
            $user->student->restore();
        }

        $user->restore();
        return back();
    }

    public function destroy(User $user)
    {
        if ($user->type == 'employe') {
            FileUploadService::deleteImage(public_path($user->employe->employe_photo));

        } elseif ($user->type == 'teacher') {

            FileUploadService::deleteImage(public_path($user->teacher->teacher_photo));

        } elseif($user->type == 'student') {

            FileUploadService::deleteImage(public_path($user->student->student_photo));
        }





        /*
        Note:

        When You Delete User Parmently, The Related Data Also Will Be Deleted

        */


        /* if ($user->hasRole("employe") == 'employe')
            FileUploadService::deleteImage(public_path($user->employe()->onlyTrashed()->first()->employe_photo));
        elseif ($user->hasRole("teacher"))
            FileUploadService::deleteImage(public_path($user->teacher()->onlyTrashed()->first()->teacher_photo));
        else
            FileUploadService::deleteImage(public_path($user->student()->onlyTrashed()->first()->student_photo));
 */
        $user->forceDelete();


        return JsonService::responseSuccess("تم الحذف بنجاح", $user);
    }
}

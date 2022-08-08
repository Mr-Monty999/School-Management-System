<?php

namespace App\Http\Controllers;

use App\Models\User;
<<<<<<< HEAD
=======
use App\Models\Employe;
use App\Models\Parents;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
>>>>>>> 31d45a712c422ede1a77c940ac1bbeb06cdbfcbb
use App\Services\FileUploadService;
use App\Services\JsonService;
use Nette\Utils\Json;

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

        return view('archive.index', compact('users'));
    }

    public function table($pageNumber)
    {
        $users = User::with("employe", "teacher", "student")
            ->onlyTrashed()
            ->paginate(5, ['*'], 'page', $pageNumber);

        return view('archive.table', compact('users'));
    }
    public function search($pageNumber, $name)
    {
        $users = User::with("employe", "teacher", "student")
<<<<<<< HEAD
        ->whereHas('employe',function($q) use($name) {
            $q->where('employe_name','LIKE',"%$name%")->onlyTrashed();
        })
        ->orWhereHas('teacher',function($q) use($name) {
            $q->where('teacher_name','LIKE',"%$name%")->onlyTrashed();
        })
        ->orWhereHas('student',function($q) use($name) {
            $q->where('student_name','LIKE',"%$name%")->onlyTrashed();
        })
        ->onlyTrashed()
        ->paginate(5);
=======
            ->onlyTrashed()
            ->where("username", "LIKE", "%$name%")
            ->paginate(5, ['*'], 'page', $pageNumber);

        //$users = User::with("employe", "teacher", "student")->where("username", "LIKE", "%$name%")->onlyTrashed()->paginate(5);
>>>>>>> 31d45a712c422ede1a77c940ac1bbeb06cdbfcbb

        return view('archive.table', compact('users'));
    }

    public function restore(User $user)
    {
        $type = $user->type;
        $user->$type->restore();

        $user->restore();
        return JsonService::responseSuccess("تم الإستعادة بنجاح", $user);
    }

    public function restoreAll(Request $request)
    {
        User::onlyTrashed()->restore();
        Employe::onlyTrashed()->restore();
        Teacher::onlyTrashed()->restore();
        Student::onlyTrashed()->restore();
        Parents::onlyTrashed()->restore();


        return JsonService::responseSuccess("تم الإسترجاع بنجاح", null);
    }

    public function destroyAll(Request $request)
    {
        User::onlyTrashed()->forceDelete();
        return JsonService::responseSuccess("تم الحذف بنجاح", null);
    }

    public function destroy(User $user)
    {
        $type = $user->type;
        FileUploadService::deleteImage(public_path($user->$type->$type.'_photo'));

<<<<<<< HEAD
=======
            FileUploadService::deleteImage(public_path($user->teacher->teacher_photo));
        } elseif ($user->type == 'student') {

            FileUploadService::deleteImage(public_path($user->student->student_photo));
        }





        /*
        Note:

        When You Delete User Parmently, The Related Data Also Will Be Deleted Auto

        */


        /* if ($user->hasRole("employe") == 'employe')
            FileUploadService::deleteImage(public_path($user->employe()->onlyTrashed()->first()->employe_photo));
        elseif ($user->hasRole("teacher"))
            FileUploadService::deleteImage(public_path($user->teacher()->onlyTrashed()->first()->teacher_photo));
        else
            FileUploadService::deleteImage(public_path($user->student()->onlyTrashed()->first()->student_photo));
 */
>>>>>>> 31d45a712c422ede1a77c940ac1bbeb06cdbfcbb
        $user->forceDelete();
        return JsonService::responseSuccess("تم الحذف بنجاح", $user);
    }
}

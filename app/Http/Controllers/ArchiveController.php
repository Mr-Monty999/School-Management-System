<?php

namespace App\Http\Controllers;

use App\Models\User;
use Nette\Utils\Json;
use App\Models\Employe;
use App\Models\Parents;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Services\JsonService;
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
        $users = User::with("employe", "teacher", "student")
            ->onlyTrashed()
            ->paginate(5);

        return view('archive.index', compact('users'));
    }


    public function table($pageNumber, $viewBy, $name = "")
    {
        $name = trim($name);
        $users = null;

        if ($viewBy == "all") {
            $users = User::with("employe", "teacher", "student")
                ->whereHas('employe', function ($q) use ($name) {
                    $q->where('employe_name', 'LIKE', "%$name%")->onlyTrashed();
                })
                ->orWhereHas('teacher', function ($q) use ($name) {
                    $q->where('teacher_name', 'LIKE', "%$name%")->onlyTrashed();
                })
                ->orWhereHas('student', function ($q) use ($name) {
                    $q->where('student_name', 'LIKE', "%$name%")->onlyTrashed();
                })
                ->onlyTrashed()
                ->paginate(5, ['*'], 'page', $pageNumber);
        } elseif ($viewBy == "students") {
            $users = User::with("student")
                ->whereHas('student', function ($q) use ($name) {
                    $q->where('student_name', 'LIKE', "%$name%")->onlyTrashed();
                })->onlyTrashed()->paginate(5, ['*'], 'page', $pageNumber);
        } elseif ($viewBy == "employees") {
            $users = User::with("employe")
                ->whereHas('employe', function ($q) use ($name) {
                    $q->where('employe_name', 'LIKE', "%$name%")->onlyTrashed();
                })->onlyTrashed()->paginate(5, ['*'], 'page', $pageNumber);
        } else {

            $users = User::with("teacher")
                ->whereHas('teacher', function ($q) use ($name) {
                    $q->where('teacher_name', 'LIKE', "%$name%")->onlyTrashed();
                })->onlyTrashed()->paginate(5, ['*'], 'page', $pageNumber);
        }

        return view('archive.table', compact('users'));
    }

    public function restore(User $user)
    {
        $type = $user->type;
        $user->$type->restore();

        $user->restore();
        return JsonService::responseSuccess("تم الإستعادة بنجاح", $user);
    }

    public function restoreAll()
    {
        User::onlyTrashed()->restore();
        Employe::onlyTrashed()->restore();
        Teacher::onlyTrashed()->restore();
        Student::onlyTrashed()->restore();
        Parents::onlyTrashed()->restore();


        return JsonService::responseSuccess("تم الإسترجاع بنجاح", null);
    }

    public function destroyAll()
    {
        User::onlyTrashed()->forceDelete();
        return JsonService::responseSuccess("تم الحذف بنجاح", null);
    }

    public function destroy(User $user)
    {
        $type = $user->type;
        FileUploadService::deleteImage(public_path($user->$type->$type . '_photo'));

        $user->forceDelete();
        return JsonService::responseSuccess("تم الحذف بنجاح", $user);
    }
}

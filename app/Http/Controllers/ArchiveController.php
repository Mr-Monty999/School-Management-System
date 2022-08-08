<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        return view('archive.table', compact('users'));
    }

    public function restore(User $user)
    {
        $type = $user->type;
        $user->$type->restore();

        $user->restore();
        return JsonService::responseSuccess("تم الإستعادة بنجاح", $user);
    }

    public function destroy(User $user)
    {
        $type = $user->type;
        FileUploadService::deleteImage(public_path($user->$type->$type.'_photo'));

        $user->forceDelete();
        return JsonService::responseSuccess("تم الحذف بنجاح", $user);
    }
}

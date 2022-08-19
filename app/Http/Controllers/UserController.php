<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:admin.view',['only' => 'index' , 'table' , 'search']);
        $this->middleware('permission:admin.edit',['only' => 'edit','update']);
    }

    public function index()
    {
        $users = User::has('student')->orHas('teacher')->orHas('employe')->paginate(5);

        return view("users.index", compact('users'));
    }

    public function table($pageNumber)
    {
        $users = User::has('student')->orHas('teacher')->orHas('employe')->paginate(5, ["*"], "page", $pageNumber);

        return view("users.table", compact('users'));
    }

    public function search($pageNumber, $name)
    {
        $users = User::whereHas('student',fn($q) => $q->where('student_name','LIKE',"%$name%"))
        ->orWhereHas('teacher',fn($q) => $q->where('teacher_name','LIKE',"%$name%"))
        ->orWhereHas('employe',fn($q) => $q->where('employe_name','LIKE',"%$name%"))
        ->orWhere('username','LIKE',"%$name%")
        ->paginate(5, ["*"], "page", $pageNumber);

        return view("users.table", compact('users'));
    }


    public function edit(User $user)
    {
        $roles = Role::all();

        $user_roles = $user->roles?->pluck('id')->toArray();
        return view('users.edit', compact('roles', 'user', 'user_roles'));
    }

    public function update(Request $request, User $user)
    {
        $roles = is_array($request->role) ? $request->role : explode(',', $request->role);

        $user->syncRoles($roles);
        return redirect()->route('users.index');
    }

}

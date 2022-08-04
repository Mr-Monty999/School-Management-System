<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        /// Not Finished
        $users = User::has('student')->orHas('teacher')->orHas('employe')->paginate(5, ["*"], "page", $pageNumber);

        return view("users.table", compact('users'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $type : presents the user type as [student,teacher,employe,admin]
     * @return \Illuminate\Http\Response
     */
    public function show($type)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        $user_role = $user->roles[0]->id ?? null;
        return view('users.edit', compact('roles', 'user', 'user_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->syncRoles($request->role);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

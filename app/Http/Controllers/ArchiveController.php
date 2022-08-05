<?php

namespace App\Http\Controllers;

use App\Models\Employe;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

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

    public function showEmployees($type)
    {
        $employees = Employe::with(['user' => fn($q) => $q->withTrashed('user')])
        ->onlyTrashed()
        ->get();

        $type = 'employe';

        return view('archive.show',compact('employees','type'));
    }

    public function showTeacher()
    {
        $teachers = Teacher::with(['user' => fn($q) => $q->withTrashed('user')])
        ->onlyTrashed()
        ->get();

        $type = 'teacher';

        return view('archive.show',compact('teachers','type'));
    }

    public function showStudent($type)
    {
        $employees = Employe::with(['user' => fn($q) => $q->withTrashed('user')])
        ->onlyTrashed()
        ->get();

        $type = 'employe';

        return view('archive.show',compact('employees','type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

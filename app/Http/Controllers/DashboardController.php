<?php

namespace App\Http\Controllers;

use App\Http\Requests\DashboardRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Classes;
use App\Models\Employe;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{



    public function index()
    {
        $students = Student::count();
        $teachers = Teacher::count();
        $employees = Employe::count();
        $classes = Classes::count();
        //dd($students,$teachers,$employees,$classes);
        return view('dashboard',compact('students','teachers','employees','classes'));
    }

    public function login()
    {
        return view("login");
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route("dashboard.login");
    }

    public function loginAttempt(LoginRequest $request)
    {

        //Check Login Inputs From User

        $input = $request->only("username", "password");

        if (Auth::attempt($input))
            return redirect()->route("dashboard.index");

        return redirect()->route("dashboard.login")->with("error", "الرجاء التحقق من البيانات !");
    }
}

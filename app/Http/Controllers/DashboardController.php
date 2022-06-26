<?php

namespace App\Http\Controllers;

use App\Http\Requests\DashboardRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{

    public function dashboard()
    {
        return view("dashboard");
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

        $input = $request->only("name", "password");

        if (Auth::attempt($input))
            return redirect()->route("dashboard.index");

        return redirect()->route("dashboard.login")->with("error", "الرجاء التحقق من البيانات !");
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\DashboardRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
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

    public function loginAttempt(LoginRequest $request)
    {
    }
}

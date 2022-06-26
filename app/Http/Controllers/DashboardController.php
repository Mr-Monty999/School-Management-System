<?php

namespace App\Http\Controllers;

use App\Http\Requests\DashboardRequest;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardController extends Controller
{

    public function index()
    {
        return view("index");
    }

    public function login()
    {
        return view("login");
    }

    public function loginAttempt(DashboardRequest $request)
    {
    }
}

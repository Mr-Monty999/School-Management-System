<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web Routes for your application. These
| Routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

////  Login Routes  ////

/*
  Notes:

middlewares {
    owner => 5
    admin => 4
    employe => 3
    student => 2
    teacher => 1
}

*/


Route::group(["middleware" => "guest"], function () {
    Route::get("/login", [DashboardController::class, "login"])->name("dashboard.login");
    Route::post("/login/attempt", [DashboardController::class, "loginAttempt"])->name("dashboard.login.attempt");
});


////// All Routes /////
Route::group(["middleware" => "auth"], function () {


    /// Logout Route ///
    Route::get("/logout", [DashboardController::class, "logout"])->name("dashboard.logout");

    /// Owner Dashboard Route ///
    Route::get("/", [DashboardController::class, "index"])->name("dashboard.index");

    Route::resource('users', UserController::class)->middleware('role:Super-Admin');



    ////  Classes Routes  //////
    Route::resource('classes', ClassesController::class)->middleware('permission:class.view');



    ////  Employees Routes  //////
    Route::resource('employees', EmployeController::class)->middleware('permission:employe.view');


    ////  Jobs Routes  //////
    Route::resource('jobs', JobController::class);


    ////  Parents Routes  //////
    Route::resource('parents', ParentsController::class)->middleware('permission:student.view');;


    ////  School Routes  //////
    Route::resource('schools', SchoolController::class)->middleware('role:Super-Admin');

    ////  Students Routes  //////
    Route::resource('students', StudentController::class)->middleware('permission:student.view');;


    ////  Subjects Routes  //////
    Route::resource('subjects', SubjectController::class)->middleware('permission:subject.view');;


    ////  Teachers Routes  //////
    Route::resource('teachers', TeacherController::class)->middleware('permission:teacher.view');;


    ////  Privacy Routes  //////
    Route::resource('privacy', PrivacyController::class)->middleware('role:Super-Admin');
});

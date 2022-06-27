<?php

use App\Http\Controllers\ClassesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ParentsController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
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
    owner
    admin
    employe
    student
    teacher
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

    Route::group(["middleware" => "owner"], function () {

        /// Owner Dashboard Route ///
        Route::get("/", [DashboardController::class, "ownerDashboard"])->name("dashboard.owner");



        ////  Users Routes  //////
        /* Route::group(["prefix" => "users"], function () {
            Route::get("/", [UserController::class, "index"])->name("users.index");
            Route::get("/edit/{id}", [UserController::class, "edit"])->name("users.edit");
            Route::post("/store", [UserController::class, "store"])->name("users.store");
            Route::put("/update/{id}", [UserController::class, "update"])->name("users.update");
            Route::delete("/delete/{id}", [UserController::class, "destroy"])->name("users.delete");
        }); */

        Route::resource('users',UserController::class);



        ////  Classes Routes  //////
        /* Route::group(["prefix" => "classes"], function () {
            Route::get("/", [ClassesController::class, "index"])->name("classes.index");
            Route::get("/edit/{id}", [ClassesController::class, "edit"])->name("classes.edit");
            Route::post("/store", [ClassesController::class, "store"])->name("classes.store");
            Route::put("/update/{id}", [ClassesController::class, "update"])->name("classes.update");
            Route::delete("/delete/{id}", [ClassesController::class, "destroy"])->name("classes.delete");
        }); */

        Route::resource('classes',ClassController::class);



        ////  Employees Routes  //////
        /* Route::group(["prefix" => "employees"], function () {
            Route::get("/", [EmployeController::class, "index"])->name("employees.index");
            Route::get("/edit/{id}", [EmployeController::class, "edit"])->name("employees.edit");
            Route::post("/store", [EmployeController::class, "store"])->name("employees.store");
            Route::put("/update/{id}", [EmployeController::class, "update"])->name("employees.update");
            Route::delete("/delete/{id}", [EmployeController::class, "destroy"])->name("employees.delete");
        }); */

        Route::resource('employees',EmployeController::class);


        ////  Jobs Routes  //////
        /* Route::group(["prefix" => "jobs"], function () {
            Route::get("/", [JobController::class, "index"])->name("jobs.index");
            Route::get("/edit/{id}", [JobController::class, "edit"])->name("jobs.edit");
            Route::post("/store", [JobController::class, "store"])->name("jobs.store");
            Route::put("/update/{id}", [JobController::class, "update"])->name("jobs.update");
            Route::delete("/delete/{id}", [JobController::class, "destroy"])->name("jobs.delete");
        }); */

        Route::resource('jobs',JobController::class);


        ////  Parents Routes  //////
        /* Route::group(["prefix" => "parents"], function () {
            Route::get("/", [ParentsController::class, "index"])->name("parents.index");
            Route::get("/edit/{id}", [ParentsController::class, "edit"])->name("parents.edit");
            Route::post("/store", [ParentsController::class, "store"])->name("parents.store");
            Route::put("/update/{id}", [ParentsController::class, "update"])->name("parents.update");
            Route::delete("/delete/{id}", [ParentsController::class, "destroy"])->name("parents.delete");
        }); */

        Route::resource('parents',ParentsController::class);


        ////  School Routes  //////
        /* Route::group(["prefix" => "schools"], function () {
            Route::get("/", [SchoolController::class, "index"])->name("schools.index");
            Route::get("/edit/{id}", [SchoolController::class, "edit"])->name("schools.edit");
            Route::post("/store", [SchoolController::class, "store"])->name("schools.store");
            Route::put("/update/{id}", [SchoolController::class, "update"])->name("schools.update");
            Route::delete("/delete/{id}", [SchoolController::class, "destroy"])->name("schools.delete");
        }); */

        Route::resource('schools',SchoolController::class);


        ////  Students Routes  //////
        /* Route::group(["prefix" => "students"], function () {
            Route::get("/", [StudentController::class, "index"])->name("students.index");
            Route::get("/edit/{id}", [StudentController::class, "edit"])->name("students.edit");
            Route::post("/store", [StudentController::class, "store"])->name("students.store");
            Route::put("/update/{id}", [StudentController::class, "update"])->name("students.update");
            Route::delete("/delete/{id}", [StudentController::class, "destroy"])->name("students.delete");
        }); */

        Route::resource('students',StudentController::class);


        ////  Subjects Routes  //////
        /* Route::group(["prefix" => "subjects"], function () {
            Route::get("/", [SubjectController::class, "index"])->name("subjects.index");
            Route::get("/edit/{id}", [SubjectController::class, "edit"])->name("subjects.edit");
            Route::post("/store", [SubjectController::class, "store"])->name("subjects.store");
            Route::put("/update/{id}", [SubjectController::class, "update"])->name("subjects.update");
            Route::delete("/delete/{id}", [SubjectController::class, "destroy"])->name("subjects.delete");
        }); */

        Route::resource('subjects',SubjectController::class);


        ////  Teachers Routes  //////
        /* Route::group(["prefix" => "teachers"], function () {
            Route::get("/", [TeacherController::class, "index"])->name("teachers.index");
            Route::get("/edit/{id}", [TeacherController::class, "edit"])->name("teachers.edit");
            Route::post("/store", [TeacherController::class, "store"])->name("teachers.store");
            Route::put("/update/{id}", [TeacherController::class, "update"])->name("teachers.update");
            Route::delete("/delete/{id}", [TeacherController::class, "destroy"])->name("teachers.delete");
        }); */

        Route::resource('teachers',TeacherController::class);


        ////  Privacy Routes  //////
        /* Route::group(["prefix" => "privacy"], function () {
            Route::get("/", [PrivacyController::class, "index"])->name("privacy.index");
            Route::get("/edit/{id}", [PrivacyController::class, "edit"])->name("privacy.edit");
            Route::post("/store", [PrivacyController::class, "store"])->name("privacy.store");
            Route::put("/update/{id}", [PrivacyController::class, "update"])->name("privacy.update");
            Route::delete("/delete/{id}", [PrivacyController::class, "destroy"])->name("privacy.delete");
        }); */

        Route::resource('privacy',PrivacyController::class);
    });
});

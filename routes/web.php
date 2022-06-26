<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

////  Login Routes  ////

/*
  Notes:



*/


route::group(["middleware" => "guest"], function () {
    route::get("/login", "DashboardController@login")->name("dashboard.login");
    route::post("/login/attempt", "DashboardController@loginAttempt")->name("dashboard.login.attempt");
});


////// All Routes /////
route::group(["middleware" => "auth"], function () {


    /// Logout Route ///
    route::get("/logout", "DashboardController@logout")->name("dashboard.logout");


    /// Dashboard Route ///
    route::get("/", "DashboardController@dashboard")->name("dashboard.index");



    ////  Users Routes  //////
    Route::group(["prefix" => "users"], function () {
        Route::get("/", "UserController@index")->name("users.index");
        Route::get("/edit/{id}", "UserController@edit")->name("users.edit");
        Route::post("/store", "UserController@store")->name("users.store");
        Route::put("/update/{id}", "UserController@update")->name("users.update");
        Route::delete("/delete/{id}", "UserController@destroy")->name("users.delete");
    });





    ////  Classes Routes  //////
    Route::group(["prefix" => "classes"], function () {
        Route::get("/", "ClassesController@index")->name("classes.index");
        Route::get("/edit/{id}", "ClassesController@edit")->name("classes.edit");
        Route::post("/store", "ClassesController@store")->name("classes.store");
        Route::put("/update/{id}", "ClassesController@update")->name("classes.update");
        Route::delete("/delete/{id}", "ClassesController@destroy")->name("classes.delete");
    });




    ////  Employees Routes  //////
    Route::group(["prefix" => "employees"], function () {
        Route::get("/", "EmployeController@index")->name("employees.index");
        Route::get("/edit/{id}", "EmployeController@edit")->name("employees.edit");
        Route::post("/store", "EmployeController@store")->name("employees.store");
        Route::put("/update/{id}", "EmployeController@update")->name("employees.update");
        Route::delete("/delete/{id}", "EmployeController@destroy")->name("employees.delete");
    });




    ////  Jobs Routes  //////
    Route::group(["prefix" => "jobs"], function () {
        Route::get("/", "JobController@index")->name("jobs.index");
        Route::get("/edit/{id}", "JobController@edit")->name("jobs.edit");
        Route::post("/store", "JobController@store")->name("jobs.store");
        Route::put("/update/{id}", "JobController@update")->name("jobs.update");
        Route::delete("/delete/{id}", "JobController@destroy")->name("jobs.delete");
    });



    ////  Parents Routes  //////
    Route::group(["prefix" => "parents"], function () {
        Route::get("/", "ParentsController@index")->name("parents.index");
        Route::get("/edit/{id}", "ParentsController@edit")->name("parents.edit");
        Route::post("/store", "ParentsController@store")->name("parents.store");
        Route::put("/update/{id}", "ParentsController@update")->name("parents.update");
        Route::delete("/delete/{id}", "ParentsController@destroy")->name("parents.delete");
    });




    ////  School Routes  //////
    Route::group(["prefix" => "schools"], function () {
        Route::get("/", "SchoolController@index")->name("schools.index");
        Route::get("/edit/{id}", "SchoolController@edit")->name("schools.edit");
        Route::post("/store", "SchoolController@store")->name("schools.store");
        Route::put("/update/{id}", "SchoolController@update")->name("schools.update");
        Route::delete("/delete/{id}", "SchoolController@destroy")->name("schools.delete");
    });



    ////  Students Routes  //////
    Route::group(["prefix" => "students"], function () {
        Route::get("/", "StudentController@index")->name("students.index");
        Route::get("/edit/{id}", "StudentController@edit")->name("students.edit");
        Route::post("/store", "StudentController@store")->name("students.store");
        Route::put("/update/{id}", "StudentController@update")->name("students.update");
        Route::delete("/delete/{id}", "StudentController@destroy")->name("students.delete");
    });


    ////  Subjects Routes  //////
    Route::group(["prefix" => "subjects"], function () {
        Route::get("/", "SubjectController@index")->name("subjects.index");
        Route::get("/edit/{id}", "SubjectController@edit")->name("subjects.edit");
        Route::post("/store", "SubjectController@store")->name("subjects.store");
        Route::put("/update/{id}", "SubjectController@update")->name("subjects.update");
        Route::delete("/delete/{id}", "SubjectController@destroy")->name("subjects.delete");
    });


    ////  Teachers Routes  //////
    Route::group(["prefix" => "teachers"], function () {
        Route::get("/", "TeacherController@index")->name("teachers.index");
        Route::get("/edit/{id}", "TeacherController@edit")->name("teachers.edit");
        Route::post("/store", "TeacherController@store")->name("teachers.store");
        Route::put("/update/{id}", "TeacherController@update")->name("teachers.update");
        Route::delete("/delete/{id}", "TeacherController@destroy")->name("teachers.delete");
    });


    ////  Privacy Routes  //////
    Route::group(["prefix" => "privacy"], function () {
        Route::get("/", "PrivacyController@index")->name("privacy.index");
        Route::get("/edit/{id}", "PrivacyController@edit")->name("privacy.edit");
        Route::post("/store", "PrivacyController@store")->name("privacy.store");
        Route::put("/update/{id}", "PrivacyController@update")->name("privacy.update");
        Route::delete("/delete/{id}", "PrivacyController@destroy")->name("privacy.delete");
    });
});

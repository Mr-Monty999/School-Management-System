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

     admin middleware => If He is Not Auth redirect to login Panel

     admin.redirect middleware => If He is Auth redirect to dashboard Panel

*/

Route::group(["middleware" => "admin.redirect"], function () {
    route::get("/login", "DashboardController@login")->name("dashboard.login");
    route::post("/login/attempt", "DashboardController@loginAttempt")->name("dashboard.login.attempt");
});


////// All Routes /////
route::group(["middleware" => "admin"], function () {


    /// Logout Route ///
    route::get("/logout", "DashboardController@logout")->name("dashboard.logout");


    /// Dashboard Route ///
    route::get("/", "DashboardController@dashboard")->name("dashboard.index");



    ////  Admins Routes  //////
    Route::group(["prefix" => "admin"], function () {
        Route::get("/", "AdminController@index")->name("admin.index");
        Route::get("/edit/{id}", "AdminController@edit")->name("admin.edit");
        Route::post("/store", "AdminController@store")->name("admin.store");
        Route::put("/update/{id}", "AdminController@update")->name("admin.update");
        Route::delete("/delete/{id}", "AdminController@destroy")->name("admin.delete");
    });





    ////  Classes Routes  //////
    Route::group(["prefix" => "class"], function () {
        Route::get("/", "ClassesController@index")->name("class.index");
        Route::get("/edit/{id}", "ClassesController@edit")->name("class.edit");
        Route::post("/store", "ClassesController@store")->name("class.store");
        Route::put("/update/{id}", "ClassesController@update")->name("class.update");
        Route::delete("/delete/{id}", "ClassesController@destroy")->name("class.delete");
    });




    ////  Employees Routes  //////
    Route::group(["prefix" => "employe"], function () {
        Route::get("/", "EmployeController@index")->name("employe.index");
        Route::get("/edit/{id}", "EmployeController@edit")->name("employe.edit");
        Route::post("/store", "EmployeController@store")->name("employe.store");
        Route::put("/update/{id}", "EmployeController@update")->name("employe.update");
        Route::delete("/delete/{id}", "EmployeController@destroy")->name("employe.delete");
    });




    ////  Jobs Routes  //////
    Route::group(["prefix" => "job"], function () {
        Route::get("/", "JobController@index")->name("job.index");
        Route::get("/edit/{id}", "JobController@edit")->name("job.edit");
        Route::post("/store", "JobController@store")->name("job.store");
        Route::put("/update/{id}", "JobController@update")->name("job.update");
        Route::delete("/delete/{id}", "JobController@destroy")->name("job.delete");
    });



    ////  Parents Routes  //////
    Route::group(["prefix" => "parent"], function () {
        Route::get("/", "ParentsController@index")->name("parent.index");
        Route::get("/edit/{id}", "ParentsController@edit")->name("parent.edit");
        Route::post("/store", "ParentsController@store")->name("parent.store");
        Route::put("/update/{id}", "ParentsController@update")->name("parent.update");
        Route::delete("/delete/{id}", "ParentsController@destroy")->name("parent.delete");
    });




    ////  School Routes  //////
    Route::group(["prefix" => "school"], function () {
        Route::get("/", "SchoolController@index")->name("school.index");
        Route::get("/edit/{id}", "SchoolController@edit")->name("school.edit");
        Route::post("/store", "SchoolController@store")->name("school.store");
        Route::put("/update/{id}", "SchoolController@update")->name("school.update");
        Route::delete("/delete/{id}", "SchoolController@destroy")->name("school.delete");
    });



    ////  Students Routes  //////
    Route::group(["prefix" => "student"], function () {
        Route::get("/", "StudentController@index")->name("student.index");
        Route::get("/edit/{id}", "StudentController@edit")->name("student.edit");
        Route::post("/store", "StudentController@store")->name("student.store");
        Route::put("/update/{id}", "StudentController@update")->name("student.update");
        Route::delete("/delete/{id}", "StudentController@destroy")->name("student.delete");
    });


    ////  Subjects Routes  //////
    Route::group(["prefix" => "subject"], function () {
        Route::get("/", "SubjectController@index")->name("subject.index");
        Route::get("/edit/{id}", "SubjectController@edit")->name("subject.edit");
        Route::post("/store", "SubjectController@store")->name("subject.store");
        Route::put("/update/{id}", "SubjectController@update")->name("subject.update");
        Route::delete("/delete/{id}", "SubjectController@destroy")->name("subject.delete");
    });


    ////  Teachers Routes  //////
    Route::group(["prefix" => "teacher"], function () {
        Route::get("/", "TeacherController@index")->name("teacher.index");
        Route::get("/edit/{id}", "TeacherController@edit")->name("teacher.edit");
        Route::post("/store", "TeacherController@store")->name("teacher.store");
        Route::put("/update/{id}", "TeacherController@update")->name("teacher.update");
        Route::delete("/delete/{id}", "TeacherController@destroy")->name("teacher.delete");
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

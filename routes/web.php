<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;
//use App\Http\Controllers\ResultsController;
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
Route::post('search', [App\Http\Controllers\StudentController::class, 'search']);

Route::group(["middleware" => "guest"], function () {
    Route::get("/login", [DashboardController::class, "login"])->name("dashboard.login");
    Route::post("/login/attempt", [DashboardController::class, "loginAttempt"])->name("dashboard.login.attempt");
});


////// All Routes /////
Route::group(["middleware" => "auth"], function () {


    /// Logout Route ///
    Route::get("/logout", [DashboardController::class, "logout"])->name("dashboard.logout");

    /// Dashboard Route ///
    Route::get("/", [DashboardController::class, "index"])->name("dashboard.index");

    Route::resource('users', UserController::class)->middleware('role:Super-Admin');


    ////  Classes Routes  //////
    Route::resource('classes', ClassesController::class)->middleware('permission:class.view');
    Route::post('classes/chnage_student_class', [App\Http\Controllers\ClassesController::class, 'changeStudentClass'])->name('students.changeStudentClass');

    ////  Results Routes  //////
    Route::resource('results', ResultsController::class)->middleware('permission:result.view');
    Route::get('results/show_result/{student}', [App\Http\Controllers\ResultsController::class, 'showResult'])->name('results.showResult');
    Route::post('results/assign_result/{student}', [App\Http\Controllers\ResultsController::class, 'assignResult'])->name('results.assignResult');
    Route::get('get_student_result', [App\Http\Controllers\ResultsController::class, 'getStudentResults'])
        ->middleware('role:student')
        ->name('results.getStudentResult');


    ////  Employees Routes  //////
    Route::resource('employees', EmployeController::class)->middleware('permission:employe.view');



    ////  Jobs Routes  //////
    Route::resource('jobs', JobController::class);


    ////  Parents Routes  //////
    Route::resource('parents', ParentsController::class)->middleware('permission:student.view');


    ////  School Routes  //////
    Route::resource('schools', SchoolController::class)->middleware('role:Super-Admin');

    ////  Students Routes  //////
    Route::resource('students', StudentController::class)->middleware('permission:student.view');
    Route::get('students/table/{pageNumber}', [App\Http\Controllers\StudentController::class, "table"])->name("students.table")->middleware('permission:student.view');

    ////  Subjects Routes  //////
    Route::resource('subjects', SubjectController::class)->middleware('permission:subject.view');
    Route::post('subjects/{subject}/attach_teacher', [App\Http\Controllers\SubjectController::class, 'attachTeacher'])->name('subjects.attachTeacher');
    Route::post('subjects/{subject}/detach_teacher', [App\Http\Controllers\SubjectController::class, 'detachTeacher'])->name('subjects.detachTeacher');

    ////  Teachers Routes  //////
    Route::resource('teachers', TeacherController::class)->middleware('permission:teacher.view');


    ////  Privacy Routes  //////
    Route::resource('privacy', PrivacyController::class)->middleware('role:Super-Admin');

    ////   Roles and permissions \\\\
    Route::resource('roles', RoleController::class);
});

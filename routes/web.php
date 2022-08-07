<?php

use App\Http\Controllers\ArchiveController;
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


    //// Users Route ////
    Route::resource('users', UserController::class)->middleware('role:Super-Admin');
    Route::get('users/table/{pageNumber}', [App\Http\Controllers\UserController::class, "table"])->name("users.table")->middleware('role:Super-Admin');
    Route::get('users/search/{pageNumber}/{name}', [App\Http\Controllers\UserController::class, "search"])->name("users.search")->middleware('role:Super-Admin');


    ////  Classes Routes  //////
    Route::resource('classes', ClassesController::class)->middleware('permission:class.view');
    Route::post('classes/chnage_student_class', [App\Http\Controllers\ClassesController::class, 'changeStudentClass'])->name('students.changeStudentClass');
    Route::get('classes/table/{pageNumber}', [App\Http\Controllers\ClassesController::class, "table"])->name("classes.table")->middleware('permission:class.view');
    Route::get('classes/search/{pageNumber}/{name}', [App\Http\Controllers\ClassesController::class, "search"])->name("classes.search")->middleware('permission:class.view');


    ////  Results Routes  //////
    Route::resource('results', ResultsController::class)->middleware('permission:result.view');
    Route::get('results/show_result/{student}', [App\Http\Controllers\ResultsController::class, 'showResult'])->name('results.showResult');
    Route::post('results/assign_result/{student}', [App\Http\Controllers\ResultsController::class, 'assignResult'])->name('results.assignResult');
    Route::get('get_student_result', [App\Http\Controllers\ResultsController::class, 'getStudentResults'])
        ->middleware('role:student')
        ->name('results.getStudentResult');


    ////  Employees Routes  //////
    Route::resource('employees', EmployeController::class)->middleware('permission:employe.view');
    Route::get('employees/table/{pageNumber}', [App\Http\Controllers\EmployeController::class, "table"])->name("employees.table")->middleware('permission:employe.view');
    Route::get('employees/search/{pageNumber}/{name}', [App\Http\Controllers\EmployeController::class, "search"])->name("employees.search")->middleware('permission:employe.view');




    ////  Parents Routes  //////
    Route::resource('parents', ParentsController::class)->middleware('permission:student.view');
    Route::get('parents/table/{pageNumber}', [App\Http\Controllers\ParentsController::class, "table"])->name("parents.table")->middleware('permission:parent.view');
    Route::get('parents/search/{pageNumber}/{name}', [App\Http\Controllers\ParentsController::class, "search"])->name("parents.search")->middleware('permission:parent.view');

    ////  School Routes  //////
    Route::resource('schools', SchoolController::class)->middleware('role:Super-Admin');

    ////  Students Routes  //////
    Route::resource('students', StudentController::class)->middleware('permission:student.view');
    Route::get('students/table/{pageNumber}', [App\Http\Controllers\StudentController::class, "table"])->name("students.table")->middleware('permission:student.view');
    Route::get('students/search/{pageNumber}/{name}', [App\Http\Controllers\StudentController::class, "search"])->name("students.search")->middleware('permission:student.view');


    ////  Subjects Routes  //////
    Route::resource('subjects', SubjectController::class)->middleware('permission:subject.view');
    Route::post('subjects/{subject}/attach_teacher', [App\Http\Controllers\SubjectController::class, 'attachTeacher'])->name('subjects.attachTeacher');
    Route::post('subjects/{subject}/detach_teacher', [App\Http\Controllers\SubjectController::class, 'detachTeacher'])->name('subjects.detachTeacher');
    Route::get('subjects/table/{pageNumber}', [App\Http\Controllers\SubjectController::class, "table"])->name("subjects.table")->middleware('permission:subject.view');
    Route::get('subjects/search/{pageNumber}/{name}', [App\Http\Controllers\SubjectController::class, "search"])->name("subjects.search")->middleware('permission:subject.view');

    ////  Teachers Routes  //////
    Route::resource('teachers', TeacherController::class)->middleware('permission:teacher.view');
    Route::get('teachers/table/{pageNumber}', [App\Http\Controllers\TeacherController::class, "table"])->name("teachers.table")->middleware('permission:teacher.view');
    Route::get('teachers/search/{pageNumber}/{name}', [App\Http\Controllers\TeacherController::class, "search"])->name("teachers.search")->middleware('permission:teacher.view');

    ////  Privacy Routes  //////
    Route::resource('privacy', PrivacyController::class);

    ////   Roles and permissions \\\\
    Route::resource('roles', RoleController::class);

    ////   Archive  \\\\
    Route::group(['middleware' => 'permission:archive.view'],function() {

        Route::get('archive', [ArchiveController::class, 'index'])->name('archive.index');
        Route::delete('archive/destroy/{user}', [ArchiveController::class, 'destroy'])->name('archive.destroy')->withTrashed();
        Route::post('archive/restore/{user}', [ArchiveController::class, 'restore'])->name('archive.restore')->withTrashed();
        Route::get('archive/table/{pageNumber}', [App\Http\Controllers\ArchiveController::class, "table"])->name("archive.table");
        Route::get('archive/search/{pageNumber}/{name}', [App\Http\Controllers\ArchiveController::class, "search"])->name("archive.search");
    });
});

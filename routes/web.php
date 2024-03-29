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
    Route::group([], function () {
        Route::resource('users', UserController::class);
        Route::get('users/table/{pageNumber}', [App\Http\Controllers\UserController::class, "table"])->name("users.table");
        Route::get('users/search/{pageNumber}/{name}', [App\Http\Controllers\UserController::class, "search"])->name("users.search");
    });


    ////  Classes Routes  //////
    Route::resource('classes', ClassesController::class);
    Route::post('classes/chnage_student_class', [App\Http\Controllers\ClassesController::class, 'changeStudentClass'])->name('classes.changeStudentClass');
    Route::post('classes/add_subject_to_class', [App\Http\Controllers\ClassesController::class, 'addSubjectToClass'])->name('classes.addSubjectToClass');
    Route::get('classes/table/{pageNumber}/{sortBy}/{name?}', [App\Http\Controllers\ClassesController::class, "table"])->name("classes.table");


    ////  Results Routes  //////
    Route::resource('results', ResultsController::class);
    Route::get('results/show_result/{student}', [App\Http\Controllers\ResultsController::class, 'showResult'])->name('results.showResult');
    Route::post('results/assign_result/{student}', [App\Http\Controllers\ResultsController::class, 'assignResult'])->name('results.assignResult');
    Route::get('get_student_result', [App\Http\Controllers\ResultsController::class, 'getStudentResults'])
        ->name('results.getStudentResult');


    ////  Employees Routes  //////
    Route::resource('employees', EmployeController::class);
    Route::get('employees/table/{pageNumber}/{sortBy}/{name?}', [App\Http\Controllers\EmployeController::class, "table"])->name("employees.table");
    Route::post('employees/destroy-all', [App\Http\Controllers\EmployeController::class, "destroyAll"])->name("employees.destroy.all");




    ////  Parents Routes  //////
    Route::resource('parents', ParentsController::class);
    Route::get('parents/table/{pageNumber}/{sortBy}/{name?}', [App\Http\Controllers\ParentsController::class, "table"])
        ->name("parents.table");



    ////  School Routes  //////
    Route::resource('schools', SchoolController::class)->middleware('role:Super-Admin');

    ////  Students Routes  //////
    Route::resource('students', StudentController::class);
    Route::get('students/table/{pageNumber}/{sortBy}/{name?}', [App\Http\Controllers\StudentController::class, "table"])->name("students.table");
    Route::post('student/destroy-all', [App\Http\Controllers\StudentController::class, "destroyAll"])->name("students.destroy.all");;


    ////  Subjects Routes  //////
    Route::resource('subjects', SubjectController::class);
    Route::post('subjects/{subject}/attach_teacher', [App\Http\Controllers\SubjectController::class, 'attachTeacher'])->name('subjects.attachTeacher');
    Route::post('subjects/{subject}/detach_teacher', [App\Http\Controllers\SubjectController::class, 'detachTeacher'])->name('subjects.detachTeacher');
    Route::get('subjects/table/{pageNumber}/{sortBy}/{name?}', [App\Http\Controllers\SubjectController::class, "table"])->name("subjects.table");


    ////  Teachers Routes  //////
    Route::resource('teachers', TeacherController::class);

    Route::get('teachers/table/{pageNumber}/{sortBy}/{name?}', [App\Http\Controllers\TeacherController::class, "table"])
    ->name("teachers.table");

    Route::post('teacher/destroy-all', [App\Http\Controllers\TeacherController::class, "destroyAll"]
    )->name("teachers.destroy.all");

    ////  Privacy Routes  //////
    Route::resource('privacy', PrivacyController::class);

    ////   Roles and permissions \\\\
    Route::resource('roles', RoleController::class);

    ////   Archive  \\\\
    Route::group([], function () {

        Route::get('archive', [ArchiveController::class, 'index'])->name('archive.index');
        Route::delete('archive/destroy/{user}', [ArchiveController::class, 'destroy'])->name('archive.destroy')->withTrashed();
        Route::post('archive/restore/{user}', [ArchiveController::class, 'restore'])->name('archive.restore')->withTrashed();
        Route::get('archive/table/{pageNumber}/{viewBy}/{name?}', [App\Http\Controllers\ArchiveController::class, "table"])->name("archive.table");
        Route::post('archive/restore-all', [App\Http\Controllers\ArchiveController::class, "restoreAll"])->name("archive.restore.all");
        Route::post('archive/destroy-all', [App\Http\Controllers\ArchiveController::class, "destroyAll"])->name("archive.destroy.all");
    });
});

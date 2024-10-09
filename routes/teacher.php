<?php

use App\Http\Controllers\Teachers\ProfileController;
use App\Http\Controllers\Teachers\QuestionContoller;
use App\Http\Controllers\Teachers\QuizController;
use App\Http\Controllers\Teachers\TeacherStudentsController;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================Dashboard============================

    Route::get('/teacher/dashboard', function () {
        $classrooms = Teacher::findOrFail(auth()->user()->id)->classrooms()->pluck('classroom_id');
        $data['count_classrooms']= $classrooms->count();
        $data['count_students']= Student::whereIn('classroom_id',$classrooms)->count();

        return view('pages.teachers.dashboard', $data);
    });

    Route::group([], function () {

        //==============================Students============================

     Route::get('teacher/students',[TeacherStudentsController::class, 'index'])->name('teacherstudents.index');
     Route::get('teacher/classrooms',[TeacherStudentsController::class, 'classrooms'])->name('classroom');
     Route::post('attendance',[TeacherStudentsController::class, 'attendance'])->name('attendance');
     Route::post('edit_attendance',[TeacherStudentsController::class, 'editAttendance'])->name('attendance.edit');

        //==============================Quizzes============================

     Route::resource('quizzes', QuizController::class);
     Route::get('Get_classrooms/{id}', [QuizController::class, 'Get_classrooms']);

        //==============================Quizzes============================

     Route::resource('Questions', QuestionContoller::class);

        //==============================Profile============================

     Route::resource('profile', ProfileController::class);


    });
});

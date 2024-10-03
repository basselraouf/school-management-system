<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Students\AttendanceController;
use App\Http\Controllers\Students\ExamController;
use App\Http\Controllers\Students\FeeInvoicesController;
use App\Http\Controllers\Students\FeesController;
use App\Http\Controllers\Students\GraduationController;
use App\Http\Controllers\Students\LibraryController;
use App\Http\Controllers\Students\OnlineClassController;
use App\Http\Controllers\Students\ProcessingFeesController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\QuestionController;
use App\Http\Controllers\Students\QuizController;
use App\Http\Controllers\Students\ReceiptStudentController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Students\SubjectController;
use App\Http\Controllers\Teachers\TeacherController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use livewire\Livewire;

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

Route::get('/', [HomeController::class, 'index'])->name('selection');

Route::group([], function () {

    Route::get('/login/{type}', [LoginController::class, 'loginForm'])->middleware('guest')->name('login.show');

    Route::post('/login', [LoginController::class, 'login'])->name('login');

    Route::post('/logout/{type}', [LoginController::class, 'logout'])->name('logout');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function(){

        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });

        //================================= Dashboard ===================================

    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

        //================================== Grades =====================================

    Route::group(['prefix' => 'grades'], function() {
        Route::get('/', [GradeController::class, 'index'])->name('grades.index');
        Route::post('/create', [GradeController::class, 'create'])->name('grades.create');
        Route::post('/store', [GradeController::class, 'store'])->name('grades.store');
        Route::get('/edit/{id}', [GradeController::class, 'edit'])->name('grades.edit');
        Route::put('/update/{id}', [GradeController::class, 'update'])->name('grades.update');
        Route::delete('/delete/{id}', [GradeController::class , 'destroy'])->name('grades.destroy');
    });

        //================================== Classrooms ===================================

    Route::group(['prefix' => 'classrooms'], function() {
        Route::get('/', [ClassroomController::class, 'index'])->name('classrooms.index');
        Route::get('/create', [ClassroomController::class, 'create'])->name('classrooms.create');
        Route::post('/store', [ClassroomController::class, 'store'])->name('classrooms.store');
        Route::get('/edit/{id}', [ClassroomController::class, 'edit'])->name('classrooms.edit');
        Route::put('/update/{id}', [ClassroomController::class, 'update'])->name('classrooms.update');
        Route::delete('/delete/{id}', [ClassroomController::class , 'destroy'])->name('classrooms.destroy');
    });

        //================================== Parents =======================================

        Route::view('add_parent','livewire.show_Form');

        //=================================== Teachers =====================================

        Route::resource('teachers', TeacherController::class);

        //=================================== Students =====================================

        Route::resource('students', StudentController::class);
        Route::get('Get_classrooms/{id}', [StudentController::class, 'Get_classrooms']);
        Route::post('Upload_attachment', [StudentController::class, 'Upload_attachment'])->name('Upload_attachment');
        Route::get('Download_attachment/{studentId}/{url}', [StudentController::class, 'Download_attachment'])->name('Download_attachment');
        Route::post('Delete_attachment', [StudentController::class, 'Delete_attachment'])->name('Delete_attachment');

        //=================================== Promotion =====================================

        Route::resource('promotions', PromotionController::class);

        //=================================== Graduation ====================================

        Route::resource('graduations', GraduationController::class);

        //===================================== fees ========================================

        Route::resource('fees', FeesController::class);

        //================================== feeInvoices ====================================

        Route::resource('feeInvoices', FeeInvoicesController::class);

        //================================ Receipt Student ==================================

        Route::resource('receipts', ReceiptStudentController::class);

        //================================ Receipt Student ==================================

        Route::resource('processingFees', ProcessingFeesController::class);

        //================================== Attendance =====================================

        Route::resource('attendance', AttendanceController::class);

        //==================================== Subject ======================================

        Route::resource('subjects', SubjectController::class);

        //===================================== Exams =======================================

        Route::resource('Quizzes', QuizController::class);

        //=================================== Questions =====================================

        Route::resource('questions', QuestionController::class);

        //================================= Online Classes ==================================

        Route::resource('online_classes', OnlineClassController::class);

        //==================================== Libraries ====================================

        Route::resource('libraries', LibraryController::class);
        Route::get('download_file/{filename}', [LibraryController::class, 'downloadAttachment'])->name('downloadAttachment');

        //==================================== Settings =====================================

        Route::resource('settings', SettingController::class);
 });




    Auth::routes();





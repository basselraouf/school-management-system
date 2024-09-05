<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\HomeController;
use App\Models\classroom;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\View\View;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function(){
        Route::get('/', function()
	    {
		    return view('auth.login');
	    });


    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'grades'], function() {
        Route::get('/', [GradeController::class, 'index'])->name('grades.index');
        Route::post('/create', [GradeController::class, 'create'])->name('grades.create');
        Route::post('/store', [GradeController::class, 'store'])->name('grades.store');
        Route::get('/edit/{id}', [GradeController::class, 'edit'])->name('grades.edit');
        Route::put('/update/{id}', [GradeController::class, 'update'])->name('grades.update');
        Route::delete('/delete/{id}', [GradeController::class , 'destroy'])->name('grades.destroy');
    });

    Route::group(['prefix' => 'classrooms'], function() {
        Route::get('/', [ClassroomController::class, 'index'])->name('classrooms.index');
        Route::get('/create', [ClassroomController::class, 'create'])->name('classrooms.create');
        Route::post('/store', [ClassroomController::class, 'store'])->name('classrooms.store');
        Route::get('/edit/{id}', [ClassroomController::class, 'edit'])->name('classrooms.edit');
        Route::put('/update/{id}', [ClassroomController::class, 'update'])->name('classrooms.update');
        Route::delete('/delete/{id}', [ClassroomController::class , 'destroy'])->name('classrooms.destroy');
    });

 });

    Auth::routes();





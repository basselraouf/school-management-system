<?php

use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use livewire\Livewire;
use Livewire\Http\LivewireController;

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

        Livewire::setUpdateRoute(function ($handle) {
            return Route::post('/livewire/update', $handle);
        });

        Route::get('/', function()
	    {
		    return view('dashboard');
	    });

        //==============================Dashboard===============================

    Route::get('/home', [HomeController::class, 'index'])->name('home');

        //==============================Grades===============================

    Route::group(['prefix' => 'grades'], function() {
        Route::get('/', [GradeController::class, 'index'])->name('grades.index');
        Route::post('/create', [GradeController::class, 'create'])->name('grades.create');
        Route::post('/store', [GradeController::class, 'store'])->name('grades.store');
        Route::get('/edit/{id}', [GradeController::class, 'edit'])->name('grades.edit');
        Route::put('/update/{id}', [GradeController::class, 'update'])->name('grades.update');
        Route::delete('/delete/{id}', [GradeController::class , 'destroy'])->name('grades.destroy');
    });

        //==============================Classrooms============================

    Route::group(['prefix' => 'classrooms'], function() {
        Route::get('/', [ClassroomController::class, 'index'])->name('classrooms.index');
        Route::get('/create', [ClassroomController::class, 'create'])->name('classrooms.create');
        Route::post('/store', [ClassroomController::class, 'store'])->name('classrooms.store');
        Route::get('/edit/{id}', [ClassroomController::class, 'edit'])->name('classrooms.edit');
        Route::put('/update/{id}', [ClassroomController::class, 'update'])->name('classrooms.update');
        Route::delete('/delete/{id}', [ClassroomController::class , 'destroy'])->name('classrooms.destroy');
    });

        //==============================parents================================


        Route::view('add_parent','livewire.show_Form');
 });




    Auth::routes();





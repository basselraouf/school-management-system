<?php

use App\Http\Controllers\GradeController;
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
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function(){
        Route::get('/', function()
	    {
		    return view('auth.login');
	    });
    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::post('/create', [GradeController::class, 'create'])->name('grades.create');
    Route::post('/store', [GradeController::class, 'store'])->name('grades.store');
    Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');
    Route::get('/edit/{id}', [GradeController::class, 'edit'])->name('grades.edit');
    Route::put('/update/{id}', [GradeController::class, 'update'])->name('grades.update');
    Route::delete('delete/{id}', [GradeController::class , 'destroy'])->name('grades.delete');

    });







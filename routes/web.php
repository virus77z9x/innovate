<?php

use App\Http\Controllers\GradeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClassroomController;

Auth::routes();


Route::group(['middleware' => 'guest'], function(){
    Route::get('/', function () {
        return view('auth.login');
    });

});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth' ]
    ], function(){ 
        Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');


        Route::get('grades', [GradeController::class, 'index'])->name('grades');
        Route::post('grades', [GradeController::class,'store'])->name('grades.store');
        Route::get('grades/edit/{id}', [GradeController::class, 'edit'])->name('grades.edit');
        Route::post('grades/update/{id}', [GradeController::class, 'update'])->name('grades.update');
        Route::post('grades/delete/{id}', [GradeController::class, 'destroy'])->name('grades.destroy');

        Route::get('classrooms', [ClassroomController::class, 'index'])->name('classroom');
        Route::get('classrooms/create', [ClassroomController::class, 'create'])->name('classrooms.create');
        Route::post('classrooms/store', [ClassroomController::class,'store'])->name('classrooms.store');
        Route::get('classrooms/edit/{id}', [ClassroomController::class, 'edit'])->name('classrooms.edit');
        Route::post('classrooms/update/{id}', [ClassroomController::class, 'update'])->name('classrooms.update');
        Route::post('classrooms/delete/{id}', [ClassroomController::class, 'destroy'])->name('classrooms.destroy');
    });
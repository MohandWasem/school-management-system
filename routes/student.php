<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Students\Dashboard\ExamController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Students\Dashboard\ProfileController;

/*
|--------------------------------------------------------------------------
| STUDENT Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:student' ]
    ], function(){

         // ============================== Dashboard ============================

         Route::get('/student/dashboard',[ExamController::class,'dashboard']);

         Route::group(['namespace'=>'Students\Dashboard'],function(){
            Route::resource('Exams', 'ExamController');
            Route::get('profile',[ProfileController::class,'index'])->name('profile.student');
            Route::patch('profileUpdate',[ProfileController::class,'update'])->name('pro.update');
         });

    });

<?php

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Parents\dashboard\ProfileController;
use App\Http\Controllers\Parents\dashboard\ChildrenController;

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
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:parent' ]
    ], function(){

         // ============================== Dashboard ============================

        //  Route::get('/parent/dashboard',[ExamController::class,'dashboard']);
         Route::get('/parent/dashboard',function(){
            $childerns = Student::where('Parent_id',auth()->user()->id)->get();
            return view('pages.parent.dashboard',compact('childerns'));
         });

         Route::group(['namespace'=>'/Parents/dashboard'],function(){
            Route::get('children',[ChildrenController::class,'index'])->name('children.index');
            Route::get('children/results/{id}',[ChildrenController::class,'childrenResult'])->name('children.results');
            Route::get('attendance',[ChildrenController::class,'attendance'])->name('attendance.index');
            Route::post('attendanceSearch',[ChildrenController::class,'attendanceSearch'])->name('sons.search');
            Route::get('fees',[ChildrenController::class,'fees'])->name('fees.index');
            Route::get('feesReceipt/{student_id}',[ChildrenController::class,'receiptStudent'])->name('fees.receipt');
            Route::get('profile',[ProfileController::class,'index'])->name('profile.parent');
            Route::patch('profileUpdate',[ProfileController::class,'update'])->name('profileParent.update');
         });

    });

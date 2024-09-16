<?php

use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Teachers\Dashboard\QuizzController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Teachers\Dashboard\ProfileController;
use App\Http\Controllers\Teachers\Dashboard\StudentController;
use App\Http\Controllers\Teachers\Dashboard\ZoomOnlineController;
use App\Http\Controllers\Teachers\Dashboard\TeacherQuestionController;

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
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:teacher' ]
    ], function(){

         // ============================== Dashboard ============================

         Route::get('/teacher/dashboard',function(){
            // query Bulider
            // $count = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->count();
            // $count = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id);
            
            // eloquent ORM
            $ids = Teacher::findOrFail(auth()->user()->id)->Sections()->pluck('section_id');
            $count_sections = $ids->count();

            $countStudent = Student::whereIn('section_id',$ids)->count();
            return view('pages.Teachers.dashboard',compact('count_sections','countStudent'));
         });

         Route::group(['namespace'=>'Teachers/Dashboard'],function(){

            Route::get('students/dash',[StudentController::class,'index'])->name('studentDash.index');
            Route::post('attendance',[StudentController::class,'store'])->name('attendance.create');
            // Route::post('attendance/edit',[StudentController::class,'update'])->name('attendance.edit');
            Route::get('sections',[StudentController::class,'section'])->name('sections.index');
            Route::get('AttendanceReport',[StudentController::class,'attendanceReport'])->name('attendanceReport.index');
            Route::post('AttendanceSearch',[StudentController::class,'attendanceSearch'])->name('attendanceReport.search');
            Route::get('Quizz',[QuizzController::class,'index'])->name('Quizz.index');
            Route::get('Quizz/create',[QuizzController::class,'create'])->name('Quizz.create');
            Route::post('Quizz/store',[QuizzController::class,'store'])->name('Quizz.store');
            Route::get('Quizz/show/{id}',[QuizzController::class,'show'])->name('Quizz.show');
            Route::get('Quizz/edit/{id}',[QuizzController::class,'edit'])->name('Quizz.edit');
            Route::put('Quizz/update',[QuizzController::class,'update'])->name('Quizz.update');
            Route::delete('Quizz/destroy',[QuizzController::class,'destroy'])->name('Quizz.destroy');
            Route::get('Get_classroom/{Grade_id}', [QuizzController::class, 'getClassrooms'])->name('getClassrooms');
            Route::get('Get_Section/{Classroom_id}', [QuizzController::class, 'getSections'])->name('getSections');
            Route::get('question/create/{id}',[TeacherQuestionController::class,'show'])->name('question.show');
            Route::post('question/add',[TeacherQuestionController::class,'store'])->name('question.store');
            Route::get('question/edit/{id}',[TeacherQuestionController::class,'edit'])->name('question.edit');
            Route::put('question/update',[TeacherQuestionController::class,'update'])->name('question.update');
            Route::delete('question/destroy',[TeacherQuestionController::class,'destroy'])->name('question.destroy');
            Route::get('ZoomOnline',[ZoomOnlineController::class,'index'])->name('ZoomOnline.index');
            Route::get('ZoomOnline/create',[ZoomOnlineController::class,'create'])->name('ZoomOnline.create');
            Route::post('ZoomOnline/store',[ZoomOnlineController::class,'store'])->name('ZoomOnline.store');
            Route::delete('ZoomOnline/destroy',[ZoomOnlineController::class,'destroy'])->name('ZoomOnline.destroy');
            Route::get('ZoomOffline/create',[ZoomOnlineController::class,'offlineClasseCreate'])->name('offlineClasse.add');
            Route::post('ZoomOffline/store',[ZoomOnlineController::class,'offlineClasseStore'])->name('offline.store');
            Route::get('Profile',[ProfileController::class,'index'])->name('profile.index');
            Route::patch('Profile/update',[ProfileController::class,'update'])->name('profile.update');
            Route::get('studentQuizz/{quizz_id}',[QuizzController::class,'studentQuizz'])->name('student.quizze');
            Route::post('repeat_quizze',[QuizzController::class,'repeatQuizze'])->name('repeat.quizze');
         });

    });

<?php

use Livewire\Livewire;
use App\Http\Livewire\Calendar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Quizze\QuizzController;
use App\Http\Controllers\Accounts\FeesController;
use App\Http\Controllers\Quizze\QuestionController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Students\LibraryController;
use App\Http\Controllers\Students\PaymentController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Http\Controllers\Students\GraduatedController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Accounts\FeeInvoiceController;
use App\Http\Controllers\Classrooms\ClassroomController;
use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Students\OnlineClasseController;
use App\Http\Controllers\Students\ProcessingFeeController;
use App\Http\Controllers\Students\ReceiptStudentController;
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

// Auth::routes();

// Route::group(['middleware'=>['guest']],function(){
//     Route::get('/', function () {
//         return view('auth.login');
//     });
// });

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('selection');
Route::namespace('Auth')->group(function (){

    Route::get('/login/{type}', [App\Http\Controllers\HomeController::class, 'loginForm'])->middleware('guest')->name('login.show');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/logout/{type}', [LoginController::class, 'logout'])->name('logout');
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
    ], function(){
        // Route::get('/dashboard', function () {
        //     return view('dashboard');
        // })->name('dashboard');

        Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

         // ============================== Grades ============================
        Route::get('/Grades', [GradeController::class, 'index'])->name('Grades');
        Route::post('/Grades', [GradeController::class, 'store'])->name('Grades.store');
        Route::patch('/Grades', [GradeController::class, 'update'])->name('Grades.update');
        Route::delete('/Grades', [GradeController::class, 'destroy'])->name('Grades.destroy');


        // ============================== Classrooms ============================
        // Route::resource('Classrooms', [ClassroomController::class]);
        Route::namespace('Classrooms')->group(function () {
            Route::resource('Classrooms', 'ClassroomController');
            Route::patch('Classrooms', [ClassroomController::class, 'update'])->name('Classrooms.update');
            Route::delete('Classrooms', [ClassroomController::class, 'destroy'])->name('Classrooms.destroy');
            Route::post('delete_all', [ClassroomController::class, 'delete_all'])->name('delete_all');
            Route::post('Filter_Classes', [ClassroomController::class, 'Filter_Classes'])->name('Filter_Classes');
            Route::get('classes/{Grade_id}', [ClassroomController::class, 'getClassrooms'])->name('getClassrooms');
        });

        // ============================== Sections ============================
        // Route::resource('Classrooms', [ClassroomController::class]);
        Route::namespace('Sections')->group(function () {
            Route::resource('Sections', 'SectionController');
            Route::patch('Sections', [SectionController::class, 'update'])->name('Sections.update');
            Route::delete('Sections', [SectionController::class, 'destroy'])->name('Sections.destroy');

        });


        // ============================== parents ============================
        Route::view('add_parent','livewire.show-parent')->name('add_parent');

        // ============================== Sections ============================

        Route::namespace('Teachers')->group(function () {
            Route::resource('Teachers', 'TeacherController');
            Route::patch('Teachers', [TeacherController::class, 'update'])->name('Teachers.update');
            Route::delete('Teachers', [TeacherController::class, 'destroy'])->name('Teachers.destroy');

        });

        // ============================== Students ============================

        Route::namespace('Students')->group(function () {
            Route::resource('Students', 'StudentController');
            Route::put('Students', [StudentController::class, 'update'])->name('Students.update');
            Route::delete('Students', [StudentController::class, 'destroy'])->name('Students.destroy');
            Route::get('Get_classrooms/{Grade_id}', [StudentController::class, 'getClassrooms'])->name('getClassrooms');
            Route::get('Get_Sections/{Classroom_id}', [StudentController::class, 'getSections'])->name('getSections');
            Route::post('Upload_attachment',[StudentController::class, 'Upload_attachment'])->name('Upload_attachment');
            Route::get('Open_attachment/{studentsname}/{filename}', [StudentController::class, 'Open_attachment'])->name('Open_attachment');
            Route::get('Download_attachment/{studentname}/{filename}', [StudentController::class, 'Download_attachment'])->name('Download_attachment');
            Route::post('Delete_attachment', [StudentController::class, 'Delete_attachment'])->name('Delete_attachment');
        });

        // ============================== Promotion ============================

        Route::namespace('Students')->group(function () {
            Route::resource('Promotion', 'PromotionController');
            Route::delete('Promotion', [PromotionController::class, 'destroy'])->name('Promotion.destroy');
        });


        // ============================== Graduated ============================

        Route::namespace('Students')->group(function () {
            Route::resource('Graduated', 'GraduatedController');
            Route::put('Graduated', [GraduatedController::class, 'update'])->name('Graduated.update');
            Route::delete('Graduated', [GraduatedController::class, 'destroy'])->name('Graduated.destroy');
        });


        // ============================== Fees ============================

        Route::namespace('Accounts')->group(function () {
            Route::resource('Fees', 'FeesController');
            Route::put('Fees', [FeesController::class, 'update'])->name('Fees.update');
            Route::delete('Fees', [FeesController::class, 'destroy'])->name('Fees.destroy');
        });

        // ============================== Fees Invoices ============================

        Route::namespace('Accounts')->group(function () {
            Route::resource('FeeInvoice', 'FeeInvoiceController');
            Route::put('FeeInvoice', [FeeInvoiceController::class, 'update'])->name('FeeInvoice.update');
            Route::delete('FeeInvoice', [FeeInvoiceController::class, 'destroy'])->name('FeeInvoice.destroy');
        });

        // ============================== Receipt Student ============================

        Route::namespace('Students')->group(function () {
            Route::resource('ReceiptStudent', 'ReceiptStudentController');
            Route::put('ReceiptStudent', [ReceiptStudentController::class, 'update'])->name('ReceiptStudent.update');
            Route::delete('ReceiptStudent', [ReceiptStudentController::class, 'destroy'])->name('ReceiptStudent.destroy');
        });


        // ============================== Processing Fee ============================

        Route::namespace('Students')->group(function () {
            Route::resource('ProcessingFee', 'ProcessingFeeController');
            Route::put('ProcessingFee', [ProcessingFeeController::class, 'update'])->name('ProcessingFee.update');
            Route::delete('ProcessingFee', [ProcessingFeeController::class, 'destroy'])->name('ProcessingFee.destroy');
        });

        // ============================== Payment ============================

        Route::namespace('Students')->group(function () {
            Route::resource('PaymentStudent', 'PaymentController');
            Route::put('PaymentStudent', [PaymentController::class, 'update'])->name('PaymentStudent.update');
            Route::delete('PaymentStudent', [PaymentController::class, 'destroy'])->name('PaymentStudent.destroy');
        });

        // ============================== Attendance ============================

        Route::namespace('Attendance')->group(function () {
            Route::resource('Attendance', 'AttendanceController');
        });

        // ============================== Subjects ============================

        Route::namespace('Subjects')->group(function () {
            Route::resource('subjects', 'SubjectController');
            Route::patch('subjects', [SubjectController::class, 'update'])->name('subjects.update');
            Route::delete('subjects', [SubjectController::class, 'destroy'])->name('subjects.destroy');
        });

        // ============================== Quizze ============================

        Route::namespace('Quizze')->group(function () {
            Route::resource('Quizzes', 'QuizzController');
            Route::put('Quizzes', [QuizzController::class, 'update'])->name('Quizzes.update');
            Route::delete('Quizzes', [QuizzController::class, 'destroy'])->name('Quizzes.destroy');
        });

        // ============================== Questions ============================

        Route::namespace('Quizze')->group(function () {
            Route::resource('Questions', 'QuestionController');
            Route::put('Questions', [QuestionController::class, 'update'])->name('Questions.update');
            Route::delete('Questions', [QuestionController::class, 'destroy'])->name('Questions.destroy');
        });

        // ============================== Online Classes ============================

        Route::namespace('Students')->group(function () {
            Route::resource('onlineClasses', 'OnlineClasseController');
            Route::get('offlineClasse', [OnlineClasseController::class, 'offlineClasseCreate'])->name('offlineClasse.create');
            Route::post('offlineClasse', [OnlineClasseController::class, 'offlineClasseStore'])->name('offlineClasse.store');
            Route::delete('onlineClasses', [OnlineClasseController::class, 'destroy'])->name('onlineClasses.destroy');
        });

        // ==============================  Library ============================

        Route::namespace('Students')->group(function () {
            Route::resource('Library', 'LibraryController');
            Route::get('downloadAttachment/{filename}', [LibraryController::class, 'downloadAttachment'])->name('downloadAttachment');
            Route::put('Library', [LibraryController::class, 'update'])->name('library.update');
            // Route::delete('onlineClasses', [LibraryController::class, 'destroy'])->name('library.destroy');
        });


        // ==============================  Settings ===========================
        Route::resource('Settings','SettingController');
        Route::put('Settings',[SettingController::class, 'update'])->name('setting.update');


        // ==============================  Calender ===========================
        Livewire::component('calendar', Calendar::class);

});






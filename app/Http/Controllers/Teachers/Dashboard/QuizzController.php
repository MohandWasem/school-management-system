<?php

namespace App\Http\Controllers\Teachers\Dashboard;

use App\Models\Grade;
use App\Models\Quizze;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\Question;

class QuizzController extends Controller
{
   
    // public $teacher_id=;

    // public function __construct($teacher_id = null)
    // {
    //     // if (auth()->check()) {
    //     //     $this->Teacher_id = auth()->user()->id;
    //     // } else {
    //     //     // يمكنك هنا التعامل مع حالة عدم تسجيل الدخول، مثل إعادة توجيه المستخدم
    //     //     abort(403, 'Unauthorized action.');
    //     // }

    //     $this->middleware('auth:teacher');
    //     $this->teacher_id = auth()->user()->id;
    // }
    public function index()
    {
        $quizzes = Quizze::where('Teacher_id',auth()->user()->id)->get();
        return view('pages.Teachers.Quizzes.index',compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['grades'] = Grade::get();
        // $data['teachers'] = Teacher::get();
        $data['subjects'] = Subject::where('Teacher_id',auth()->user()->id)->get();
        return view('pages.Teachers.Quizzes.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            // اضافه البيانات في جدول الاختبارات 
            $Quizz = new Quizze();
            $Quizz->Name = ['en'=>$request->Name_en , 'ar'=>$request->Name_ar];
            $Quizz->Subject_id = $request->subject_id;
            $Quizz->Grade_id = $request->Grade_id;
            $Quizz->Classroom_id = $request->Classroom_id;
            $Quizz->Section_id = $request->section_id;
            $Quizz->Teacher_id = auth()->user()->id;
            $Quizz->save();
            toastr()->success(trans('messages.Success'));
            return redirect()->back();

        }  catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }

    public function show($id)
    {
        $questions = Question::where('quizz_id',$id)->get();
        $quizz = Quizze::findOrFail($id);
        return view('pages.Teachers.Questions.index',compact('questions','quizz'));
    }

    public function edit($id)
    {
        $data['quizz'] = Quizze::findOrFail($id);
        $data['grades'] = Grade::get();
        $data['subjects'] = Subject::where('Teacher_id',auth()->user()->id)->get();
        return view('pages.Teachers.Quizzes.edit',$data);
    }


    public function update(Request $request)
    {
        try {

            // تعديل البيانات في جدول الاختبارات =
            $Quizz = Quizze::findOrFail($request->id);
            $Quizz->Name = ['en'=>$request->Name_en , 'ar'=>$request->Name_ar];
            $Quizz->Subject_id = $request->subject_id;
            $Quizz->Grade_id = $request->Grade_id;
            $Quizz->Classroom_id = $request->Classroom_id;
            $Quizz->Section_id = $request->section_id;
            $Quizz->Teacher_id = auth()->user()->id;
            $Quizz->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->back();

        }  catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }

    public function destroy(Request $request)
    {
        try {
            Quizze::findOrFail($request->id)->delete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    public function getClassrooms($Grade_id)
    {
        $classroom = Classroom::where('Grade_id',$Grade_id)->pluck('Name_classroom','id');
        return response()->json($classroom);
    }

    public function getSections($Classroom_id)
    {
        $Section = Section::where('Classroom_id',$Classroom_id)->pluck('Name_Section','id');
        return response()->json($Section);
    }

    public function studentQuizz($quizz_id)
    {
        $degrees = Degree::where('quizz_id',$quizz_id)->get();
        return view('pages.Teachers.Quizzes.student_quizz',compact('degrees'));
    }

    public function repeatQuizze(Request $request)
    {
        Degree::where('student_id',$request->student_id)->where('quizz_id',$request->quizze_id)->delete();
        toastr()->success(trans('messages.retest_degree'));
        return redirect()->back();
    }
}

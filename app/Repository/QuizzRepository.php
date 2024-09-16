<?php

namespace App\Repository;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Interfaces\QuizzRepositoryInterface;
use App\Models\Quizze;
use App\Models\Subject;
use App\Models\Teacher;

class QuizzRepository implements QuizzRepositoryInterface
{

    public function index()
    {
        $quizzes = Quizze::get();
        return view('pages.Quizzes.index',compact('quizzes'));
    }

    public function create()
    {
        $subjects = Subject::get();
        $teachers = Teacher::get();
        $grades = Grade::get();
        return view('pages.Quizzes.create',compact('subjects','teachers','grades'));
    }

    public function store($request)
    {
        try {

            // اضافه البيانات في جدول الاختبارات 
            $Quizz = new Quizze();
            $Quizz->Name = ['en'=>$request->Name_en , 'ar'=>$request->Name_ar];
            $Quizz->Subject_id = $request->subject_id;
            $Quizz->Grade_id = $request->Grade_id;
            $Quizz->Classroom_id = $request->Classroom_id;
            $Quizz->Section_id = $request->section_id;
            $Quizz->Teacher_id = $request->teacher_id;
            $Quizz->save();
            toastr()->success(trans('messages.Success'));
            return redirect()->back();

        }  catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }

    public function edit($id)
    {
        $quizz = Quizze::findOrFail($id);
        $subjects = Subject::get();
        $teachers = Teacher::get();
        $grades = Grade::get();
        return view('pages.Quizzes.edit',compact('subjects','teachers','grades','quizz'));
    }

    public function update($request)
    {
        try {

            // تعديل البيانات في جدول الاختبارات =
            $Quizz = Quizze::findOrFail($request->id);
            $Quizz->Name = ['en'=>$request->Name_en , 'ar'=>$request->Name_ar];
            $Quizz->Subject_id = $request->subject_id;
            $Quizz->Grade_id = $request->Grade_id;
            $Quizz->Classroom_id = $request->Classroom_id;
            $Quizz->Section_id = $request->section_id;
            $Quizz->Teacher_id = $request->teacher_id;
            $Quizz->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->back();

        }  catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }

    public function destroy($request)
    {
        try {
            Quizze::findOrFail($request->id)->delete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

}
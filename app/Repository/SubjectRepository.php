<?php

namespace App\Repository;
use Illuminate\Support\Facades\DB;
use App\Interfaces\SubjectRepositoryInterface;
use App\Models\Grade;
use App\Models\Subject;
use App\Models\Teacher;

class SubjectRepository implements SubjectRepositoryInterface
{

    public function index()
    {
        $subjects = Subject::get();
        return view('pages.Subjects.show',compact('subjects'));
    }

    public function add()
    {
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('pages.Subjects.create',compact('grades','teachers'));
    }

    public function store($request)
    {
        try {

            // اضافه البيانات في جدول المواد الدراسية
            $subjects = new Subject();
            $subjects->Name = ['en'=>$request->Name_en , 'ar'=>$request->Name_ar];
            $subjects->Grade_id = $request->Grade_id;
            $subjects->Classroom_id = $request->Class_id;
            $subjects->Teacher_id = $request->teacher_id;
            $subjects->save();
            toastr()->success(trans('messages.Success'));
            return redirect()->route('subjects.index');

        }  catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }

    public function edit($id)
    {
        $subject = Subject::findOrFail($id);
        $grades = Grade::get();
        $teachers = Teacher::get();
        return view('pages.Subjects.edit',compact('grades','teachers','subject'));
    }

    public function update($request)
    {
        try {

            // تعديل البيانات في جدول المواد الدراسية
            $subjects = Subject::findOrFail($request->id);
            $subjects->Name = ['en'=>$request->Name_en , 'ar'=>$request->Name_ar];
            $subjects->Grade_id = $request->Grade_id;
            $subjects->Classroom_id = $request->Class_id;
            $subjects->Teacher_id = $request->teacher_id;
            $subjects->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('subjects.index');

        }  catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }

    public function destroy($request)
    {
        try {
            Subject::findOrFail($request->id)->delete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('subjects.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }
}
<?php

namespace App\Repository;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Interfaces\GraduatedRepositoryInterface;

class GraduatedRepository implements GraduatedRepositoryInterface
{

    public function index()
    {
        $students = Student::onlyTrashed()->get();
        return view('pages.Student.Graduated.index',compact('students'));
    }

    public function create()
    {
        $Grades = Grade::get();
        return view('pages.Student.Graduated.create',compact('Grades'));
    }

    public function softDelete($request)
    {
        
        try {
            $students = Student::query()
                ->where('Grade_id', $request->Grade_id)
                ->where('Classroom_id', $request->Classroom_id)
                ->where('Section_id', $request->section_id)
                ->get();
            if($students->count() < 1){
                return redirect()->back()->with('error_Graduate',trans('Students_trans.error_Graduate'));
            }

            foreach ($students as $student) {
               $ids = explode(',',$student->id);
               Student::whereIn('id',$ids)->Delete();
            }

            toastr()->success(trans('messages.Success'));
            return redirect()->route('Graduated.index');

        } catch (\Throwable $th) {
            DB::rollback(); // not insert data in database
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    public function returnStudent($request)
    {
        Student::onlyTrashed()->where('id',$request->id)->first()->restore();
        toastr()->success(trans('messages.Success'));
        return redirect()->back();
    }

    public function destroy($request)
    {
        Student::onlyTrashed()->where('id',$request->id)->first()->forceDelete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->back();
    }
}
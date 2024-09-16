<?php

namespace App\Repository;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Interfaces\FeesRepositoryInterface;
use App\Models\Fee;

class FeesRepository implements FeesRepositoryInterface
{

    public function index()
    {
        $fees = Fee::get();
        return view('pages.Fees.show',compact('fees'));
    }

    public function create()
    {
        $Grades = Grade::get();
        return view('pages.Fees.create',compact('Grades'));
    }

    public function store($request)
    {
        try {
            $fees = new Fee();
            $fees->Name = ['en'=>$request->name_en,'ar'=>$request->name_ar];
            $fees->amount = $request->amount;
            $fees->Grade_id = $request->Grade_id;
            $fees->Classroom_id = $request->Classroom_id;
            $fees->academic_year = $request->year;
            $fees->Fee_type = $request->Fee_type;
            $fees->notes = $request->notes;
            $fees->save();
            toastr()->success(trans('messages.Success'));
            return redirect()->route('Fees.create');

        } catch (\Throwable $th) {
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $Grades = Grade::get();
        $fee = Fee::findOrFail($id);
        return view('pages.Fees.edit',compact('Grades','fee'));
    }

    public function update($request)
    {
        try {
            $fees = Fee::findOrFail($request->id);
            $fees->Name = ['en'=>$request->name_en,'ar'=>$request->name_ar];
            $fees->amount = $request->amount;
            $fees->Grade_id = $request->Grade_id;
            $fees->Classroom_id = $request->Classroom_id;
            $fees->academic_year = $request->year;
            $fees->Fee_type = $request->Fee_type;
            $fees->notes = $request->notes;
            $fees->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Fees.index');

        } catch (\Throwable $th) {
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Fee::destroy($request->id);
            toastr()->success(trans('messages.Delete'));
            return redirect()->back();

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }

}
<?php

namespace App\Repository;

use App\Models\Gender;
use App\Models\Teacher;
use App\Models\Specialization;
use Illuminate\Support\Facades\Hash;
use App\Interfaces\TeacherRepositoryInterface;

class TeacherRepository implements TeacherRepositoryInterface {


    public function getAllTeachers()
    {
        $Teachers=Teacher::get();
        return view('pages.Teachers.show',compact('Teachers'));
    }

    public function insertTeachers()
    {
        $specializations = Specialization::get();
        $genders = Gender::get();
        return view('pages.Teachers.create',compact('specializations','genders'));
    }

    public function storeTeachers($request)
    {
        try {

            $Teacher = new Teacher();
            $Teacher->email = $request->Email;
            $Teacher->password = Hash::make($request->Password);
            $Teacher->Name = ['ar'=>$request->Name_ar,'en'=>$request->Name_en];
            $Teacher->Specialization_id = $request->Specialization_id;
            $Teacher->Gender_id = $request->Gender_id;
            $Teacher->Joining_Date = $request->Joining_Date;
            $Teacher->Address = $request->Address;
            $Teacher->save();
            toastr()->success(trans('messages.Success'));
            return redirect()->route('Teachers');

        }  catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }

    public function EditTeachers($id)
    {
        $Teachers= Teacher::findOrFail($id);
        $specializations = Specialization::get();
        $genders = Gender::get();
        return view('pages.Teachers.edit',compact('Teachers','specializations','genders'));
    }

    public function UpdateTeachers($request)
    {
        try {
        $Teachers= Teacher::findOrFail($request->id);
        $Teachers->email = $request->Email;
        $Teachers->password = Hash::make($request->Password);
        $Teachers->Name = ['ar'=>$request->Name_ar,'en'=>$request->Name_en];
        $Teachers->Specialization_id = $request->Specialization_id;
        $Teachers->Gender_id = $request->Gender_id;
        $Teachers->Joining_Date = $request->Joining_Date;
        $Teachers->Address = $request->Address;
        $Teachers->save();
        toastr()->success(trans('messages.Update'));
        return redirect()->route('Teachers.index');
    }  catch (\Throwable $th) {
        return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
     }
    }

    public function DeleteTeachers($request)
    {
        try {
            Teacher::findOrFail($request->id)->delete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('Teachers.index');
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }
}
<?php

namespace App\Repository;
use App\Models\Student;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ProcessingFeeRepositoryInterface;
use App\Models\ProcessingFee;

class ProcessingFeeRepository implements ProcessingFeeRepositoryInterface
{

    public function index()
    {
        $ProcessingFees = ProcessingFee::get();
        return view('pages.ProcessingFee.index',compact('ProcessingFees'));
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.ProcessingFee.add',compact('student'));
    }

    public function create($request)
    {
        DB::beginTransaction();
        try {

            // اضافه البيانات في جدول معالجه الرسوم
            $processing_fee = new ProcessingFee();
            $processing_fee->date = date('Y-m-d');
            $processing_fee->student_id = $request->student_id;
            $processing_fee->amount = $request->amount;
            $processing_fee->description = $request->description;
            $processing_fee->save();

            // اضافه البيانات في جدول حساب الطالب 
            $student_account = new StudentAccount();
            $student_account->date = date('Y-m-d');
            $student_account->type = 'ProcessingFee';
            $student_account->student_id = $request->student_id;
            $student_account->processing_id = $processing_fee->id;
            $student_account->Debait = 0.00;
            $student_account->Credit = $request->amount;
            $student_account->notes = $request->description;
            $student_account->save();
         
            DB::commit(); // insert data
            toastr()->success(trans('messages.Success'));
            return redirect()->route('ProcessingFee.index');

        } catch (\Throwable $th) {
            DB::rollback(); // not insert data in database
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $ProcessingFee = ProcessingFee::findOrFail($id);
        return view('pages.ProcessingFee.edit',compact('ProcessingFee'));
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {

            // تعديل البيانات في جدول معالجه الرسوم
            $processing_fee =  ProcessingFee::findOrFail($request->id);
            $processing_fee->date = date('Y-m-d');
            $processing_fee->student_id = $request->student_id;
            $processing_fee->amount = $request->amount;
            $processing_fee->description = $request->description;
            $processing_fee->save();

            // تعديل البيانات في جدول حساب الطالب 
            $student_account = StudentAccount::where('receipt_id',$request->id)->first();
            $student_account->date = date('Y-m-d');
            $student_account->type = 'ProcessingFee';
            $student_account->student_id = $request->student_id;
            $student_account->processing_id = $processing_fee->id;
            $student_account->Debait = 0.00;
            $student_account->Credit = $request->amount;
            $student_account->notes = $request->description;
            $student_account->save();
         
            DB::commit(); // insert data
            toastr()->success(trans('messages.Update'));
            return redirect()->route('ProcessingFee.index');

        } catch (\Throwable $th) {
            DB::rollback(); // not insert data in database
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            ProcessingFee::destroy($request->id);
            toastr()->success(trans('messages.Delete'));
            return redirect()->back();

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }
}
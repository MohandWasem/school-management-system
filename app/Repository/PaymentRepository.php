<?php

namespace App\Repository;
use App\Models\Student;
use App\Models\fundAccount;
use App\Models\PaymentStudent;
use App\Models\StudentAccount;
use Illuminate\Support\Facades\DB;
use App\Interfaces\PaymentRepositoryInterface;

class PaymentRepository implements PaymentRepositoryInterface
{

    public function index()
    {
        $payment_students = PaymentStudent::get();
        return view('pages.Payment.index',compact('payment_students'));
    }
    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.Payment.add',compact('student'));
    }

    public function store($request)
    {
        DB::beginTransaction();
        try {


            // اضافه البيانات في جدول سند صرف  
            $payment_student = new PaymentStudent();
            $payment_student->date = date('Y-m-d');
            $payment_student->student_id = $request->student_id;
            $payment_student->amount = $request->amount;
            $payment_student->description = $request->description;
            $payment_student->save();

            // اضافه البيانات في جدول صندوق الحساب 
            $fund_account = new fundAccount();
            $fund_account->date = date('Y-m-d');
            $fund_account->payment_id =  $payment_student->id;
            $fund_account->Debait = 0.00;
            $fund_account->Credit = $request->amount;
            $fund_account->description = $request->description;
            $fund_account->save();

            //  اضافه البيانات في جدول جدول حساب الطالب 
            $student_account = new StudentAccount();
            $student_account->date = date('Y-m-d');
            $student_account->type = 'payment';
            $student_account->student_id  = $request->student_id;
            $student_account->payment_id  = $payment_student->id;
            $student_account->Debait  = $request->amount;
            $student_account->Credit  = 0.00;
            $student_account->notes  = $request->description;
            $student_account->save();
         
            DB::commit(); // insert data
            toastr()->success(trans('messages.Success'));
            return redirect()->route('PaymentStudent.index');

        } catch (\Throwable $th) {
            DB::rollback(); // not insert data in database
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $payment_student = PaymentStudent::findOrFail($id);
        return view('pages.Payment.edit',compact('payment_student'));
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {

            // تعديل البيانات في جدول سند صرف  
            $payment_student =  PaymentStudent::findOrFail($request->id);
            $payment_student->date = date('Y-m-d');
            $payment_student->student_id = $request->student_id;
            $payment_student->amount = $request->amount;
            $payment_student->description = $request->description;
            $payment_student->save();

            // تعديل البيانات في جدول صندوق الحساب 
            $fund_account =  fundAccount::where('payment_id',$request->id)->first();
            $fund_account->date = date('Y-m-d');
            $fund_account->payment_id =  $payment_student->id;
            $fund_account->Debait = 0.00;
            $fund_account->Credit = $request->amount;
            $fund_account->description = $request->description;
            $fund_account->save();

            //  تعديل البيانات في جدول جدول حساب الطالب 
            $student_account = StudentAccount::where('payment_id',$request->id)->first();
            $student_account->date = date('Y-m-d');
            $student_account->type = 'payment';
            $student_account->student_id  = $request->student_id;
            $student_account->payment_id  = $payment_student->id;
            $student_account->Debait  = $request->amount;
            $student_account->Credit  = 0.00;
            $student_account->notes  = $request->description;
            $student_account->save();
         
            DB::commit(); // insert data
            toastr()->success(trans('messages.Update'));
            return redirect()->route('PaymentStudent.index');

        } catch (\Throwable $th) {
            DB::rollback(); // not insert data in database
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            PaymentStudent::destroy($request->id);
            toastr()->success(trans('messages.Delete'));
            return redirect()->back();

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }
}
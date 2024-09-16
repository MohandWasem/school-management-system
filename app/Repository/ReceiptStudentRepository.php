<?php

namespace App\Repository;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ReceiptStudentRepositoryInterface;
use App\Models\fundAccount;
use App\Models\ReceiptStudent;
use App\Models\Student;
use App\Models\StudentAccount;

class ReceiptStudentRepository implements ReceiptStudentRepositoryInterface
{

    public function index()
    {
        $receipt_students = ReceiptStudent::get();
        return view('pages.Receipt_student.index',compact('receipt_students'));
    }

    public function show($id)
    {
        $student = Student::findOrFail($id);
        return view('pages.Receipt_student.add',compact('student'));
    }

    public function add($request)
    {
        DB::beginTransaction();
        try {

            // اضافه  البيانات في جدول  سند قبض 
            $receipt_student = new ReceiptStudent();
            $receipt_student->date = date('Y-m-d');
            $receipt_student->student_id = $request->student_id;
            $receipt_student->Debait = $request->Debit;
            $receipt_student->description = $request->description;
            $receipt_student->save();

            // اضافه البيانات في جدول صندوق الحساب 
            $fund_account = new fundAccount();
            $fund_account->date = date('Y-m-d');
            $fund_account->receipt_id =  $receipt_student->id;
            $fund_account->Debait = $request->Debit;
            $fund_account->Credit = 0.00;
            $fund_account->description = $request->description;
            $fund_account->save();

            //  اضافه البيانات في جدول جدول حساب الطالب 
            $student_account = new StudentAccount();
            $student_account->date = date('Y-m-d');
            $student_account->type = 'receipt';
            $student_account->student_id  = $request->student_id;
            $student_account->receipt_id  = $receipt_student->id;
            $student_account->Debait  = 0.00;
            $student_account->Credit  = $request->Debit;
            $student_account->notes  = $request->description;
            $student_account->save();
         
            DB::commit(); // insert data
            toastr()->success(trans('messages.Success'));
            return redirect()->route('ReceiptStudent.index');

        } catch (\Throwable $th) {
            DB::rollback(); // not insert data in database
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $receipt_student = ReceiptStudent::findOrFail($id);
        return view('pages.Receipt_student.edit',compact('receipt_student'));
    }
    public function update($request)
    {
        DB::beginTransaction();
        try {

            // تعديل  البيانات في جدول  سند قبض 
            $receipt_student = ReceiptStudent::findOrFail($request->id);
            $receipt_student->date = date('Y-m-d');
            $receipt_student->student_id = $request->student_id;
            $receipt_student->Debait = $request->Debit;
            $receipt_student->description = $request->description;
            $receipt_student->save();

            // تعديل البيانات في جدول صندوق الحساب 
            $fund_account =  fundAccount::where('receipt_id',$request->id)->first();
            $fund_account->date = date('Y-m-d');
            $fund_account->receipt_id =  $receipt_student->id;
            $fund_account->Debait = $request->Debit;
            $fund_account->Credit = 0.00;
            $fund_account->description = $request->description;
            $fund_account->save();

            //  تعديل البيانات في جدول جدول حساب الطالب 
            $student_account =  StudentAccount::where('receipt_id',$request->id)->first();
            $student_account->date = date('Y-m-d');
            $student_account->type = 'receipt';
            $student_account->student_id  = $request->student_id;
            $student_account->receipt_id  = $receipt_student->id;
            $student_account->Debait  = 0.00;
            $student_account->Credit  = $request->Debit;
            $student_account->notes  = $request->description;
            $student_account->save();

            DB::commit(); // insert data
            toastr()->success(trans('messages.Update'));
            return redirect()->route('ReceiptStudent.index');

        } catch (\Throwable $th) {
            DB::rollback(); // not insert data in database
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            ReceiptStudent::destroy($request->receipt_id);
            toastr()->success(trans('messages.Delete'));
            return redirect()->back();

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }
}
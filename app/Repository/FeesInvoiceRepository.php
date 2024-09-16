<?php

namespace App\Repository;
use App\Models\Fee;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Interfaces\FeesInvoiceRepositoryInterface;
use App\Models\Feeinvoice;
use App\Models\StudentAccount;

class FeesInvoiceRepository implements FeesInvoiceRepositoryInterface
{

    public function index()
    {
        $Fee_invoices = Feeinvoice::get();
        $Grades = Grade::get();
        return view('pages.Fees_Invoice.index',compact('Fee_invoices','Grades'));
    }
    public function show($id)
    {
        $student = Student::findOrFail($id);
        $fees = Fee::where('Classroom_id',$student->Classroom_id)->get();
        return view('pages.Fees_Invoice.add',compact('student','fees'));
    }

    public function store($request)
    {
        $List_Fees = $request->List_Fees;
        DB::beginTransaction();
        try {

            foreach($List_Fees as $List_Fee)
            {
                // حفظ البيانات في جدول فواتير الرسوم الدراسيه
                $Fee = new Feeinvoice();
                $Fee->invoice_date = date('Y-m-d');
                $Fee->student_id = $List_Fee['student_id'];
                $Fee->Grade_id = $request->Grade_id;
                $Fee->Classroom_id = $request->Classroom_id;
                $Fee->fee_id = $List_Fee['fee_id'];
                $Fee->amount = $List_Fee['amount'];
                $Fee->notes = $List_Fee['description'];
                $Fee->save();

                //  حفظ البيانات في جدول حسابات الطالب
                $student_account =  new StudentAccount();
                $student_account->date = date('Y-m-d');
                $student_account->type = 'invoice';
                $student_account->student_id = $List_Fee['student_id'];
                $student_account->fee_invoice_id = $Fee->id;
                $student_account->Debait = $List_Fee['amount'];
                $student_account->Credit = 0.00;
                $student_account->notes = $List_Fee['description'];
                $student_account->save();
            }
          
            DB::commit(); // insert data
            toastr()->success(trans('messages.Success'));
            return redirect()->route('FeeInvoice.index');

        } catch (\Throwable $th) {
            DB::rollback(); // not insert data in database
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    public function edit($id)
    {
        $fee_invoices = Feeinvoice::findOrFail($id);
        $fees = Fee::where('Classroom_id',$fee_invoices->Classroom_id)->get();
        return view('pages.Fees_Invoice.edit',compact('fee_invoices','fees'));
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {

            // تعديل البيانات في جدول فواتير الرسوم الدراسيه
            $fee_invoices = Feeinvoice::findOrFail($request->id);
            $fee_invoices->amount = $request->amount;
            $fee_invoices->fee_id = $request->fee_id;
            $fee_invoices->notes = $request->description;
            $fee_invoices->save();

            //  تعديل البيانات في جدول حسابات الطالب
            $student_account =   StudentAccount::where('fee_invoice_id',$fee_invoices->id)->first();
            $student_account->Debait = $request->amount;
            $student_account->notes = $request->description;
            $student_account->save();
         
            DB::commit(); // insert data
            toastr()->success(trans('messages.Update'));
            return redirect()->route('FeeInvoice.index');

        } catch (\Throwable $th) {
            DB::rollback(); // not insert data in database
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    public function destroy($request)
    {
        try {
            Feeinvoice::destroy($request->id);
            toastr()->success(trans('messages.Delete'));
            return redirect()->back();

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }
}
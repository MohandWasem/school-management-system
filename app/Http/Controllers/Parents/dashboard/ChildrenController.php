<?php

namespace App\Http\Controllers\Parents\dashboard;

use App\Models\Degree;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Feeinvoice;
use App\Models\ReceiptStudent;

class ChildrenController extends Controller
{
    public function index()
    {
        $childerns = Student::where('Parent_id',auth()->user()->id)->get();
        return view('pages.parent.childrens.children',compact('childerns'));
    }

    public function childrenResult($id)
    {
        $sons = Student::findOrfail($id);

        if($sons->Parent_id == auth()->user()->id)
        {
           $degrees = Degree::where('student_id',$id)->get();
           if($degrees->isEmpty()){
            toastr()->error('لا يوجد نتائج للطالب');
            return redirect()->route('children.index');
           }
           return view('pages.parent.degree.degree',compact('degrees'));

        } else {
            toastr()->error('خطأ في كود الطالب');
            return redirect()->route('children.index');
        }

    }

    public function attendance()
    {
        $students = Student::where('Parent_id',auth()->user()->id)->get();
        return view('pages.parent.attendance.index',compact('students'));
    }

    public function attendanceSearch(Request $request)
    {
        $request->validate([
            'from'=>'required|date|date_format:Y-m-d',
            'to'=>'required|date|date_format:Y-m-d|after_or_equal:form',
        ] ,
        [
            'to.after_or_equal'=>trans('messages.attendance_message'),
            'to.date_format'=>trans('messages.date_format'),
            'from.date_format'=>trans('messages.date_format')
        ]);

        $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
        $parent_id = auth()->user()->id;
        $students = Student::where('Parent_id',$parent_id)->whereIn('Section_id',$ids)->get();
        
        if($request->student_id == 0)
        {
            $Students = Attendance::whereIn('student_id',$students->pluck('id'))
                ->whereBetween('Attendance_date',[$request->from,$request->to])->get();
            return view('pages.parent.attendance.index',compact('Students','students'));
        } else {
            $Students = Attendance::whereIn('student_id',$students->pluck('id'))
                ->whereBetween('Attendance_date',[$request->from,$request->to])
                ->where('student_id',$request->student_id)->get();
            return view('pages.parent.attendance.index',compact('Students','students'));
        }
    }

    public function fees()
    {
        $students_id = Student::where('Parent_id',auth()->user()->id)->pluck('id');
        $Fee_invoices = Feeinvoice::whereIn('student_id',$students_id)->get();
        return view('pages.parent.fees.index',compact('Fee_invoices'));
    }

    public function receiptStudent($student_id)
    {
        $sons = Student::findOrfail($student_id);
        if($sons->Parent_id !== auth()->user()->id)
        {
            toastr()->error(' يوجد خطأ في كود الطالب');
            return redirect()->route('fees.index');
        }

        $receipt_students = ReceiptStudent::where('student_id',$student_id)->get();
        if($receipt_students->isEmpty())
        {
            toastr()->error('لا يوجد مدفوعات للطالب');
            return redirect()->route('fees.index');
        }
        return view('pages.parent.Receipt.index',compact('receipt_students'));
    }
}

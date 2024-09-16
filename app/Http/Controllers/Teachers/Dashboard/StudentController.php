<?php

namespace App\Http\Controllers\Teachers\Dashboard;

use App\Models\Section;
use App\Models\Student;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id',$ids)->get();
        return view('pages.Teachers.students.index',compact('students'));
    }

    public function section()
    {
        $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
        $sections = Section::whereIn('id',$ids)->get();
        return view('pages.Teachers.sections.index',compact('sections'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            // اضافه  البيانات في جدول الحضور والغياب 
            foreach ($request->attendances as $studentid => $attendance) {
               
                if($attendance == '1'){
                    $Attendance_status = true;
                } else if ($attendance == '0') {
                    $Attendance_status = false;
                }

                Attendance::UpdateOrCreate(['student_id'=>$studentid,'Attendance_date'=>date('Y-m-d')],[
                    'Attendance_date'=>date('Y-m-d'),
                    'student_id'=>$studentid,
                    'Grade_id'=>$request->grade_id,
                    'Classroom_id'=>$request->classroom_id,
                    'Section_id'=>$request->section_id,
                    'Teacher_id'=>auth()->user()->id,
                    'Attendance_status'=>$Attendance_status,
                ]);
            }

            toastr()->success(trans('messages.Success'));
            return redirect()->back();

        } catch (\Throwable $th) {
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    public function attendanceReport()
    {
        $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id',$ids)->get();
        return view('pages.Teachers.students.attendanceReport',compact('students'));
    }

    public function attendanceSearch(Request $request)
    {

        $request->validate([
            'from'=>'required|date|date_format:Y-m-d',
            'to'=>'required|date|date_format:Y-m-d|after_or_equal:from',
        ],[
            'to.after_or_equal'=>trans('messages.attendance_message'),
            'from.date_format'=>trans('messages.date_format'),
            'to.date_format'=>trans('messages.date_format'),
        ]);

        $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id',$ids)->get();

        if($request->student_id == 'all'){

            $Students = Attendance::whereBetween('Attendance_date',[$request->from,$request->to])->get();
            return view('pages.Teachers.students.attendanceReport',compact('Students','students'));
        } else {
            
            $Students = Attendance::whereBetween('Attendance_date',[$request->from,$request->to])
            ->where('student_id',$request->student_id)->get();
            return view('pages.Teachers.students.attendanceReport',compact('Students','students'));


        }
    }

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {

            // تعديل  البيانات في جدول الحضور والغياب 
            $date = date('Y-m-d');
            $studentId = Attendance::where('Attendance_date',$date)->where('student_id',$request->id)->first();
             
            if($request->attendences == 'presence'){
                $attendance_status = true;
            } else if ($request->attendences == 'absent') {
                $attendance_status = false;
            }

            $studentId->update([
                'Attendance_status'=>$attendance_status
            ]);

            toastr()->success(trans('messages.Success'));
            return redirect()->back();

        } catch (\Throwable $th) {
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Repository;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Interfaces\AttendanceRepositoryInterface;
use App\Models\Attendance;

class AttendanceRepository implements AttendanceRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::get();
        return view('pages.Attendance.Section',compact('Grades'));
    }

    public function show($id)
    {
        $students = Student::with('attendance')->where('section_id',$id)->get();
        return view('pages.Attendance.index',compact('students'));
    }

    public function store($request)
    {
        try {

            // اضافه  البيانات في جدول الحضور والغياب 
            foreach ($request->attendances as $studentid => $attendance) {
               
                if($attendance == '1'){
                    $Attendance_status = true;
                } else if ($attendance == '0') {
                    $Attendance_status = false;
                }

                Attendance::create([
                    'Attendance_date'=>date('Y-m-d'),
                    'student_id'=>$studentid,
                    'Grade_id'=>$request->grade_id,
                    'Classroom_id'=>$request->classroom_id,
                    'Section_id'=>$request->section_id,
                    'Teacher_id'=>1,
                    'Attendance_status'=>$Attendance_status,
                ]);
            }

            toastr()->success(trans('messages.Success'));
            return redirect()->back();

        } catch (\Throwable $th) {
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }
}
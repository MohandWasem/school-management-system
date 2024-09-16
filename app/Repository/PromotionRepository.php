<?php

namespace App\Repository;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use App\Interfaces\PromotionRepositoryInterface;
use App\Models\Promotion;

class PromotionRepository implements PromotionRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::get();
        return view('pages.Student.promotion.index',compact('Grades'));
    }

    public function create()
    {
        $promotions = Promotion::get();
        return view('pages.Student.promotion.management',compact('promotions'));
    }

    public function store($request)
    {
        
        DB::beginTransaction();
        try {
            // $students = Student::where('Grade_id',$request->Grade_id)->where('Classroom_id',$request->Classroom_id)->where('Section_id',$request->section_id)->where('academic_year',$request->academic_year)->get();
            $students = Student::query()
                ->where('Grade_id', $request->Grade_id)
                ->where('Classroom_id', $request->Classroom_id)
                ->where('Section_id', $request->section_id)
                ->where('academic_year', $request->academic_year)
                ->get();
            if($students->count() < 1){
                return redirect()->back()->with('error_promotions',trans('Students_trans.error_promotions'));
            }

            // update in table student 
            foreach($students as $student){
                $ids = explode(',',$student->id);
                Student::whereIn('id',$ids)
                    ->update([
                    'Grade_id'=>$request->Grade_id_new,
                    'Classroom_id'=>$request->Classroom_id_new,
                    'Section_id'=>$request->section_id_new,
                    'academic_year'=>$request->academic_year_new,
                ]);

                // insert i n table  promotion
                $Promotions = Promotion::updateOrCreate([
                    'student_id'=>$student->id,
                    'from_grade'=>$request->Grade_id,
                    'from_classroom'=>$request->Classroom_id,
                    'from_section'=>$request->section_id,
                    'to_grade'=>$request->Grade_id_new,
                    'to_classroom'=>$request->Classroom_id_new,
                    'to_section'=>$request->section_id_new,
                    'academic_year'=>$request->academic_year,
                    'academic_year_new'=>$request->academic_year_new,
                ]);
            }

            DB::commit(); // insert data
            toastr()->success(trans('messages.Success'));
            return redirect()->route('Promotion.index');

        } catch (\Throwable $th) {
            DB::rollback(); // not insert data in database
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    public function destory($request)
    {
        
        try {
        
            if($request->page_id == 1)
            {
                $Promotions = Promotion::get();
        
                foreach ($Promotions as $Promotion) {
                    $ids = explode(',', $Promotion->student_id);
        
                    Student::whereIn('id', $ids)
                        ->update([
                            'Grade_id' => $Promotion->from_grade,
                            'Classroom_id' => $Promotion->from_classroom,
                            'Section_id' => $Promotion->from_section,
                            'academic_year' => $Promotion->academic_year,
                        ]);
                }
        
                // حذف في جدول الترقية
                Promotion::truncate();
                toastr()->success(trans('messages.Delete'));
                return redirect()->back();
            }else {
                if($request->id)
                {
                    //  $Promotions = Promotion::where('id',$request->id)->first();
                    $Promotion = Promotion::findOrFail($request->id);
                    Student::where('id', $Promotion->student_id)
                    ->update([
                        'Grade_id' => $Promotion->from_grade,
                        'Classroom_id' => $Promotion->from_classroom,
                        'Section_id' => $Promotion->from_section,
                        'academic_year' => $Promotion->academic_year,
                    ]);

                    // حذف في جدول الترقية
                    // Promotion::destroy($request->id);
                    $Promotion->delete();
                    toastr()->success(trans('messages.Delete'));
                    return redirect()->back();
                }
            }
        
        } catch (\Throwable $th) {
            DB::rollback(); // عدم إدخال البيانات في قاعدة البيانات
            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
        
    }

}
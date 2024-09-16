<?php

namespace App\Repository;

use App\Models\Blood;
use App\Models\Grade;
use App\Models\Image;
use App\Models\Gender;
use App\Models\Section;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\MyParent;
use App\Models\Classroom;
use App\Models\Nationality;
use App\Models\StudentAttachment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface
{

    public function getStudent()
    {
        $Students = Student::get();
        // $Students = Student::with('images')->get();
        return view('pages.Student.show',compact('Students'));
    }


    public function CreateStudent()
    {
        $data['my_classes'] = Grade::get();
        $data['parents'] = MyParent::get();
        $data['Genders'] = Gender::get();
        $data['nationals'] = Nationality::get();
        $data['bloods'] = Blood::get();
        return view('pages.Student.create',$data);
    }

    public function getClassrooms($Grade_id)
    {
        $classroom = Classroom::where('Grade_id',$Grade_id)->pluck('Name_classroom','id');
        return response()->json($classroom);
    }

    public function getSections($Classroom_id)
    {
        $Section = Section::where('Classroom_id',$Classroom_id)->pluck('Name_Section','id');
        return response()->json($Section);
    }

    public function storeStudent($request)
    {

        DB::beginTransaction();
        try {
            
            $validated = $request->validated();

            $Students = new Student();
            $Students->Name = ['en'=>$request->name_en,'ar'=>$request->name_ar];
            $Students->email = $request->email;
            $Students->password = Hash::make($request->password);
            $Students->Gender_id = $request->gender_id;
            $Students->Nationality_id = $request->nationalitie_id;
            $Students->Blood_id = $request->blood_id;
            $Students->Date_Birth = $request->Date_Birth;
            $Students->Grade_id = $request->Grade_id;
            $Students->Classroom_id  = $request->Classroom_id;
            $Students->Section_id  = $request->section_id;
            $Students->Parent_id  = $request->parent_id;
            $Students->academic_year  = $request->academic_year;
            $Students->save();

            //  insert images
            if($request->hasfile('photos')){
                foreach ($request->file('photos') as $file) {
                    $name = $file->getClientOriginalName();
                    $file->storeAs('attachments/students/'.$Students->Name,$file->getClientOriginalName(),'upload_attachments');
                    // add image
                    $images = new StudentAttachment();
                    $images->file_name = $name;
                    $images->student_id = $Students->id;
                    // $images->imageable_type = 'App/Models/Student';
                    $images->save();
                }
            }
            DB::commit(); // insert data
            toastr()->success(trans('messages.Success'));
            return redirect()->route('Students.create');

        } catch (\Throwable $th) {
            DB::rollback(); // not insert data in database
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    public function editStudent($id)
    {
        $Students = Student::findOrFail($id);
        $data['Grades'] = Grade::get();
        $data['parents'] = MyParent::get();
        $data['Genders'] = Gender::get();
        $data['nationals'] = Nationality::get();
        $data['bloods'] = Blood::get();
        return view('pages.Student.edit',compact('Students'),$data);
    }

    public function updateStudent($request)
    {
        try {
            
            $Students = Student::findOrFail($request->id);
            $Students->Name = ['en'=>$request->name_en,'ar'=>$request->name_ar];
            $Students->email = $request->email;
            $Students->password = Hash::make($request->password);
            $Students->Gender_id = $request->gender_id;
            $Students->Nationality_id = $request->nationalitie_id;
            $Students->Blood_id = $request->blood_id;
            $Students->Date_Birth = $request->Date_Birth;
            $Students->Grade_id = $request->Grade_id;
            $Students->Classroom_id  = $request->Classroom_id;
            $Students->Section_id  = $request->section_id;
            $Students->Parent_id  = $request->parent_id;
            $Students->academic_year  = $request->academic_year;
            $Students->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Students.index');

        } catch (\Throwable $th) {
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    public function showStudent($id)
    {
        $Student = Student::with('Attachments')->findOrFail($id);
        return view('pages.Student.details_student',compact('Student'));
    }

    public function deleteStudent($request)
    {
        // Student::findOrFail($request->id)->delete();
        Student::destroy($request->id);
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('Students.index');
    }

    public function Upload_attachment($request)
    {
        if($request->hasfile('photos')){
            foreach ($request->file('photos') as $file) {
                $name = $file->getClientOriginalName();
                $file->storeAs('attachments/students/'.$request->student_name,$file->getClientOriginalName(),'upload_attachments');
                // add image
                $images = new StudentAttachment();
                $images->file_name = $name;
                $images->student_id = $request->student_id;
                // $images->imageable_type = 'App/Models/Student';
                $images->save();
            }
        }
        DB::commit(); // insert data
        toastr()->success(trans('messages.Success'));
        return redirect()->route('Students.show',$request->student_id);
        // return redirect()->back();
    }

    public function Download_attachment($studentname,$filename)
    {
        // return response()->download(public_path('attachments/students/'.$studentname.'/'.$filename));

        $studentname = urldecode($studentname);
        $filename = urldecode($filename);
        $filePath = public_path('attachments/students/' . $studentname . '/' . $filename);

        if (file_exists($filePath)) {
            return response()->download($filePath);
        } else {
            return response()->json(['message' => 'File not found.'], 404);
        }
    }

    public function Delete_attachment($request)
    {
        Storage::disk('upload_attachments')->delete('attachments/students/'.$request->student_name.'/'.$request->filename);

        // Delete in data
        StudentAttachment::where('id',$request->id)->where('file_name',$request->filename)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('Students.show',$request->student_id);
    }

    public function Open_attachment($studentsname, $filename) 
    {
        $filePath = 'attachments/students/' . $studentsname . '/' . $filename;

        if (Storage::disk('upload_attachments')->exists($filePath)) {
            return response()->file(storage_path($filePath));
        } else {
            abort(404, "File not found");
        }
    }
}
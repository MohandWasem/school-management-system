<?php

namespace App\Http\Controllers\Classrooms;

use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClassroomRequest;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = 1;
        $My_Classes = Classroom::with('Grades')->get();
        $Grades = Grade::get();
        return view('pages.My_Classes.show',compact('Grades','id','My_Classes'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function store(ClassroomRequest $request)
    {
        $List_classes = $request->List_Classes;
        try 
        {
            $validated = $request->validated();
            
            foreach ($List_classes as $List_classe){
                $classroom = new Classroom();
                $classroom->Name_classroom = ['ar' => $List_classe['Name'],'en' => $List_classe['Name_class_en']];
                $classroom->Grade_id = $List_classe['Grade_id'];
                $classroom->save();
            }
            toastr()->success(trans('messages.Success'));
            return redirect()->route('Classrooms.index');

        } catch (\Throwable $th) {
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
    public function update(ClassroomRequest $request)
    {
        try {
            
            $validated = $request->validated();
            $My_Classes = Classroom::findOrFail($request->id);
            $My_Classes->update([
                $My_Classes->Name_classroom = ['en'=>$request->Name_en,'ar'=>$request->Name],
                $My_Classes->Grade_id = $request->Grade_id,
            ]);

            toastr()->success(trans('messages.Update'));
            return redirect()->route('Classrooms.index');

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
    public function destroy(Request $request)
    {
        $Grades = Classroom::findOrFail($request->id)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('Classrooms.index');
    }

    public function delete_all(Request $request)
    {
        $delete_all_id = explode(',',$request->delete_all_id);
        Classroom::whereIn('id',$delete_all_id)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('Classrooms.index');
    }

    public function Filter_Classes(Request $request)
    {
        $Grades = Grade::all();
        $details = Classroom::select('*')->where('Grade_id',$request->Grade_id)->get();
        return view('pages.My_Classes.show',compact('Grades','details'));

    }

    public function getClassrooms($Grade_id)
    {
        $Grade= Grade::findOrFail($Grade_id);
        $classroom = Classroom::where('Grade_id',$Grade_id)->pluck('Name_classroom','id');
        return response()->json($classroom);
    }
}

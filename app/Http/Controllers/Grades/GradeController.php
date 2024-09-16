<?php

namespace App\Http\Controllers\Grades;

use App\Models\Grade;
use Illuminate\Http\Request;
use App\Http\Requests\StoreGrade;
use App\Http\Controllers\Controller;
use App\Models\Classroom;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id=1;
        $Grades = Grade::get();
        return view('pages.Grades.show',compact('Grades','id'));
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
    public function store(StoreGrade $request)
    {

        // if(Grade::where('Name->ar',$request->Name)
        //    ->orWhere('Name->en',$request->Name_en)
        //    ->exists()){
        //     toastr()->error(trans('messages.Error'));
        //     return redirect()->back();
        //     // return redirect()->back()->withErrors(trans('messages.Error'));
        // }
        try {
            
            $validated = $request->validated();
    
            $Grade = new Grade();
            $Grade->Name = ['en'=>$request->Name_en,'ar'=>$request->Name];
            $Grade->Notes = $request->Notes;
            $Grade->save();
            toastr()->success(trans('messages.Success'));
            return redirect()->route('Grades');

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
    public function update(StoreGrade $request)
    {
        try {
            
            $validated = $request->validated();
            $Grades = Grade::findOrFail($request->id);
            $Grades->update([
                $Grades->Name = ['en'=>$request->Name_en,'ar'=>$request->Name],
                $Grades->Notes = $request->Notes,
            ]);

            toastr()->success(trans('messages.Update'));
            return redirect()->route('Grades');

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

        $classroom_id = Classroom::where('Grade_id',$request->id)->count();
        
        if($classroom_id == 0){
            $Grades = Grade::findOrFail($request->id)->delete();
            toastr()->success(trans('messages.Delete'));
        }else{
            toastr()->error(trans('grades_trans.delete_Grade_Error'));
        }

        return redirect()->route('Grades');
    }
}

<?php

namespace App\Http\Controllers\Sections;

use App\Models\Grade;
use App\Models\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\SectionRequest;
use App\Models\Teacher;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = 1;
        $Grade_Section = Grade::with(['Sections'])->get();
        $List_Grades = Grade::get();
        $Teachers = Teacher::get();
        return view('pages.Sections.show',compact('List_Grades','id','Grade_Section','Teachers'));
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
    public function store(SectionRequest $request)
    {
        
        try {
            
            $validated = $request->validated();
            $Section = new Section();
            $Section->Name_Section = ['en'=>$request->Name_Section_En,'ar'=>$request->Name_Section_Ar];
            $Section->Grade_id = $request->Grade_id;
            $Section->Classroom_id = $request->Classroom_id;
            $Section->Status = 1;
            $Section->save();
            $Section->teachers()->attach($request->teacher_id);
            toastr()->success(trans('messages.Success'));
            return redirect()->route('Sections.index');

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
    public function update(SectionRequest $request)
    {
        try {
            
            $validated = $request->validated();

            $Sections = Section::findOrFail($request->id);
            $Sections->update([
                $Sections->Name_Section = ['en'=>$request->Name_Section_En,'ar'=>$request->Name_Section_Ar],
                $Sections->Grade_id = $request->Grade_id,
                $Sections->Classroom_id = $request->Classroom_id,
                $Sections->Status = isset($request->Status) ? 1 : 0,
            ]);

            $Sections->teachers()->sync($request->teacher_id ?? []);

            // $Sections->teachers()->sync($request->teacher_id ?? []);

            toastr()->success(trans('messages.Update'));
            return redirect()->route('Sections.index');

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
        $Sections = Section::findOrFail($request->id)->delete();
        toastr()->success(trans('messages.Delete'));
        return redirect()->route('Sections.index');
    }
}

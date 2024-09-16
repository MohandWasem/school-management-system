<?php

namespace App\Http\Controllers\Students\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Quizze;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $quizzes = Quizze::query()
            ->where('Grade_id',$user->Grade_id)
            ->where('Classroom_id',$user->Classroom_id)
            ->where('Section_id',$user->Section_id)
            ->orderBy('id','DESC')
            ->get();

        return view('pages.Student.Exams.index',compact('quizzes'));
    }

    public function dashboard()
    {
        $user = auth()->user();
         $quizzeCount = Quizze::query()
            ->where('Grade_id',$user->Grade_id)
            ->where('Classroom_id',$user->Classroom_id)
            ->where('Section_id',$user->Section_id)
            ->orderBy('id','DESC')
            ->count();

        return view('pages.Student.dashboard',compact('quizzeCount'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($quizz_id)
    {
        $student_id = Auth::user()->id;
        return view('pages.Student.Exams.show',compact('student_id','quizz_id'));
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
    public function update(Request $request, $id)
    {
        //
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

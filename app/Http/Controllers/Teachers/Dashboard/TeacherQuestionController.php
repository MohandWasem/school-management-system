<?php

namespace App\Http\Controllers\Teachers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Question;
use App\Models\Quizze;
use Illuminate\Http\Request;

class TeacherQuestionController extends Controller
{

    public function store(Request $request)
    {
        try {

            // اضافه البيانات في جدول الاختبارات 
            $Questions = new Question();
            $Questions->title = $request->title;
            $Questions->answers = $request->answers;
            $Questions->right_answer = $request->right_answer;
            $Questions->score = $request->score;
            $Questions->quizz_id = $request->quizz_id;
            $Questions->save();
            toastr()->success(trans('messages.Success'));
            return redirect()->back();

        }  catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }

    public function show($id)
    {
        // $quizz_id = $id;
        $quizz_id = Quizze::findOrFail($id);
        return view('pages.Teachers.Questions.create',compact('quizz_id'));
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('pages.Teachers.Questions.edit',compact('question'));
    }

    public function update(Request $request)
    {
        try {

            // اضافه البيانات في جدول الاختبارات 
            $Questions =  Question::findOrFail($request->id);
            $Questions->title = $request->title;
            $Questions->answers = $request->answers;
            $Questions->right_answer = $request->right_answer;
            $Questions->score = $request->score;
            $Questions->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->back();

        }  catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }

    public function destroy(Request $request)
    {
        try {
            Question::findOrFail($request->id)->delete();
            toastr()->success(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }
}

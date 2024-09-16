<?php

namespace App\Repository;
use App\Models\Quizze;
use App\Interfaces\QuestionRepositoryInterface;
use App\Models\Question;

class QuestionRepository implements QuestionRepositoryInterface
{

    public function index()
    {
        $questions = Question::get();
        return view('pages.Questions.index',compact('questions'));
    }

    public function create()
    {
        $quizzes = Quizze::get();
        return view('pages.Questions.create',compact('quizzes'));
    }

    public function store($request)
    {
        try {
 
            // اضافه البيانات في جدول الاسئلة 
            $question = new  Question();
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quizz_id = $request->quizze_id;
            $question->save();
            toastr()->success(trans('messages.Success'));
            return redirect()->back();

        }  catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $quizzes = Quizze::get();
        return view('pages.Questions.edit',compact('question','quizzes'));
    }

    public function update($request)
    {
        try {
 
            // تعديل  البيانات في جدول الاسئلة 
            $question = Question::findOrFail($request->id);
            $question->title = $request->title;
            $question->answers = $request->answers;
            $question->right_answer = $request->right_answer;
            $question->score = $request->score;
            $question->quizz_id = $request->quizze_id;
            $question->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->back();

        }  catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }

    public function destroy($request)
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
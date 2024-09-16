<?php

namespace App\Http\Livewire;

use App\Models\Degree;
use App\Models\Question;
use GrahamCampbell\ResultType\Success;
use Livewire\Component;

class ShowQuestion extends Component
{

    public $quizz_id,$student_id,$data,$counter = 0,$questionCount = 0;

    public function render()
    {
        $this->data = Question::where('quizz_id',$this->quizz_id)->get();
        $this->questionCount = $this->data->count();
        return view('livewire.show-question',['data']);
    }

    public function nextQuestion($question_id, $score ,$answer, $right_answer)
    {
        $stuDegree = Degree::where('student_id',$this->student_id)
            ->where('quizz_id',$this->quizz_id)
            ->first();
        // insert
        if($stuDegree == null)
        {
            $degree = new Degree();
            $degree->quizz_id = $this->quizz_id;
            $degree->student_id = $this->student_id;
            $degree->question_id = $question_id;

            if(strcmp(trim($answer),trim($right_answer)) === 0)
            {
                $degree->score +=$score;
            } else {
                $degree->score +=0;
            }
            $degree->date = date('Y-m-d');
            $degree->save();

        } else {
          if($stuDegree->question_id >= $this->data[$this->counter]->id )
          {
            $stuDegree->score = 0;
            $stuDegree->abuse = '1';
            $stuDegree->save();
            toastr()->error('تم الغاء الاختبار لاكتشاف تلاعب بالنظام');
            return redirect('Exams');

          // update
          } else {
            $stuDegree->question_id = $question_id;
            if(strcmp(trim($answer),trim($right_answer)) === 0)
            {
                $stuDegree->score += $score;
            } else {
                $stuDegree->score += 0;
            }
            $stuDegree->save();
          }
        }

        if($this->counter < $this->questionCount - 1)
        {
            $this->counter++;
        } else {
            toastr()->success('تم اجراء الاختبار بنجاح');
            return redirect()->route('Exams.index');
        }
    }
}

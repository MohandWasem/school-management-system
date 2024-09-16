<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function quizz()
    {
        return $this->belongsTo(Quizze::class, 'quizz_id');
    }

    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Quizze extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name'];
    protected $guarded = [];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'Teacher_id');
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class, 'Classroom_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'Subject_id');
    }

    public function Section()
    {
        return $this->belongsTo(Section::class, 'Section_id');
    }

    public function degree()
    {
        return $this->hasMany(Degree::class, 'quizz_id');
    }
}

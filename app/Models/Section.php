<?php

namespace App\Models;

use App\Models\Grade;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name_Section'];
    protected $fillable = [
        'Name_Section','Grade_id','Status','Classroom_id'
    ];

    public function Grades()
    {
        return $this->belongsTo(Grade::class,'Grade_id');
    }

    public function Classrooms()
    {
        return $this->belongsTo(Classroom::class,'Classroom_id');
    }

    // لعلاقة الاقسام مع المعلمين pivot tableجدول ال
    public function teachers() 
    {
        return $this->belongsToMany('App\Models\Teacher','teacher_section'); //teacher_sectionاللي اسمه Pivot table لازم احط اسم ال
    }
}

<?php

namespace App\Models;

use App\Models\Gender;
use App\Models\Specialization;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name'];
    protected $guarded=[];

    public function specializations()
    {
        return $this->belongsTo(Specialization::class, 'Specialization_id');
    }

    public function genders()
    {
        return $this->belongsTo(Gender::class, 'Gender_id');
    }

    // علاقة المعلمين مع الاقسام
    public function Sections()
    {
        return $this->belongsToMany('App\Models\Section','teacher_section');
    }
}

<?php

namespace App\Models;

use App\Models\Blood;
use App\Models\Grade;
use App\Models\Image;
use App\Models\Gender;
use App\Models\Section;
use App\Models\MyParent;
use App\Models\Classroom;
use App\Models\Nationality;
use App\Models\StudentAttachment;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use SoftDeletes;
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name'];
    protected $guarded=[];

    public function genders()
    {
        return $this->belongsTo(Gender::class, 'Gender_id');
    }

    public function nationalities()
    {
        return $this->belongsTo(Nationality::class, 'Nationality_id');
    }

    public function bloods()
    {
        return $this->belongsTo(Blood::class, 'Blood_id');
    }

    public function grades()
    {
        return $this->belongsTo(Grade::class, 'Grade_id');
    }

    public function classrooms()
    {
        return $this->belongsTo(Classroom::class, 'Classroom_id');
    }

    public function sections()
    {
        return $this->belongsTo(Section::class, 'Section_id');
    }

    public function parents()
    {
        return $this->belongsTo(MyParent::class, 'Parent_id');
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function Attachments()
    {
        return $this->hasMany(StudentAttachment::class,'student_id');
    }

    public function student_account()
    {
        return $this->hasMany(StudentAccount::class,'student_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class,'student_id');

    }


}

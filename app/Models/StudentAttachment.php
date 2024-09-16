<?php

namespace App\Models;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentAttachment extends Model
{
    use HasFactory;

    protected $fillable = ['file_name','student_id'];

    public function student()
    {
        return $this->belongsTo(Student::class,'student_id');
    }
}

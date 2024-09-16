<?php

namespace App\Models;

use App\Models\Fee;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Classroom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feeinvoice extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_date','student_id','Grade_id','Classroom_id','fee_id','amount','notes'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function Grade()
    {
        return $this->belongsTo(Grade::class,'Grade_id');
    }

    public function Classroom()
    {
        return $this->belongsTo(Classroom::class,'Classroom_id');
    }

    public function Fee()
    {
        return $this->belongsTo(Fee::class,'fee_id');
    }
}

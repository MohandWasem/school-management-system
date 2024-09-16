<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAccount extends Model
{
    use HasFactory;
    protected $fillable = ['student_id','fee_invoice_id','date','Debait','Credit','notes','type'];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    // public function Grade()
    // {
    //     return $this->belongsTo(Grade::class,'Grade_id');
    // }

    // public function Classroom()
    // {
    //     return $this->belongsTo(Classroom::class,'Classroom_id');
    // }

    public function Fee_invoice()
    {
        return $this->belongsTo(Feeinvoice::class, 'fee_invoice_id');
    }
}

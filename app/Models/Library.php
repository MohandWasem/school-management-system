<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Library extends Model
{
    use HasFactory;
    protected $table = 'library';
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

    public function section()
    {
        return $this->belongsTo(Section::class, 'Section_id');
    }
}

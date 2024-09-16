<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OnlineClasse extends Model
{
    use HasFactory;
    protected $guarded = [];

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

    public function user()
    {
        return $this->belongsTo(User::class, 'User_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fee extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name'];
    protected $fillable = ['Name','amount','Grade_id','Classroom_id','academic_year','notes','Fee_type'];

    public function grade()
    {
        return $this->belongsTo(Grade::class,'Grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class,'Classroom_id');

    }
}

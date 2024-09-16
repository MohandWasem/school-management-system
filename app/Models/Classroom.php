<?php

namespace App\Models;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classroom extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name_classroom'];
    protected $fillable = [
        'Name_classroom','Grade_id'
    ];

    public function Grades()
    {
        return $this->belongsTo(Grade::class,'Grade_id');
    } 
}

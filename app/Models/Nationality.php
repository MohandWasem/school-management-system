<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nationality extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name'];
    protected $fillable = ['Name'];

//  دي نفس fillable بس دي بتبقي فارغه مش بيتحط فيها اي عمود 
// protected $guarded = [];
}

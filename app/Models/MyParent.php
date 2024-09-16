<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MyParent extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name_Father','Job_Father','Name_Mother','Job_Mother']; //دول هيتم ترجمتهم
    //  دي نفس fillable بس دي بتبقي فارغه مش بيتحط فيها اي عمود 
    protected $guarded = [];

}

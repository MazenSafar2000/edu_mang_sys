<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class My_Parent extends Authenticatable
{
    use HasTranslations;
    public $translatable = ['Name_Father','Job_Father',];
    protected $table = 'my__parents';
    protected $guarded=[];
}

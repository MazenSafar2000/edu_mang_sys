<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Translatable\HasTranslations;

class Teacher extends  Authenticatable
{
    use HasTranslations;
    public $translatable = ['Name'];
    protected $guarded = [];

    public function specializations()
    {
        return $this->belongsTo('App\Models\Specialization', 'Specialization_id');
    }

    public function genders()
    {
        return $this->belongsTo('App\Models\Gender', 'Gender_id');
    }

    public function Sections()
    {
        return $this->belongsToMany('App\Models\Section', 'teacher_section');
    }

    public function subjects()
    {
        return $this->hasMany('App\Models\Subject', 'teacher_id');
    }

    public function libraries()
    {
        return $this->hasMany(Library::class);
    }
}

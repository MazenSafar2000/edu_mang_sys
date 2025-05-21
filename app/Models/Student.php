<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Student extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    use HasTranslations;
    public $translatable = ['name'];
    protected $guarded = [];

    public function gender()
    {
        return $this->belongsTo('App\Models\Gender', 'gender_id');
    }

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }

    public function classroom()
    {
        return $this->belongsTo('App\Models\Classroom', 'Classroom_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function myparent()
    {
        return $this->belongsTo('App\Models\My_Parent', 'parent_id');
    }

    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher', 'teacher_section', 'section_id', 'teacher_id');
    }

    public function homeworkSubmissions()
    {
        return $this->hasMany(HomeworkSubmission::class);
    }

    public function submissions()
{
    return $this->hasMany(HomeworkSubmission::class);
}



    protected static function booted()
    {
        static::deleting(function ($student) {
            foreach ($student->images as $image) {
                Storage::disk('upload_attachments')->delete('attachments/students/' . $student->name['en'] . '/' . $image->filename);
            }

            $student->images()->delete();
        });
    }
}

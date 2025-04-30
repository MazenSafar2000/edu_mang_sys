<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homework extends Model
{
    use HasFactory;

    protected $table = 'homeworks';

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'title',
        'description',
        'total_degree',
        'allowed_file_types',
        'allow_multiple_submissions',
        'due_date',
        'grade_id',
        'classroom_id',
        'section_id',
        'attachment_path',
    ];

    protected $casts = [
        'allowed_file_types' => 'array',
        'due_date' => 'datetime',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function submissions()
    {
        return $this->hasMany(HomeworkSubmission::class);
    }

    public function grade()
    {
        return $this->belongsTo(Grade::class);
    }

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

}

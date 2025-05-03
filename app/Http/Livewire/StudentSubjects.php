<?php

namespace App\Http\Livewire;

use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class StudentSubjects extends Component
{

    public $subjects;

    public function mount()
    {
        $student = Auth::user();
        $this->subjects = Subject::with('teacher')
            ->where('grade_id', $student->Grade_id)
            ->where('classroom_id', $student->Classroom_id)
            ->get();
    }

    public function render()
    {
        return view('livewire.student-subjects');
    }
}

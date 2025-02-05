<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CalendarStudent extends Component
{
    public function render()
    {
        // Retrieve the authenticated student
        $student = Auth::user(); // Assuming you are using the default "user" guard for students

        // Retrieve the section of the student
        $section = $student->section;

        // Retrieve the teachers associated with the student's section
        $teachers = $section->teachers()->take(5)->get();

        return view('livewire.calendar-student', compact('teachers'));
    }
}

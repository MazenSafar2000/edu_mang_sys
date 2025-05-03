<?php

namespace App\Http\Livewire;

use App\Models\Student;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class CalendarStudent extends Component
{
    public function render()
    {
        return view('livewire.calendar-student');
    }
}

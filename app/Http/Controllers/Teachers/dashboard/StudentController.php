<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\Library;
use App\Models\online_classe;
use App\Models\Quizze;
use App\Models\RecordedClass;
use App\Models\Section;
use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{

    public function index()
    {
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $students = Student::whereIn('section_id', $ids)->get();
        return view('pages.Teachers.dashboard.students.index', compact('students'));
    }

    public function sections()
    {
        $ids = DB::table('teacher_section')->where('teacher_id', auth()->user()->id)->pluck('section_id');
        $sections = Section::whereIn('id', $ids)->get();
        return view('pages.Teachers.dashboard.sections.index', compact('sections'));
    }

    public function studentInformation($id)
    {
        try {
            $student = Student::with(['gender', 'grade', 'classroom', 'section', 'myparent'])->findOrFail($id);
            return view('pages.Teachers.dashboard.students.students_information', compact('student'));
        } catch (\Exception $e) {
            return redirect()->back()->with('status', 'Student not found or an error occurred.');
        }
    }

    public function showMaterials($sectionId)
    {
        $teacherId = auth()->user()->id;
        $section = Section::findOrFail($sectionId);

        $books = Library::where('section_id', $sectionId)
            ->where('teacher_id', $teacherId)
            ->get();

        $homeworks = Homework::where('section_id', $sectionId)
            ->where('teacher_id', $teacherId)
            ->get();

        $quizzes = Quizze::where('section_id', $sectionId)
            ->where('teacher_id', $teacherId)
            ->get();

        $onlineClasses = online_classe::where('section_id', $sectionId)
            ->where('created_by', auth()->user()->email) // assuming email is used
            ->get();

        $recordedClasses = RecordedClass::where('section_id', $sectionId)
            ->where('teacher_id', $teacherId)
            ->get();

        return view('pages.Teachers.dashboard.sections.show_materials', compact('books', 'homeworks', 'quizzes', 'onlineClasses', 'recordedClasses', 'section'));
    }
}

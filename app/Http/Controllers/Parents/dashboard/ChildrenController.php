<?php

namespace App\Http\Controllers\Parents\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Degree;
use App\Models\Homework;
use App\Models\HomeworkSubmission;
use App\Models\My_Parent;
use App\Models\Quizze;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ChildrenController extends Controller
{
    public function index()
    {

        $students = Student::where('parent_id', auth()->user()->id)->get();
        return view('pages.parents.children.index', compact('students'));
    }

    public function results($id)
    {

        $student = Student::findorFail($id);

        if ($student->parent_id !== auth()->user()->id) {
            toastr()->error('يوجد خطا في كود الطالب');
            return redirect()->route('sons.index');
        }
        $degrees = Degree::where('student_id', $id)->get();

        if ($degrees->isEmpty()) {
            toastr()->error('لا توجد نتائج لهذا الطالب');
            return redirect()->route('sons.index');
        }

        return view('pages.parents.degrees.index', compact('degrees'));
    }

    public function profile()
    {
        $information = My_Parent::findorFail(auth()->user()->id);
        return view('pages.parents.profile', compact('information'));
    }

    public function update(Request $request, $id)
    {

        $information = My_Parent::findorFail($id);

        if (!empty($request->password)) {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->password = Hash::make($request->password);
            $information->save();
        } else {
            $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $information->save();
        }
        toastr()->success(trans('messages.Update'));
        return redirect()->back();
    }

    public function student_info(Request $request, $id)
    {
        $student = Student::with(['grade', 'classroom', 'section'])->findOrFail($id);
        $subjects = Subject::where('classroom_id', $student->Classroom_id)->get();
        $teacher_ids = DB::table('teacher_section')
            ->where('section_id', $student->section_id)
            ->pluck('teacher_id')
            ->toArray();
        $teachers = Teacher::whereIn('id', $teacher_ids)->get();

        return view('pages.parents.children.student_info', compact('student', 'subjects', 'teachers'));
    }

    public function subjectDetails($student_id, $subject_id)
    {
        $student = Student::findOrFail($student_id);
        $subject = Subject::findOrFail($subject_id);

        $quizzes = Quizze::where('subject_id', $subject_id)->where('grade_id', $student->Grade_id)->get();
        $homeworks = Homework::where('subject_id', $subject_id)->where('grade_id', $student->Grade_id)->get();

        return view('pages.parents.children.subject_details', compact('student', 'subject', 'quizzes', 'homeworks'));
    }

    public function previewQuiz($quiz_id, $student_id)
    {
        $quiz = Quizze::with('subject')->findOrFail($quiz_id);

        $studentDegree = Degree::where('quizze_id', $quiz->id)
            ->where('student_id', $student_id)
            ->first();

        return view('pages.parents.children.preview_quiz', compact('quiz', 'studentDegree'));
    }

    public function previewHomework($homework_id, $student_id)
    {
        $homework = Homework::findOrFail($homework_id);

        $submission = HomeworkSubmission::where('homework_id', $homework_id)
            ->where('student_id', $student_id)
            ->first();

        return view('pages.parents.children.preview_homework', compact('homework', 'submission'));
    }
}

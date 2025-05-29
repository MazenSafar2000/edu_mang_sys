<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Degree;
use App\Models\Grade;
use App\Models\Question;
use App\Models\Quizze;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Notifications\Parent\NewExamAdded as ParentNewExamAdded;
use App\Notifications\Student\NewExamAdded;
use Illuminate\Http\Request;

class QuizzController extends Controller
{


    public function index()
    {
        $quizzes = Quizze::where('teacher_id', auth()->user()->id)->get();
        return view('pages.Teachers.dashboard.Quizzes.index', compact('quizzes'));
    }


    public function create()
    {
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id', auth()->user()->id)->get();
        return view('pages.Teachers.dashboard.Quizzes.create', $data);
    }


    public function store(Request $request)
    {
        try {
            $quizzes = new Quizze();
            $quizzes->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizzes->subject_id = $request->subject_id;
            $quizzes->grade_id = $request->Grade_id;
            $quizzes->classroom_id = $request->Classroom_id;
            $quizzes->section_id = $request->section_id;
            $quizzes->teacher_id = auth()->user()->id;
            $quizzes->duration = $request->duration;
            $quizzes->start_at = $request->start_at;
            $quizzes->end_at = $request->end_at;
            $quizzes->save();

            $students = Student::where('grade_id', $request->Grade_id)
                ->where('classroom_id', $request->Classroom_id)
                ->where('section_id', $request->section_id)
                ->get();


            $examTitle = $quizzes->getTranslation('name', app()->getLocale());

            foreach ($students as $student) {
                $student->notify(new NewExamAdded($quizzes->id, $examTitle, auth()->user()->Name));
                $student->myparent->notify(new ParentNewExamAdded($quizzes, $student));
            }

            toastr()->success(trans('messages.success'));
            return redirect()->route('quizzes.create');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }



    public function edit($id)
    {
        $quizz = Quizze::findorFail($id);
        $data['grades'] = Grade::all();
        $data['subjects'] = Subject::where('teacher_id', auth()->user()->id)->get();
        return view('pages.Teachers.dashboard.Quizzes.edit', $data, compact('quizz'));
    }

    public function show($id)
    {
        $questions = Question::where('quizze_id', $id)->get();
        $quizz = Quizze::findorFail($id);
        return view('pages.Teachers.dashboard.Questions.index', compact('questions', 'quizz'));
    }

    public function update(Request $request)
    {
        try {
            $quizz = Quizze::findorFail($request->id);
            $quizz->name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];
            $quizz->subject_id = $request->subject_id;
            $quizz->grade_id = $request->Grade_id;
            $quizz->classroom_id = $request->Classroom_id;
            $quizz->section_id = $request->section_id;
            $quizz->duration = $request->duration;
            $quizz->teacher_id = auth()->user()->id;
            $quizz->start_at = $request->start_at;
            $quizz->end_at = $request->end_at;
            $quizz->save();

            toastr()->success(trans('messages.Update'));
            return redirect()->route('quizzes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        try {
            Quizze::destroy($id);
            toastr()->error(trans('messages.Delete'));
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function student_quizze($quizze_id)
    {
        $quiz = Quizze::findOrFail($quizze_id);

        // Get all students in the quiz's section
        $students = Student::where('section_id', $quiz->section_id)->get();

        // Get degrees for this quiz
        $degrees = Degree::where('quizze_id', $quizze_id)->get();

        // Pass all data to the view
        return view('pages.Teachers.dashboard.Quizzes.student_quizze', compact('students', 'degrees', 'quiz'));
    }

    public function storeManualDegree(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'quizze_id' => 'required|exists:quizzes,id',
            'score' => 'required|numeric|min:0',
            'feedback' => 'nullable|string',
        ]);

        $degree = Degree::where('student_id', $request->student_id)
            ->where('quizze_id', $request->quizze_id)
            ->first();

        if ($degree) {
            $degree->update([
                'score' => $request->score,
                'feedback' => $request->feedback,
                'date' => now(),
            ]);
        } else {
            Degree::create([
                'student_id' => $request->student_id,
                'quizze_id' => $request->quizze_id,
                'score' => $request->score,
                'feedback' => $request->feedback,
                'abuse' => '0',
                'date' => now(),
            ]);
        }

        return back()->with('success', trans('teacher_trans.score_saved'));
    }

    public function repeat_quizze(Request $request, $quizze_id)
    {
        $quiz = Quizze::findOrFail($quizze_id);

        if (now()->greaterThan($quiz->end_at)) {
            return redirect()->back()->with('error', trans('teacher_trans.plz_update_end_at'));
        }

        Degree::where('student_id', $request->student_id)
            ->where('quizze_id', $quizze_id)
            ->delete();

        return redirect()->back()->with('success', trans('teacher_trans.reopen_success'));
    }
}

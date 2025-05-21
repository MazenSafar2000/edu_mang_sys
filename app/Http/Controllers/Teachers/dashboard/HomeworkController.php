<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Traits\AttachFilesTrait;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\Homework;
use App\Models\HomeworkSubmission;
use App\Models\Section;
use App\Models\Student;
use App\Models\Subject;
use App\Notifications\Student\NewBookAdded;
use App\Notifications\Student\NewHomeworkAdded;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeworkController extends Controller
{
    use AttachFilesTrait;

    public function index()
    {
        $homeworks = Homework::where('teacher_id', Auth::id())->latest()->paginate(10);
        return view('pages.Teachers.dashboard.Homeworks.index', compact('homeworks'));
    }

    public function create()
    {
        $grades = Grade::all();
        $subjects = Subject::where('teacher_id', Auth::id())->get();
        return view('pages.Teachers.dashboard.Homeworks.create', compact('subjects', 'grades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'subject_id' => 'required|exists:subjects,id',
            'grade_id' => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'due_date' => 'required|date|after_or_equal:today',
            'allowed_file_types' => 'required|array',
            'allowed_file_types.*' => 'in:pdf,doc,docx,jpg,png,rar,zip',
            'total_degree' => 'required|numeric|min:0|max:100',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,png,zip,rar|max:2048',
        ]);

        $homework = Homework::create([
            'teacher_id' => Auth::id(),
            'subject_id' => $request->subject_id,
            'title' => $request->title,
            'description' => $request->description,
            'total_degree' => $request->total_degree,
            'allowed_file_types' => $request->allowed_file_types,
            'allow_multiple_submissions' => $request->has('allow_multiple_submissions'),
            'due_date' => $request->due_date,
            'grade_id' => $request->grade_id,
            'classroom_id' => $request->classroom_id,
            'section_id' => $request->section_id,
        ]);


        if ($request->hasFile('attachment')) {
            $teacherName = Auth::user()->getTranslation('Name', 'en');
            $path = $this->uploadHomeworkFile($request, $teacherName);
            $homework->update(['attachment_path' => $path]);
        }

        $students = Student::where('grade_id', $request->grade_id)
            ->where('classroom_id', $request->classroom_id)
            ->where('section_id', $request->section_id)
            ->get();


        foreach ($students as $student) {
            $student->notify(new NewHomeworkAdded($homework->id, $homework->title, auth()->user()->Name));
        }


        toastr()->success(trans('messages.success'));
        return redirect()->route('teacher.homeworks.index');
    }

    public function show(Homework $homework)
    {
        // Check if the logged-in teacher is the owner
        if ($homework->teacher_id !== Auth::id()) {
            abort(403);
        }

        return view('pages.Teachers.dashboard.Homeworks.view', compact('homework'));
    }

    public function showSubmissions(Homework $homework)
    {
        // Get students in the same grade/class/section of the homework
        $students = Student::with(['submissions' => function ($q) use ($homework) {
            $q->where('homework_id', $homework->id);
        }])
            ->where('grade_id', $homework->grade_id)
            ->where('classroom_id', $homework->classroom_id)
            ->where('section_id', $homework->section_id)
            ->get();



        return view('pages.Teachers.dashboard.Homeworks.show', compact('homework', 'students'));
    }

    public function gradeStudent(Request $request, Homework $homework, Student $student)
    {
        $submission = HomeworkSubmission::firstOrCreate([
            'homework_id' => $homework->id,
            'student_id' => $student->id,
        ], [
            'submitted_at' => now(), // default value in case it's a 0 grade
            'file_path' => null,
            'status' => 'graded'
        ]);

        $submission->update([
            'degree' => $request->degree,
            'feedback' => $request->feedback,
            'status' => 'graded',
        ]);

        toastr()->success(trans('messages.Update'));
        return back();
    }


    // public function gradeStudent(Request $request, HomeworkSubmission $submission)
    // {
    //     $request->validate([
    //         'degree' => 'required|integer|min:0|max:' . $submission->homework->total_degree,
    //     ]);

    //     $submission->update([
    //         'degree' => $request->degree,
    //         'status' => $submission->is_late ? 'late' : 'graded',
    //     ]);

    //     return back()->with('success', __('Teacher_trans.graded_successfully'));
    // }


    public function edit($id)
    {
        $homework = Homework::findOrFail($id);
        $subjects = Auth::user()->subjects;
        $grades = Grade::all();

        return view('pages.Teachers.dashboard.Homeworks.edit', compact('homework', 'subjects', 'grades'));
    }

    public function update(Request $request, $id)
    {

        try {

            $homework = Homework::findOrFail($id);

            $request->validate([
                'subject_id' => 'required|exists:subjects,id',
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'grade_id' => 'required|exists:grades,id',
                'classroom_id' => 'required|exists:classrooms,id',
                'section_id' => 'required|exists:sections,id',
                'total_degree' => 'required|numeric|min:0|max:100',
                'allowed_file_types' => 'required|array',
                'allowed_file_types.*' => 'in:pdf,doc,docx,jpg,png,rar,zip',
                'due_date' => 'required|date',
                'attachment' => 'nullable|file|mimes:pdf,doc,docx,jpg,png,zip,rar|max:2048',

            ]);

            $homework->update([
                'subject_id' => $request->subject_id,
                'title' => $request->title,
                'description' => $request->description,
                'total_degree' => $request->total_degree,
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'section_id' => $request->section_id,
                'allowed_file_types' => $request->allowed_file_types,
                'allow_multiple_submissions' => $request->has('allow_multiple_submissions') ? true : false,
                'due_date' => $request->due_date,
            ]);

            if ($request->has('remove_attachment') && $homework->attachment_path) {
                $this->deleteHomeworkFile($homework->attachment_path);
                $homework->update(['attachment_path' => null]);
            }

            if ($request->hasFile('attachment')) {
                // Delete old file first
                if ($homework->attachment_path) {
                    $this->deleteHomeworkFile($homework->attachment_path);
                }

                $teacherName = Auth::user()->Name;
                $path = $this->uploadHomeworkFile($request, $teacherName);
                $homework->update(['attachment_path' => $path]);
            }

            toastr()->success(trans('messages.Update'));
            return redirect()->route('teacher.homeworks.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            toastr()->error($e->getMessage());
        }
    }

    public function destroy(Homework $homework, $id)
    {
        $homework = Homework::findOrFail($id);

        // Check if the logged-in teacher is the owner
        if ($homework->teacher_id !== Auth::id()) {
            abort(403);
        }

        // Delete attachment if it exists
        if ($homework->attachment_path) {
            $this->deleteHomeworkFile($homework->attachment_path);
        }

        // Delete homework record
        $homework->delete();

        toastr()->error(trans('messages.Delete'));
        return redirect()->route('teacher.homeworks.index');
    }

    public function getClassrooms($grade_id)
    {
        $teacher_id = Auth::id();
        $locale = App::getLocale(); // detect current app language

        $classroom_ids = Section::whereHas('teachers', function ($q) use ($teacher_id) {
            $q->where('teacher_id', $teacher_id);
        })->where('Grade_id', $grade_id)
            ->pluck('Class_id')
            ->unique();

        $classrooms = Classroom::whereIn('id', $classroom_ids)->get();

        // Map the result to pick only current language
        $classrooms = $classrooms->map(function ($classroom) use ($locale) {
            return [
                'id' => $classroom->id,
                'name' => $classroom->getTranslation('Name_Class', $locale),
            ];
        });

        return response()->json($classrooms);
    }

    public function getSections($class_id)
    {
        $teacher_id = Auth::id();
        $locale = App::getLocale();

        $sections = Section::where('Class_id', $class_id)
            ->whereHas('teachers', function ($q) use ($teacher_id) {
                $q->where('teacher_id', $teacher_id);
            })->get();

        $sections = $sections->map(function ($section) use ($locale) {
            return [
                'id' => $section->id,
                'name' => $section->getTranslation('Name_Section', $locale),
            ];
        });

        return response()->json($sections);
    }

    public function getSubjects($grade_id, $class_id, $section_id)
    {
        $teacher_id = Auth::id();
        $locale = App::getLocale();

        // Verify the teacher is assigned to this section
        $sectionAssigned = DB::table('teacher_section')
            ->where('teacher_id', $teacher_id)
            ->where('section_id', $section_id)
            ->exists();

        if (!$sectionAssigned) {
            return response()->json([], 403); // Forbidden
        }

        $subjects = Subject::where('teacher_id', $teacher_id)
            ->where('grade_id', $grade_id)
            ->where('classroom_id', $class_id)
            ->get();

        $subjects = $subjects->map(function ($subject) use ($locale) {
            return [
                'id' => $subject->id,
                'name' => $subject->getTranslation('name', $locale), // assuming you don't use translations
            ];
        });

        return response()->json($subjects);
    }
}

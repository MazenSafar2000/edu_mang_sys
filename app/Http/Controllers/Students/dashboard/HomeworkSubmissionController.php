<?php

namespace App\Http\Controllers\Students\dashboard;

use App\Http\Traits\AttachFilesTrait;
use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\HomeworkSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeworkSubmissionController extends Controller
{
    use AttachFilesTrait;

    public function index()
    {
        $student = Auth::user();
        $homeworks = Homework::where('grade_id', $student->Grade_id)
            ->where('classroom_id', $student->Classroom_id)
            ->where('section_id', $student->section_id)
            ->latest()
            ->get();

        return view('pages.Students.dashboard.homeworks.index', compact('homeworks'));
    }

    public function create(Homework $homework)
    {
        $student = Auth::user();

        $existing = HomeworkSubmission::where('homework_id', $homework->id)
            ->where('student_id', $student->id)
            ->first();

        return view('pages.Students.dashboard.homeworks.create', compact('homework', 'existing'));
    }

    public function store(Request $request, Homework $homework)
    {
        $request->validate([
            'submission_file' => 'required|file|mimes:pdf,doc,docx,zip,rar,png,jpg,jpeg|max:10240',
        ]);

        $student = auth('student')->user();
        $studentName = $student->getTranslation('name', 'en');

        $existingSubmission = HomeworkSubmission::where('student_id', $student->id)
            ->where('homework_id', $homework->id)
            ->first();

        $filePath = $this->uploadStudentHomeworkFile($request, $studentName);

        if ($existingSubmission) {
            if (!$homework->allow_multiple_submissions) {
                return back()->with('message', __('Students_trans.submission_already_done'));
            }

            // Delete old file
            $this->deleteHomeworkSubmissionFile($existingSubmission->file_path);

            // Update existing
            $existingSubmission->update([
                'file_path' => $filePath,
                'submitted_at' => now(),
                'status' => now()->gt($homework->due_date) ? 'late' : 'pending',
            ]);
        } else {
            HomeworkSubmission::create([
                'homework_id' => $homework->id,
                'student_id' => $student->id,
                'file_path' => $filePath,
                'submitted_at' => now(),
                'status' => now()->gt($homework->due_date) ? 'late' : 'pending',
            ]);
        }

        return redirect()->route('student.submissions.index')->with('success', __('Students_trans.submitted_successfully'));
    }

    public function show(Homework $homework)
    {
        $student = Auth::user();
        $submission = HomeworkSubmission::where('homework_id', $homework->id)
            ->where('student_id', $student->id)
            ->firstOrFail();

        return view('pages.Students.dashboard.homeworks.show', compact('homework', 'submission'));
    }

    public function preview(Homework $homework)
    {
        $student = Auth::user();
        $submission = HomeworkSubmission::where('homework_id', $homework->id)
            ->where('student_id', $student->id)
            ->first();

        return view('pages.Students.dashboard.homeworks.preview', compact('homework', 'submission'));
    }



    public function edit(HomeworkSubmission $homeworkSubmission)
    {
        //
    }

    public function update(Request $request, HomeworkSubmission $homeworkSubmission)
    {
        //
    }

    public function destroy(HomeworkSubmission $homeworkSubmission)
    {
        //
    }
}

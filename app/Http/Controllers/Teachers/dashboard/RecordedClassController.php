<?php

namespace App\Http\Controllers\Teachers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\Grade;
use App\Models\RecordedClass;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;

class RecordedClassController extends Controller
{

    public function index()
    {
        $recordedClasses = RecordedClass::all();
        return view('pages.Teachers.dashboard.recorded_classes.index', compact('recordedClasses'));
    }

    public function create()
    {
        $grades = Grade::all();
        $subjects = Subject::all();
        return view('pages.Teachers.dashboard.recorded_classes.create', compact('grades', 'subjects'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
        ]);

        try {
            RecordedClass::create([
                'teacher_id' => auth()->user()->id,
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'section_id' => $request->section_id,
                'subject_id' => $request->subject_id,
                'title' => $request->title,
                'description' => $request->description,
                'video_url' => $request->video_url,
                'created_by' => auth()->user()->email,
            ]);

            toastr()->success(trans('messages.success'));
            return redirect()->route('recorded-classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $recordedClass = RecordedClass::findOrFail($id);
        $grades = Grade::all();
        $subjects = Subject::all();

        return view('pages.Teachers.dashboard.recorded_classes.edit', compact('recordedClass', 'grades', 'subjects',));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'grade_id' => 'required|exists:grades,id',
            'classroom_id' => 'required|exists:classrooms,id',
            'section_id' => 'required|exists:sections,id',
            'subject_id' => 'required|exists:subjects,id',
            'title' => 'required|string|max:255',
            'video_url' => 'required|url',
        ]);

        try {
            $recordedClass = RecordedClass::findOrFail($id);
            $recordedClass->update([
                'grade_id' => $request->grade_id,
                'classroom_id' => $request->classroom_id,
                'section_id' => $request->section_id,
                'subject_id' => $request->subject_id,
                'title' => $request->title,
                'description' => $request->description,
                'video_url' => $request->video_url,
            ]);

            toastr()->success(trans('messages.Update'));
            return redirect()->route('recorded-classes.index');
        } catch (\Exception $e) {
            toastr()->error($e->getMessage());
            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        $recordedClass = RecordedClass::findOrFail($id);
        $recordedClass->delete();
        toastr()->error('mesages.Delete');
        return redirect()->route('recorded-classes.index');
    }
}

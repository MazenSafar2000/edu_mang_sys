<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Homework;
use App\Models\Library;
use App\Models\Quizze;
use App\Models\RecordedClass;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showSubjectContent($subject_id)
    {
        $subject = Subject::findOrFail($subject_id);

        // Extract filter info from subject
        $grade_id = $subject->grade_id;
        $classroom_id = $subject->classroom_id;
        $teacher_id = $subject->teacher_id;

        // Fetch all related materials
        $books = Library::where([
            ['Grade_id', $grade_id],
            ['Classroom_id', $classroom_id],
            ['teacher_id', $teacher_id],
            ['subject_id', $subject_id],
        ])->orderBy('created_at', 'asc')->get();

        $homeworks = Homework::where([
            ['grade_id', $grade_id],
            ['classroom_id', $classroom_id],
            ['teacher_id', $teacher_id],
            ['subject_id', $subject_id],
        ])->orderBy('created_at', 'asc')->get();

        $quizzes = Quizze::where([
            ['grade_id', $grade_id],
            ['classroom_id', $classroom_id],
            ['teacher_id', $teacher_id],
            ['subject_id', $subject_id],
        ])->orderBy('created_at', 'asc')->get();

        $Videos = RecordedClass::where([
            ['grade_id', $grade_id],
            ['classroom_id', $classroom_id],
            ['teacher_id', $teacher_id],
            ['subject_id', $subject_id],
        ])->orderBy('created_at', 'asc')->get();

        // Merge all in a single collection
        $materials = collect()
            ->merge($books->map(fn($item) => [
                'type' => 'book',
                'title' => $item->title,
                'created_at' => $item->created_at,
                'data' => $item,
            ]))
            ->merge($homeworks->map(fn($item) => [
                'type' => 'homework',
                'title' => $item->title,
                'created_at' => $item->created_at,
                'data' => $item,
            ]))
            ->merge($quizzes->map(fn($item) => [
                'type' => 'exam',
                'title' => $item->name,
                'created_at' => $item->created_at,
                'data' => $item,
            ]))
            ->merge($Videos->map(fn($item) => [
                'type' => 'VideoClass',
                'title' => $item->title,
                'created_at' => $item->created_at,
                'data' => $item,
            ]))
            ->sortBy('created_at')
            ->values();

        return view('pages.Students.subject_content', compact('subject', 'materials'));
    }
}

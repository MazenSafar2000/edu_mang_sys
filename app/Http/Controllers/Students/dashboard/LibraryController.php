<?php

namespace App\Http\Controllers\Students\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Library;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryController extends Controller
{

    public function index()
    {
        $student = Auth::user();
        $books = Library::where('Grade_id', $student->Grade_id)
            ->where('Classroom_id', $student->Classroom_id)
            ->where('section_id', $student->section_id)
            ->with(['teacher', 'subject'])
            ->get();

        return view('pages.Students.dashboard.library.index', compact('books'));
    }

    public function preview($id)
    {
        $book = Library::findOrFail($id);
        return view('pages.Students.dashboard.library.preview', compact('book'));
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

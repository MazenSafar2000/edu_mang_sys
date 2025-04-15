<?php

namespace App\Repository;

use App\Http\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\Library;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryRepository implements LibraryRepositoryInterface
{

    use AttachFilesTrait;

    public function index()
    {
        // $books = Library::all();
        // return view('pages.library.index',compact('books'));

        $teacher = Auth::user();
        // dd($teacher);
        $books = Library::where('teacher_id', $teacher->id)->get();
        return view('pages.Teachers.dashboard.library.index', compact('books'));
    }

    public function create()
    {
        // $grades = Grade::all();
        // return view('pages.library.create',compact('grades'));

        $grades = Grade::all();
        return view('pages.Teachers.dashboard.library.create', compact('grades'));
    }

    public function store($request)
    {
        try {

            // $teacherName = $request->teacher_name;
            $teacherName = Auth::user()->Name;
            // dd($teacherName);

            $books = new Library();

            $books->title = $request->title;
            $books->file_name =  $request->file('file_name')->getClientOriginalName();
            $books->Grade_id = $request->Grade_id;
            $books->Classroom_id = $request->Classroom_id;
            $books->teacher_id = Auth::user()->id;
            $books->section_id = $request->section_id;
            // $books->path = $request->teacher_name;
            $books->save();
            $this->uploadFile($request, $teacherName, 'file_name');
            toastr()->success(trans('messages.success'));
            return redirect()->route('library.create');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $grades = Grade::all();
        $book = library::findorFail($id);
        $teacherName = Auth::user()->Name;
        return view('pages.teachers.dashboard.library.edit', compact('book', 'grades', 'teacherName'));
    }

    public function update($request)
    {
        try {
            $book = library::findorFail($request->id);
            $teacherName = Auth::user()->Name;

            $book->title = $request->title;
            if ($request->hasfile('file_name')) {

                $this->deleteFile($teacherName, $book->file_name);

                $this->uploadFile($request, $teacherName, 'file_name');

                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
            }

            $book->Grade_id = $request->Grade_id;
            $book->Classroom_id = $request->Classroom_id;
            $book-> section_id = $request->section_id;
            $book->teacher_id =  Auth::user()->id;
            $book->save();
            toastr()->success(trans('messages.Update'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $book = Library::findOrFail($id);

            $fileName = $book->file_name;
            $fileFolder = Auth::user()->Name;
            // dd($fileName, $fileFolder);

            $this->deleteFile($fileFolder, $fileName);
            $book->delete();

            toastr()->error(trans('messages.Delete'));
            return redirect()->route('library.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    // download books for teacher dashboard
    public function download($file_name)
    {
        // return response()->download(public_path('attachments/library/' . $filename));
        return response()->download(public_path('attachments/library/teachers/' . Auth::user()->Name . '/' . $file_name));
    }
}

<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait AttachFilesTrait
{
    public function uploadFile($request, $teacherName, $name)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('attachments/library/teachers/', $teacherName . '/' . $file_name, 'upload_attachments');
    }

    public function deleteFile($teacherName, $name)
    {
        $exists = Storage::disk('upload_attachments')->exists('attachments/library/teachers/' . $teacherName . '/' . $name);

        if ($exists) {
            Storage::disk('upload_attachments')->delete('attachments/library/teachers/' . $teacherName . '/' . $name);
        }
    }

    // Homework File Upload and Delete For Teacher
    public function uploadHomeworkFile($request, $teacherName)
    {
        $file = $request->file('attachment');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = 'attachments/homework/teachers/' . $teacherName . '/' . $fileName;

        $file->storeAs('attachments/homework/teachers/' . $teacherName, $fileName, 'upload_attachments');

        return $path;
    }

    public function deleteHomeworkFile($path)
    {
        if (Storage::disk('upload_attachments')->exists($path)) {
            Storage::disk('upload_attachments')->delete($path);
        }
    }

    // Homework File Upload For Student
    public function uploadStudentHomeworkFile($request, $studentName)
    {
        $file = $request->file('submission_file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = 'attachments/homework_submissions/students/' . $studentName . '/' . $fileName;

        $file->storeAs('attachments/homework_submissions/students/' . $studentName, $fileName, 'upload_attachments');

        return $path;
    }

    // Check if the student has already submitted the homework, and want to resubmit
    public function uploadHomeworkSubmissionFile($request, $studentName)
    {
        $file = $request->file('submission_file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $path = 'attachments/homework_submissions/students/' . $studentName . '/' . $fileName;

        $file->storeAs('attachments/homework_submissions/students/' . $studentName, $fileName, 'upload_attachments');

        return $path;
    }

    public function deleteHomeworkSubmissionFile($path)
    {
        if (Storage::disk('upload_attachments')->exists($path)) {
            Storage::disk('upload_attachments')->delete($path);
        }
    }
}

<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait AttachFilesTrait
{
    public function uploadFile($request,$teacherName ,$name)
    {
        $file_name = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('attachments/library/teachers/',$teacherName.'/'.$file_name,'upload_attachments');

    }

    public function deleteFile($teacherName, $name)
    {
        $exists = Storage::disk('upload_attachments')->exists('attachments/library/teachers/'.$teacherName.'/'.$name);

        if($exists)
        {
            Storage::disk('upload_attachments')->delete('attachments/library/teachers/'.$teacherName.'/'.$name);

        }
    }
}

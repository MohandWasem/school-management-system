<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


trait  AttachFile 
{
    public function uploadFile($request,$name)
    {
        // الحصول على الاسم الأصلي للملف مع الامتداد
        $fileName = $request->file($name)->getClientOriginalName();

        // تحديد مسار تخزين الملف
        $path = 'attachments/Library';

        // تخزين الملف في المسار المحدد
        $request->file($name)->storeAs($path,$fileName,'upload_pdf');
    }

    public function deleteFile($name)
    {
        // حدد المسار الكامل للملف في مجلد public
        $filePath = public_path('upload_library/attachments/Library/'.$name);

        // تحقق من وجود الملف
        if (file_exists($filePath)) {
            // إذا كان الملف موجودًا، قم بحذفه
            unlink($filePath);
            // DB::table('library')->where('file_name', $name)->delete();
            // return "File deleted successfully.";
        } else {
            return "File not found.";
        }
    }

    public function delete_one_file($disk, $folder) //use to delete folder has one file only
    {
        $path = 'attachments/' . $folder;
        if(!empty($path))
        Storage::disk($disk)->deleteDirectory($path);
    }


    protected function uploadfolder($request, $name,$folder)
    {
        $fileName = $request->file($name)->getClientOriginalName();
        $request->file($name)->storeAs('attachments/',$folder.'/'.$fileName,'upload_logo');

    }

}
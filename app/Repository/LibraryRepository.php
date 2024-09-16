<?php

namespace App\Repository;

use App\Models\Grade;
use App\Models\Library;
use App\Models\Student;
use App\Http\Traits\AttachFile;
use Illuminate\Support\Facades\DB;
use App\Interfaces\LibraryRepositoryInterface;

class LibraryRepository implements LibraryRepositoryInterface
{
    use AttachFile;

    public function index()
    {
        $books = Library::get();
        return view('pages.Library.index',compact('books'));
    }

    public function create()
    {
        $grades = Grade::get();
        return view('pages.Library.create',compact('grades'));
    }

    public function store($request)
    {
        try {
            $books = new Library();
            $books->title = $request->title;
            $books->file_name = $request->file('file_name')->getClientOriginalName();
            $books->Grade_id = $request->Grade_id;
            $books->Classroom_id = $request->Classroom_id;
            $books->Section_id = $request->section_id;
            $books->Teacher_id = 1;
            $books->save();
            $this->uploadFile($request,'file_name');

            toastr()->success(trans('messages.Success'));
            return redirect()->route('Library.index');

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }

    public function edit($id)
    {
        $book = Library::findOrFail($id);
        $grades = Grade::get();
        return view('pages.Library.edit',compact('grades','book'));
    }

    public function update($request)
    {
        try {
            $book = Library::findOrFail($request->id);
            $book->title = $request->title;
            $book->Grade_id = $request->Grade_id;
            $book->Classroom_id = $request->Classroom_id;
            $book->Section_id = $request->section_id;
            $book->Teacher_id = 1;
        
            if($request->hasFile('file_name')){
                $fileNameNew =  $request->file('file_name')->getClientOriginalName();
                if ($book->file_name != $fileNameNew) {
                    $this->deleteFile($book->file_name);
                    $this->uploadFile($request, 'file_name');
                    $book->file_name = $fileNameNew;
                }
            }
        
            $book->save();
            
            toastr()->success(trans('messages.Update'));
            return redirect()->route('Library.index');
        
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
        
    }

    public function downloadAttachment($filename)
    {
        // return response()->download(storage_path('attachments/Library/'.$filename));
        $filePath = public_path('upload_library/attachments/Library/'.$filename);
        return response()->download($filePath);
    }


}
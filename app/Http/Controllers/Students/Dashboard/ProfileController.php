<?php

namespace App\Http\Controllers\Students\Dashboard;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $information = Student::findOrFail(auth()->user()->id);
        return view('pages.Student.profile',compact('information'));
    }

    public function update(Request $request)
    {
        $information = Student::findOrFail(auth()->user()->id);

        $information->Name = ['en' => $request->Name_en, 'ar' => $request->Name_ar];

        // Update the password only if provided
        if (!empty($request->password)) {
            $information->password = Hash::make($request->password);
        }

        $information->save();

        toastr()->success(trans('messages.Update'));
        return redirect()->back();
    }
}

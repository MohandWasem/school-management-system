<?php

namespace App\Http\Controllers\Parents\dashboard;

use App\Models\MyParent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $information = MyParent::findOrFail(auth()->user()->id);
        return view('pages.parent.profile',compact('information'));
    }

    public function update(Request $request)
    {
        $information = MyParent::findOrFail(auth()->user()->id);

        $information->Name_Father = ['en' => $request->Name_en, 'ar' => $request->Name_ar];

        // Update the password only if provided
        if (!empty($request->password)) {
            $information->password = Hash::make($request->password);
        }

        $information->save();

        toastr()->success(trans('messages.Update'));
        return redirect()->back();
    }
}

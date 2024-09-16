<?php

namespace App\Http\Controllers;

use App\Http\Traits\AttachFile;
use App\Models\Setting;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class SettingController extends Controller
{
    use AttachFile;

    public function index()
    {
        $collection = Setting::get();
        $setting['setting'] = $collection->flatMap(function ($collection){
            return [$collection->key =>$collection->value];
        });
        return view('pages.Settings.index',$setting);
    }

    public function update(Request $request)
    {
    
        try 
        {
            $info = $request->except('_method','logo','_token');

            foreach ($info as $key => $value) {
                Setting::where('key',$key)->update(['value'=>$value]);
            }

            // طريقه تانيه ل تحديث الاعدادات
            // $key = array_keys($info);
            // $value = array_values($info);
            // for($i=0; $i < count($info); $i++){
            //     Setting::where('key',$key[$i])->update(['value'=>$value[$i]]);
            // }

            if($request->hasFile('logo')){
                $logoName = $request->file('logo')->getClientOriginalName();
                $this->delete_one_file('upload_logo', 'logo');   
                $this->uploadfolder($request,'logo','logo');
                Setting::where('key','logo')->update(['value'=>$logoName]);
            }

            toastr()->success(trans('messages.Update'));
            return redirect()->back();

        } catch (\Throwable $th) {
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }
}

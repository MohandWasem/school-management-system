<?php

namespace App\Http\Controllers\Teachers\Dashboard;

use App\Models\Grade;
use App\Models\OnlineClasse;
use Illuminate\Http\Request;
use App\Http\Traits\MettingZoom;
use App\Http\Controllers\Controller;

class ZoomOnlineController extends Controller
{
    use MettingZoom;
    public function index()
    {
        $online_classes = OnlineClasse::where('created_by',auth()->user()->email)->get();
        return view('pages.Teachers.online_classes.index',compact('online_classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Grades = Grade::get();
        return view('pages.Teachers.online_classes.add',compact('Grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $meeting = $this->createMeeting($request);
            OnlineClasse::create([
                'integration'=>true,
                'Grade_id'=>$request->Grade_id,
                'Classroom_id'=>$request->Classroom_id,
                'Section_id'=>$request->section_id,
                'created_by'=>auth()->user()->email,
                'meeting_id'=>$meeting->id,
                'topic'=>$request->topic,
                'start_at'=>$request->start_time,
                'duration'=>$request->duration,
                'password'=>$meeting->password,
                'start_url'=>$meeting->start_url,
                'join_url'=>$meeting->join_url,
            ]);

            toastr()->success(trans('messages.Success'));
            return redirect()->route('ZoomOnline.index');

        } catch (\Throwable $th) {
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }


    public function destroy(Request $request)
    {
        try {

            $checkIntegration = OnlineClasse::findOrFail($request->id);
            if($checkIntegration->integration == true){
                // $meeting = Zoom::meeting()->find($request->meeting_id);
                // $meeting->delete();
                // OnlineClasse::where('meeting_id',$request->id)->delete();
                OnlineClasse::destroy($request->id);
            } else {
                OnlineClasse::destroy($request->id);
            }
            toastr()->success(trans('messages.Delete'));
            return redirect()->back();

        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
         }
    }

    public function offlineClasseCreate()
    {
        $Grades = Grade::get();
        return view('pages.Teachers.online_classes.offlineClass',compact('Grades'));
    }

    public function offlineClasseStore(Request $request)
    {
        try {
    
            OnlineClasse::create([
                'integration'=>false,
                'Grade_id'=>$request->Grade_id,
                'Classroom_id'=>$request->Classroom_id,
                'Section_id'=>$request->section_id,
                'created_by'=>auth()->user()->email,
                'meeting_id'=>$request->meeting_id,
                'topic'=>$request->topic,
                'start_at'=>$request->start_time,
                'duration'=>$request->duration,
                'password'=>$request->password,
                'start_url'=>$request->start_url,
                'join_url'=>$request->join_url,
            ]);

            toastr()->success(trans('messages.Success'));
            return redirect()->route('ZoomOnline.index');

        } catch (\Throwable $th) {
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }
}

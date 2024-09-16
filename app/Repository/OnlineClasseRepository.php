<?php

namespace App\Repository;
use App\Models\Grade;
use App\Models\OnlineClasse;
use App\Http\Traits\MettingZoom;
use MacsiDigital\Zoom\Facades\Zoom;
use App\Interfaces\OnlineClasseRepositoryInterface;

class OnlineClasseRepository implements OnlineClasseRepositoryInterface
{
    use MettingZoom;

    public function index()
    {
        $online_classes = OnlineClasse::where('created_by',auth()->user()->email)->get();
        return view('pages.online_classes.index',compact('online_classes'));
    }

    public function create()
    {
        $Grades = Grade::get();
        return view('pages.online_classes.add',compact('Grades'));
    }

    public function store($request)
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
            return redirect()->route('onlineClasses.index');

        } catch (\Throwable $th) {
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

    public function destroy($request)
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

        //  return $delete_meeting = $this->deleteMeeting($request->meeting_id);
    }

    public function offlineClasseCreate()
    {
        $Grades = Grade::get();
        return view('pages.online_classes.offlineClass',compact('Grades'));
    }

    public function offlineClasseStore($request)
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
            return redirect()->route('onlineClasses.index');

        } catch (\Throwable $th) {
           return redirect()->back()->withErrors(['error'=>$th->getMessage()]);
        }
    }

}
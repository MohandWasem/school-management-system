<?php

namespace App\Http\Traits;

use Carbon\Carbon;
use App\Models\OnlineClasse;
use MacsiDigital\Zoom\Facades\Zoom;

trait MettingZoom
{
    public function createMeeting($request)
    {
        $user = Zoom::user()->first();

        $meetingData = [
            'topic'=>$request->topic,
            'duration'=>$request->duration,
            'password'=>$request->password,
            'timezone'=>'Africa/Cairo',
        ];

        $meeting = Zoom::meeting()->make($meetingData);

        $meeting->settings()->make([
            'join_before_host' => false,
            'host_video'=>false,
            'participant_video'=>false,
            'approval_type' => 1,
            'registration_type' => 2,
            'enforce_login' => false,
            'waiting_room' => true,
            'approval_type'=>config('zoom.approval_type'),
            'audio'=>config('zoom.audio'),
            'auto_recording'=>config('zoom.auto_recording'),
        ]);

        return $user->meetings()->save($meeting);
    }

    public function deleteMeeting($meetingId)
    {
    try {
        // Find the meeting by ID
        $meeting = Zoom::meeting()->find($meetingId);
        
        if ($meeting) {
            // Delete the meeting
            $meeting->delete();
            
            // Optionally, remove the related record from the local database
            $onlineClass = OnlineClasse::where('meeting_id', $meetingId)->first();
            if ($onlineClass) {
                $onlineClass->delete();
            }

            // Success message
            toastr()->success(trans('messages.Delete'));
            return redirect()->route('onlineClasses.index');
        } else {
            // Meeting not found
            return redirect()->back()->withErrors(['error' => 'Meeting not found']);
        }
    } catch (\Throwable $th) {
        // Log the error for debugging
        return redirect()->back()->withErrors(['error' => $th->getMessage()]);
    }

}
}
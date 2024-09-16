<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;

class CalenderStudent extends Component
{
    public $events = '';
    
    public function render()
    {       
        $events = Event::select('id','title','start')->get();

        $this->events = json_encode($events);

        return view('livewire.calender-student');
    }


    public function getevent()
    {       
        $events = Event::select('id','title','start')->get();

        return  json_encode($events);
    }
}

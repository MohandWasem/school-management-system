<?php

namespace App\Http\Livewire;

use App\User;
use Livewire\Component;

class Counter extends Component
{

    public $name;
    public $email;
 
    protected $rules = [
        'name' => 'required|min:6',
        'email' => 'required|email',
    ];

    
    protected $messages = [
        'name.required' => 'هذا الاسم مطلوب',
        'email.required' => 'The Email Address cannot be empty.',
        'email.email' => 'The Email Address format is not valid.',
    ];
    
    protected $validationAttributes = [
        'email' => 'email address'
    ];
    
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
    public function saveContact()
    {
        $validatedData = $this->validate();
 
        User::create($validatedData);
    }

    public function render()
    {
        return view('livewire.counter');
    }
}

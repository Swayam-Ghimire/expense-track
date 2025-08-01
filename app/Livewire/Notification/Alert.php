<?php

namespace App\Livewire\Notification;

use Livewire\Component;

class Alert extends Component
{
    public $user_type = '';


    public $std_message = "Same here dude I am unemployed to that's why let's connect!!!";
    public $emp_message = "Hello congrats on your job, if you have job for me please provide me that as well!!";

    public function render()
    {
        return view('livewire.notification.alert');
    }
}

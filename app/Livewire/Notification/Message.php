<?php

namespace App\Livewire\Notification;

use Livewire\Attributes\On;
use Livewire\Component;

class Message extends Component
{
    public $visibleErrors = [];
    public $clear;
    public ?string $message = null;

    public function mount()
    {
        $this->clear = 'false';
        if (session()->has('errors')) {
            $this->visibleErrors = session('errors')->all();
        }
    }
    #[On('notify')]
    public function showMessage($message){
        $this->message = $message;
    }
    public function toggleMsg()
    {
        $this->clear = 'true';
    }

    public function remove($index)
    {
        unset($this->visibleErrors[$index]);
        $this->visibleErrors = array_values($this->visibleErrors);
    }
    public function render()
    {
        return view('livewire.notification.message');
    }
}

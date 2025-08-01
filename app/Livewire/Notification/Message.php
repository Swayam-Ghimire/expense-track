<?php

namespace App\Livewire\Notification;

use Livewire\Component;

class Message extends Component
{
    public $visibleErrors = [];
    public $clear;

    public function mount()
    {
        $this->clear = 'false';
        if (session()->has('errors')) {
            $this->visibleErrors = session('errors')->all();
        }
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

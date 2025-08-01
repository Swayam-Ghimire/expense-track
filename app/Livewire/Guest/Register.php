<?php

namespace App\Livewire\Guest;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Register extends Component
{
    #[Title('Register')]
    #[Layout('components.layouts.guest')]
    public function render()
    {
        return view('livewire.guest.register');
    }
}

<?php

namespace App\Livewire\Guest;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Landing extends Component
{
    #[Layout('components.layouts.guest')]
    #[Title('Landing Page')]
    public function render()
    {
        return view('livewire.guest.landing');
    }
}

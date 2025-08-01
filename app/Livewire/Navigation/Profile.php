<?php

namespace App\Livewire\Navigation;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


class Profile extends Component
{

    #[Title('Your-Profile')]
    #[Layout('components.layouts.app')]
    public function render()
    {
        return view('livewire.navigation.profile');
    }
}

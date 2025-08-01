<?php

namespace App\Livewire\Navigation;

use Livewire\Attributes\Title;
use Livewire\Component;

class Transaction extends Component
{

    #[Title('Transactions')]
    public function render()
    {
        return view('livewire.navigation.transaction');
    }
}

<?php

namespace App\Livewire\Navigation;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Transactions')]
class Transaction extends Component
{
    public int $counter = 1;
    public $user;
    public $expenses;

    public function mount() {
        $this->user = Auth::user();
        // $this->expenses = $this->user->transactions()->with('category')->latest()->paginate(12);
    }
    public function render()
    {
        return view('livewire.navigation.transaction');
    }
}

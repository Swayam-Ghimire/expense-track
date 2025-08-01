<?php

namespace App\Livewire\Navigation;

use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Record Expense')]
class Create extends Component
{

    public $user;

    public function mount(): void {
        $this->user = Auth::user();
    }

    #[Computed]
    public function categories() {
        return ;
    }
    public function render()
    {
        return view('livewire.navigation.create');
    }
}

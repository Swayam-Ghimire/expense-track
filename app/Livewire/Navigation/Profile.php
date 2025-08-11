<?php

namespace App\Livewire\Navigation;

use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title('Your-Profile')]
class Profile extends Component
{
    use WithFileUploads;

    public $user;
    public $name;
    public $photo;
    public $user_type;
    public $password;

    public function mount(){
        $this->user = Auth::user();
    }
    
    public function render()
    {
        return view('livewire.navigation.profile');
    }
}

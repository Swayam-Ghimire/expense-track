<?php

namespace App\Livewire\Navigation;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use Livewire\Component;


#[Title('Your-Profile')]
class Profile extends Component
{
    use WithFileUploads;

    public $user;
    #[Rule('required|min:3|max:25|string')]
    public $name;

    #[Rule('required|in:Student,Employee')]
    public $user_type;

    #[Rule('nullable|file|mimes:png,jpg,jpeg|max:10240')]
    public $photo;

    #[Rule('nullable|required_with:new_password|current_password')]
    public $current_password;

    #[Rule('nullable|min:8|max:15|same:confirm_password')]
    public $new_password;

    #[Rule('nullable|min:8|max:15')]
    public $confirm_password;

    public function mount(){
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->user_type = $this->user->type;
    }
    public function save() {
        $this->validate();
    }

    public function render()
    {
        return view('livewire.navigation.profile');
    }
}

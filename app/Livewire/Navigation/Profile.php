<?php

namespace App\Livewire\Navigation;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
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

    #[Rule('nullable|required_with:new_password|string')]// required if new_password is set
    public $current_password;

    #[Rule('nullable|min:8|max:15|same:confirm_password|required_with:confirm_password')]
    public $new_password;

    #[Rule('nullable|min:8|max:15')]
    public $confirm_password;

    public function mount(){
        $this->user = Auth::user();
        $this->name = $this->user->name;
        $this->user_type = $this->user->type;
    }

    #[Computed]
    public function savings(): float {
        // Calculate total savings done till now
        $saving = $this->user->income()->sum('monthly_income') - $this->user->transactions()->sum('amount');
        return round($saving, 1);
    }

    public function save() {
        $this->validate();
        $user = $this->user;
        // Update name & type if changed
        if($this->name !== $user->name) {
            $user->name = $this->name;
        }
        if($this->user_type !== $user->type) {
            $user->type = $this->user_type;
        }
        if($this->new_password) {
            if(Hash::check($this->current_password, $user->password)) {
                $user->password = bcrypt($this->new_password);
            }
            else {
                $this->addError('current_password', 'Current password doesnot match with your existing password');
                return;
            }
        }
        if($this->photo) {
            // Delete
            if($user->img_path && Storage::disk('public')->exists($user->img_path)) {
                Storage::disk('public')->delete($user->img_path);
            }

            // Store new and generate the filename with the user’s ID to avoid possible collisions.
            $path = $this->photo->storeAs('user_image', $user->id.'_'.time().'.'.$this->photo->extension(), 'public');
            $user->img_path = $path;
        }

        $user->save();
        $this->dispatch('notify', message:'Profile updated');
        $this->clear();
    }

    public function clear()
    {
    $this->reset(['photo', 'current_password', 'new_password', 'confirm_password']);
    }


    public function render()
    {
        return view('livewire.navigation.profile');
    }
}

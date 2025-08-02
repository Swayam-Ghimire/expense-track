<?php

namespace App\Livewire\Navigation;

use App\Models\Categories;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Record Expense')]
class Create extends Component
{

    public $user;

    #[Rule('required|integer|min:0')]
    public ?int $amount = null;

    #[Rule('required|string|min:5|max:200')]
    public string $description = '';

    #[Rule('required|date')]
    public $date;

    #[Rule('required|max:9')]
    public ?int $selectedCategory = null;

    public function mount(): void {
        $this->user = Auth::user();
        // Set the default date to today for a better user experience.
        $this->date = now()->format('Y-m-d');
    }

    #[Computed]
    public function categories() {
        return Categories::all();
    }

    public function save() {
        // 1. Validate all the properties with rules
        $this->validate();
        // 2. Create the expense record associated with the logged-in user.
        $this->user->transactions()->create([
            'amount' => $this->amount,
            'description' => $this->description,
            'transaction_date' => $this->date,
            'category_id' => $this->selectedCategory,
        ]);
        // 3. Send a success message to the user.
        session()->flash('success', 'Expense recorded successfully!');
        return $this->redirect('/dashboard', navigate:true);
    }

    public function clear() {
        $this->reset(['amount', 'description', 'selectedCategory']);
        $this->date = now()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.navigation.create');
    }
}

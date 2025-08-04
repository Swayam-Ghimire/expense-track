<?php

namespace App\Livewire\Navigation;

use App\Models\Income;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public $user;
    public ?Income $existingIncome = null; // Holds the Eloquent model instance, can be null.
    // public $existingTransaction = null;// Holds the Eloquent model collection, can be null.

    #[Rule('integer|required|min:0')]
    public int $monthlyIncome; // Use a dedicated property for the form input.

    public int $totalExpense;
    public int $monthlyExpense; // Dedicated property to display the total expense and monthly expense

    public int $amountLeft; // Dedicated property to display the total amount left monthly

    public bool $showEdit;

    public function mount(): void
    {
        $this->user = Auth::user();

        // 1. Fetch the existing record once and store it.
        $this->existingIncome = $this->user->income()
            ->whereDate('created_date', '>', now()->subDays(30))
            ->latest('created_date')
            ->first();


        // 2. Populate the dedicated property
        if ($this->existingIncome) {
            $this->monthlyIncome = $this->existingIncome->monthly_income;
            $this->showEdit = true; // Start in edit mode if income exists
        } else {
            $this->showEdit = false; // Start in form input mode if no income exists
        }
        $this->monthlyExpense = $this->user->transactions()->whereDate('transaction_date', '>', now()->subDays(30))->latest('transaction_date')->sum('amount');
        $this->totalExpense = $this->user->transactions()->sum('amount');
    }

    // Use a computed property for display logic. It's cleaner.
    #[Computed]
    public function type(): string
    {
        return $this->user->type === 'Student' ? 'Pocket Money' : 'Income';
    }

    public function save(): void
    {
        $this->validate();

        // Use the record we already fetched in mount(). No extra query needed.
        if ($this->existingIncome) {
            $this->existingIncome->update(['monthly_income' => $this->monthlyIncome]);
        } else {
            $this->user->income()->create(['monthly_income' => $this->monthlyIncome]);
            $this->mount();
        }
        $this->showEdit = true; // Hide form after saving.
        session()->flash('success', 'Updated successfully');
    }

    public function display(): void
    {
        $this->showEdit = !$this->showEdit;
    }



    public function render()
    {
        return view('livewire.navigation.dashboard');
    }
}
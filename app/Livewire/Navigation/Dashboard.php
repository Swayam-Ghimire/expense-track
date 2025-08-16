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
    public ?int $monthlyIncome = null; // Use a dedicated property for the form input.

    public float $totalExpense;
    public float $monthlyExpense; // Dedicated property to display the total expense and monthly expense

    public ?float $amountLeft = 0; // Dedicated property to display the total amount left monthly

    public bool $showEdit;


    public function mount(): void
    {
        $this->user = Auth::user();

        // 1. Fetch the existing record once and store it.
        $this->existingIncome = $this->user->income()
            ->whereYear('created_date', now()->year)
            ->whereMonth('created_date', now()->month)
            ->latest('created_date')
            ->first();

        // 2. Populate the dedicated property
        if ($this->existingIncome) {
            $this->monthlyIncome = $this->existingIncome->monthly_income;
            $this->showEdit = true; // Start in edit mode if income exists
        } else {
            $this->showEdit = false; // Start in form input mode if no income exists
        }
        $this->monthlyExpense = $this->user->transactions()->whereMonth('transaction_date', now()->month)->whereYear('transaction_date', now()->year)
            ->sum('amount');
        $this->totalExpense = $this->user->transactions()
            ->sum('amount');
        $this->amountLeft = $this->monthlyIncome - $this->monthlyExpense;
    }

    #[Computed]
    public function type(): string
    {
        return $this->user->type === 'Student' ? 'Pocket Money' : 'Income';
    }

    #[Computed]
    public function monthlyExpensesByCategory(): array
    {
        // Get current month expenses grouped by category
        return $this->user->transactions()
            ->join('categories', 'transactions.category_id', '=', 'categories.id')
            ->whereMonth('transaction_date', now()->month)
            ->whereYear('transaction_date', now()->year)
            ->selectRaw('categories.category, SUM(transactions.amount) as total')
            ->groupBy('categories.category')
            ->pluck('total', 'categories.category')
            ->toArray();
    }

    #[Computed]
    public function allTimeIncomeVsExpense(): array
    {
        // Get the last 12 months income and expense as an array
        $incomes = $this->user->income()
            ->selectRaw("STRFTIME('%Y-%m', created_date) as year_month, SUM(monthly_income) as total_income")
            ->groupBy('year_month')
            ->pluck('total_income', 'year_month')
            ->toArray();

        $expenses = $this->user->transactions()
            ->selectRaw("STRFTIME('%Y-%m', transaction_date) as year_month, SUM(amount) as total_expense")
            ->groupBy('year_month')
            ->pluck('total_expense', 'year_month')
            ->toArray();

        // Generate last 12 months including current
        $months = [];
        for ($i = 11; $i >= 0; $i--) {
            $key = date('Y-m', strtotime("-$i months"));
            $label = date('M Y', strtotime("-$i months")); // e.g. "Jan 2025"
            $months[] = [
                'year_month' => $label,
                'income' => (float) ($incomes[$key] ?? 0),
                'expense' => (float) ($expenses[$key] ?? 0),
                'saving' => number_format(($incomes[$key] ?? 0) - ($expenses[$key] ?? 0), 2),
            ];
        }

        return $months;
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
        $this->dispatch('notify', message: 'Income Updated!', clear: 'false');
    }

    public function display(): void
    {
        $this->showEdit = !$this->showEdit;
    }


    public function render()
    {
        return view('livewire.navigation.dashboard', ['expenseByCategory' => $this->monthlyExpensesByCategory], ['incomeVsExpense' => $this->allTimeIncomeVsExpense]);
    }
}

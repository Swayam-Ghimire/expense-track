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

    public $incomes;
    public $expenses;

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
    public function allTimeIncomeVsExpense(): array{
        // Get all time data for income and expense but month wise in an array
        $this->incomes = $this->user->income()
        ->selectRaw("STRFTIME('%Y-%M', created_date) as year_month, monthly_income as total_income")
        ->orderBy('created_date', 'asc')
        ->groupBy('year_month')
        ->pluck('total_income', 'year_month')
        ->toArray();

        $this->expenses = $this->user->transactions()->selectRaw("STRFTIME('%Y-%m', transaction_date) as year_month, SUM(amount) as total_expense")
        ->orderBy('transaction_date', 'desc')
        ->groupBy('year_month')
        ->pluck('total_expense', 'year_month')
        ->toArray();
        $allDates = array_unique(array_merge(array_keys($this->incomes), array_keys($this->expenses)));
        sort($allDates);
        $data = [];
        foreach($allDates as $date) {
            $income = $this->incomes[$date] ?? 0;
            $expense = $this->expenses[$date] ?? 0;
            $year_month = date('Y-F', strtotime($date));
            $data[] = [
                'year_month' => $year_month,
                'income' => number_format($income, 2),
                'expense' => number_format($expense, 2)
            ];
        }
        return $data;
        
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

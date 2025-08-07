<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SavingHistory extends Component
{
    public $user;

    public array $incomes;
    public array $expenses;

    public function mount()
    {
        $this->user = Auth::user();
        $this->incomes = DB::table('incomes')
            ->selectRaw("STRFTIME('%Y-%m', created_date) as year_month, SUM(monthly_income) as total_income")
            ->where('user_id', $this->user->id)
            ->groupBy('year_month')->limit(6)->orderBy('created_date', 'desc')
            ->pluck('total_income', 'year_month')->toArray(); // returns associative array: ['2025-08' => 20000, ...]

        $this->expenses = DB::table('transactions')
            ->selectRaw("STRFTIME('%Y-%m', transaction_date) as  year_month, SUM(amount) as total_expense")
            ->where('user_id', $this->user->id)
            ->groupBy('year_month')->limit(6)->orderBy('transaction_date', 'desc')
            ->pluck('total_expense', 'year_month')->toArray();
    }

    #[Computed]
    public function data() :array{
        $allDates = array_unique(array_merge(array_keys($this->incomes), array_keys($this->expenses)));
        rsort($allDates);
        $data = [];
        foreach($allDates as $dates) {
            $income = $this->incomes[$dates] ?? 0;
            $expense = $this->expenses[$dates] ?? 0;
            $saving = $income - $expense;
            $year_month = date('Y-F', strtotime($dates));

            $data[] = [
                'year_month' => $year_month,
                'income' => $income,
                'expense' => round($expense, 2),
                'saving' => round($saving, 2),
            ];
        }
        return $data;
    }

    public function render()
    {
        return view('livewire.saving-history');
    }
}
// Adding pagination in the future
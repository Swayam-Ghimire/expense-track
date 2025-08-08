<?php

namespace App\Livewire\Navigation;

use App\Models\Transaction as TransactionModel;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Livewire\Component;

#[Title('Transactions')]
class Transaction extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';
    public function render()
    {
        return view('livewire.navigation.transaction', [
            'expenses' => TransactionModel::with('category:id,category')
                ->select('amount', 'category_id', 'description', 'transaction_date')
                ->where('user_id', Auth::id())
                ->latest('transaction_date')
                ->paginate(10)
        ]);
    }
}

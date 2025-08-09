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

    public $search = '';
    public function delete(TransactionModel $transaction)
    {
        $transaction->delete();
    }

    public function updatedSearch()
    {
        // Reset pagination to first page when the search term changes
        $this->resetPage();
    }

    public function render()
    {
        $transactions = TransactionModel::with('category:id,category')
            ->select('id', 'amount', 'category_id', 'description', 'transaction_date')
            ->where('user_id', Auth::id())
            ->when($this->search, function ($query) {
                // Search in category name
                $query->whereHas('category', function ($q) {
                    $q->where('category', 'like', '%' . $this->search . '%');
                })
                    // OR search in description
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->latest('transaction_date')
            ->paginate(10);


        return view('livewire.navigation.transaction', [
            'expenses' => $transactions
        ]);
    }
}

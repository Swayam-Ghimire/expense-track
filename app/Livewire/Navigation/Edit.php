<?php

namespace App\Livewire\Navigation;

use App\Models\Categories;
use App\Models\Transaction as ModelTransaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Edit')]
class Edit extends Component
{
    #[Rule('required|integer|min:0')]
    public $amount;

    #[Rule('required|string|min:5|max:34')]
    public $description;

    #[Rule('required|date')]
    public $date;

    #[Rule('required|max:9')]
    public $selectedCategory;

    public $transaction;

    public function mount(ModelTransaction $transaction)
    {
        if ($transaction->user_id != Auth::id()) {
            return redirect()->back();
        }
        $this->transaction = $transaction;
        $this->amount = $transaction->amount;
        $this->description = $transaction->description;
        $this->date = date('Y-m-d', strtotime($transaction->transaction_date));
        $this->selectedCategory = $transaction->category_id;
    }

    #[Computed]
    public function categories()
    {
        return Categories::all();
    }

    public function save() {
        // update
        $this->validate();
        $this->transaction->update([
            'amount' => $this->amount,
            'description' => $this->description,
            'transaction_date' => $this->date,
            'category_id' =>$this->selectedCategory,
        ]);

        session()->flash('success', 'Updated Successfully');
        return $this->redirect('/transaction', navigate:true);

    }
    
    public function render()
    {
        return view('livewire.navigation.edit');
    }
}

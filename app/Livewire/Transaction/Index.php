<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public $all_transactions;
    public $loads = 0;
    public $amount = 10;

    public function loadMore()
    {
        $this->loads++;
    }

    public function render()
    {
        $new_transactions = Transaction::where('user_id', Auth::user()->id)
            ->offset($this->amount * $this->loads)
            ->limit($this->amount)
            ->get();
        $this->all_transactions = $this->loads === 0 ? $new_transactions : $this->all_transactions->merge($new_transactions);

        return view('livewire.transaction.index', [
            'transactions' => $this->all_transactions,
        ]);
    }
}

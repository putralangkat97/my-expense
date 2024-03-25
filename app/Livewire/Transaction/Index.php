<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.transaction.index', [
            'transactions' => Transaction::where('user_id', Auth::user()->id)
                ->orderBy('transaction_date', 'desc')
                ->get(),
        ]);
    }
}

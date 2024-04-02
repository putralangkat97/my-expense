<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $all_transactions;

    public function render()
    {
        $new_transactions = Transaction::where('user_id', Auth::user()->id)
            ->simplePaginate(8);

        $new_transactions =  $new_transactions->setCollection(
            $new_transactions->groupBy('transaction_date')
        );

        return view('livewire.transaction.index', [
            'transactions' => $new_transactions,
        ]);
    }
}

<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    public $all_transactions;
    public $limit = 10;
    public $loads = 0;
    public $count = 0;

    public function loadMore()
    {
        $this->loads++;
    }

    public function render()
    {
        $new_transactions = Transaction::where('user_id', Auth::user()->id)
            ->offset($this->limit * $this->loads)
            ->limit($this->limit)
            ->orderBy('transaction_date', 'desc')
            ->get();

        $this->count = Transaction::count();


        $this->all_transactions = $this->loads == 0 ? $new_transactions->toArray() : [...$this->all_transactions, ...$new_transactions->toArray()];

        return view('livewire.transaction.index', [
            'transactions' => $this->all_transactions,
            'data_count' => count($this->all_transactions),
        ]);
    }
}

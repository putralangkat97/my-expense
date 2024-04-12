<?php

namespace App\Livewire\Transaction;

use App\Repository\Repositories\TransactionRepository;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    private TransactionRepository $transactionRepository;
    public $all_transactions;
    public $limit = 10;
    public $loads = 0;
    public $count = 0;

    public function boot(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function loadMore()
    {
        $this->loads++;
    }

    public function render()
    {
        $new_transactions = $this->transactionRepository->getAllTransactions(
            limit: $this->limit,
            loads: $this->loads,
        );

        $this->count = $this->transactionRepository->transactionCount();


        $this->all_transactions = $this->loads == 0 ? $new_transactions->toArray() : [...$this->all_transactions, ...$new_transactions->toArray()];

        return view('livewire.transaction.index', [
            'transactions' => $this->all_transactions,
            'data_count' => count($this->all_transactions),
        ]);
    }
}

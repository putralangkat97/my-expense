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
    public $search = '';

    public function boot(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function render()
    {
        $transactions = $this->transactionRepository->getAllTransactions(
            filter: $this->search != '' ? true : false,
            value: $this->search != '' ? $this->search : ''
        );

        return view('livewire.transaction.index', [
            'transactions' => $transactions,
        ]);
    }
}

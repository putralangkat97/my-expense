<?php

namespace App\Livewire\Transaction;

use App\Repository\Repositories\TransactionRepository;
use Livewire\Component;

class Show extends Component
{
    protected TransactionRepository $transactionRepository;
    public $id;

    public function boot(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function render()
    {
        return view('livewire.transaction.show', [
            'transaction' => $this->transactionRepository->getATransaction($this->id),
        ]);
    }
}

<?php

namespace App\Livewire\Transaction;

use App\Livewire\Forms\TransactionForm;
use App\Models\Transaction;
use Livewire\Component;

class Form extends Component
{
    public ?Transaction $transaction;
    public TransactionForm $form;

    public function mount()
    {
        if (isset($this->transaction)) {
            $this->form->setTransaction($this->transaction);
        }
    }

    public function save()
    {
        $message = "created";
        if ($this->transaction) {
            $message = "updated";
        }
        $this->form->insert();
        session()->flash('success', __("Transaction {$message} successfully"));
        return $this->redirectRoute('transaction.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.transaction.form');
    }
}

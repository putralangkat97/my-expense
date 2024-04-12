<?php

namespace App\Livewire\Transaction;

use App\Livewire\Forms\TransactionForm;
use Livewire\Component;

class Form extends Component
{
    public $id;
    public TransactionForm $form;

    public function mount()
    {
        if ($this->id) {
            $this->form->setTransaction($this->id);
        }
    }

    public function save()
    {
        $message = "created";
        if ($this->id) {
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

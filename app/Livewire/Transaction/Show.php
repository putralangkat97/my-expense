<?php

namespace App\Livewire\Transaction;

use App\Models\Transaction;
use Livewire\Component;

class Show extends Component
{
    public $id;

    public function render()
    {
        return view('livewire.transaction.show', [
            'transaction' => Transaction::findOrFail($this->id),
        ]);
    }
}

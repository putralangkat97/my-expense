<?php

namespace App\Livewire\Forms;

use App\Helpers\LocalDateFormat;
use App\Repository\Repositories\TransactionRepository;
use Carbon\Carbon;
use Livewire\Form;

class TransactionForm extends Form
{
    protected TransactionRepository $transactionRepository;

    public $transaction_name = '';

    public $transaction_value = '';

    public $transaction_date = '';

    public $id;

    public function boot(TransactionRepository $transactionRepository)
    {
        $this->transactionRepository = $transactionRepository;
    }

    public function rules()
    {
        return [
            'transaction_name' => ['required', 'min:2', 'max:100'],
            'transaction_value' => ['required', 'max:20'],
            'transaction_date' => ['required'],
        ];
    }

    public function insert()
    {
        $this->validate();
        $validated = $this->only([
            'transaction_name',
            'transaction_value',
            'transaction_date',
        ]);

        if ($this->id) {
            $this->transactionRepository->updateATransaction(
                transaction_id: $this->id,
                data: $validated
            );
        } else {
            $this->transactionRepository->createATransaction(
                data: $validated
            );
        }
    }

    public function setTransaction($transaction_id)
    {
        if ($transaction_id) {
            $transaction = $this->transactionRepository->getATransaction($transaction_id);
            $this->transaction_name = $transaction->transaction_name;
            $this->transaction_value = $transaction->transaction_value;
            $this->transaction_date = Carbon::parse($transaction->transaction_date)
                ->timezone(LocalDateFormat::getTimezone())
                ->toDateTimeString();
            $this->id = $transaction->id;
        }
    }
}

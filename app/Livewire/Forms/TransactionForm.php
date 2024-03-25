<?php

namespace App\Livewire\Forms;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Validate;
use Livewire\Form;

class TransactionForm extends Form
{
    public $transaction_name = '';
    public $transaction_value = '';
    public $transaction_date = '';
    public $id;

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
            'transaction_date'
        ]);

        DB::beginTransaction();
        try {
            if ($this->id) {
                $transaction = Transaction::findOrFail($this->id);
            } else {
                $transaction = new Transaction();
            }
            $transaction_date = date('Y-m-d H:i:s', strtotime($validated['transaction_date']));
            $transaction->transaction_name = $validated['transaction_name'];
            $transaction->transaction_value = $validated['transaction_value'];
            $transaction->transaction_date = Carbon::parse($transaction_date, $transaction->timezone)
                ->timezone('UTC')
                ->toDateTimeString();
            $transaction->user_id = Auth::user()->id;
            $transaction->save();

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            Log::error($th->getMessage());
        }
    }

    public function setTransaction($transaction)
    {
        if ($transaction) {
            $this->transaction_name = $transaction->transaction_name;
            $this->transaction_value = $transaction->transaction_value;
            $this->transaction_date = Carbon::parse($transaction->transaction_date)->timezone($transaction->timezone)->toDateTimeString();
            $this->id = $transaction->id;
        }
    }
}

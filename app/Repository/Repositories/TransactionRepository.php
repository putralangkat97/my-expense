<?php

namespace App\Repository\Repositories;

use App\Helpers\LocalDateFormat;
use App\Models\Transaction;
use App\Repository\Interfaces\TransactionInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TransactionRepository implements TransactionInterface
{
    public function getAllTransactions(bool $filter = false, string $value = "")
    {
        $transactions = Transaction::where('user_id', Auth::user()->id);
        if ($filter) {
            $transactions = $transactions->whereAny([
                'transaction_name',
                'transaction_value',
                'transaction_date',
            ], "LIKE", "%{$value}%");
        }
        $transactions = $transactions->orderBy('transaction_date', 'desc')
            ->simplePaginate(10);

        return $transactions;
    }

    public function getATransaction(string|int $transaction_id)
    {
        return Transaction::findOrFail($transaction_id);
    }

    public function createATransaction(array $data)
    {
        DB::beginTransaction();
        try {
            $data_array = $this->generateBody($data);
            Transaction::create($data_array);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
    }

    public function updateATransaction(string|int $transaction_id, array $data)
    {
        DB::beginTransaction();
        try {
            Transaction::where('id', $transaction_id)
                ->update($this->generateBody($data));
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error($e->getMessage());
        }
    }

    public function transactionCount(): int
    {
        return Transaction::count();
    }

    private function generateBody(array $data): array
    {
        $transaction_date = date('Y-m-d H:i:s', strtotime($data['transaction_date']));
        $data = [
            'transaction_name' => $data['transaction_name'],
            'transaction_value' => $data['transaction_value'],
            'transaction_date' => Carbon::parse($transaction_date, LocalDateFormat::getTimezone())
                ->timezone('UTC')
                ->toDateTimeString(),
            'user_id' => Auth::user()->id,
        ];

        return $data;
    }
}

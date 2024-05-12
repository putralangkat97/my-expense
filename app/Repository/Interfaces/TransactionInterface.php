<?php

namespace App\Repository\Interfaces;

interface TransactionInterface
{
    public function getAllTransactions();

    public function getATransaction(string|int $transaction_id);

    public function createATransaction(array $data);

    public function updateATransaction(string|int $transaction_id, array $data);

    public function transactionCount();
}

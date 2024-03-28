<?php

namespace Database\Seeders;

use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('transactions')->truncate();

        for ($i = 0; $i < 10000; $i++) {
            $data[] = [
                'transaction_name' => 'TRX' . rand(2000, 3999) . now()->format('Ymd'),
                'transaction_value' => rand(100_000, 299999),
                'transaction_date' => now()->toDateTimeString(),
                'user_id' => 1,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }

        $data_chunk = array_chunk($data, 1000);

        foreach ($data_chunk as $record) {
            Transaction::insert($record);
        }
    }
}

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

        for ($i = 0; $i < 15; $i++) {
            $data[] = [
                'transaction_name' => 'TRX' . rand(2000, 3999) . now()->format('Ymd'),
                'transaction_value' => rand(1_000_000, 2_999_999),
                'transaction_date' => '2024-0' . rand(1, 9) . '-' . rand(1, 30) . ' ' . rand(0, 23) . ':' . rand(0, 59) . ':00',
                'user_id' => 1,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString(),
            ];
        }

        $data_chunk = array_chunk($data, 10);

        foreach ($data_chunk as $record) {
            Transaction::insert($record);
        }
    }
}

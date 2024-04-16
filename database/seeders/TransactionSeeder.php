<?php

namespace Database\Seeders;

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
        $transactions=array(
            array(
                'equipment_id' => 14,
                'release_by' => 10,
                'borrowed_by' => 'Stephanie Reyes',
                'date_borrowed' => '2024-03-08 08:23:00',
                'date_returned' => '2024-03-18 08:23:00',
                'office' => 18,
                'returned_date' => '2024-03-18 08:23:00',
                'returned_by' => 'Stephany Reyes',
                'received_by' => 10,
                'status' => 'Return',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'equipment_id' => 16,
                'release_by' => 10,
                'borrowed_by' => 'Joselito Ladiana',
                'date_borrowed' => '2024-12-19 08:23:00',
                'date_returned' => '2024-12-27 08:23:00',
                'office' => 14,
                'returned_date' => '2024-12-27 08:23:00',
                'returned_by' => 'Joselito Ladiana',
                'received_by' => 10,
                'status' => 'Return',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'equipment_id' => 16,
                'release_by' => 10,
                'borrowed_by' => 'Mark Porca',
                'date_borrowed' => '2024-10-25 08:23:00',
                'date_returned' => '2024-10-27 08:23:00',
                'office' => 7,
                'returned_date' => '2024-10-27 08:23:00',
                'returned_by' => 'Mark Porca',
                'received_by' => 10,
                'status' => 'Return',
                'created_at' => now(),
                'updated_at' => now(),
            ),
        );
        DB::table('transactions')->insert($transactions);

    }
}

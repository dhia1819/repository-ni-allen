<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use Faker\Factory as Faker;

class TransactionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Generate sample transactions
        for ($i = 0; $i < 10; $i++) {
            $equipmentId = $faker->numberBetween(1, 13);
            $releaseBy = $faker->numberBetween(1, 33); // Random number between 1 and 33
            $borrowedBy = $faker->name;
            $dateBorrowed = $faker->dateTimeBetween('-1 year', 'now');
            $dateReturned = $faker->dateTimeBetween($dateBorrowed, '+1 month');
            $officeNumber = $faker->numberBetween(1, 54);
            $uploadFile = null; // Set to null as per requirement
            $returnedDate = $faker->dateTimeBetween($dateBorrowed, 'now'); // Actual return date can be any time after borrow date
            $returnedBy = $faker->name;
            $receivedBy = $faker->numberBetween(1, 33); // Random number between 1 and 33
            $status = 'return'; // Set status to 'return'

            // Create a new Transaction using the Transaction model
            Transaction::create([
                'equipment_id' => $equipmentId,
                'release_by' => $releaseBy,
                'borrowed_by' => $borrowedBy,
                'date_borrowed' => $dateBorrowed,
                'date_returned' => $dateReturned,
                'office' => $officeNumber,
                'upload_file' => $uploadFile,
                'returned_date' => $returnedDate,
                'returned_by' => $returnedBy,
                'received_by' => $receivedBy,
                'status' => $status,
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = array(
            array(
                'firstName' => 'Raiven',
                'lastName' => 'Muega',
                'position' => 'Computer programmer 2',
                'status' => 1
            )
            );
            DB::table('employees')->insert($employees);
    }
}

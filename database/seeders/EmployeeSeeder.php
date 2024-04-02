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
                'fullName' => 'Hiro Alarzar',
                'position' => 'Assistant Manager',
                'status' => 1
            ),

            array(
                'fullName' => 'Raiven Muega',
                'position' => 'Manager', 
                'status' => 1
            )
            );
            DB::table('employees')->insert($employees);
    }
}

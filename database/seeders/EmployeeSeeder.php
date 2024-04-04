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
            ),

            // Additional Employees
            array(
                'fullName' => 'John Doe',
                'position' => 'Developer',
                'status' => 1
            ),

            array(
                'fullName' => 'Jane Smith',
                'position' => 'Designer',
                'status' => 1
            ),

            array(
                'fullName' => 'Michael Johnson',
                'position' => 'Sales Manager',
                'status' => 1
            ),

            array(
                'fullName' => 'Emily Brown',
                'position' => 'Marketing Coordinator',
                'status' => 1
            ),

            array(
                'fullName' => 'David Lee',
                'position' => 'IT Specialist',
                'status' => 1
            ),

            array(
                'fullName' => 'Sarah Williams',
                'position' => 'HR Consultant',
                'status' => 1
            ),

            array(
                'fullName' => 'Alex Clark',
                'position' => 'Accountant',
                'status' => 1
            ),

            array(
                'fullName' => 'Michelle Martinez',
                'position' => 'Customer Service Representative',
                'status' => 1
            ),

            array(
                'fullName' => 'Daniel Garcia',
                'position' => 'Project Manager',
                'status' => 1
            ),

            array(
                'fullName' => 'Olivia Wilson',
                'position' => 'Executive Assistant',
                'status' => 1
            )
        );
        
        DB::table('employees')->insert($employees);
    }
}

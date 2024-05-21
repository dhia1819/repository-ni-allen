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
                'fullName' => 'Jaime M. Garcia',
                'position' => 'OIC-MISO',
                'status' => 1
            ),

            array(
                'fullName' => 'Analee P. Vergel',
                'position' => 'Information Technology Officer II', 
                'status' => 1
            ),

            // Additional Employees
            array(
                'fullName' => 'Aileen U. Rosales',
                'position' => 'Administrative Officer IV',
                'status' => 1
            ),

            array(
                'fullName' => 'Rodney Boy C. Reyes',
                'position' => 'Bookbinder I',
                'status' => 1
            ),

            array(
                'fullName' => 'Jocelyn M. Dela Cruz',
                'position' => 'Administrative Aide I',
                'status' => 1
            ),

            array(
                'fullName' => 'Girlie D. Radaza',
                'position' => 'Administrative Aide I',
                'status' => 1
            ),

            array(
                'fullName' => 'Charlie R. Crisostomo',
                'position' => 'Casual',
                'status' => 1
            ),

            array(
                'fullName' => 'Audie B. Cada',
                'position' => 'Computer Maintenance Technologist II',
                'status' => 1
            ),

            array(
                'fullName' => 'Allan N. Abasola',
                'position' => 'Administrative Aide III',
                'status' => 1
            ),

            array(
                'fullName' => 'Rodessa G. Mendoza',
                'position' => '',
                'status' => 1
            ),

            array(
                'fullName' => 'Pamela L. Yu',
                'position' => 'COS - Information Systems Researcher I',
                'status' => 1
            ),

            array(
                'fullName' => 'Venz Lawrence O. Cao',
                'position' => 'Job Order',
                'status' => 1
            ),

            array(
                'fullName' => 'Leandro Martin L. Bona',
                'position' => 'Job Order',
                'status' => 1
            ),

            array(
                'fullName' => 'Rowena M. Palacol',
                'position' => 'Administrative Assistant III',
                'status' => 1
            ),

            array(
                'fullName' => 'Raquel M. Burbos',
                'position' => 'Administrative Officer II',
                'status' => 1
            ),

            array(
                'fullName' => 'Rodrigo N. Abasola',
                'position' => 'Administrative Aide III',
                'status' => 1
            ),

            array(
                'fullName' => 'Stephanie Grace C. Reyes',
                'position' => 'COS - Information Systems Researcher II',
                'status' => 1
            ),

            array(
                'fullName' => 'Christian G. Juano',
                'position' => 'COS - System Developer & Administrator',
                'status' => 1
            ),

            array(
                'fullName' => 'Jan Ivy S. Flores',
                'position' => 'COS - Information Systems Researcher',
                'status' => 1
            ),

            array(
                'fullName' => 'Sean Edriel T. Umali',
                'position' => 'COS - Information Systems Researcher',
                'status' => 1
            ),

            array(
                'fullName' => 'Roi Vinson D. Abrazaldo',
                'position' => 'Computer Programmer II',
                'status' => 1
            ),
            array(
                'fullName' => 'John Derel M. Tuazon',
                'position' => 'Information Systems Analyst I',
                'status' => 1
            ),
            array(
                'fullName' => 'Renz Alfred J. Litan',
                'position' => 'Computer Programmer I',
                'status' => 1
            ),
            array(
                'fullName' => 'Reinald M. De Luna',
                'position' => 'COS - Information Systems Researcher II',
                'status' => 1
            ),
            array(
                'fullName' => 'Jayvee M. Dela Cruz',
                'position' => '',
                'status' => 1
            ),
            array(
                'fullName' => 'Maeron Joseph A. Reyes',
                'position' => 'COS - Computer Programmer I',
                'status' => 1
            ),
            array(
                'fullName' => 'Mara Angelica C. Delgado',
                'position' => ' I',
                'status' => 1
            ),
            array(
                'fullName' => 'Danika Ana P. Billiones',
                'position' => 'Information Systems Researcher',
                'status' => 1
            ),
            array(
                'fullName' => 'Forrest S. Dimasaca',
                'position' => 'Job Order - Programmer',
                'status' => 1
            ),
            array(
                'fullName' => 'John Ray M. Pleto',
                'position' => 'Job Order - Programmer',
                'status' => 1
            ),
            array(
                'fullName' => 'Adrian F. Miras',
                'position' => 'Senior Administrative Assistant',
                'status' => 1
            ),
            array(
                'fullName' => 'Julie Ann D. Yaneza',
                'position' => 'Computer Programmer I    ',
                'status' => 1
            ),
            array(
                'fullName' => 'Elenor O. Perejas',
                'position' => 'Computer Maintenance Technologist I',
                'status' => 1
            ),
        );
        
        DB::table('tbl_employees')->insert($employees);
    }
}

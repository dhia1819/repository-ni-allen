<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category=array(
           array(
            'category'=>'Laptop Computer',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'category'=>'Air Conditioner',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'category'=>'Vehicle',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'category'=>'Scanner',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'category'=>'Television',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'category'=>'Table',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'category'=>'Camera',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'category'=>'ATS Machine',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'category'=>'Computer Accessory',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'category'=>'Digital Audio Video',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'category'=>'Copier Machine',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'category'=>'Generator Set',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'category'=>'Printer',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
        );

        DB::table('categories')->insert($category);

    }
}

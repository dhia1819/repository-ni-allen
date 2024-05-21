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
            'name'=>'Laptop Computer',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Air Conditioner',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Vehicle',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Scanner',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Television',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Table',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Photobooth',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'ATS Machine',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Computer Accessory',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Digital Audio Video',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Copier Machine',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Generator Set',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Printer',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Table',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Projector',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Computer Set',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Server Unit',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Tower Server',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Database Server',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Server',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Computer Server',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),
           array(
            'name'=>'Video Mixing Server',
            'status'=>1,
            'created_at' => now(),
            'updated_at' => now(),
           ),   

        );

        DB::table('tbl_category')->insert($category);

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array(
            array(
                'name' => 'Overall Administrator',
                'username' => 'overalladmin',
                'password' => Hash::make('overalladmin'),
                'classification_id' => 1,
                'status' => 1,
            ),

            array(
                'name' => 'System Administrator',
                'username' => 'admin',
                'password' => Hash::make('admin'),
                'classification_id' => 2,
                'status' => 1,
            )
        );

        DB::table('tbl_users')->insert($users);
    }
}

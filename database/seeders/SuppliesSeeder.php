<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppliesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $supplies = array(
            array(
                'date_acquired'=>'2020-02-14',
                'supply_name'=>'Envelope (Brown) Long',
                'supply_desc'=>'Envelope (Brown) Long',
                'quantity'=> 116,
                'unit'=>'pieces',
                'location'=>'Cabinet 1, Rack 1, Row 1',
                'remarks'=>1,
                'created_at'=>now(),
            ),
            array(
                'date_acquired'=>'2020-02-14',
                'supply_name'=>'Envelope (Brown) Short',
                'supply_desc'=>'Envelope (Brown) Short',
                'quantity'=> 69,
                'unit'=>'pieces',
                'location'=>'Cabinet 1, Rack 1, Row 1',
                'remarks'=>1,
                'created_at'=>now(),
            ),
            array(
                'date_acquired'=>'2020-02-14',
                'supply_name'=>'Sliding Folder',
                'supply_desc'=>'Sliding Folder',
                'quantity'=> 11,
                'unit'=>'pieces',
                'location'=>'Cabinet 1, Rack 1, Row 1',
                'remarks'=>1,
                'created_at'=>now(),
            ),
            array(
                'date_acquired'=>'2020-02-14',
                'supply_name'=>'Parchment Paper',
                'supply_desc'=>'Parchment Paper',
                'quantity'=> 3,
                'unit'=>'reams',
                'location'=>'Cabinet 1, Rack 1, Row 1',
                'remarks'=>1,
                'created_at'=>now(),
            ),
        );

        DB::table('supplies')->insert($supplies);
    }
}

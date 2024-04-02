<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $equipment=array(
            array(
            'admin_id' => 1,
            'equipment_name' => 'Air Conditioner',
            'category' => 2,
            'Description' => '2.5Hp window type aircondition-CARRIER',
            'property_no' => 'F100225',
            'serial_no' => '51PMX-RAC-CAR-24KEA N16PC-1220130',
            'unit_of_measure' => 'unit',
            'value' => '57300',
            'quantity' => 1,
            'conditions' => 'Good',
            'remarks' => 'Aileen Rosales',
            'status' => 'available',
            'date_acquired' => '2026-01-12',
            'created_at' => now(),
            'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop Computer',
                'category' => 1,
                'Description' => 'Laptop with separated audio jack with high-end webcam-DELL, 15.6" FHD, Core i5-10300H (8MB Cache, up to 4.5GHz, 4 Cores). 8GB DDR4-2933MHz, 2x4G. 1TB SATA HD + 256GB M.2 Pcle NVMe SSD. 4GB GDDR6. Operating System',
                'property_no' => 'LAP0024935',
                'serial_no' => 'FJRF203',
                'unit_of_measure' => 'unit',
                'value' => '86980',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Aileen Rosales',
                'status' => 'available',
                'date_acquired' => '2021-06-01',
                'created_at' => now(),
                'updated_at' => now(),
                )
            
        );
        DB::table('equipment')->insert($equipment);

    }
}

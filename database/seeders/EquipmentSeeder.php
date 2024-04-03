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
            'date_acquired' => '2016-01-12',
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
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop Computer',
                'category' => 1,
                'Description' => 'Laptop with separated audio jack with high-end webcam-DELL, Sn: GGRF203. 15.6" FHD, Core i5-10300H (8MB Cache, up to 4.5GHz, 4 Cores). 8GB DDR4-2933MHz, 2x4G. 1TB SATA HD + 256GB M.2 Pcle NVMe SSD. 4GB GDDR6. Operating System                ',
                'property_no' => 'LAP0024936',
                'serial_no' => 'GGRF203',
                'unit_of_measure' => 'unit',
                'value' => '86980',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Aileen Rosales',
                'status' => 'available',
                'date_acquired' => '2021-06-01',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop Computer',
                'category' => 1,
                'Description' => 'Laptop with separated audio jack with high-end webcam-DELL, Sn: JLRF203. 15.6" FHD, Core i5-10300H (8MB Cache, up to 4.5GHz, 4 Cores). 8GB DDR4-2933MHz, 2x4G. 1TB SATA HD + 256GB M.2 Pcle NVMe SSD. 4GB GDDR6. Operating System                ',
                'property_no' => 'LAP0024937',
                'serial_no' => 'JLRF203',
                'unit_of_measure' => 'unit',
                'value' => '86980',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Aileen Rosales',
                'status' => 'available',
                'date_acquired' => '2021-06-01',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop Computer',
                'category' => 1,
                'Description' => 'Laptop Computer - ACER ASPIRE, Sn: NXAYCSP004207113B33400, Intel Core i71195G7, 16GB DDR4, 1TB Pcle NVMe SSD.
                                    Intel Iris XE Graphics, 15.6"" Full HD 1080p IPS Slim Bezel.
                                    Windows 11 Licensed MS Office Home and Student 2021',
                'property_no' => 'LAP0030613',
                'serial_no' => 'NXAYCSP004207113B33400',
                'unit_of_measure' => 'unit',
                'value' => '82500',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Aileen Rosales',
                'status' => 'available',
                'date_acquired' => '2021-14-03',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Scanner',
                'category' => 4,
                'Description' => 'Finger Scanner-ACTAtek, Sn: 00111DB025D0. 
                                Real time system update and configuration 500DPI optical scanner; 
                                Auto-match support up to 10,000 users (1:N) operates in Standalone or Network mode (Access Manager); 
                                Robust and scalable (Thousands of users on global basis) for enterprise wide deployment; 
                                IP65 rated, weather and impact resistant casing (Fluid ingress, dust, salt, fog protection); 
                                Built-in CMOS/Video camera for Video Surveillance (optional); Up to 500 photos (FIFO internal storage); 
                                API support for easy interface to most software applications 1,000 users up to 75,000 event logs, Five modes of authentication; 
                                Fingers print only',
                'property_no' => 'SCA0021698',
                'serial_no' => '00111DB025D0',
                'unit_of_measure' => 'unit',
                'value' => '57395',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Aileen Rosales',
                'status' => 'available',
                'date_acquired' => '2020-30-06',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Television',
                'category' => 5,
                'Description' => 'Smart Television-LG, Sn: 010INBSA9149. 55" Smart TV wide angle 4k Active HDR',
                'property_no' => 'SMA0024968',
                'serial_no' => '010INBSA9149',
                'unit_of_measure' => 'unit',
                'value' => '74985',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Aileen Rosales',
                'status' => 'available',
                'date_acquired' => '2021-06-01',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Television',
                'category' => 5,
                'Description' => 'Smart Television-LG, Sn: 010INTXA9137. 55" Smart TV wide angle 4k Active HDR',
                'property_no' => 'SMA0024970',
                'serial_no' => '010INTXA9137',
                'unit_of_measure' => 'unit',
                'value' => '74985',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Aileen Rosales',
                'status' => 'available',
                'date_acquired' => '2021-06-01',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Photobooth',
                'category' => 7,
                'Description' => 'Camera Body Only CANON EOS 6D Sn: 398051004695; Lens Sn: 667891.',
                'property_no' => 'PHO0012754B',
                'serial_no' => '398051004695',
                'unit_of_measure' => 'unit',
                'value' => '63950',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Aileen Rosales',
                'status' => 'available',
                'date_acquired' => '2021-14-01',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Table',
                'category' => 14,
                'Description' => 'Orlando, conference, valnut finish, 24ft. X 4 ft.',
                'property_no' => 'J200002',
                'serial_no' => '-',
                'unit_of_measure' => 'unit',
                'value' => '56850',
                'quantity' => 1,
                'conditions' => 'Fair',
                'remarks' => 'Aileen Rosales',
                'status' => 'available',
                'date_acquired' => '1996-03-01',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Air Conditioner',
                'category' => 2,
                'Description' => 'Air conditioner, 2.0Hp, window type, inverter - CARRIER
                                Sn: 2322-0154162
                                3021-0200230
                                Without installation..',
                'property_no' => 'AIR0030625-626',
                'serial_no' => '2322-0154162',
                'unit_of_measure' => 'unit',
                'value' => '90394',
                'quantity' => 2,
                'conditions' => 'Fair',
                'remarks' => 'Allan Abasola',
                'status' => 'available',
                'date_acquired' => '2023-15-02',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Air Conditioner',
                'category' => 2,
                'Description' => 'Air conditioner, 2.0Hp, window type, inverter - CARRIER
                                Sn: 2322-0154162
                                3021-0200230
                                Without installation..',
                'property_no' => 'AIR0030625-626',
                'serial_no' => '3021-0200230',
                'unit_of_measure' => 'unit',
                'value' => '90394',
                'quantity' => 2,
                'conditions' => 'Good',
                'remarks' => 'Allan Abasola',
                'status' => 'available',
                'date_acquired' => '2023-15-02',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            
            
        );
        DB::table('equipment')->insert($equipment);

    }
}

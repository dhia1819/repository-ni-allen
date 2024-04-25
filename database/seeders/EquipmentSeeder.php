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
            'date_acquired' => '2016-12-01',
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
                'date_acquired' => '2021-01-06',
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
                'date_acquired' => '2021-01-06',
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
                'date_acquired' => '2021-01-06',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop Computer - ACER ASPIRE',
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
                'date_acquired' => '2021-03-14',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Finger Scanner-ACTAtek',
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
                'date_acquired' => '2020-06-30',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Smart Television-LG',
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
                'date_acquired' => '2021-01-06',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Smart Television-LG',
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
                'date_acquired' => '2021-01-06',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'CANON EOS 6D',
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
                'date_acquired' => '2021-01-14',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Orlando conference - walnut finish',
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
                'date_acquired' => '1996-01-03',
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
                'date_acquired' => '2023-02-15',
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
                'date_acquired' => '2023-02-15',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop-ACER',
                'category' => 1,
                'Description' => 'Laptop-ACER, 
                SN: NHQ7NSP00C112231D73400.
                i5-10300H Processor/8GB DDR4 Memory/ 256GB NVMe
                SSD/15.6" FHD 19x1080/PS 144Hz Display/ Nvidia
                GTX1650Ti 4GB GDDR5 VRAM / 802.11AX WiFi + BT
                HDMI Port',
                'property_no' => 'LAP0028666',
                'serial_no' => 'NHQ7NSP00C112231D73400',
                'unit_of_measure' => 'unit',
                'value' => '66680',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Allan Abasola',
                'status' => 'available',
                'date_acquired' => '2021-11-03',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Acer Laptop',
                'category' => 1,
                'Description' => 'Laptop-A315-56 512U (red) 15.6 FHD - ACER
                Core i5-1035G1, 4GB, 512GB SSD',
                'property_no' => 'LAP0029050',
                'serial_no' => 'NXHS7SP0031471AB143400',
                'unit_of_measure' => 'unit',
                'value' => '58499.85',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'John Derel Tuazon',
                'status' => 'available',
                'date_acquired' => '2022-02-09',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Projector-ACER',
                'category' => 15,
                'Description' => 'Projector-ACER, Sn: MRJPJ11007801002EE5900. 4500 Lumens, WXGA 1280x800, WUXGA 1920x1200. Contrast Ratio 20,000: 1, Lamp Life 4,000hrs., 16W speaker, HDMI.',
                'property_no' => 'PRO0024938',
                'serial_no' => 'MRJPJ11007801002EE5900',
                'unit_of_measure' => 'unit',
                'value' => '91480',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Allan Abasola',
                'status' => 'available',
                'date_acquired' => '2022-01-06',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Projector-ACER',
                'category' => 15,
                'Description' => 'Projector-ACER, Sn: MRJPJ11007106012835910. 4500 Lumens, WXGA 1280x800, WUXGA 1920x1200. Contrast Ratio 20,000: 1, Lamp Life 4,000hrs., 16W speaker, HDMI.',
                'property_no' => 'PRO0024940',
                'serial_no' => 'MRJPJ11007106012835910',
                'unit_of_measure' => 'unit',
                'value' => '91480',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Allan Abasola',
                'status' => 'available',
                'date_acquired' => '2022-01-06',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Toyota Tamaraw FX',
                'category' => 3,
                'Description' => 'Toyota Tamaraw FX, Plate No. SFB 820, Standard Gas with complete accessries. Model No: Wagon 1800CC 4 Cyl 2010 kg., (Engine No. 7K-0331651; Chassis No. KF52-963421; Year Model: 2000; Make: Toyota-SR M/T Wagon; Color: Wine Red)',
                'property_no' => 'LLL200012',
                'serial_no' => 'KF52-963421',
                'unit_of_measure' => 'unit',
                'value' => '427000',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Allan Abasola',
                'status' => 'available',
                'date_acquired' => '2000-08-17',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Toyota Tamaraw FX',
                'category' => 3,
                'Description' => 'Plate No. SDS 893, Toyota Tamaraw FX; Engine No. 7K-0261381; Chassis No. KF52-962820',
                'property_no' => 'LLL200015',
                'serial_no' => 'KF52-962820',
                'unit_of_measure' => 'unit',
                'value' => '450000',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Allan Abasola',
                'status' => 'available',
                'date_acquired' => '1999-09-07',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Toyota Revo',
                'category' => 3,
                'Description' => 'Toyota Revo, Plate No. SFB 815. (Engine No. 7K-0349160; Chassis No. KF80-8017544; Year Model: 2000; Make: Toyota-Revo SR MT Wagon; Color: Wine Red). With one (1) set seat cover.',
                'property_no' => 'LLL200029',
                'serial_no' => 'KF80-8017544',
                'unit_of_measure' => 'unit',
                'value' => '650000',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Allan Abasola',
                'status' => 'available',
                'date_acquired' => '2000-11-08',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Carrier Air Conditioner',
                'category' => 2,
                'Description' => '2.5Hp split type aircondition-CARRIER, Sn: Indoor-D202217700116912170068; Outdoor-D202161730216815170005',
                'property_no' => 'F100224',
                'serial_no' => 'D202217700116912170068',
                'unit_of_measure' => 'unit',
                'value' => '94700',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Analee Vergel',
                'status' => 'available',
                'date_acquired' => '2016-12-01',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            //separate ba or hindi na??
            array(
                'admin_id' => 1,
                'equipment_name' => 'Carrier Air Conditioner',
                'category' => 2,
                'Description' => '2.5Hp split type aircondition-CARRIER, Sn: Indoor-D202217700116912170068; Outdoor-D202161730216815170005',
                'property_no' => 'F100224',
                'serial_no' => 'D202161730216815170005',
                'unit_of_measure' => 'unit',
                'value' => '94700',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Analee Vergel',
                'status' => 'available',
                'date_acquired' => '2016-12-01',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            
            array(
                'admin_id' => 1,
                'equipment_name' => 'Toyota Tamaraw FX',
                'category' => 3,
                'Description' => 'Plate No. SDS 893, Toyota Tamaraw FX; Engine No. 7K-0261381; Chassis No. KF52-962820',
                'property_no' => 'LLL200029',
                'serial_no' => 'KF80-8017544',
                'unit_of_measure' => 'unit',
                'value' => '650000',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Allan Abasola',
                'status' => 'available',
                'date_acquired' => '2000-11-08',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            

            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop-ACER',
                'category' => 1,
                'Description' => 'Laptop-ACER. Intel core i5-4210u up tp 2.70Ghz/4GB/1TB. 14inches HD, 8x DVD Super multi double layer drive. Windows 8.1, Serial Nos.: NXMN3SP0014240307E7600',
                'property_no' => 'LAP0010903',
                'serial_no' => 'NXMN3SP0014240307E7600',
                'unit_of_measure' => 'unit',
                'value' => '55665',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Analee Vergel',
                'status' => 'available',
                'date_acquired' => '2015-05-18',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            //Di sure serial no. camera at lens
            array(
                'admin_id' => 1,
                'equipment_name' => 'NIKON D5300',
                'category' => 7,
                'Description' => 'Camera Body Only NIKON D5300 Sn: 7840460; Lens Sn: 23818843.',
                'property_no' => 'PHO0012754A',
                'serial_no' => '7840460',
                'unit_of_measure' => 'set',
                'value' => '63950',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Analee Vergel',
                'status' => 'available',
                'date_acquired' => '2016-01-14',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            
            array(
                'admin_id' => 1,
                'equipment_name' => 'Police Patrol Type Jeep',
                'category' => 3,
                'Description' => 'Police Patrol Type Jeep Multicab, (Engine No. F6A-55033117; Chassis No. DD51B-100194; Year Model: 2008; Make: Suzuki-HSPUR; Color: Not Indicated)',
                'property_no' => 'MVO018',
                'serial_no' => 'DD51B-100194',
                'unit_of_measure' => 'unit',
                'value' => '178000',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Analee Vergel',
                'status' => 'available',
                'date_acquired' => '2008-01-01',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'ATS Machine Facial and Fingerprint Verification - ACTATEK',
                'category' => 8,
                'Description' => 'ATS Machine Facial and Fingerprint Verification - ACTATEK
                    Sn: 00111DB03FE8
                    Specs: 
                    2.8" TFT 256K color screen with slim and compact design.
                    Upgradeable to 3000, 5000, 100000 users.
                    Up to 500,000 event logs
                    Mode of verification:
                    - Facial only
                    - Fingerprint only
                    - PIN only
                    - Combination of any or all the 3 models',
                'property_no' => 'ATS0030605',
                'serial_no' => '00111DB03FE8',
                'unit_of_measure' => 'unit',
                'value' => '96703.55',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2023-03-14',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'ATS Machine Facial and Fingerprint Verification - ACTATEK',
                'category' => 8,
                'Description' => 'ATS Machine Facial and Fingerprint Verification - ACTATEK
                    Sn: 000111DB03FE9
                    Specs: 
                    2.8"" TFT 256K color screen with slim and compact design.
                    Upgradeable to 3000, 5000, 100000 users.
                    Up to 500,000 event logs
                    Mode of verification:
                    - Facial only
                    - Fingerprint only
                    - PIN only
                    - Combination of any or all the 3 models"',
                'property_no' => 'ATS0030606',
                'serial_no' => '00111DB03FE9',
                'unit_of_measure' => 'unit',
                'value' => '96703.55',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2023-03-14',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            

            array(
                'admin_id' => 1,
                'equipment_name' => 'ATS Machine Facial and Fingerprint Verification - ACTATEK',
                'category' => 8,
                'Description' => '"ATS Machine Facial and Fingerprint Verification - ACTATEK
                    Sn:  00111DB03FE3     
                    Specs: 
                    2.8"" TFT 256K color screen with slim and compact design.
                    Upgradeable to 3000, 5000, 100000 users.
                    Up to 500,000 event logs
                    Mode of verification:
                    - Facial only
                    - Fingerprint only
                    - PIN only
                    - Combination of any or all the 3 models"',
                'property_no' => 'ATS0030600',
                'serial_no' => '00111DB03FE3',
                'unit_of_measure' => 'unit',
                'value' => '96703.55',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2023-03-14',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'ATS Machine Facial and Fingerprint Verification - ACTATEK',
                'category' => 8,
                'Description' => 'ATS Machine Facial and Fingerprint Verification - ACTATEK
                Sn: 00111DB03FE0
                Specs: 
                2.8" TFT 256K color screen with slim and compact design.
                Upgradeable to 3000, 5000, 100000 users.
                Up to 500,000 event logs
                Mode of verification:
                - Facial only
                - Fingerprint only
                - PIN only
                - Combination of any or all the 3 models',
                'property_no' => 'ATS0030607',
                'serial_no' => '00111DB03FE0',
                'unit_of_measure' => 'unit',
                'value' => '96703.55',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2023-03-14',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'ATS Machine Facial and Fingerprint Verification - ACTATEK',
                'category' => 8,
                'Description' => '""ATS Machine Facial and Fingerprint Verification - ACTATEK
                    Sn: 00111DB03FE4     
                    Specs: 
                    2.8"" TFT 256K color screen with slim and compact design.
                    Upgradeable to 3000, 5000, 100000 users.
                    Up to 500,000 event logs
                    Mode of verification:
                    - Facial only
                    - Fingerprint only
                    - PIN only
                    - Combination of any or all the 3 models"',
                'property_no' => 'ATS0030601',
                'serial_no' => '00111DB03FE4',
                'unit_of_measure' => 'unit',
                'value' => '96703.55',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2023-03-14',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'ATS Machine Facial and Fingerprint Verification - ACTATEK',
                'category' => 8,
                'Description' => 'ATS Machine Facial and Fingerprint Verification - ACTATEK
                Sn: 00111DB03FEA
                Specs: 
                2.8" TFT 256K color screen with slim and compact design.
                Upgradeable to 3000, 5000, 100000 users.
                Up to 500,000 event logs
                Mode of verification:
                - Facial only
                - Fingerprint only
                - PIN only
                - Combination of any or all the 3 models',
                'property_no' => 'ATS0030608',
                'serial_no' => '00111DB03FEA',
                'unit_of_measure' => 'unit',
                'value' => '96703.55',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2023-03-14',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'ATS Machine Facial and Fingerprint Verification - ACTATEK',
                'category' => 8,
                'Description' => 'ATS Machine Facial and Fingerprint Verification - ACTATEK
                Sn:  00111DB03FE5     
                Specs: 
                2.8" TFT 256K color screen with slim and compact design.
                Upgradeable to 3000, 5000, 100000 users.
                Up to 500,000 event logs
                Mode of verification:
                - Facial only
                - Fingerprint only
                - PIN only
                - Combination of any or all the 3 models',
                'property_no' => 'ATS0030602',
                'serial_no' => '00111DB03FE5',
                'unit_of_measure' => 'unit',
                'value' => '96703.55',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2023-03-14',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'ATS Machine Facial and Fingerprint Verification - ACTATEK',
                'category' => 8,
                'Description' => 'ATS Machine Facial and Fingerprint Verification - ACTATEK
                Sn: 00111DB03FEB
                Specs: 
                2.8" TFT 256K color screen with slim and compact design.
                Upgradeable to 3000, 5000, 100000 users.
                Up to 500,000 event logs
                Mode of verification:
                - Facial only
                - Fingerprint only
                - PIN only
                - Combination of any or all the 3 models',
                'property_no' => 'ATS0030609',
                'serial_no' => '00111DB03FEB',
                'unit_of_measure' => 'unit',
                'value' => '96703.55',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2023-03-14',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'ATS Machine Facial and Fingerprint Verification - ACTATEK',
                'category' => 8,
                'Description' => 'ATS Machine Facial and Fingerprint Verification - ACTATEK
                Sn: 00111DB03FE7     
                Specs: 
                2.8" TFT 256K color screen with slim and compact design.
                Upgradeable to 3000, 5000, 100000 users.
                Up to 500,000 event logs
                Mode of verification:
                - Facial only
                - Fingerprint only
                - PIN only
                - Combination of any or all the 3 models',
                'property_no' => 'ATS0030604',
                'serial_no' => '00111DB03FE7',
                'unit_of_measure' => 'unit',
                'value' => '96703.55',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2023-03-14',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'ATS Finger Scanner - ACTATEK',
                'category' => 8,
                'Description' => 'ATS Finger Scanner - ACTATEK
                Sn: 00111DB025DA
                Real-time system update of configuration 500 DPI optical scanner.
                Auto match support up to 10,000 users (1:n).
                Operates in stand-alone or network mode (Access Manager).
                Up to 75,000 logs.
                Five modes of authentication, finger-print only.',
                'property_no' => 'ATS0030612',
                'serial_no' => '00111DB025DA',
                'unit_of_measure' => 'unit',
                'value' => '59650',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2023-03-14',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop Computer - ACER',
                'category' => 1,
                'Description' => 'Laptop Computer-ACER, Sn: NXGDWSP0047130FAE57600. Core i5-7200U (3MB L3 cache 2.5Ghz with turbo boost). 4GB of DDR2. 2TB 2.5inch 5400 RPM. 15.6" Full HD',
                'property_no' => 'COM0016449',
                'serial_no' => 'NXGDWSP0047130FAE57600',
                'unit_of_measure' => 'unit',
                'value' => '59790',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2017-12-01',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop Computer-ASUS',
                'category' => 1,
                'Description' => 'Laptop Computer-ASUS, Sn: DBNOCX343136466. Intel core i7-4500U 1.8Ghz Processor/4GB DDR3, 15.6", Windows 8 SL.',
                'property_no' => 'LAP0007968',
                'serial_no' => 'DBNOCX343136466',
                'unit_of_measure' => 'unit',
                'value' => '64863',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2024-15-01',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop Computer - ACER',
                'category' => 1,
                'Description' => 'Laptop-ACER, Sn: NXMN3SP0014240308E7600. Intel core i5-4210u up tp 2.70Ghz/4GB/1TB. 14inches HD, 8x DVD Super multi double layer drive. Windows 8.1 (Health Service Program)',
                'property_no' => 'LAP0010905',
                'serial_no' => 'NXGDWSP0047130FAE57600',
                'unit_of_measure' => 'unit',
                'value' => '55665',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2015-05-18',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop-ACER',
                'category' => 1,
                'Description' => 'Laptop-ACER. Intel core i5-4210u up tp 2.70Ghz/4GB/1TB. 14inches HD, 8x DVD Super multi double layer drive. Windows 8.1, Serial Nos.: NXMN3SP001423171FF7600',
                'property_no' => 'LAP0010909',
                'serial_no' => 'NXMN3SP001423171FF7600',
                'unit_of_measure' => 'unit',
                'value' => '55665',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2024-05-18',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop Computer - ACER',
                'category' => 1,
                'Description' => 'Laptop-ACER. Intel core i5-4210u up tp 2.70Ghz/4GB/1TB. 14inches HD, 8x DVD Super multi double layer drive. Windows 8.1, Serial Nos.: NXMN3SP001423170AB7600',
                'property_no' => 'LAP0010913',
                'serial_no' => 'NXMN3SP001423170AB7600',
                'unit_of_measure' => 'unit',
                'value' => '55665',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2015-05-18',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop-ACER',
                'category' => 1,
                'Description' => 'Laptop-ACER, Sn: NXMN3SP0014240331D7600. Intel core i5-4210u up tp 2.70Ghz/4GB/1TB. 14inches HD, 8x DVD Super multi double layer drive. Windows 8.1 (Health Service Program)',
                'property_no' => 'LAP0010916',
                'serial_no' => 'NXMN3SP0014240331D7600',
                'unit_of_measure' => 'unit',
                'value' => '55665',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2024-05-18',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop Computer - ACER',
                'category' => 1,
                'Description' => 'Laptop-ACER, Sn: NXMN3SP001427045AB7600. Intel core i5-4210u up tp 2.70Ghz/4GB/1TB. 14inches HD, 8x DVD Super multi double layer drive. Windows 8.1 (Health Service Program)',
                'property_no' => 'LAP0010919',
                'serial_no' => 'NXMN3SP001427045AB7600',
                'unit_of_measure' => 'unit',
                'value' => '55665',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2015-05-18',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Letwork Switch  (28 port)-LINKSYS',
                'category' => 1,
                'Description' => '"Network Switch  (28 port)-LINKSYS, 
                Sn: 14E10C91801926
                28-port Bussiness Managed Gigabit PoE + 2x Gigabit
                Ethernet + 2x Gigabit SFP/RJ45 Combo ports (192W)"',
                'property_no' => 'NET0028677',
                'serial_no' => '14E10C91801926',
                'unit_of_measure' => 'unit',
                'value' => '74950',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2021-03-11',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Network Switch  (28 port)-LINKSYS',
                'category' => 9,
                'Description' => 'Network Switch  (28 port)-LINKSYS, 
                Sn: 14E10C91801904
                28-port Bussiness Managed Gigabit PoE + 2x Gigabit
                Ethernet + 2x Gigabit SFP/RJ45 Combo ports (192W)',
                'property_no' => 'NET0028676',
                'serial_no' => '14E10C91801904',
                'unit_of_measure' => 'unit',
                'value' => '74950',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2021-03-11',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Network Switch  (24 port)-LINKSYS',
                'category' => 9,
                'Description' => 'Network Switch  (24 port)-LINKSYS, 
                Sn: 39B10GH8B00375
                24-port Bussiness Managed Gigabit PoE + Switch w/4 10G, SPF + Uplinks 410W',
                'property_no' => 'NET0028678',
                'serial_no' => '39B10GH8B00375',
                'unit_of_measure' => 'unit',
                'value' => '67950',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2021-03-11',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Uninterrupted Power Supply (UPS) - VERTIV',
                'category' => 9,
                'Description' => 'Uninterrupted Power Supply (UPS) - VERTIV
                    Model: GXTRT 3000IRT2UXL
                    Sn: 2232810321RT13C
                    3kVA 230v 2U Rak/Tower with batteries
                    Ratings: (VA/W): 3000/2700
                    Unit: W438 x D632 x H88/27.6kg
                    Nominal Voltage: 230VAC
                    Range: 120-300 VAC',
                'property_no' => 'UPS0031159',
                'serial_no' => '2232810321RT13C',
                'unit_of_measure' => 'unit',
                'value' => '194430',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2023-06-27',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Digital Audio Video NTSC Professional Offer Data Video',
                'category' => 10,
                'Description' => 'Digital Audio Video NTSC Professional Offer Data Video, Switcher Model SE 500, Sn: 00399943',
                'property_no' => 'DIG0012755',
                'serial_no' => '00399943',
                'unit_of_measure' => 'unit',
                'value' => '66560',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2016-01-14',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Solar Power Portable Generator - POWEROAD',
                'category' => 12,
                'Description' => 'Solar Power Portable Generator - POWEROAD
                Model: Prime 750.
                SN: Y1261520K180024.
                Specification:
                Battery: Type li-on battery (NMC)
                Capacity-786wh, cycle life-1500, Input: AC wall charging 12.7 5A or 12.6v 10A. Solar Charging: 12.5v - 25v/max power up to 125w.
                AC Output: total port - 2 x AC ports.
                Rated power - 500w. Pulse power - 2500w.
                Voltage/frequency - 230v/60Hz.
                DC Output: USB port - 1 x 5v 1A, 1 x 5v 2A.
                Cigarette lighter, socket - 1x12v/60w (max 96w).
                DC port - 2 x 12v 2.5A.
                LED lighting: Multi mode - High Bright (100% power); Normal (50% power); energy saving (25% power); Emergency flash, SOS rignet.
                Dimension (LxWxH): 349x160x285mm (13.7x6.3x11.2inch).
                Net Weight - 7.5 kg (16.5lbs)',
                'property_no' => 'GEN0029040',
                'serial_no' => 'Y1261520K180024',
                'unit_of_measure' => 'unit',
                'value' => '79999',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2022-02-08',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Document Scanner-CANON',
                'category' => 12,
                'Description' => 'Document Scanner-CANON. Scanning resolution: 150x150dpi, 200x200dpi, 300x300dpi, 400x400dpi. Serial Nos.: FW434824 (Health Service Program)',
                'property_no' => 'SCA0010965',
                'serial_no' => 'FW434824',
                'unit_of_measure' => 'unit',
                'value' => '68980',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Audie Cada',
                'status' => 'available',
                'date_acquired' => '2018-05-18',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Photocopier Machine-GESTETNER',
                'category' => 12,
                'Description' => 'Photocopier Machine-GESTETNER, Sn: 
                    E356M350085. Warm-up time: 10secs. 1st Output Speed: 6.5secs. Continous output speed: 20/25 pages/m. Memory: Standard 128MB. Dimensions: 587x568x430/587x568x528mm. Weight: 37kg. Power source: 220-240V. 50/60Hz',
                'property_no' => 'COP0013447',
                'serial_no' => 'E356M350085',
                'unit_of_measure' => 'unit',
                'value' => '79999',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Girlie Radaza',
                'status' => 'available',
                'date_acquired' => '2016-06-08',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            
            array(
                'admin_id' => 1,
                'equipment_name' => 'Document Scanner-CANON',
                'category' => 9,
                'Description' => 'Document Scanner-CANON. Scanning resolution: 150x150dpi, 200x200dpi, 300x300dpi, 400x400dpi. Serial Nos.: FW4355690',
                'property_no' => 'SCA0010960',
                'serial_no' => 'FW4355690',
                'unit_of_measure' => 'unit',
                'value' => '68980',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Girlie Radaza',
                'status' => 'available',
                'date_acquired' => '2015-05-18',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Document Scanner-CANON',
                'category' => 9,
                'Description' => 'Document Scanner-CANON. Scanning resolution: 150x150dpi, 200x200dpi, 300x300dpi, 400x400dpi. Serial Nos.: FW4355690',
                'property_no' => 'SCA0010960',
                'serial_no' => 'FW4355690',
                'unit_of_measure' => 'unit',
                'value' => '68980',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Girlie Radaza',
                'status' => 'available',
                'date_acquired' => '2015-05-18',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop-ACER',
                'category' => 1,
                'Description' => 'Laptop-ACER. Intel core i5-4210u up tp 2.70Ghz/4GB/1TB. 14inches HD, 8x DVD Super multi double layer drive. Windows 8.1, Serial Nos.: NXMN3SP001423170C97600',
                'property_no' => 'LAP0010915',
                'serial_no' => 'NXMN3SP001423170C97600',
                'unit_of_measure' => 'unit',
                'value' => '55665',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Girlie Radaza',
                'status' => 'available',
                'date_acquired' => '2015-05-18',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Information and Communication Technology Thermal ID card Printer with Flipper - SMART',
                'category' => 13,
                'Description' => 'Information and Communication Technology Thermal ID card Printer with Flipper - SMART
                Sn: 5SPH000000270017, Model: SMART-51S
                PRINTING
                Print mode: Single sided
                Print Type: Direct Dye Sublimation 
                Print Area: Edge to edge
                Resolution: 300 dpi ( colour & mono): 600dpi & 1200dpi
                Mono only 
                Dual sided printing: Optional
                CARD
                Card Feeding: Automatic
                Card Size: ISO CR80 or ISO CR79 (Option Factory installed)
                Card Type: PVC, PET, Composite PVC
                PRINT SPEED 
                Monochrome: sec/card (720 cards/hour)
                Capacity: 
                Input Card Hopper: 100 cards/200 cards with cover open 
                Output Card Hopper: Front: 40 cards/ Rear: 100 cards
                (Optional rear - side stacker)
                SYSTEM
                Memory: 65MB RAM
                Interface: 2 Line LCD/ 2 LED Buttons
                Supported Platforms: Microsoft windows 7/8/10, MAC OS, Linux
                Communication: USB Ethernet (Option), Wifi (Option)
                Power supply: Free voltage (AC100/220V, 50-60Hz)
                Power Consumption: 48W
                Temperature: 15-35 °C
                Humidity: 35-70%
                Dimension: Millimeter-165(W)x390(L)x210(H); Inch-6.54(W)x154.4(L)x8.3(H)
                Weight: 4.5kg/10lbs
                Encoding Option: Certifications-CB, CE, FCC, KC CCC',
                'property_no' => 'PRI0030540',
                'serial_no' => '5SPH000000270017',
                'unit_of_measure' => 'unit',
                'value' => '299950',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Girlie Radaza',
                'status' => 'available',
                'date_acquired' => '2022-12-09',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop-ACER',
                'category' => 1,
                'Description' => 'Laptop-ACER, 
                SN: NHQ7NSP00C112233EE3400.
                i5-10300H Processor/8GB DDR4 Memory/ 256GB NVMe
                SSD/15.6" FHD 19x1080/PS 144Hz Display/ Nvidia
                GTX1650Ti 4GB GDDR5 VRAM / 802.11AX WiFi + BT',
                'property_no' => 'LAP0028661',
                'serial_no' => 'NHQ7NSP00C112233EE3400',
                'unit_of_measure' => 'unit',
                'value' => '66680',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Renz Alfred Litan',
                'status' => 'available',
                'date_acquired' => '2015-11-03',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop-ACER',
                'category' => 1,
                'Description' => 'Laptop-ACER, 
                SN: NHQ7NSP00C11222DA43400.
                i5-10300H Processor/8GB DDR4 Memory/ 256GB NVMe
                SSD/15.6" FHD 19x1080/PS 144Hz Display/ Nvidia
                GTX1650Ti 4GB GDDR5 VRAM / 802.11AX WiFi + BT
                HDMI Port',
                'property_no' => 'LAP0028663',
                'serial_no' => 'NHQ7NSP00C11222DA43400',
                'unit_of_measure' => 'unit',
                'value' => '66680',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Renz Alfred Litan',
                'status' => 'available',
                'date_acquired' => '2015-11-03',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop-ACER',
                'category' => 1,
                'Description' => 'Laptop-ACER, 
                SN: NHQ7NSP00C112231DC3400.
                i5-10300H Processor/8GB DDR4 Memory/ 256GB NVMe
                SSD/15.6" FHD 19x1080/PS 144Hz Display/ Nvidia
                GTX1650Ti 4GB GDDR5 VRAM / 802.11AX WiFi + BT
                HDMI Port',
                'property_no' => 'LAP0028664',
                'serial_no' => 'NHQ7NSP00C112231DC3400',
                'unit_of_measure' => 'unit',
                'value' => '66680',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Renz Alfred Litan',
                'status' => 'available',
                'date_acquired' => '2015-11-03',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop-ACER',
                'category' => 1,
                'Description' => 'Laptop-ACER, 
                SN: NHQ7NSP00C11222DB03400.
                i5-10300H Processor/8GB DDR4 Memory/ 256GB NVMe
                SSD/15.6" FHD 19x1080/PS 144Hz Display/ Nvidia
                GTX1650Ti 4GB GDDR5 VRAM / 802.11AX WiFi + BT
                HDMI Port',
                'property_no' => 'LAP0028665',
                'serial_no' => 'NHQ7NSP00C11222DB03400',
                'unit_of_measure' => 'unit',
                'value' => '66680',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Renz Alfred Litan',
                'status' => 'available',
                'date_acquired' => '2015-11-03',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop-ACER',
                'category' => 1,
                'Description' => 'Laptop-ACER, 
                SN: NHQ7NSP00C112235133400.
                i5-10300H Processor/8GB DDR4 Memory/ 256GB NVMe
                SSD/15.6" FHD 19x1080/PS 144Hz Display/ Nvidia
                GTX1650Ti 4GB GDDR5 VRAM / 802.11AX WiFi + BT
                HDMI Port',
                'property_no' => 'LAP0028668',
                'serial_no' => 'NHQ7NSP00C112235133400',
                'unit_of_measure' => 'unit',
                'value' => '66680',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Renz Alfred Litan',
                'status' => 'available',
                'date_acquired' => '2015-11-03',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Storage-SYNOLOGY',
                'category' => 9 ,
                'Description' => 'Storage-SYNOLOGY, Sn: 2050SBR7CJY6J. 4 Bay NAS Disk Station 4GB DDR3L-1866 Memory, expandable up to 8GB',
                'property_no' => 'STO0024931',
                'serial_no' => '2050SBR7CJY6J',
                'unit_of_measure' => 'unit',
                'value' => '57980',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Renz Alfred Litan',
                'status' => 'available',
                'date_acquired' => '2021-01-06',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Machine ID Card-HITI',
                'category' => 1,
                'Description' => 'Machine ID Card-HITI, Sn: C2E00A44700021',
                'property_no' => 'MAC0010625',
                'serial_no' => 'C2E00A44700021',
                'unit_of_measure' => 'unit',
                'value' => '116230',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Jocelyn Dela Cruz',
                'status' => 'available',
                'date_acquired' => '2015-03-1',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop-ACER',
                'category' => 1,
                'Description' => 'Laptop-ACER, Serial No: NXMN3SP001423171157600. Intel core i5-4210u up tp 2.70Ghz/4GB/1TB. 14inches HD, 8x DVD Super multi double layer drive. Windows 8.1',
                'property_no' => 'LAP0010907',
                'serial_no' => 'NXMN3SP001423171157600',
                'unit_of_measure' => 'unit',
                'value' => '55665',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Jocelyn Dela Cruz',
                'status' => 'available',
                'date_acquired' => '2015-05-18',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Machine ID Card-HITI',
                'category' => 9 ,
                'Description' => 'Machine ID Card-HITI, Sn: C2E00A50300001',
                'property_no' => 'MAC0010626',
                'serial_no' => 'C2E00A50300001',
                'unit_of_measure' => 'unit',
                'value' => '116230',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Jocelyn Dela Cruz',
                'status' => 'available',
                'date_acquired' => '2015-03-16',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Machine ID Card-HITI',
                'category' => 9 ,
                'Description' => 'Machine ID Card-HITI, Sn: C2E00A43800048',
                'property_no' => 'MAC0010628',
                'serial_no' => 'C2E00A43800048',
                'unit_of_measure' => 'unit',
                'value' => '116230',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Jocelyn Dela Cruz',
                'status' => 'available',
                'date_acquired' => '2015-03-16',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            array(
                'admin_id' => 1,
                'equipment_name' => 'Machine ID Card-HITI',
                'category' => 9 ,
                'Description' => 'Machine ID Card-HITI, Sn: C2E00A43800045',
                'property_no' => 'MAC0010630',
                'serial_no' => 'C2E00A43800045',
                'unit_of_measure' => 'unit',
                'value' => '116230',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Jocelyn Dela Cruz',
                'status' => 'available',
                'date_acquired' => '2015-03-16',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Barcode Printer - ZEBRA',
                'category' => 13 ,
                'Description' => 'Barcode Printer - ZEBRA
                Sn: 52J224201212
                Resolution: 203 dpi
                Print Method: Thermal transfer and Direct thermal
                Print Speed: 6inches/sec
                Memory: 128MB flash, 128MB SDRAM
                Package includes: 
                Designer basic barcode software
                Power cord
                USB printer cable
                2 hrs. training to end users',
                'property_no' => 'PRI0030617',
                'serial_no' => '52J224201212',
                'unit_of_measure' => 'unit',
                'value' => '114150',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Jocelyn Dela Cruz',
                'status' => 'available',
                'date_acquired' => '2015-03-14',
                'created_at' => now(),
                'updated_at' => now(),
            ),
            
            array(
                'admin_id' => 1,
                'equipment_name' => 'Machine ID Card Printer-HITI',
                'category' => 9 ,
                'Description' => 'Machine ID Card Printer-HITI, Model: PK-636G, Sn: C2E00163100046. Printing Speed: Colored-180 cards/hour (max), Monochrome-up to 1200cards/hour (max), Resolution-300x300dpi with USB connection. Print modes: color dye sublimation and monochrome thermal faster. Enhance color management system. Edge to edge printing (no margin). Integrated ribbon saver for monochrome printing.',
                'property_no' => 'X909044-A',
                'serial_no' => 'C2E00163100046',
                'unit_of_measure' => 'unit',
                'value' => '116230',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Jocelyn Dela Cruz',
                'status' => 'available',
                'date_acquired' => '2015-12-15',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Barcode Printer - ZEBRA',
                'category' => 13 ,
                'Description' => 'Barcode Printer - ZEBRA
                Sn: 52J224201212
                Resolution: 203 dpi
                Print Method: Thermal transfer and Direct thermal
                Print Speed: 6inches/sec
                Memory: 128MB flash, 128MB SDRAM
                Package includes: 
                Designer basic barcode software
                Power cord
                USB printer cable
                2 hrs. training to end users',
                'property_no' => 'PRI0030617',
                'serial_no' => '52J224201212',
                'unit_of_measure' => 'unit',
                'value' => '114150',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'Jocelyn Dela Cruz',
                'status' => 'available',
                'date_acquired' => '2015-03-14',
                'created_at' => now(),
                'updated_at' => now(),
                
            ),
            
            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop-ACER',
                'category' => 1 ,
                'Description' => 'Laptop-ACER, 
                SN: NHQ7NSP00C11222D1C3400.
                i5-10300H Processor/8GB DDR4 Memory/ 256GB NVMe
                SSD/15.6" FHD 19x1080/PS 144Hz Display/ Nvidia
                GTX1650Ti 4GB GDDR5 VRAM / 802.11AX WiFi + BT
                HDMI Port',
                'property_no' => 'LAP0028660',
                'serial_no' => 'NHQ7NSP00C11222D1C3400',
                'unit_of_measure' => 'unit',
                'value' => '66680',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'John Derel Tuazon',
                'status' => 'available',
                'date_acquired' => '2015-11-03',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop-ACER',
                'category' => 1 ,
                'Description' => 'Laptop-ACER, 
                SN: NHQ7NSP00C1122325C3400.
                i5-10300H Processor/8GB DDR4 Memory/ 256GB NVMe
                SSD/15.6" FHD 19x1080/PS 144Hz Display/ Nvidia
                GTX1650Ti 4GB GDDR5 VRAM / 802.11AX WiFi + BT
                HDMI Port',
                'property_no' => 'LAP0028669',
                'serial_no' => 'NHQ7NSP00C1122325C3400',
                'unit_of_measure' => 'unit',
                'value' => '66680',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'John Derel Tuazon',
                'status' => 'available',
                'date_acquired' => '2015-11-03',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'equipment_name' => 'Laptop-A315-56 512U (red) 15.6 FHD - ACER',
                'category' => 1 ,
                'Description' => 'Laptop-A315-56 512U (red) 15.6 FHD - ACER
                Core i5-1035G1, 4GB, 512GB SSD
                SN: NXHS7SP0031471AB143400',
                'property_no' => 'LAP0029050',
                'serial_no' => 'NXHS7SP0031471AB143400',
                'unit_of_measure' => 'unit',
                'value' => '58499.85',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'John Derel Tuazon',
                'status' => 'available',
                'date_acquired' => '2022-02-09',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'category' => 1,
                'equipment_name' => 'Laptop-A315-56 512U (red) 15.6 FHD - ACER',
                'Description' => 'Laptop-A315-56 512U (red) 15.6 FHD - ACER
                Core i5-1035G1, 4GB, 512GB SSD
                SN: NXHS7SP0031471B4D43400',
                'property_no' => 'LAP0029051',
                'serial_no' => 'NXHS7SP0031471B4D43400',
                'unit_of_measure' => 'unit',
                'value' => '58499.85',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'John Derel Tuazon',
                'status' => 'available',
                'date_acquired' => '2022-02-09',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'category' => 1 ,
                'equipment_name' => 'Laptop-A315-56 512U (red) 15.6 FHD - ACER',
                'Description' => 'Laptop-A315-56 512U (red) 15.6 FHD - ACER
                Core i5-1035G1, 4GB, 512GB SSD
                SN: NXHS7SP0031471B8913400',
                'property_no' => 'LAP0029052',
                'serial_no' => 'NXHS7SP0031471B8913400',
                'unit_of_measure' => 'unit',
                'value' => '58499.85',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'John Derel Tuazon',
                'status' => 'available',
                'date_acquired' => '2022-02-09',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'category' => 1 ,
                'equipment_name' => 'Large Format Printer-EPSON',
                'Description' => 'Large Format Printer-EPSON, 
                Sn: VRSE100360
                Nozzle Configuration: 360 nozzles each color, Print Direction
                Bi-directional printing,uni-directional printing: Max Print
                Resolution: 2880x1440dpi; Min Ink Droplet Size: 3.5pl with
                photo paper gloss 24in x 30.5in 1 roll and maintenance box',
                'property_no' => 'PRI0028675',
                'serial_no' => 'VRSE100360',
                'unit_of_measure' => 'unit',
                'value' => '394850',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'John Derel Tuazon',
                'status' => 'available',
                'date_acquired' => '2021-11-03',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'category' => 17 ,
                'equipment_name' => 'Server System',
                'Description' => 'Server System x 3105 (434748A) AMD Dual Core Opteron 1210 1.8Ghz Processor, 2x1MB of L2 cache; 2x 512MB 667 Mhz PCs-5200ECC DDR2 SDRAM; 1x160 GB Simple swap SATA HDD; Combo DVD/CDRW + LCD Monitor 17" Syncmaster 740N black; Server-Sn: 2K02659; Monitor-Sn: MY17HMEQ105547. For HOMIS Project',
                'property_no' => 'Q200005',
                'serial_no' => '2K02659',
                'unit_of_measure' => 'unit',
                'value' => '65950',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'John Derel Tuazon',
                'status' => 'available',
                'date_acquired' => '2008-05-30',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'category' => 17,
                'equipment_name' => 'Server System Monitor',
                'Description' => 'Server System x 3105 (434748A) AMD Dual Core Opteron 1210 1.8Ghz Processor, 2x1MB of L2 cache; 2x 512MB 667 Mhz PCs-5200ECC DDR2 SDRAM; 1x160 GB Simple swap SATA HDD; Combo DVD/CDRW + LCD Monitor 17" Syncmaster 740N black; Server-Sn: 2K02659; Monitor-Sn: MY17HMEQ105547. For HOMIS Project',
                'property_no' => 'Q200005',
                'serial_no' => 'MY17HMEQ105547',
                'unit_of_measure' => 'unit',
                'value' => '65950',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'John Derel Tuazon',
                'status' => 'available',
                'date_acquired' => '2008-05-30',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'category' => 16,
                'equipment_name' => 'IBM Server X3200 SAS',
                'Description' => 'Personal Computer, IBM Server X3200 SAS (4262iBS) Dual Core Intel Xeron Processor 3040, 1.86Ghz, 2x1MB 12 cache 1x73GB 10K, Hot-swap SAS HDD, 1GB Hot-swap redundant, Integrated hardware RAID-0, IPMI 1.5-complaint mini-BMC, IBM Director, Alert Standard Format 2.0, IBM Server guide, Optical RSA II and Optional Remote Deployment Manager, 3 year on-site limited warranty, Sn: 99A4995; Keyboard-Sn: 00002729; Mouse-Sn: 23-014298. For Document Tracking System Project',
                'property_no' => 'Q200011',
                'serial_no' => '99A4995',
                'unit_of_measure' => 'unit',
                'value' => '94500',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'John Derel Tuazon',
                'status' => 'available',
                'date_acquired' => '2008-01-16',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'category' => 16,
                'equipment_name' => 'IBM Server X3200 SAS',
                'Description' => 'Personal Computer, IBM Server X3200 SAS (4262iBS), Sn: 99A2802; Keyboard-Sn: 02263707; Mouse-Sn: 23-014298. Dual Core Intel Xeron Processor 3040, 1.86Ghz, 2x1MB 12 cache 1x73GB 10K, Hot-swap SAS HDD, 1GB Hot-swap redundant, Integrated hardware RAID-0, IPMI 1.5-complaint mini-BMC, IBM Director, Alert Standard Format 2.0, IBM Server guide, Optical RSA II and Optional Remote Deployment Manager, 3 year on-site limited warranty',
                'property_no' => 'Q200012',
                'serial_no' => '99A2802',
                'unit_of_measure' => 'unit',
                'value' => '94500',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'John Derel Tuazon',
                'status' => 'available',
                'date_acquired' => '2008-01-16',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'category' => 17,
                'equipment_name' => 'Server Unit Processor - LENOVO',
                'Description' => 'Server Unit Processor - LENOVO
                Sn: J3035WBI
                5215 Gold 10c 85w 2.5GHz
                Form Factor: 2Urack-mount
                Chipset: C624
                Memory min/max: 1x 16GB (x8) 293MHz
                Operating System not included',
                'property_no' => 'SER0030616',
                'serial_no' => 'J3035WBI',
                'unit_of_measure' => 'unit',
                'value' => '858650',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'John Derel Tuazon',
                'status' => 'available',
                'date_acquired' => '2023-03-14',
                'created_at' => now(),
                'updated_at' => now(),
            ),

            array(
                'admin_id' => 1,
                'category' => 16,
                'equipment_name' => 'Server Unit Processor - LENOVO',
                'Description' => 'Server Unit Processor - LENOVO
                Sn: J3035WBI
                5215 Gold 10c 85w 2.5GHz
                Form Factor: 2Urack-mount
                Chipset: C624
                Memory min/max: 1x 16GB (x8) 293MHz
                Operating System not included',
                'property_no' => 'SER0030616',
                'serial_no' => 'J3035WBI',
                'unit_of_measure' => 'unit',
                'value' => '858650',
                'quantity' => 1,
                'conditions' => 'Good',
                'remarks' => 'John Derel Tuazon',
                'status' => 'available',
                'date_acquired' => '2023-03-14',
                'created_at' => now(),
                'updated_at' => now(),
            ),
        );
        DB::table('equipment')->insert($equipment);

    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class OfficeSeeder extends Seeder
{

    public function run()
    {
        $timestamp = Carbon::now('Asia/Manila');

        $offices = array(
            array( // 1
                'code' => 'DJPMDH', 
                'office' => 'Dr. Jose P. Rizal Memorial District Hospital',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 2
                'code' => 'FAES', 
                'office' => 'Field Agriculture Extension Service',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 3
                'code' => 'GCMDH', 
                'office' => 'General Cailles Memorial District Hospital',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 4
                'code' => 'GSO', 
                'office' => 'General Services Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 5
                'code' => 'G.O. Executive', 
                'office' => 'Governor\'s Office - Executive Division',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 6
                'code' => 'Hectan', 
                'office' => 'Governor\'s Office Extension - Hectan',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 7
                'code' => 'PHRMO', 
                'office' => 'Provincial Human Resource Management Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 8
                'code' => 'Chest', 
                'office' => 'Laguna Chest Center',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 9
                'code' => 'LCCAO', 
                'office' => 'Laguna Climate Change Adoptation Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 10
                'code' => 'LCC', 
                'office' => 'Laguna Command and Control Center',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 11
                'code' => 'LMC', 
                'office' => 'Laguna Medical Center',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 12
                'code' => 'Jail', 
                'office' => 'Laguna Provincial Jail',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 13
                'code' => 'LTCATO', 
                'office' => 'Laguna Tourism, Culture, Arts and Trade Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 14
                'code' => 'LTMO', 
                'office' => 'Laguna Traffic Management Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 15
                'code' => 'LU', 
                'office' => 'Laguna University',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 16
                'code' => 'LDH', 
                'office' => 'Luisiana District Hospital',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 17
                'code' => 'MDH', 
                'office' => 'Majayjay District Hospital',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 18
                'code' => 'MISO', 
                'office' => 'Management Information Systems Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 19
                'code' => 'Moral', 
                'office' => 'Moral Development Program and Womens Desk',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 20
                'code' => 'NDH', 
                'office' => 'Nagcarlan District Hospital',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 21
                'code' => 'G.O. ADMIN', 
                'office' => 'Office of the Provincial Administrator',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 22
                'code' => 'PPL-BAY', 
                'office' => 'Pagamutang Pangmasa ng Laguna - Bay',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( //23
                'code' => 'Legal', 
                'office' => 'Provincial Attorneys Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 24
                'code' => 'Accounting', 
                'office' => 'Provincial Accounting Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 25
                'code' => 'Assessor', 
                'office' => 'Provincial Assessors Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 26
                'code' => 'Budget', 
                'office' => 'Provincial Budget Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 27
                'code' => 'COOP', 
                'office' => 'Provincial Cooperative and Development Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 28
                'code' => 'PDRRMO', 
                'office' => 'Provincial Disaster Risk Reduction and Management Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 29
                'code' => 'PEO', 
                'office' => 'Provincial Engineering Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 30
                'code' => 'PENRO', 
                'office' => 'Provincial Environment and Natural Resources Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 31
                'code' => 'Sports', 
                'office' => 'Provincial Games and Sports Development Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 32
                'code' => 'PHO', 
                'office' => 'Provincial Health Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 33
                'code' => 'PIO', 
                'office' => 'Provincial Information Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 34
                'code' => 'Library', 
                'office' => 'Provincial Library',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 35
                'code' => 'Nutrition', 
                'office' => 'Provincial Nutrition Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 36
                'code' => 'PPAOO', 
                'office' => 'Provincial Peace and Order Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 37
                'code' => 'PPDCO', 
                'office' => 'Provincial Planning and Development Coordinating Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 38
                'code' => 'PPO-Clinical', 
                'office' => 'Provincial Population Office (Clinical)',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( //39
                'code' => 'PPO-Outreach', 
                'office' => 'Provincial Population Office (Outreach)',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 40
                'code' => 'PSWDO', 
                'office' => 'Provincial Social Welfare & Development Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 41
                'code' => 'PTO', 
                'office' => 'Provincial Treasurers Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 42
                'code' => 'Housing', 
                'office' => 'Provincial Urban Development and Housing Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 43
                'code' => 'PVet', 
                'office' => 'Provincial Veterenarians Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 44
                'code' => 'PAO', 
                'office' => 'Public Affairs Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 45
                'code' => 'PESO', 
                'office' => 'Public Employement Service Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 46
                'code' => 'SPCDH', 
                'office' => 'San Pablo City District Hospital',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 47
                'code' => 'SPMH', 
                'office' => 'San Pedro Municipal Hospital',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 48
                'code' => 'Legislative', 
                'office' => 'Sangguniang Panlalawigan (Legislative)',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 49
                'code' => 'Secretariat', 
                'office' => 'Sangguniang Panlalawigan (Secretariat)',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 50
                'code' => 'SCO', 
                'office' => 'Sectoral Concern Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 51
                'code' => 'STAC', 
                'office' => 'Serbisyong Tama Action Center',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 52
                'code' => 'SLO', 
                'office' => 'Special Livelihood Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 53
                'code' => 'VGO', 
                'office' => 'Vice-Governor Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            ),
            array( // 54
                'code' => 'YDA', 
                'office' => 'Youth Development Affairs Office',
                'created_at' => $timestamp,
                'type' => 'interoffice' // interoffice
            )
        );  

        DB::table('tbl_office')->insert($offices);
    }
}

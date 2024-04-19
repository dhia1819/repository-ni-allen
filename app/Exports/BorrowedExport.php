<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class BorrowedExport implements FromCollection, WithHeadings, WithColumnWidths, WithTitle
{
    protected $Borrowed;

    public function __construct($Borrowed)
    {
        $this->Borrowed = $Borrowed;
    }
    public function collection()
    {
        $data = $this->Borrowed->map(function ($Borrowed) {
            return [
                'Serial Number' =>$Borrowed->serial_no,
                'Property Number' => $Borrowed->property_no,
                'Equipment' => $Borrowed->equipment_name,
                'Category' =>$Borrowed->category_name,
                'Borrower' => $Borrowed->borrowed_by,
                'Office' => $Borrowed->office_name,
                'Date Borrowed' => $Borrowed->date_borrowed,
                'Expected Return' => $Borrowed->date_returned,
                'Released by' => $Borrowed->release_by,
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'Serial Number',
            'Property Number',
            'Equipment',
            'Category',
            'Borrower',
            'Office',
            'Date Borrowed',
            'Expected Return',
            'Released by'
        ];
    }

    public function title(): string
    {
        return 'Borrowed Equipments';
    }

    public function columnWidths(): array
    {
        return [
            'A' => '20', 
            'B' => '20',
            'C' => '20', 
            'D' => '20', 
            'E' => '20', 
            'F' => '40', 
            'G' => '20', 
            'H' => '20', 
            'I' => '20'
        ];
    }
    
}

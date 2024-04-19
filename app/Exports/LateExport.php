<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LateExport implements FromCollection, WithColumnFormatting, ShouldAutoSize, WithHeadings
{
    protected $transactions;

    public function __construct(Collection $transactions)
    {
        $this->transactions = $transactions;
    }

    public function collection()
    {
        // Prepare and return the data as a collection
        return $this->transactions->map(function ($transaction) {
            return [
                
                'Category' => $transaction->category_name,
                'Borrower' => $transaction->borrowed_by,
                'Office' => $transaction->office_name,
                'Date Borrowed' => $transaction->date_borrowed,
                'Expected Return' => $transaction->date_borrowed, // This should likely be a different date field
                'Released by' => $transaction->release_by,
          
            ];
        });
    }

    public function headings(): array
    {
        return [
            
            'Category',
            'Borrower',
            'Office',
            'Date Borrowed',
            'Expected Return',
            'Released by',
           
        ];
    }

    public function columnFormats(): array
    {
        // Set column widths (A = 10, B = 20, C = 15, etc.)
        return [
            'A' => '20', // Equipment
            'B' => '20', // Category
            'C' => '20', // Borrower
            'D' => '20', // Office
            'E' => '20', // Date Borrowed
            'F' => '20', // Expected Return
            'G' => '20', // Released by
           
        ];
    }
}

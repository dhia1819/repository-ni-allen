<?php

namespace App\Exports;

use App\Models\Transaction;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;

class TransactionsExport implements FromCollection, WithHeadings, WithColumnWidths, WithTitle
{
    protected $transactions;

    public function __construct($transactions)
    {
        $this->transactions = $transactions;
    }

    public function collection()
    {
        // Prepare and return the data as a collection
        $data = $this->transactions->map(function ($transaction) {
            return [
                'Serial Number' =>$transaction->serial_no,
                'Property Number' => $transaction->property_no,
                'Equipment' => $transaction->equipmentName,
                'Category' =>$transaction->category_name,
                'Borrower' => $transaction->borrowed_by,
                'Office' => $transaction->office_name,
                'Date Borrowed' => $transaction->date_borrowed,
                'Expected Return' => $transaction->date_borrowed,
                'Released by' => $transaction->release_by,
                'Date Returned' => $transaction->returned_date,
                'Returned by' => $transaction->returned_by,
                'Received by' => $transaction->received_by,
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
            'Released by',
            'Date Returned',
            'Returned by',
            'Received by',
        ];
    }

    public function title(): string
    {
        return 'Borrowing History';
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
            'I' => '20', 
            'J' => '20',
            'K' => '20',
            'L' => '20'

        ];
    }
}
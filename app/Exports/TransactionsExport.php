<?php

namespace App\Exports;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TransactionsExport implements FromCollection, WithHeadings, WithColumnWidths, WithTitle, WithStyles
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
                'Date Borrowed' => Carbon::parse($transaction->date_borrowed)->format('F d, Y'),
                'Expected Return' => Carbon::parse($transaction->date_borrowed)->format('F d, Y'),
                'Released by' => $transaction->release_by,
                'Date Returned' => Carbon::parse($transaction->returned_date)->format('F d, Y'),
                'Returned by' => $transaction->returned_by,
                'Received by' => $transaction->received_by,
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            ['Borrowing History'],
            [],
            [
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
            ]
        ];
    }

    public function title(): string
    {
        return 'Borrowing History';
    }

    public function columnWidths(): array
    {
        return [
            'A' => '15', 
            'B' => '15',
            'C' => '15', 
            'D' => '15', 
            'E' => '15', 
            'F' => '30', 
            'G' => '15', 
            'H' => '15', 
            'I' => '15', 
            'J' => '15',
            'K' => '15',
            'L' => '15'

        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Merge cells for the title
        $sheet->mergeCells('A1:l1');

        // Set title font to bold, increase font size, horizontally center align, and vertically middle align
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getAlignment()->setVertical('middle');

        // Set headings font to bold, horizontally center align, and vertically middle align
        $sheet->getStyle('A3:L3')->getFont()->setBold(true);
        $sheet->getStyle('A3:L3')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A3:L3')->getAlignment()->setVertical('middle');

        // Enable text wrapping and vertically middle align for all cells
        $sheet->getStyle('A1:L' . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
        $sheet->getStyle('A1:L' . $sheet->getHighestRow())->getAlignment()->setVertical('middle');
    }
}
<?php
namespace App\Exports;

use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class BorrowedExport implements FromCollection, WithHeadings, WithColumnWidths, WithTitle, WithStyles
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
                'Serial Number' => $Borrowed->serial_no,
                'Property Number' => $Borrowed->property_no,
                'Equipment' => $Borrowed->equipment_name,
                'Category' => $Borrowed->category_name,
                'Borrower' => $Borrowed->borrowed_by,
                'Office' => $Borrowed->office_name,
                'Date Borrowed' => Carbon::parse($Borrowed->date_borrowed)->format('F d, Y'),
                'Expected Return' => Carbon::parse($Borrowed->date_returned)->format('F d, Y'),
                'Released by' => $Borrowed->release_by,
            ];
        });

        return $data;
    }

    public function title(): string
    {
        return 'Borrowed Equipments';
    }

    public function headings(): array
    {
        return [
            ['Borrowed Equipments'],
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
                'Released by'
            ],
        ];
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

    public function styles(Worksheet $sheet)
    {
        // Merge cells for the title
        $sheet->mergeCells('A1:I1');

        // Set title font to bold, increase font size, horizontally center align, and vertically middle align
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getAlignment()->setVertical('middle');

        // Set headings font to bold, horizontally center align, and vertically middle align
        $sheet->getStyle('A3:I3')->getFont()->setBold(true);
        $sheet->getStyle('A3:I3')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A3:I3')->getAlignment()->setVertical('middle');

        // Enable text wrapping and vertically middle align for all cells
        $sheet->getStyle('A1:I' . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
        $sheet->getStyle('A1:I' . $sheet->getHighestRow())->getAlignment()->setVertical('middle');
    }
}

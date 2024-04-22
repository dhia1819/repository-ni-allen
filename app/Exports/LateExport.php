<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Carbon;

class LateExport implements FromCollection, WithColumnFormatting, ShouldAutoSize, WithHeadings, WithStyles
{
    protected $missing;

    public function __construct(Collection $missing)
    {
        $this->missing = $missing;
    }

    public function collection()
    {
        // Prepare and return the data as a collection
        return $this->missing->map(function ($missing) {
            return [
                'Date Borrowed' => Carbon::parse($missing->date_borrowed)->format('F d, Y'),
                'Expected Return' => Carbon::parse($missing->date_returned)->format('F d, Y'),
                'Borrower' => $missing->borrowed_by,
                'Office' => $missing->office_name,
                'Serial Number' => $missing->serial_no,
                'Property Number' => $missing->property_no,
                'Equipment' => $missing->equipment_name,
                'Category' => $missing->category_name,
                'Released by' => $missing->release_by,
          
            ];
        });
    }

    public function title(): string
    {
        return 'Missing_Items';
    }

    public function headings(): array
    {
        return [
            ['Missing Items/Unreturned Items'],
            [],
            [
                'Date Borrowed',
                'Expected Return',
                'Borrower',
                'Office',
                'Serial Number',
                'Property Number',
                'Equipment',
                'Category',
                'Released by',
               
            ]
        ];
    }

    public function columnFormats(): array
    {
        return [
            'A' => '12', 
            'B' => '12', 
            'C' => '15', 
            'D' => '40', 
            'E' => '15',
            'F' => '15', 
            'G' => '15',
            'H' => '15',
            'I' => '15'
           
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
        $sheet->getStyle('A3:I' . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
        $sheet->getStyle('A3:I' . $sheet->getHighestRow())->getAlignment()->setVertical('middle');

        // Change text color for the "Expected Return" column (column B)
        $sheet->getStyle('B')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);

    }


}

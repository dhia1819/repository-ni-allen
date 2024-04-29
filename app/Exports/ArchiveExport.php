<?php

namespace App\Exports;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ArchiveExport implements FromCollection, WithHeadings, WithColumnWidths, WithTitle, WithStyles
{
    protected $archive;

    public function __construct($archive)
    {
        $this->archive = $archive;
    }
    public function collection()
    {
        
        // Prepare and return the data as a collection
        $data = $this->archive->map(function ($archive) {
            return [
                'Article/Item Name'=> $archive->equipment_name,
                'Category'=> $archive->category,
                'Description' => $archive->Description,
                'Property no.' => $archive->property_no,
                'Serial no.' => $archive->serial_no,
                'Unit of Measure'=> $archive->unit_of_measure,
                'Value' => $archive->value,
                'Quantity' => $archive->quantity,
                'Condition'=> $archive->conditions,
                'Remarks' => $archive->remarks,
                'Date Acquired' => Carbon::parse($archive->date_acquired)->format('F d, Y'),
            ];
        });

        return $data;
    }

    public function title(): string
    {
        return 'Archived_Equipments';
    }

    public function headings(): array
    {
        return [
            ['List of Condemned_Equipments'],
            [],
            [
                'Article/Item Name',
                'Category',
                'Description',
                'Property no.',
                'Serial no.',
                'Unit of Measure',
                'Value',
                'Quantity',
                'Condition',
                'Remarks',
                'Date Acquired',
            ]
        
        ];
        
    }

    public function columnWidths(): array
    {
        return [
            'A' => '15', // Article/Item Name
            'B' => '15', // Category
            'C' => '60', // Description
            'D' => '15', // Property no.
            'E' => '20', // Serial no.
            'F' => '10', // Unit of Measure
            'G' => '10', // Value
            'H' => '10', // Quantity
            'I' => '10', // Condition
            'J' => '15', // Remarks
            'K' => '20', // Date Acquired
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Merge cells for the title
        $sheet->mergeCells('A1:K1');

        // Set title font to bold, increase font size, horizontally center align, and vertically middle align
        $sheet->getStyle('A1')->getFont()->setBold(true);
        $sheet->getStyle('A1')->getFont()->setSize(16);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getAlignment()->setVertical('middle');

        // Set headings font to bold, horizontally center align, and vertically middle align
        $sheet->getStyle('A3:K3')->getFont()->setBold(true);
        $sheet->getStyle('A3:K3')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A3:K3')->getAlignment()->setVertical('middle');

        // Enable text wrapping and vertically middle align for all cells
        $sheet->getStyle('A1:K' . $sheet->getHighestRow())->getAlignment()->setWrapText(true);
        $sheet->getStyle('A1:K' . $sheet->getHighestRow())->getAlignment()->setVertical('middle');

    }
}
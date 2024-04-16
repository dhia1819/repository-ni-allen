<?php

namespace App\Exports;

use App\Models\Equipment;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;

class EquipmentsExport implements FromCollection, WithHeadings, WithColumnWidths, WithTitle
{
    protected $equipments;

    public function __construct($equipments)
    {
        $this->equipments = $equipments;
    }
    public function collection()
    {
        
        // Prepare and return the data as a collection
        $data = $this->equipments->map(function ($equipment) {
            return [
                'Article/Item Name'=> $equipment->equipment_name,
                'Category'=> $equipment->category,
                'Description' => $equipment->Description,
                'Property no.' => $equipment->property_no,
                'Serial no.' => $equipment->serial_no,
                'Unit of Measure'=> $equipment->unit_of_measure,
                'Value' => $equipment->value,
                'Quantity' => $equipment->quantity,
                'Condition'=> $equipment->conditions,
                'Remarks' => $equipment->remarks,
                'Date Acquired' => $equipment->date_acquired,
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
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
        ];
        
    }

    public function title(): string
    {
        return 'Equipment';
    }

    public function columnWidths(): array
    {
        return [
            'A' => '20', // Article/Item Name
            'B' => '20', // Category
            'C' => '40', // Description
            'D' => '20', // Property no.
            'E' => '20', // Serial no.
            'F' => '20', // Unit of Measure
            'G' => '20', // Value
            'H' => '20', // Quantity
            'I' => '20', // Condition
            'J' => '20', // Remarks
            'K' => '20', // Date Acquired
        ];
    }
}
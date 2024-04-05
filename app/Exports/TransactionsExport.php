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
    public function collection()
    {
        // Fetch transactions data from the database
        $transactions = Transaction::leftJoin('equipment', 'transactions.equipment_id', '=', 'equipment.id')
        ->leftJoin('offices', 'transactions.office', '=', 'offices.id')
        ->leftJoin('employees as release_employees', 'transactions.release_by', '=', 'release_employees.id')
        ->leftJoin('employees as received_employees', 'transactions.received_by', '=', 'received_employees.id')
        ->select('transactions.*', 'equipment.equipment_name as equipmentName', 'offices.office as office_name', 'release_employees.fullName as release_by', 'received_employees.fullName as received_by')
        ->where('transactions.status', '=', 'Return')
        ->get();

        // Prepare and return the data as a collection
        $data = $transactions->map(function ($transaction) {
            return [
                'Equipment' => $transaction->equipmentName,
                'Borrower' => $transaction->borrowed_by,
                'Office' => $transaction->office_name,
                'Date Borrowed' => $transaction->date_borrowed,
                'Expected Return' => $transaction->date_borrowed,
                'Released by' => $transaction->release_by,
                'Date Returned' => $transaction->returned_date,
                'Returned by' =>$transaction->returned_by,
                'Received by' => $transaction->received_by,
            ];
        });

        return $data;
    }

    public function headings(): array
    {
        return [
            'Equipment',
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
            'A' => '20', // Equipment
            'B' => '20', // Borrower
            'C' => '40', // Office
            'D' => '20', // Date Borrowed
            'E' => '20', // Expected Return
            'F' => '20', // Released by
            'G' => '20', // Date Returned
            'H' => '20', // Returned by
            'I' => '20', //Received by

        ];
    }
}
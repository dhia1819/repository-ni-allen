<?php

namespace App\Exports;

use App\Models\Transaction;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Support\Collection;

class TransactionsExport implements FromCollection
{
    public function collection()
    {
        // Fetch transactions data from the database
        $transactions = Transaction::all();

        // Prepare and return the data as a collection
        $data = $transactions->map(function ($transaction) {
            return [
                'Equipment'=>$transaction->equipment_id,
                'Released by'=>$transaction->release_by,
                'Borrower' => $transaction->borrowed_by,
                'Date Borrowed' => $transaction->date_borrowed,
                'Expected Return' => $transaction->date_borrowed,
                'Office' => $transaction->office_name,
                'Date Returned' => $transaction->returned_date,
                'Received by' => $transaction->received_by,
            ];
        });

        return $data;
    }
}

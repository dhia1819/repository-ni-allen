<?php

namespace App\Http\Controllers;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Office;
use App\Models\Employee;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function return()
{
    $categories = Category::all();
    $offices = Office::all(); // Assuming you have an Office model
    $employees = Employee::all();

    $page = [
        'name'  =>  'Borrowed', // Change the name to "Borrowed"
        'title' =>  'Borrowed', // Change the title to "Borrowed"
        'crumb' =>  ['Borrowed' => '/borrow/return'] // Change the crumb to "Borrowed"
    ];
    
    $borrowedData = Transaction::leftJoin('equipment', 'transactions.equipment_id', '=', 'equipment.id')
        ->leftJoin('categories', 'equipment.category', '=', 'categories.id')
        ->leftJoin('offices', 'transactions.office', '=', 'offices.id')
        ->leftJoin('employees', 'transactions.release_by', '=', 'employees.id')
        ->where('transactions.status', 'Borrowed') // Filter out borrowed transactions
        ->select('transactions.*', 'equipment.*', 'categories.category as category_name', 'offices.office as office_name', 'employees.fullName as release_by', 'transactions.id as transaction_id')
        ->orderBy('transactions.created_at', 'ASC')
        ->get();

    return view('equipment.return', compact('page', 'borrowedData', 'categories', 'offices', 'employees'));       
}

public function showreturn(string $id)
{
    $page = [
        'name'  =>  'Return',
        'title' =>  'Return Equipment',
        'crumb' =>  ['Borrowed' => '/borrow/return', 'Return Equipment' => "/borrow/return/{$id}"]
    ];

    // Assuming you have an 'Offices' model
    $offices = Office::all();
    $employees = Employee::all();

    $transactions = Transaction::leftJoin('equipment', 'transactions.equipment_id', '=', 'equipment.id')
        ->leftJoin('offices', 'transactions.office', '=', 'offices.id')
        ->leftJoin('employees', 'transactions.release_by', '=', 'employees.id')
        ->select('transactions.*', 'equipment.*', 'offices.office as office_name', 'employees.fullName as release_by', 'transactions.id as transaction_id')
        ->where('equipment.id', $id)
        ->where('transactions.status', '=', 'Borrowed')
        ->get();

    return view('equipment.showreturn', compact('transactions', 'page', 'offices', 'employees'));
}

public function phase(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'returned_date' => 'required|date',
            'returned_by' => 'required|string',
            'received_by' => 'required|string',
        ]);
    
        // Here, you're setting the status to 'Good'. However, it's not clear where 'status' should be updated.
        // Assuming you have a status field in the transaction table, you might need to adjust this part accordingly.
        // Otherwise, you might encounter errors or unexpected behavior.
        $validatedData['status'] = 'Return';
    
        // Assuming 'transaction_id' is a variable representing the ID of the transaction being updated.
        // However, the syntax for updating in Laravel is incorrect. You should use the 'update' method on the model instance.
        $transaction = Transaction::findOrFail($id); // Retrieve the transaction by ID
        $transaction->update($validatedData);
    
        // Update equipment status to Borrowed
        // Assuming 'equipment_id' is a field in the 'transactions' table that represents the ID of the equipment related to this transaction.
        // If not, please replace it with the correct field name.
        $equipment = Equipment::find($transaction->equipment_id); // Retrieve equipment related to this transaction
        if ($equipment) {
            $equipment->status = 'Available';
            $equipment->save(); // Use save() to persist changes to the database
        }
    
        // Return a response indicating success
        return redirect()->route('return')->with('success', 'Equipment returned successfully.');
    }

}

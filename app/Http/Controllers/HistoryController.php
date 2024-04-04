<?php

namespace App\Http\Controllers;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Office;
use App\Models\Employee;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function history()
{
    $categories = Category::all();
    $offices = Office::all(); // Assuming you have an Office model

    $page = [
        'name'  =>  'History', // Change the name to "Borrowed"
        'title' =>  'History', // Change the title to "Borrowed"
        'crumb' =>  ['History' => '/borrow/history'] // Change the crumb to "Borrowed"
    ];
    
    $borrowedData = Transaction::leftJoin('equipment', 'transactions.equipment_id', '=', 'equipment.id')
        ->leftJoin('categories', 'equipment.category', '=', 'categories.id')
        ->leftJoin('offices', 'transactions.office', '=', 'offices.id')
        ->where('transactions.status', 'Return') // Filter out borrowed transactions
        ->select('transactions.*', 'equipment.*', 'categories.category as category_name', 'offices.office as office_name', 'transactions.id as transaction_id','transactions.status as tstatus')
        ->orderBy('transactions.created_at', 'ASC')
        ->get();

    return view('equipment.history', compact('page', 'borrowedData', 'categories', 'offices'));       
}
public function showhistory(string $id)
{
    $page = [
        'name'  =>  'Return',
        'title' =>  'History Details',
        'crumb' =>  ['History' => '/borrow/history', 'History Details' => "/borrow/showhistory/{$id}"]
    ];

    // Assuming you have an 'Offices' model
    $offices = Office::all();
    $employees = Employee::all();

    $transactions = Transaction::leftJoin('equipment', 'transactions.equipment_id', '=', 'equipment.id')
        ->leftJoin('offices', 'transactions.office', '=', 'offices.id')
        ->leftJoin('employees', 'transactions.release_by', '=', 'employees.id')
        ->select('transactions.*', 'equipment.*', 'offices.office as office_name', 'employees.fullName as release_by', 'transactions.received_by', 'employees.fullName as employee_name') // corrected the assignment
        ->where('transactions.id', $id)
        ->where('transactions.status', '=', 'Return')
        ->get();

    return view('equipment.showhistory', compact('transactions', 'page', 'offices', 'employees'));
}

}

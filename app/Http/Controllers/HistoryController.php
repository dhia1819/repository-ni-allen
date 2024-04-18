<?php

namespace App\Http\Controllers;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Office;
use App\Models\Employee;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Excel;
use App\Exports\TransactionsExport;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

class HistoryController extends Controller
{
    protected $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }
    

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
            ->select('transactions.*', 'equipment.*', 'categories.category as category_name', 'offices.code as office_name', 'transactions.id as transaction_id','transactions.status as tstatus')
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
        ->leftJoin('employees as release_employees', 'transactions.release_by', '=', 'release_employees.id')
        ->leftJoin('employees as received_employees', 'transactions.received_by', '=', 'received_employees.id')
        ->select('transactions.*', 'equipment.*', 'offices.office as office_name', 'release_employees.fullName as release_by', 'received_employees.fullName as received_by')
        ->where('transactions.id', $id)
        ->where('transactions.status', '=', 'Return')
        ->get();


        return view('equipment.showhistory', compact('transactions', 'page', 'offices', 'employees'));
    }
    public function downloadHistory(Request $request)
    {
        $startBorrow = $request->input('start_date_borrowed');
        $endBorrow =$request->input('end_date_borrowed');
        $startReturn = $request->input('start_date_return');
        $endReturn = $request->input('end_date_return');
        $category_filter = $request->input('category_filter');
        $office_filter =$request->input('office_filter');

         // Adjust the end date to include transactions up to 11:59:59 PM on the end date
         $endBorrowPlusOneDay = date('Y-m-d', strtotime($endBorrow . ' +1 day'));
         $endReturnPlusOneDay = date('Y-m-d', strtotime($endReturn . ' +1 day'));

        // Initialize query
        $query = Transaction::leftJoin('equipment', 'transactions.equipment_id', '=', 'equipment.id')
            ->leftJoin('offices', 'transactions.office', '=', 'offices.id')
            ->leftJoin('employees as release_employees', 'transactions.release_by', '=', 'release_employees.id')
            ->leftJoin('employees as received_employees', 'transactions.received_by', '=', 'received_employees.id')
            ->leftJoin('categories', 'equipment.category', '=', 'categories.id')
            ->select('transactions.*', 
                    'equipment.equipment_name as equipmentName', 
                    'offices.office as office_name', 'release_employees.fullName as release_by', 
                    'received_employees.fullName as received_by',
                    'categories.category as category_name', )
            ->where('transactions.status', '=', 'Return');

            if (!empty($startBorrow) && !empty($endBorrow)) {
                $query->whereBetween('date_borrowed', [$startBorrow, $endBorrowPlusOneDay]);
            
            } 

            if (!empty($startBorrow) && empty($endBorrow)) {
                $query->whereBetween('date_borrowed', [$startBorrow, $endBorrowPlusOneDay]);
            }

            if (!empty($startReturn) && !empty($endReturn)) {
                $query->whereBetween('returned_date', [$startReturn, $endReturnPlusOneDay]);
            } 

            if (!empty($startReturn) && empty($endReturn)) {
                $query->whereBetween('returned_date', [$startReturn, $endReturnPlusOneDay]);
            } 

            if (!empty($category_filter)) {
                $query->where('categories.category', $category_filter);
            }
        
            if (!empty($office_filter)) {
                $query->where('offices.code', $office_filter);
            }
                    $fileName = 'test.xlsx';
           

        // Get transactions data from the database
        $transactions = $query->get();


        // Check if there are transactions within the date range
        if ($transactions->isEmpty()) {
            // return response()->json(['message' => 'No transactions found within the specified date range'], 404);
            return Redirect::back()->withErrors('No transactions found within the specified date range.');
        }

        
        // Assuming you have an Export class named TransactionsExport
        return $this->excel->download(new TransactionsExport($transactions), $fileName);
    }


}

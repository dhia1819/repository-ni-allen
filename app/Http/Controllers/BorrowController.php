<?php

namespace App\Http\Controllers;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Office;
use App\Models\Employee;
use Carbon\Carbon;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Excel;
use App\Exports\BorrowedExport;

class BorrowController extends Controller
{

    public function return()
{
    // Set the timezone for Carbon to match your local timezone (e.g., Asia/Manila)
    // Adjust this to match your actual timezone
    date_default_timezone_set('Asia/Manila');

    $categories = Category::all();
    $offices = Office::all();
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
    ->where(function ($query) {
        $query->where('transactions.status', 'Borrowed')
            ->orWhere('transactions.status', 'Late');
    })
    ->select('transactions.*', 'equipment.id as equipment_id','equipment.equipment_name as equipment_name', 'equipment.serial_no as serial_no', 'equipment.property_no as property_no', 'categories.category as category_name', 'offices.code as office_name', 'employees.fullName as release_by', 'transactions.id as transaction_id')
    ->orderBy('transactions.created_at', 'ASC')
        ->get();

    // Update transaction status to 'Late' if the expected return datetime has passed
    foreach ($borrowedData as $transaction) {
        $expectedReturnDateTime = Carbon::parse($transaction->date_returned);

        if (Carbon::now()->greaterThan($expectedReturnDateTime) && $transaction->status !== 'Return') {
            // Update transaction status to 'Late'
            $transaction->status = 'Late';
            $transaction->save(); // Save the updated status
        }
    }

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
        ->where('transactions.id', $id)
      
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
        return redirect('/borrow/history')->with('success', 'Equipment returned successfully.');
    }

    protected $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }   

    public function downloadBorrowed(Request $request){

        $office_filter = $request->input('office_filter');
        $category_filter = $request->input('category_filter');
        $start_date_borrowed = $request->input('start_date_borrowed');
        $end_date_borrowed = $request->input('end_date_borrowed');
        $start_date_return = $request->input('start_date_return');
        $end_date_return = $request->input('end_date_return');

        // Adjust the end date to include transactions up to 11:59:59 PM on the end date
        $endBorrowPlusOneDay = date('Y-m-d', strtotime($end_date_borrowed . ' +1 day'));
        $endReturnPlusOneDay = date('Y-m-d', strtotime($end_date_return . ' +1 day'));

        $query = Transaction::leftJoin('equipment', 'transactions.equipment_id', '=', 'equipment.id')
        ->leftJoin('categories', 'equipment.category', '=', 'categories.id')
        ->leftJoin('offices', 'transactions.office', '=', 'offices.id')
        ->leftJoin('employees', 'transactions.release_by', '=', 'employees.id')
        ->select('transactions.*', 
                'equipment.id as equipment_id',
                'equipment.equipment_name as equipment_name', 
                'equipment.serial_no as serial_no', 
                'equipment.property_no as property_no', 
                'categories.category as category_name', 
                'offices.office as office_name', 
                'employees.fullName as release_by', 
                'transactions.id as transaction_id')
        ->where(function ($query) {
            $query->where('transactions.status', 'Borrowed')
                ->orWhere('transactions.status', 'Late');
        });

        if(!empty($office_filter)){
            $query->where('offices.code', $office_filter);
        }
        if(!empty($category_filter)){
            $query->where('categories.category', $category_filter);
        }
        if(!empty($start_date_borrowed)&& !empty($end_date_borrowed)){
            $query->whereBetween('date_borrowed', [$start_date_borrowed, $endBorrowPlusOneDay]);
        }
        if(!empty($start_date_borrowed) && empty($end_date_borrowed)){
            $query->where('date_borrowed', '>=', $start_date_borrowed);
        }
        if(!empty($start_date_return)&& !empty($end_date_return)){
            $query->whereBetween('date_returned', [$start_date_return, $endReturnPlusOneDay]);
        }
        if(!empty($start_date_return) && empty($end_date_return)){
            $query->where('date_returned', '>=', $start_date_return);
        }

        $fileName = 'Borrowed_Equipments';

        if (!empty($office_filter)) {
            $fileName .= '_' . $office_filter;
        }
        if (!empty($category_filter)) {
            $fileName .= '_' . $category_filter;
        }
        if (!empty($start_date_borrowed) && !empty($end_date_borrowed)) {
            $fileName .= '_' . $start_date_borrowed . '_to_' . $end_date_borrowed;
        }
        if (!empty($start_date_borrowed) && empty($end_date_borrowed)) {
            $fileName .= '_' . $start_date_borrowed . '_to_present';
        }
        if (!empty($start_date_return) && !empty($end_date_return)) {
            $fileName .= '_' . $start_date_return . '_to_' . $end_date_return;
        }
        if (!empty($start_date_return) && empty($end_date_return)) {
            $fileName .= '_' . $start_date_return . '_to_present';
        }

        $fileName .= '.xlsx';


        $Borrowed = $query->get();

        if($Borrowed->isEmpty()){
            return Redirect::back()->withErrors('No transactions to download.');
        }

        return $this->excel->download(new BorrowedExport($Borrowed), $fileName);       
        

    }

}

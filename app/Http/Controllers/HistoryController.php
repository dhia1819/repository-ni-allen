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
        $offices = Office::all(); 

        $page = [
            'name'  =>  'History', 
            'title' =>  'History', 
            'crumb' =>  ['History' => '/borrow/history'] 
        ];
        
        $borrowedData = Transaction::leftJoin('equipment', 'transactions.equipment_id', '=', 'equipment.id')
            ->leftJoin('categories', 'equipment.category', '=', 'categories.id')
            ->leftJoin('offices', 'transactions.office', '=', 'offices.id')
            ->where('transactions.status', 'Return') 
            ->select('transactions.*', 'equipment.*', 'categories.category as category_name', 'offices.code as office_name', 'transactions.id as transaction_id','transactions.status as tstatus')
            ->orderBy('transactions.returned_date', 'ASC')
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

        
        $offices = Office::all();
        $employees = Employee::all();

        $transactions = Transaction::leftJoin('equipment', 'transactions.equipment_id', '=', 'equipment.id')
        ->leftJoin('offices', 'transactions.office', '=', 'offices.id')
        ->leftJoin('employees as release_employees', 'transactions.release_by', '=', 'release_employees.id')
        ->leftJoin('employees as received_employees', 'transactions.received_by', '=', 'received_employees.id')
        ->select('transactions.*', 
                    'equipment.equipment_name',
                    'equipment.property_no',
                    'equipment.serial_no', 
                    'offices.office as office_name', 
                    'release_employees.fullName as release_by', 
                    'received_employees.fullName as received_by')
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

         
         $endBorrowPlusOneDay = date('Y-m-d', strtotime($endBorrow . ' +1 day'));
         $endReturnPlusOneDay = date('Y-m-d', strtotime($endReturn . ' +1 day'));

        
        $query = Transaction::leftJoin('equipment', 'transactions.equipment_id', '=', 'equipment.id')
            ->leftJoin('offices', 'transactions.office', '=', 'offices.id')
            ->leftJoin('employees as release_employees', 'transactions.release_by', '=', 'release_employees.id')
            ->leftJoin('employees as received_employees', 'transactions.received_by', '=', 'received_employees.id')
            ->leftJoin('categories', 'equipment.category', '=', 'categories.id')
            ->select('transactions.*', 
                    'equipment.equipment_name as equipmentName', 'equipment.serial_no as serial_no', 'equipment.property_no as property_no',
                    'offices.office as office_name', 'release_employees.fullName as release_by', 
                    'received_employees.fullName as received_by',
                    'categories.category as category_name', )
            ->where('transactions.status', '=', 'Return')
            ->orderBy('transactions.returned_date', 'ASC');

            if (!empty($startBorrow) && !empty($endBorrow)) {
                $query->whereBetween('date_borrowed', [$startBorrow, $endBorrowPlusOneDay]);
            
            } 

            if (!empty($startBorrow) && empty($endBorrow)) {
                $query->where('date_borrowed', '>=', $startBorrow);
            }

            if (!empty($startReturn) && !empty($endReturn)) {
                $query->whereBetween('returned_date', [$startReturn, $endReturnPlusOneDay]);
            } 

            if (!empty($startReturn) && empty($endReturn)) {
                $query->whereBetween('returned_date', '>=', $$startReturn);
            } 

            if (!empty($category_filter)) {
                $query->where('categories.category', $category_filter);
            }
        
            if (!empty($office_filter)) {
                $query->where('offices.code', $office_filter);
            }
            
            $fileName = 'Borrowing_History';

            if (!empty($office_filter)) {
                $fileName .= '_' . $office_filter;
            }
            if (!empty($category_filter)) {
                $fileName .= '_' . $category_filter;
            }
            if (!empty($startBorrow) && !empty($endBorrow)) {
                $fileName .= '_' . $startBorrow . '_to_' . $endBorrow;
            }
            if (!empty($startBorrow) && empty($endBorrow)) {
                $fileName .= '_' . $startBorrow . '_to_present';
            }
            if (!empty($startReturn) && !empty($endReturn)) {
                $fileName .= '_' . $startReturn . '_to_' . $endReturn;
            }
            if (!empty($startReturn) && empty($endReturn)) {
                $fileName .= '_' . $startReturn . '_to_present';
            }
    
            $fileName .= '.xlsx';
           

        
        $missing = $query->get();


        
        if ($missing->isEmpty()) {
            
            return Redirect::back()->withErrors('No transactions to download.');
        }

        
        
        return $this->excel->download(new TransactionsExport($missing), $fileName);
    }


    public function updatefile(Request $request, string $id){

        $transaction = Transaction::findOrFail($id);
    
        $validatedData = $request->validate([
            'upload_file' => 'nullable|file|mimes:jpeg,png,pdf'
        ]);
    
        
        if ($request->hasFile('upload_file')) {
            $upload_file = $request->file('upload_file');
            
            
            $fileName = $upload_file->getClientOriginalName();
            
            
            $upload_file->move(public_path('uploads'), $fileName);
    
            
            $validatedData['upload_file'] = $fileName;
        }
    
        $transaction->update($validatedData);
        
        return redirect()->route('show.history', ['id' => $transaction->id])->with('success', 'File updated successfully.');
    }
    
}

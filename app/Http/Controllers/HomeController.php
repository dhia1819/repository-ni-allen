<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Equipment;
use App\Models\Office;
use App\Models\Transaction;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LateExport;;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{
    $page = [
        'name'  => 'Dashboard',
        'title' => 'Dashboard',
        'crumb' => ['Dashboard' => '/home']
    ];

    
    $users = User::count();
    $equipment = Equipment::count();
    $employee = Employee::count();
    $history = Transaction::where('status', 'Return')->count();
    
    
    $officeCounts = Transaction::select('offices.code AS office_code', DB::raw('COUNT(*) AS office_count'))
        ->join('offices', 'transactions.office', '=', 'offices.id')
        ->where('transactions.status', 'Return')
        ->groupBy('offices.code')
        ->get();

    
    $conditions = Equipment::select('conditions', DB::raw('COUNT(*) AS total'))
        ->groupBy('conditions')
        ->pluck('total', 'conditions')
        ->toArray();

    
    $statusAvailable = Equipment::where('status', 'available')->count();
    $statusBorrowed = Equipment::where('status', 'Borrowed')->count();
    $statusUnavailable = Equipment::where('status', 'unavailable')->count();

    
    $lateReturn = Transaction::where('status', 'Late')->count();

    
    $categories = Category::all();
    $offices = Office::all();

    
    return view('home', compact(
        'page', 
        'users', 
        'equipment', 
        'conditions',
        'employee',
        'officeCounts',
        'history',
        'statusAvailable',
        'statusBorrowed',
        'statusUnavailable',
        'lateReturn',
        'offices',
        'categories'
    ));
}

    public function late(){
        $page = [
            'name'      =>  'Late Transactions',
            'title'     =>  'Late Transactions',
            'crumb'     =>  ['Dashboard' => '/home', 'Late Transactions' => '/home/home-late']
        ];

        $categories = Category::all();
        $offices = Office::all();
        $employees = Employee::all();

        $lateTransaction = Transaction::leftJoin('equipment', 'transactions.equipment_id', '=', 'equipment.id')
    ->leftJoin('categories', 'equipment.category', '=', 'categories.id')
    ->leftJoin('offices', 'transactions.office', '=', 'offices.id')
    ->leftJoin('employees', 'transactions.release_by', '=', 'employees.id')
    ->where('transactions.status', 'Late')
    ->select('transactions.*', 'equipment.id as equipment_id','equipment.equipment_name as equipment_name', 'equipment.serial_no as serial_no', 'equipment.property_no as property_no', 'categories.category as category_name', 'offices.code as office_name', 'employees.fullName as release_by', 'transactions.id as transaction_id')
    ->orderBy('transactions.created_at', 'ASC')
    ->get();

        return view('equipment.late', compact('page', 'lateTransaction', 'categories', 'offices', 'employees' ));
    }

    
    public function downloadLate(Request $request)
{
    $startBorrow = $request->input('start_date_borrowed');
    $endBorrow = $request->input('end_date_borrowed');
    $startReturn = $request->input('start_date_return');
    $endReturn = $request->input('end_date_return');
    $category_filter = $request->input('category_filter');
    $office_filter = $request->input('office_filter');

    
    $endBorrowPlusOneDay = date('Y-m-d', strtotime($endBorrow . ' +1 day'));
    $endReturnPlusOneDay = date('Y-m-d', strtotime($endReturn . ' +1 day'));

    $query = Transaction::leftJoin('equipment', 'transactions.equipment_id', '=', 'equipment.id')
        ->leftJoin('categories', 'equipment.category', '=', 'categories.id')
        ->leftJoin('offices', 'transactions.office', '=', 'offices.id')
        ->leftJoin('employees', 'transactions.release_by', '=', 'employees.id')
        ->where('transactions.status', 'Late')
        ->select('transactions.*', 
                'equipment.id as equipment_id', 
                'equipment.equipment_name as equipment_name', 
                'equipment.serial_no as serial_no', 
                'equipment.property_no as property_no', 
                'categories.category as category_name', 
                'offices.office as office_name', 
                'employees.fullName as release_by', 
                'transactions.id as transaction_id')
        ->orderBy('transactions.created_at', 'ASC');

    if (!empty($startBorrow) && !empty($endBorrow)) {
        $query->whereBetween('date_borrowed', [$startBorrow, $endBorrowPlusOneDay]);
    }

    if (!empty($startReturn) && !empty($endReturn)) {
        $query->whereBetween('returned_date', [$startReturn, $endReturnPlusOneDay]);
    }

    if (!empty($category_filter)) {
        $query->where('categories.category', $category_filter);
    }

    if (!empty($office_filter)) {
        $query->where('offices.code', $office_filter);
    }

    
    $lateTransactions = $query->get();

    
    $fileName = 'Unreturned_Equipments';

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


        $lateTransaction = $query->get();

        if($lateTransaction->isEmpty()){
            return Redirect::back()->withErrors('No transactions to download.');
        }

        $fileName .= '.xlsx';

    
    return Excel::download(new LateExport($lateTransactions), $fileName);
}
}


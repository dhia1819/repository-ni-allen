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
            'name'      =>  'Dashboard',
            'title'     =>  'Dashboard',
            'crumb'     =>  array('Dashboard' => '/home')
        ];

        $users = User::count();
        $equipment = Equipment::count();
        $employee = Employee::count();
        $history =Transaction::where('status', 'Return')->count();
        $conditions = Equipment::select('conditions', DB::raw('count(*) as total'))
                           ->groupBy('conditions')
                           ->pluck('total', 'conditions')
                           ->toArray();

        $statusAvailable = Equipment::where('status', 'available')
                           ->count();

        $statusBorrowed = Equipment::where('status', 'Borrowed')
                           ->count();
        $statusUnavailable = Equipment::where('status', 'unavailable')
                           ->count();
        
        $lateReturn = Transaction::where('status', 'Late')
                    ->count();
        return view('home', compact(
            'page', 
            'users', 
            'equipment', 
            'conditions',
            'employee',
            'history',
            'statusAvailable',
            'statusBorrowed',
            'statusUnavailable',
            'lateReturn'
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

    
}



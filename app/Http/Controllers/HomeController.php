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
use Maatwebsite\Excel\Excel;
use App\Exports\LateExport;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $excel;

    // Modify the existing constructor to include Excel service injection
    public function __construct(Excel $excel)
    {
        $this->middleware('auth');
        $this->excel = $excel;
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

    $users = User::orderBy('name', 'ASC')
    ->where('id', '<>', Auth::user()->id)
    ->get();

    // Retrieve counts and data for various entities
    $equipment = Equipment::count();
    $employee = Employee::count();
    $history = Transaction::where('status', 'Return')->count();
    

    $officeCounts = Transaction::with(['office' => function ($query) {
        $query->select('id', 'code');
    }])
    ->select('office_id', DB::raw('COUNT(*) AS office_count'))
    ->where('status', 'Return')
    ->groupBy('office_id')
    ->get()
    ->map(function ($item) {
        return [
            'office_code' => $item->office ? $item->office->code : null,
            'office_count' => $item->office_count,
        ];
    });



    
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

public function late()
{
    $page = [
        'name'      => 'Late Transactions',
        'title'     => 'Late Transactions',
        'crumb'     => ['Dashboard' => '/home', 'Late Transactions' => '/home/home-late']
    ];

    // Fetch necessary related data with eager loading
    $lateTransactions = Transaction::with(['equipment.category', 'office', 'releaseBy'])
        ->where('status', 'Late')
        ->orderBy('created_at', 'ASC')
        ->get();

    // Extract other necessary data
    $categories = Category::all();
    $offices = Office::all();
    $employees = Employee::all();

    return view('equipment.late', compact('page', 'lateTransactions', 'categories', 'offices', 'employees'));
}



public function downloadLate(Request $request)
{
    $office_filter = $request->input('office_filter');
    $category_filter = $request->input('category_filter');
    $startBorrow = $request->input('start_date_borrowed');
    $endBorrow = $request->input('end_date_borrowed');
    $startReturn = $request->input('start_date_return');
    $endReturn = $request->input('end_date_return');

    $endBorrowPlusOneDay = date('Y-m-d', strtotime($endBorrow . ' +1 day'));
    $endReturnPlusOneDay = date('Y-m-d', strtotime($endReturn . ' +1 day'));

    $query = Transaction::with(['equipment.category', 'office', 'releaseBy'])
        ->where(function ($query) {
            $query->where('status', 'Late');
        });

    // Apply filters
    if (!empty($office_filter)) {
        $query->whereHas('office', function ($officeQuery) use ($office_filter) {
            $officeQuery->where('code', $office_filter);
        });
    }

    if (!empty($category_filter)) {
        $query->whereHas('equipment.category', function ($categoryQuery) use ($category_filter) {
            $categoryQuery->where('name', $category_filter);
        });
    }

    if (!empty($startBorrow) && !empty($endBorrow)) {
        $query->whereBetween('date_borrowed', [$startBorrow, $endBorrowPlusOneDay]);
    } elseif (!empty($startBorrow)) {
        $query->where('date_borrowed', '>=', $startBorrow);
    }

    if (!empty($startReturn) && !empty($endReturn)) {
        $query->whereBetween('date_returned', [$startReturn, $endReturnPlusOneDay]);
    } elseif (!empty($startReturn)) {
        $query->where('date_returned', '>=', $startReturn);
    }

    // Prepare file name
    $fileName = 'Missing_Equipments';

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

    $lateTransactions = $query->get();

    if ($lateTransactions->isEmpty()) {
        return redirect()->back()->withErrors('No transactions to download.');
    }

    return $this->excel->download(new LateExport($lateTransactions), $fileName);
}
}


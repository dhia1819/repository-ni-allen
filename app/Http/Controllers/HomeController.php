<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Equipment;
use App\Models\Office;
use App\Models\Transaction;
use App\Models\User;
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
        return view('home', compact(
            'page', 
            'users', 
            'equipment', 
            'conditions',
            'employee',
            'history',
            'statusAvailable',
            'statusBorrowed',
            'statusUnavailable'
        ));
    }

    
}



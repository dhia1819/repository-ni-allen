<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Equipment;
use App\Models\Office;
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
        $office = Office::count();
        $conditions = Equipment::select('conditions', DB::raw('count(*) as total'))
                           ->groupBy('conditions')
                           ->pluck('total', 'conditions')
                           ->toArray();
  
        return view('home', compact(
            'page', 
            'users', 
            'equipment', 
            'conditions',
            'employee',
            'office'
        ));
    }

    
}



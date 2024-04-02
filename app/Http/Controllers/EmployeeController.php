<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $page = [
            'name'  =>  'Employee',
            'title' =>  'Employee',
            'crumb' =>  array('Employee' => '/employee')
        ];
        
        $employees = Employee::orderBy('created_at', 'DESC')->get();

        
        return view('employee.index', compact('page', 'employees')); 
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException; 

class EmployeeController extends Controller
{
    public function index()
    {
        $page = [
            'name'  =>  'Employee',
            'title' =>  'Employee',
            'crumb' =>  array('Employee' => '/employee')
        ];
        
        $employees = Employee::orderBy('fullName', 'ASC')->get();

        
        return view('employee.index', compact('page', 'employees')); 
    }

    public function store(Request $request)
{
    // Validation rules
    $rules = [
        'fullName'           => 'required',
        'position'       => 'required',
    ];

    // Validate the request
    $validator = Validator::make($request->all(), $rules);

    // Check if validation fails
    if ($validator->fails()) {
        return Redirect::back()->withErrors($validator)->withInput();
    }

    // Start database transaction
    DB::beginTransaction();

    try {
        // Create a new User instance
        $employee = new Employee;
        $employee->fullName = $request->fullName;
        $employee->position = $request->position;
        $employee->status = 1;
        $employee->created_at = Carbon::now('Asia/Manila');
        $employee->save();

        // Commit the transaction
        DB::commit(); 

        return Redirect::back()->with('success', 'Employee added successfully!');
    }catch (QueryException $e) {
        // Check if the exception is due to a duplicate entry
        if ($e->errorInfo[1] == 1062) {
            return Redirect::back()->withErrors('')->withInput();
        } else {
            // Rollback the transaction for other exceptions
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage())->withInput();
        }
    }}


    public function edit($id)
    {
        // Find the user with the specified ID or throw a ModelNotFoundException
        $employee = Employee::findOrFail($id);
    
        // Return the user data as JSON response
        return response()->json($employee);
    }


    public function update(Request $request, string $id)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'fullName' => 'required|string',
            'position' => 'required|string',
            'status' => 'required|string',
        ]);
        
        // Find the existing Office model by its ID
        $employee = Employee::where('id', $id)->firstOrFail();
        
        // Update the attributes of the Office model with the validated data
        $employee->fill($validatedData);
        
        // Save the changes to the database
        $employee->save();
        
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Employee updated successfully!');
    }

}

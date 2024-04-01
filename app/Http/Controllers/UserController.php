<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException; // Add this import

use Carbon\Carbon;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = [
            'name'  =>  'Users',
            'title' =>  'Users',
            'crumb' =>  array('Users' => '/users')
        ];

        $users = User::orderBy('name', 'ASC')
            ->where('id', '<>', Auth::user()->id)
            ->get();

        return view('users.index', compact(
            'page','users'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validation rules
    $rules = [
        'name'           => 'required',
        'username'       => 'required|unique:tbl_users', // Ensure username is unique
        'classification' => 'required'
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
        $user = new User;
        $user->name = $request->name;
        $user->username = strtolower($request->username);
        $user->password = bcrypt('12345678'); // Default password
        $user->classification_id = $request->classification;
        $user->status = 1; // Assuming status is active by default
        $user->created_at = Carbon::now('Asia/Manila');
        $user->save();

        // Commit the transaction
        DB::commit(); 

        return Redirect::back()->with('success', 'User added successfully!');
    } catch (QueryException $e) {
        // Check if the exception is due to a duplicate entry
        if ($e->errorInfo[1] == 1062) {
            return Redirect::back()->withErrors('Username already exists. Please choose a different username.')->withInput();
        } else {
            // Rollback the transaction for other exceptions
            DB::rollBack();
            return Redirect::back()->withErrors($e->getMessage())->withInput();
        }
    }
}
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Find the user with the specified ID or throw a ModelNotFoundException
        $user = User::findOrFail($id);
    
        // Return the user data as JSON response
        return response()->json($user);
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'rowid'          => 'required|exists:tbl_users,id',
            'name'           => 'required',
            'username'       => 'required',
            'classification' => 'required',
            'status'        => 'required'
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }
    
        try {
            // Find the user by rowid
            $user = User::findOrFail($request->rowid);
    
            // Update the user instance with new data
            $user->name = $request->name;
            $user->username = strtolower($request->username);
            $user->classification_id = $request->classification;
            $user->status=$request->status;
            $user->updated_at = Carbon::now('Asia/Manila');
            $user->save();
    
            return Redirect::back()->with('success', 'User updated successfully!');
        } catch (\Exception $exception) {
            return Redirect::back()->withErrors('An error occurred while updating the user.')->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}

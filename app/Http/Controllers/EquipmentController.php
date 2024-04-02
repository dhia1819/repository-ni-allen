<?php

namespace App\Http\Controllers;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Office;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        $page = [
            'name'  =>  'Equipment',
            'title' =>  'Equipment',
            'crumb' =>  array('Equipment' => '/equipment')
        ];
        
        $equipment = Equipment::leftJoin('categories', 'equipment.category', '=', 'categories.id')
            ->orderBy('equipment.created_at', 'ASC')
            ->select('equipment.*', 'categories.category as category_name')
            ->get();
        
        return view('equipment.index', compact('page', 'equipment','categories'));
        
    }

    public function borrow(int $id)
    {
        $office = Office::all();
        $equipment = Equipment::findOrFail($id);
        
        $page = [
            'name'  =>  'Borrow',
            'title' =>  'Borrow Equipment',
            'crumb' =>  ['Borrow Equipment' => '/borrow']
        ];
    
        return view('equipment.borrow', compact('page', 'equipment','office'));
    }
public function save(Request $request){
    $validatedData = $request->validate([
        'equipment_id' => 'required|string',
        'release_by' => 'required|string',
        'borrowed_by' => 'required|string', // Marked as required
        'date_borrowed' => 'required|date',
        'date_returned' => 'nullable|date',
        'office' => 'required|string',
        'upload_file' => 'nullable|file|mimes:jpeg,png,pdf', // Keep as nullable since it's not always required
        'returned_by' => 'nullable|string',
        'received_by' => 'nullable|string',
    ]);

    // If upload_file is provided, process it
    if ($request->hasFile('upload_file')) {
        $image = $request->file('upload_file');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $imageName);

        $validatedData['upload_file'] = $imageName;
    }

    // Set status to Borrowed
    $validatedData['status'] = 'Borrowed';

    // Create a new instance of your model with validated data
    $transaction = Transaction::create($validatedData);

    // Update equipment status to Borrowed
    $equipment = Equipment::find($validatedData['equipment_id']);
    if ($equipment) {
        $equipment->status = 'Borrowed';
        $equipment->save();
    }
    return redirect()->route('equipment')->with('success', 'Equipment Borrowed successfully.');

    
}
public function return()
{
    $categories = Category::all();
    $offices = Office::all(); // Assuming you have an Office model

    $page = [
        'name'  =>  'Borrowed', // Change the name to "Borrowed"
        'title' =>  'Borrowed', // Change the title to "Borrowed"
        'crumb' =>  ['Borrowed' => '/borrow/borrowed'] // Change the crumb to "Borrowed"
    ];
    
    $borrowedData = Transaction::leftJoin('equipment', 'transactions.equipment_id', '=', 'equipment.id')
        ->leftJoin('categories', 'equipment.category', '=', 'categories.id')
        ->leftJoin('offices', 'transactions.office', '=', 'offices.id')
        ->where('transactions.status', 'Borrowed') // Filter out borrowed transactions
        ->select('transactions.*', 'equipment.*', 'categories.category as category_name', 'offices.office as office_name', 'transactions.id as transaction_id')
        ->orderBy('transactions.created_at', 'ASC')
        ->get();

    return view('equipment.return', compact('page', 'borrowedData', 'categories', 'offices'));       
}
public function history()
{
    $categories = Category::all();
    $offices = Office::all(); // Assuming you have an Office model

    $page = [
        'name'  =>  'History', // Change the name to "Borrowed"
        'title' =>  'History', // Change the title to "Borrowed"
        'crumb' =>  ['Borrowed' => '/history'] // Change the crumb to "Borrowed"
    ];
    
    $borrowedData = Transaction::leftJoin('equipment', 'transactions.equipment_id', '=', 'equipment.id')
        ->leftJoin('categories', 'equipment.category', '=', 'categories.id')
        ->leftJoin('offices', 'transactions.office', '=', 'offices.id')
        ->where('transactions.status', 'Return') // Filter out borrowed transactions
        ->select('transactions.*', 'equipment.*', 'categories.category as category_name', 'offices.office as office_name', 'transactions.id as transaction_id','transactions.status as tstatus')
        ->orderBy('transactions.created_at', 'ASC')
        ->get();

    return view('equipment.history', compact('page', 'borrowedData', 'categories', 'offices'));       
}

public function showhistory(string $id) {
    $page = [
        'name'  =>  'Return',
        'title' =>  'Return Equipment',
        'crumb' =>  ['Return Equipment' => '/borrow/return']
    ];

    // Assuming you have an 'Offices' model
    $offices = Office::all();

    $transactions = Transaction::leftJoin('equipment', 'transactions.equipment_id', '=', 'equipment.id')
        ->leftJoin('offices', 'transactions.office', '=', 'offices.id')
        ->select('transactions.*', 'equipment.*', 'offices.office as office_name')
        ->where('transactions.id', $id)
        ->where('transactions.status', '=', 'Return')
        ->get();

    return view('equipment.showhistory', compact('transactions', 'page', 'offices'));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch all categories with status 'Active'
        $categories = Category::where('status', '1')->get();
    
        // Data for the page
        $page = [
            'name'  =>  'Equipment',
            'title' =>  'Add Equipment',
            'crumb' =>  ['Add Equipment' => '/equipment']
        ];
    
        // Return the view with the necessary data
        return view('equipment.create', compact('page', 'categories'));
    }
    
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Validate incoming request data
    $validatedData = $request->validate([
        'equipment_name' => 'required|string',
        'category' => 'required|string',
        'Description' => 'required|string',
        'property_no' => 'required|string',
        'serial_no' => 'required|string',
        'unit_of_measure' => 'required|string',
        'value' => 'required|string',
        'quantity' => 'required|integer',
        'image' => 'nullable|image',
        'remarks' => 'required|string',
        'date_acquired' => 'nullable|date',
        'conditions' => 'required|string'
    ]);

    // Set admin_id to the authenticated user's ID
    $validatedData['admin_id'] = Auth::id();

    //status
    $validatedData['status'] = 'available';

    // Handle image upload
    if($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('uploads'), $imageName);

        // Set image name to the validated data
        $validatedData['image'] = $imageName;
    }

    // Create new equipment record
    Equipment::create($validatedData);

    // Redirect back with success message
    return redirect()->back()->with('success', 'Equipment added successfully.');
}

public function condition(Request $request, $id)
{
    // Validate the request data
    $request->validate([
        'condition' => 'required|in:Good,Fair,Poor', // Validate the condition field
    ]);

    // Find the equipment by its ID
    $equipment = Equipment::findOrFail($id);

    // Update the condition of the equipment
    $equipment->update([
        'condition' => $request->condition,
    ]);

    // Redirect back or return a response indicating success
    return redirect()->back()->with('success', 'Equipment condition updated successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categories = Category::all();
        
        // Fetch the specific equipment item by ID
        $equipment = Equipment::leftJoin('categories', 'equipment.category', '=', 'categories.id')
            ->where('equipment.id', $id) // Filter by equipment ID
            ->select('equipment.*', 'categories.category as category_name')
            ->firstOrFail(); // Use firstOrFail() to fetch a single record
        
        $page = [
            'name'  =>  'Equipment',
            'title' =>  'Show Equipment',
            'crumb' =>  array('Show Equipment' => '/equipment')
        ];
        
        return view('equipment.show', compact('equipment', 'page', 'categories'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();

        
        $equipment = Equipment::findOrFail($id); // Fetch the equipment data
        
        $page = [
            'name'  =>  'Equipment',
            'title' =>  'Edit Equipment',
            'crumb' =>  array('Edit Equipment' => '/equipment')
        ];
    
        return view('equipment.edit', compact('equipment', 'page', 'categories'));
    }
    public function showreturn(string $id) {
        $page = [
            'name'  =>  'Return',
            'title' =>  'Return Equipment',
            'crumb' =>  ['Return Equipment' => '/borrow/return']
        ];
    
        // Assuming you have an 'Offices' model
        $offices = Office::all();
    
        $transactions = Transaction::leftJoin('equipment', 'transactions.equipment_id', '=', 'equipment.id')
            ->leftJoin('offices', 'transactions.office', '=', 'offices.id')
            ->select('transactions.*', 'equipment.*', 'offices.office as office_name', 'transactions.id as transaction_id')
            ->where('equipment.id', $id)
            ->where('transactions.status', '=', 'Borrowed')
            ->get();
    
        return view('equipment.showreturn', compact('transactions', 'page', 'offices'));
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
        return redirect()->route('return')->with('success', 'Equipment returned successfully.');
    }
    
    
    


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Find the equipment record by ID
        $equipment = Equipment::findOrFail($id);
    
        // Validate incoming request data
        $validatedData = $request->validate([
            'equipment_name' => 'required|string',
            'category' => 'required|string',
            'Description' => 'required|string',
            'property_no' => 'required|string',
            'serial_no' => 'required|string',
            'unit_of_measure' => 'required|string',
            'value' => 'required|string',
            'quantity' => 'required|integer',
            'image' => 'nullable|image',
            'remarks' => 'required|string',
            'date_acquired' => 'nullable|date',
            'conditions' => 'required|string',
        ]);
    
        // Set admin_id to the authenticated user's ID
        $validatedData['admin_id'] = Auth::id();
    
        // Set status
        if ($equipment->status === 'available') {
            $validatedData['status'] = 'available';
        } elseif ($equipment->status === 'Borrowed') {
            $validatedData['status'] = 'Borrowed';
        }
        
        
        

    
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('uploads'), $imageName);
    
            // Set image name to the validated data
            $validatedData['image'] = $imageName;
        }
    
        // Update the equipment record with the validated data
        $equipment->update($validatedData);
    
        // Redirect back with success message
        return redirect()->back()->with('success', 'Equipment updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

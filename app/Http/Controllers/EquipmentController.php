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
    //Reading Of Equipment
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

    //Borrow Button Action Dsiplay
    public function borrow(int $id)
{
    $office = Office::all();
    $equipment = Equipment::findOrFail($id);
    
    $page = [
        'name'  =>  'Borrow',
        'title' =>  'Borrow Equipment',
        'crumb' =>  ['Equipment' => '/equipment', 'Borrow Equipment' => "/equipment/borrow/{$id}"]
    ];

    return view('equipment.borrow', compact('page', 'equipment', 'office'));
}

//Create function of borrowing transaction
public function save(Request $request){
    $validatedData = $request->validate([
        'equipment_id' => 'required|string',
        'release_by' => 'required|string',
        'borrowed_by' => 'required|string', 
        'date_borrowed' => 'required|date',
        'date_returned' => 'nullable|date',
        'office' => 'required|string',
        'upload_file' => 'nullable|file|mimes:jpeg,png,pdf', //Can be nullable or not depends on process
        'returned_by' => 'nullable|string',
        'received_by' => 'nullable|string',
    ]);

    //Upload file part
    if ($request->hasFile('upload_file')) {
        $image = $request->file('upload_file');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $imageName);

        $validatedData['upload_file'] = $imageName;
    }

    
    $validatedData['status'] = 'Borrowed';

    
    $transaction = Transaction::create($validatedData);

    
    $equipment = Equipment::find($validatedData['equipment_id']);
    if ($equipment) {
        $equipment->status = 'Borrowed';
        $equipment->save();
    }
    return redirect()->route('equipment')->with('success', 'Equipment Borrowed successfully.');

    
}



    //Display Add Item page
    public function create()
{
    // Fetch all categories with status 'Active'
    $categories = Category::where('status', '1')->get();

    // Data for the page
    $page = [
        'name'  =>  'Equipment',
        'title' =>  'Add Equipment',
        'crumb' =>  ['Equipment' => '/equipment', 'Add Equipment' => '/equipment/create']
    ];

    
    return view('equipment.create', compact('page', 'categories'));
}
    
    
    //Creating or Adding of new equipment for the inventory
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

    
    //Display and reading of full equipment details on a new view
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
        'title' =>  'Equipment Details',
        'crumb' =>  ['Equipment' => '/equipment', 'Details' => "/show/{$id}"]
    ];
    
    return view('equipment.show', compact('equipment', 'page', 'categories'));
}

    

    //Display Page for the editing function of equipment
    public function edit(string $id)
    {
        $categories = Category::all();

        
        $equipment = Equipment::findOrFail($id); // Fetch the equipment data
        
        $page = [
            'name'  =>  'Equipment',
            'title' =>  'Edit Equipment',
            'crumb' =>  ['Equipment' => '/equipment', 'Details' => "/show/{$id}", 'Edit Equipment' => "/edit/{$id}"]
        ];
    
        return view('equipment.edit', compact('equipment', 'page', 'categories'));
    }


    //Actual Update function after making the changes 
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

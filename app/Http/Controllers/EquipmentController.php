<?php

namespace App\Http\Controllers;
use App\Models\Equipment;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Office;
use App\Models\Employee;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Exports\EquipmentsExport;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;

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
    $employees = Employee::all();
    $equipment = Equipment::findOrFail($id);
    
    $page = [
        'name'  =>  'Borrow',
        'title' =>  'Borrow Equipment',
        'crumb' =>  ['Equipment' => '/equipment', 'Borrow Equipment' => "/equipment/borrow/{$id}"]
    ];

    return view('equipment.borrow', compact('page', 'equipment', 'office', 'employees'));
}

public function save(Request $request)
{
    // Set timezone to Asia/Manila
    date_default_timezone_set('Asia/Manila');

    $validatedData = $request->validate([
        'equipment_id' => 'required|string',
        'release_by' => 'required|string',
        'borrowed_by' => 'required|string', 
        'date_borrowed' => 'required|date',
        'date_returned' => 'nullable|date', // Validate datetime format (date and time)
        'office' => 'required|string',
        'upload_file' => 'nullable|file|mimes:jpeg,png,pdf', //Can be nullable or not depends on process
        'returned_by' => 'nullable|string',
        'received_by' => 'nullable|string',
    ]);

    // Upload file part
    if ($request->hasFile('upload_file')) {
        $image = $request->file('upload_file');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('uploads'), $imageName);

        $validatedData['upload_file'] = $imageName;
    }

    // Check if the return date and time has passed
    if (!empty($validatedData['date_returned'])) {
        $returnDateTime = Carbon::parse($validatedData['date_returned'])->timezone('Asia/Manila');
        $currentDateTime = Carbon::now()->timezone('Asia/Manila');

        // Compare date and time (including seconds) for precise comparison
        if ($currentDateTime->greaterThanOrEqualTo($returnDateTime)) {
            $status = 'Late';
        } else {
            $status = 'Borrowed';
        }
    } else {
        // If no return date is specified, default to 'Borrowed'
        $status = 'Borrowed';
    }
    
    // Set the status based on whether the return date and time has passed
    $validatedData['status'] = $status;

    // Create the transaction
    $transaction = Transaction::create($validatedData);

    // Update equipment status to 'Borrowed' if applicable
    $equipment = Equipment::find($validatedData['equipment_id']);
    if ($equipment) {
        $equipment->status = 'Borrowed';
        $equipment->save();
    }

    return redirect('/borrow/return')->with('success', 'Equipment Borrowed successfully.');
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
        'serial_no' => 'required|string|unique:equipment,serial_no',
        'unit_of_measure' => 'required|string',
        'value' => 'required|string',
        'quantity' => 'required|integer',
        'image' => 'nullable|image',
        'remarks' => 'required|string',
        'date_acquired' => 'required|date',
        'conditions' => 'required|string'
    ]);

    // Set admin_id to the authenticated user's ID
    $validatedData['admin_id'] = Auth::id();

    //status
    if ($validatedData['conditions'] === 'Good' || $validatedData['conditions'] === 'Fair' || $validatedData['conditions'] === 'Poor') {
        $validatedData['status'] = 'available';
    }
    else{
        $validatedData['status'] = 'unavailable';
    }
    
    

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
    return redirect('equipment')->with('success', 'Equipment updated successfully.');
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
            'serial_no' => 'required|string|unique:equipment,serial_no',
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
        if ($equipment->status === 'available' || $equipment->status === 'unavailable') {
            if ($validatedData['conditions'] === 'Good' || $validatedData['conditions'] === 'Fair' || $validatedData['conditions'] === 'Poor') {
                $validatedData['status'] = 'available';
            }
            else{
                $validatedData['status'] = 'unavailable';
            }
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

// Redirect to the show route for the updated equipment
return redirect()->route('equipment.show', ['id' => $equipment->id])->with('success', 'Equipment updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    protected $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }
    public function downloadEquipment(Request $request)
    {
        $category_filter = $request->input('category_filter');
        $condition_filter = $request->input('condition_filter');
        $status_filter = $request->input('status_filter');

        // Get equipments data from the database
        $query = Equipment::leftJoin('categories', 'equipment.category', '=', 'categories.id')
                        ->select('equipment.*', 'categories.category as category');

        if (!empty($category_filter) && !empty($condition_filter) && !empty($status_filter)) {
            // Code for when all filters are not empty
            $query->where('categories.category', '=', $category_filter)
                    ->where('conditions', '=', $condition_filter)
                    ->where('equipment.status', '=', $status_filter);
            $fileName = 'Equipments_'.$category_filter.'_'.$condition_filter.'_'.$status_filter.'.xlsx';
        } elseif (!empty($category_filter) && !empty($condition_filter) && empty($status_filter)) {
            // Code for when category and condition filters are not empty, but status filter is empty
            $query->where('categories.category', '=', $category_filter)
                    ->where('conditions', '=', $condition_filter);
                    $fileName = 'Equipments_'.$category_filter.'_'.$condition_filter.'.xlsx';
        } elseif (!empty($category_filter) && empty($condition_filter) && !empty($status_filter)) {
            // Code for when category and status filters are not empty, but condition filter is empty
            $query->where('categories.category', '=', $category_filter)
                    ->where('equipment.status', '=', $status_filter);
                    $fileName = 'Equipments_'.$category_filter.'_'.$status_filter.'.xlsx';
        } elseif (empty($category_filter) && !empty($condition_filter) && !empty($status_filter)) {
            // Code for when condition and status filters are not empty, but category filter is empty
            $query->where('conditions', '=', $condition_filter)
                    ->where('equipment.status', '=', $status_filter);
                    $fileName = 'Equipments_'.$condition_filter.'_'.$status_filter.'.xlsx';
        } elseif (!empty($category_filter) && empty($condition_filter) && empty($status_filter)) {
            // Code for when only category filter is not empty
            $query->where('categories.category', '=', $category_filter);
            $fileName = 'Equipments_'.$category_filter.'.xlsx';
        } elseif (empty($category_filter) && !empty($condition_filter) && empty($status_filter)) {
            // Code for when only condition filter is not empty
            $query->where('conditions', '=', $condition_filter);
            $fileName = 'Equipments_'.$condition_filter.'.xlsx';
        } elseif (empty($category_filter) && empty($condition_filter) && !empty($status_filter)) {
            // Code for when only status filter is not empty
            $query->where('equipment.status', '=', $status_filter);
            $fileName = 'Equipments_'.$status_filter.'.xlsx';
        } else {
            // Code for when all filters are empty
            $fileName = 'MISO_Equipments.xlsx';
        }

        $equipments = $query->get();

        if ($equipments->isEmpty()) {
            return Redirect::back()->withErrors('No equipments found with the specified filters.');
        }
        
        // Use the Excel facade to download the Excel file
        return $this->excel->download(new EquipmentsExport($equipments), $fileName);
    }

}

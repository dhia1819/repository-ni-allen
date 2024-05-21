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
use App\Models\Equipment_Archive;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\QueryException;

class EquipmentController extends Controller
{

    public function index()
{
    $categories = Category::all();

    $page = [
        'name'  => 'Equipment',
        'title' => 'Equipment',
        'crumb' => ['Equipment' => '/equipment']
    ];

    $equipment = Equipment::with('category')
        ->orderBy('equipment_name', 'ASC')
        ->whereIn('status', ['available', 'unavailable', 'Borrowed'])
        ->get();

    return view('equipment.index', compact('page', 'equipment', 'categories'));
}


    
    public function borrow(int $id)
    {
        $offices = Office::all();
        $employees = Employee::all();
        $equipment = Equipment::findOrFail($id);
        
        $page = [
            'name'  =>  'Borrow',
            'title' =>  'Borrow Equipment',
            'crumb' =>  ['Equipment' => '/equipment', 'Borrow Equipment' => "/equipment/borrow/{$id}"]
        ];

        return view('equipment.borrow', compact('page', 'equipment', 'offices', 'employees'));
    }

    //to submit the borrow form
    public function save(Request $request)
    {
        // Set timezone to Asia/Manila
        date_default_timezone_set('Asia/Manila');

        $validatedData = $request->validate([
            'equipment_id' => 'required|string',
            'release_by' => 'required|string',
            'borrowed_by' => 'required|string', 
            'date_borrowed' => 'required|date',
            'date_returned' => 'nullable|date',
            'office_id' => 'required|string',
            'upload_file' => 'nullable|file|mimes:jpeg,png,pdf', 
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

    
    public function create()
    {
       
        $categories = Category::where('status', '1')->get();

       
        $page = [
            'name'  =>  'Equipment',
            'title' =>  'Add Equipment',
            'crumb' =>  ['Equipment' => '/equipment', 'Add Equipment' => '/equipment/create']
        ];

        
        return view('equipment.create', compact('page', 'categories'));
    }
    
    
    
    public function store(Request $request)
{
    
    $validatedData = $request->validate([
        'equipment_name' => 'required|string',
        'category_id' => 'required|string',
        'Description' => 'required|string',
        'property_no' => 'required|string',
        'serial_no' => 'required|string|unique:tbl_equipment,serial_no',
        'unit_of_measure' => 'required|string',
        'value' => 'required|numeric|min:0.01', 
        'quantity' => 'required|integer',
        'image' => 'nullable|image',
        'remarks' => 'required|string',
        'date_acquired' => 'required|date',
        'conditions' => 'required|string'
    ]);

    
    $validatedData['admin_id'] = Auth::id();

    
    if ($validatedData['conditions'] === 'Good' || $validatedData['conditions'] === 'Fair' || $validatedData['conditions'] === 'Poor') {
        $validatedData['status'] = 'available';
    } else {
        $validatedData['status'] = 'unavailable';
    }

    
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->extension();
        $image->move(public_path('uploads'), $imageName);

        
        $validatedData['image'] = $imageName;
    }

    
    Equipment::create($validatedData);

    
    return redirect('equipment')->with('success', 'Equipment created successfully.');
}

    
    public function condition(Request $request, $id)
    {
        
        $request->validate([
            'condition' => 'required|in:Good,Fair,Poor', 
        ]);

        
        $equipment = Equipment::findOrFail($id);

        
        $equipment->update([
            'condition' => $request->condition,
        ]);

        
        return redirect()->back()->with('success', 'Equipment condition updated successfully.');
    }

    
    
    public function show(string $id)
    {
        $categories = Category::all();
        $equipment = Equipment::find($id);
        
        $page = [
            'name'  =>  'Equipment',
            'title' =>  'Equipment Details',
            'crumb' =>  ['Equipment' => '/equipment', 'Details' => "/show/{$id}"]
        ];
        
        return view('equipment.show', compact('equipment', 'page', 'categories'));
    }

    

    
    public function edit(string $id)
    {
        $categories = Category::all();

        
        $equipment = Equipment::findOrFail($id); 
        
        $page = [
            'name'  =>  'Equipment',
            'title' =>  'Edit Equipment',
            'crumb' =>  ['Equipment' => '/equipment', 'Details' => "/show/{$id}", 'Edit Equipment' => "/edit/{$id}"]
        ];
    
        return view('equipment.edit', compact('equipment', 'page', 'categories'));
    }


     
    public function update(Request $request, string $id)
    {
        
        $equipment = Equipment::findOrFail($id);
    
        
        $validatedData = $request->validate([
            'equipment_name' => 'required|string',
            'category_id' => 'required|string',
            'Description' => 'required|string',
            'property_no' => 'required|string',
            'serial_no' => 'required|string|unique:tbl_equipment,serial_no,'.$equipment->id,
            'unit_of_measure' => 'required|string',
            'value' => 'required|string',
            'quantity' => 'required|integer',
            'image' => 'nullable|image',
            'remarks' => 'required|string',
            'date_acquired' => 'nullable|date',
            'conditions' => 'required|string',
        ]);
        
    
        
        $validatedData['admin_id'] = Auth::id();
    
        
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
    
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('uploads'), $imageName);
    
            
            $validatedData['image'] = $imageName;
        }
    
        
        $equipment->update($validatedData);

        
        return redirect()->route('equipment.show', ['id' => $equipment->id])->with('success', 'Equipment updated successfully.');
    }
    
    
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

    // Start building the query with the Equipment model
    $query = Equipment::with('category')
        ->where('status', '!=', 'Archived');

    if (!empty($category_filter)) {
        $query->whereHas('category', function($q) use ($category_filter) {
            $q->where('name', '=', $category_filter);
        });
    }

    if (!empty($condition_filter)) {
        $query->where('conditions', '=', $condition_filter);
    }

    if (!empty($status_filter)) {
        $query->where('status', '=', $status_filter);
    }

    // Generate the filename based on the filters
    $fileName = 'MISO_Equipments.xlsx';
    if (!empty($category_filter)) {
        $fileName = 'Equipments_'.$category_filter.'.xlsx';
    }
    if (!empty($condition_filter)) {
        $fileName = str_replace('.xlsx', '_'.$condition_filter.'.xlsx', $fileName);
    }
    if (!empty($status_filter)) {
        $fileName = str_replace('.xlsx', '_'.$status_filter.'.xlsx', $fileName);
    }

    // Execute the query and get the results
    $equipments = $query->get();

    if ($equipments->isEmpty()) {
        return Redirect::back()->withErrors('No equipments found with the specified filters.');
    }

    // Use the Excel facade to download the Excel file
    return $this->excel->download(new EquipmentsExport($equipments), $fileName);
}


    public function archive($id)
{
    // Find the equipment record by ID
    $equipment = Equipment::findOrFail($id);

    $equipment->status = 'archived';
    $equipment->conditions = 'Condemned';
    $equipment->save();

    return redirect('/equipment-archive')->with('success', 'Equipment archived successfully.');
}

}

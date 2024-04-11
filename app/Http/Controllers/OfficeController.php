<?php

namespace App\Http\Controllers;
use App\Models\Office;

use Illuminate\Http\Request;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = [
            'name'  =>  'Office',
            'title' =>  'Office',
            'crumb' =>  array('Office' => '/office')
        ];
        
        $office = Office::orderBy('created_at', 'DESC')->get();

        
        return view('office.index', compact('page', 'office')); 
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
        // Validate incoming request data
        $validatedData = $request->validate([
            'code' => 'required|string',
            'office' => 'required|string',
            'type' => 'required|string',
        ]);

        $existingOffice = Office::where('office', $validatedData['office'])->first();
        $existingCode = Office::where('code', $validatedData['code'])->first();
    
        if ($existingOffice) {
            return redirect()->back()->withErrors(['This Office already exists']);  
        }
        if ($existingCode) {
            return redirect()->back()->withErrors(['This Code already exists']);  
        }
    
        // Create a new instance of your model
        $newItem = new Office();
    
        // Fill the model with the validated data
        $newItem->fill($validatedData);
    
        // Save the new item to the database
        $newItem->save();
    
        // Optionally, you can return a response indicating success
        return redirect()->back()->with('success', 'Office added successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'code' => 'required|string',
            'office' => 'required|string',
            'type' => 'required|string',
        ]);
        
        // Find the existing Office model by its ID
        $office = Office::where('id', $id)->firstOrFail();
        
        // Update the attributes of the Office model with the validated data
        $office->fill($validatedData);
        
        // Save the changes to the database
        $office->save();
        
        // Redirect back with a success message
        return redirect()->back()->with('success', 'Office updated successfully!');
    }
    
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

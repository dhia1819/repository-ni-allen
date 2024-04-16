<?php

namespace App\Http\Controllers;

use App\Models\Supplies;
use Illuminate\Http\Request;

class SuppliesController extends Controller
{
    public function index()
    {
        $supplies = Supplies::all();
        
        $page = [
            'name'  =>  'Supplies',
            'title' =>  'Supplies',
            'crumb' =>  array('Supplies' => '/supplies')
        ];
        
        return view('supplies.index', compact('page', 'supplies'));
        
    }

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
            'status' => 'required|string|max:255' // Assuming 'status' is a string in the form ('Active' or 'Inactive')
        ]);
    
        return redirect()->back()->with('success', 'Category added successfully!');
    }
}

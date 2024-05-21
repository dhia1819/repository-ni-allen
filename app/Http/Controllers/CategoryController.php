<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\Equipment; // Add this line to import the Equipment model


use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    $page = [
        'name'  => 'Category',
        'title' => 'Category',
        'crumb' => ['Category' => '/category']
    ];

    // Ordering by 'id' instead of 'created_at'
    $category = Category::orderBy('name', 'ASC')->get();

    return view('category.index', compact('page', 'category'));
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
        $validatedData = $request->validate([
            'category' => 'required|string|max:255',
            'status' => 'required|string|max:255' 
        ]);
    
        $existingCategory = Category::where('category', $validatedData['category'])->first();
    
        if ($existingCategory) {
            return redirect()->back()->withErrors(['This category already exists']);
        }
    
        $tblCategory = new Category();
        $tblCategory->category = $validatedData['category'];
        $tblCategory->status = $validatedData['status'] === '1' ? true : false;
        $tblCategory->save();
    
        return redirect()->back()->with('success', 'Category added successfully!');
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
    public function edit($id)
{
    $category = Category::findOrFail($id); 

    
    
    return response()->json([
        'id' => $category->id,
        'category' => $category->name,
        'status' => $category->status,
    ]);
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    $validatedData = $request->validate([
        'rowid'    => 'required|exists:tbl_category,id',
        'category' => 'required|string|max:255',
        'status'   => 'required|string|max:255' 
    ]);

    // Check if there are any borrowed items in the category
    $hasBorrowedItems = Equipment::where('category_id', $validatedData['rowid'])
                                  ->where('status', 'Borrowed')
                                  ->exists();

    // If there are borrowed items and the new status is 'Inactive', show a message
    if ($hasBorrowedItems && $validatedData['status'] === '0') {
        return redirect()->back()->withErrors(['Cannot set category status to Inactive. There are borrowed items in this category.']);
    }

    
    $tblCategory = Category::findOrFail($validatedData['rowid']);
    $tblCategory->name = $validatedData['category'];
    $tblCategory->status = $validatedData['status'] === 'Active'; 
    $tblCategory->save();

    // Update the conditions in the equipment table based on the category status
    $conditions = $validatedData['status'] === 'Active' ? 'Available' : 'Archived';
    Equipment::where('category_id', $tblCategory->id)
             ->update(['status' => $conditions]);

    return redirect()->back()->with('success', 'Category updated successfully!');
}

    

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

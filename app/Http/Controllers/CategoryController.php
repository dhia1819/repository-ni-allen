<?php

namespace App\Http\Controllers;
use App\Models\Category;


use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = [
            'name'  =>  'Category',
            'title' =>  'Category',
            'crumb' =>  array('Category' => '/category')
        ];
        $category = Category::orderBy('created_at', 'ASC')->get();


        return view('category.index', compact('page','category'));
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
            'status' => 'required|string|max:255' // Assuming 'status' is a string in the form ('Active' or 'Inactive')
        ]);
    
        $existingCategory = Category::where('category', $validatedData['category'])->first();
    
        if ($existingCategory) {
            return redirect()->back()->withErrors(['This category already exists']);
        }
    
        $tblCategory = new Category();
        $tblCategory->category = $validatedData['category'];
        $tblCategory->status = $validatedData['status'] === 'Active' ? true : false;
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
    $category = Category::findOrFail($id); // Assuming you're using Eloquent ORM

    // Return the category data as JSON
    return response()->json([
        'id' => $category->id,
        'category' => $category->category,
        'status' => $category->status,
    ]);
}
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'rowid'    => 'required|exists:categories,id',
            'category' => 'required|string|max:255',
            'status' => 'required|string|max:255' // Assuming 'status' is a string in the form ('Active' or 'Inactive')
        ]);
    
        // Check if the category already exists
        $existingCategory = Category::where('category', $validatedData['category'])->first();
        if ($existingCategory && $existingCategory->id != $validatedData['rowid']) {
            return redirect()->back()->withErrors(['This category already exists']);
        }
    
        // Update the category
        $tblCategory = Category::findOrFail($validatedData['rowid']);
        $tblCategory->category = $validatedData['category'];
        $tblCategory->status = $validatedData['status'] === 'Active';
        $tblCategory->save();
    
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

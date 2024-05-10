<?php

namespace App\Http\Controllers;

use App\Exports\ArchiveExport;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Equipment;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Excel;

class EquipmentArchiveController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        $page = [
            'name'  =>  'Equipment Archive',
            'title' =>  'Equipment Archive',
            'crumb' =>  array('Equipment Archive' => '/equipment-archive')
        ];

        $equipment=Equipment::leftJoin('categories', 'equipment.category', '=', 'categories.id')
        ->orderBy('equipment.created_at', 'ASC')
        ->select('equipment.*', 'categories.category as category_name')
        ->where('equipment.status', '=', 'archived')
        ->get();
        
        return view('equipment_archive.index', compact('page', 'equipment','categories'));
        
    }

    public function view(string $id){

        $page = [
            'name'  =>  'Archived Equipment Details',
            'title' =>  'Archived Equipment Details',
            'crumb' =>  ['Equipment Archive' => '/equipment-archive', 'Details' => "/show/{$id}"]
        ];

        $categories = Category::all();

        $equipment = Equipment::leftJoin('categories', 'equipment.category', '=', 'categories.id')
        ->where('equipment.id', $id) 
        ->select('equipment.*', 'categories.category as category_name')
        ->firstOrFail();
    
        return view('equipment_archive.details', compact('equipment', 'page', 'categories'));
    }

    public function restore(string $id){
        
        // Find the equipment
        $equipment = Equipment::findOrFail($id);
    
        // Update equipment status
        $equipment->status = 'available';
        $equipment->conditions = 'Good';
        $equipment->save();
    
        // Retrieve the category ID associated with the equipment
        $category = $equipment->category;
    
        // Update the category status in the categories table
        Category::where('id', $category)->update(['status' => 1]);
    
        // Redirect with success message
        return redirect('/equipment')->with('success', 'Equipment Restored successfully.');
    }

    protected $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }
    public function downloadArchive(Request $request){
        $category_filter = $request->input('category_filter');

        $query = Equipment::leftJoin('categories', 'equipment.category', '=', 'categories.id')
            ->select('equipment.*', 'categories.category as category')
            ->where('equipment.status', '=', 'archived');

        if(!empty($category_filter)){
            $query->where('categories.category', '=', $category_filter);
            $fileName = 'Condemned_Equipments_'.$category_filter.'.xlsx';
        }
        else{
            $fileName = 'Archived_Equipment.xlsx';
        }

        
        $archive = $query->get();

       
      
        if ($archive->isEmpty()) {
            return Redirect::back()->withErrors('No equipments found with the specified filters.');
        }
        
        // Excel File Download
        return $this->excel->download(new ArchiveExport($archive), $fileName);
    }
}

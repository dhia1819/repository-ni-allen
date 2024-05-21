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

        $equipment = Equipment::with('category')
    ->orderBy('equipment_name', 'ASC')
    ->where('status', 'archived')
    ->get();

return view('equipment_archive.index', compact('page', 'equipment', 'categories'));
        
    }

    public function view(string $id){

        $page = [
            'name'  =>  'Archived Equipment Details',
            'title' =>  'Archived Equipment Details',
            'crumb' =>  ['Equipment Archive' => '/equipment-archive', 'Details' => "/show/{$id}"]
        ];

        $categories = Category::all();

        $equipment = Equipment::findOrFail($id);
    
        return view('equipment_archive.details', compact('equipment', 'page', 'categories'));
    }

    public function restore(string $id){
        
        
        $equipment = Equipment::findOrFail($id);
    
        
        $equipment->status = 'available';
        $equipment->conditions = 'Good';
        $equipment->save();
    
        
        $category = $equipment->category;
    
        
        Category::where('id', $category)->update(['status' => 1]);
    
        
        return redirect('/equipment')->with('success', 'Equipment Restored successfully.');
    }

    protected $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }
    public function downloadArchive(Request $request)
{
    $category_filter = $request->input('category_filter');

    // Query with relationships
    $query = Equipment::with('category')
                      ->orderBy('equipment_name', 'ASC')
                      ->where('status', '=', 'archived');

    if (!empty($category_filter)) {
        $query->whereHas('category', function ($q) use ($category_filter) {
            $q->where('name', '=', $category_filter);
        });
        $fileName = 'Condemned_Equipments_' . $category_filter . '.xlsx';
    } else {
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


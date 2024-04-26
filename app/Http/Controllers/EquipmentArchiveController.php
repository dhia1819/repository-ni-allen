<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Equipment_Archive;

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

        $equipment=Equipment_Archive::leftJoin('categories', 'equipment__archives.category', '=', 'categories.id')
        ->orderBy('equipment__archives.created_at', 'ASC')
        ->select('equipment__archives.*', 'categories.category as category_name')
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

        $equipment = Equipment_Archive::leftJoin('categories', 'equipment__archives.category', '=', 'categories.id')
        ->where('equipment__archives.id', $id) 
        ->select('equipment__archives.*', 'categories.category as category_name')
        ->firstOrFail();
    
        return view('equipment_archive.details', compact('equipment', 'page', 'categories'));
    }
}

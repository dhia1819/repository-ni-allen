<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'equipment_name',
        'category',
        'Description',
        'property_no',
        'serial_no',
        'unit_of_measure',
        'value',
        'quantity',
        'image',
        'conditions',
        'remarks',
        'status',
        'date_acquired',
    ];
}

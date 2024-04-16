<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplies extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_acquired',
        'supply_name',
        'supply_desc',
        'quantity',
        'location',
        'remarks',
        'unit'
    ];
}

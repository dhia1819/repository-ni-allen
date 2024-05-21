<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'tbl_equipment';

    protected $fillable = [
        'admin_id',
        'equipment_name',
        'category_id',
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

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'equipment_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}



<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'equipment_id',
        'release_by',
        'borrowed_by',
        'date_borrowed',
        'date_returned',
        'office',
        'upload_file',
        'returned_date',
        'returned_by',
        'received_by',
        'status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon; // Import Carbon for datetime handling

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

    protected $casts = [
        'date_borrowed' => 'datetime', // Cast date_borrowed to datetime
        'date_returned' => 'datetime', // Cast date_returned to datetime
        'returned_date' => 'datetime', // Cast returned_date to datetime
    ];

    // Additional attributes and methods can be defined here
}

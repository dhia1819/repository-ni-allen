<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'equipment_id',
        'release_by',
        'borrowed_by',
        'date_borrowed',
        'date_returned',
        'office_id',
        'upload_file',
        'returned_date',
        'returned_by',
        'received_by',
        'status',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id');
    }

    public function office()
    {
        return $this->belongsTo(Office::class, 'office_id');
    }

    public function releaseBy()
    {
        return $this->belongsTo(Employee::class, 'release_by');
    }

    public function receivedBy()
    {
        return $this->belongsTo(Employee::class, 'received_by');
    }
}



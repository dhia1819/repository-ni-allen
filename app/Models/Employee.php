<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'tbl_employees';

    protected $fillable=[
        'fullName',
        'position',
        'status'
    ];

    public function transactions()
{
    return $this->hasMany(Transaction::class, 'release_by', 'received_by');
}

}

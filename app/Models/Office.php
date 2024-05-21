<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Office extends Model
{

    protected $table = 'tbl_office';

    use HasFactory;
    protected $fillable = [
        'code',
        'office',
        'type',
    ];

    public function transactions()
{
    return $this->hasMany(Transaction::class, 'office_id');
}

}

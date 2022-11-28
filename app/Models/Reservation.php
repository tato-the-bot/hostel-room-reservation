<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'contract_start_date',
        'contract_end_date',
        'remark',
        'status',
    ];
}

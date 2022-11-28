<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    const STATUS_TYPE_PENDING_PAYMENT = 0;
    const STATUS_TYPE_PENDING_APPROVAL = 1;
    const STATUS_TYPE_APPROVED = 2;

    protected $fillable = [
        'user_id',
        'room_id',
        'transaction_id',
        'contract_start_date',
        'contract_end_date',
        'remark',
        'status',
    ];
}

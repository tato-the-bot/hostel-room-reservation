<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Transaction extends Model
{ 
    const PAYMENT_TYPE_IN_PROGRESS = 0;
    const PAYMENT_TYPE_APPROVED = 1;
    const PAYMENT_TYPE_CANCELLED = 2;
    const PAYMENT_TYPE_REJECTED = 3;

    const STATUS_LABEL = [
        self::PAYMENT_TYPE_IN_PROGRESS => 'In Progress',
        self::PAYMENT_TYPE_APPROVED => 'Approved',
        self::PAYMENT_TYPE_CANCELLED => 'Canceled',
        self::PAYMENT_TYPE_REJECTED => 'Rejected',
    ];

    protected $fillable = [
        'reservation_id',
        'transaction_no',
        'invoice_no',
        'pay_method',
        'amount', 
        'status',
    ];

    public function reservation()
    {
        return $this->hasOne(Reservation::class, 'id', 'reservation_id');
    }
}

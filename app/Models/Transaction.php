<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Reservation;

class Transaction extends Model
{ 
    const STATUS_TYPE_PAYMENT_IN_PROGRESS = 0;
    const STATUS_TYPE_PAYMENT_APPROVED = 1;
    const STATUS_TYPE_PAYMENT_CANCELLED = 2;
    const STATUS_TYPE_PAYMENT_REJECTED = 3;

    const STATUS_LABEL = [
        self::STATUS_TYPE_PAYMENT_IN_PROGRESS => 'In Progress',
        self::STATUS_TYPE_PAYMENT_APPROVED => 'Approved',
        self::STATUS_TYPE_PAYMENT_CANCELLED => 'Canceled',
        self::STATUS_TYPE_PAYMENT_REJECTED => 'Rejected',
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

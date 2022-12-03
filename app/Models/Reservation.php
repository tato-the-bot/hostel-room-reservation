<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Room;

class Reservation extends Model
{ 
    const STATUS_TYPE_PENDING_APPROVAL = 0;
    const STATUS_TYPE_APPROVED = 1;
    const STATUS_TYPE_PAID_DEPOSIT = 2;
    const STATUS_TYPE_CANCELLED = 3;
    const STATUS_TYPE_REJECTED = 4;

    const STATUS_LABEL = [
        self::STATUS_TYPE_PENDING_APPROVAL => 'Pending Approval',
        self::STATUS_TYPE_APPROVED => 'Approved',
        self::STATUS_TYPE_PAID_DEPOSIT => 'Paid Deposit',
        self::STATUS_TYPE_CANCELLED => 'Canceled',
        self::STATUS_TYPE_REJECTED => 'Rejected',
    ];

    protected $fillable = [
        'student_id',
        'room_id',
        'transaction_id',
        'contract_start_date',
        'contract_end_date',
        'remark',
        'status',
    ];

    public function room()
    {
        return $this->hasOne(Room::class, 'id', 'room_id');
    }
}

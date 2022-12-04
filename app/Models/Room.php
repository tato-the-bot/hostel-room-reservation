<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Agent;
use App\Models\Reservation;

class Room extends Model
{
    use HasFactory;

    const ROOM_TYPE_BIG = 'big_room';
    const ROOM_TYPE_MEDIUM = 'medium_room';
    const ROOM_TYPE_SINGLE = 'single_room';

    const ROOM_TYPE_LABEL = [
        self::ROOM_TYPE_BIG => 'Big Room',
        self::ROOM_TYPE_MEDIUM => 'Medium Room',
        self::ROOM_TYPE_SINGLE => 'Single Room',
    ];

    const STATUS_ACTIVE = 0;
    const STATUS_RESERVED = 1;

    const STATUS_LABEL = [
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_RESERVED => 'Reserved',
    ];

    protected $fillable = [
        'room_title',
        'room_type',
        'room_desc',
        'monthly_rental',
        'deposit',
        'image',
        'remark',
        'status',
        'agent_id'
    ];

    public function agent()
    {
        return $this->hasOne(Agent::class, 'id', 'agent_id');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'room_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    const BIG_ROOM_TYPE = 'big_room';
    const MEDIUM_ROOM_TYPE = 'medium_room';
    const SINGLE_ROOM_TYPE = 'single_room';

    protected $fillable = [
        'room_type',
        'room_desc',
        'monthly_rental',
        'deposit',
        'image',
        'remark',
        'status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Reservation;

class Student extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const STATUS_UNVERIFIED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_FREEZE = 2;

    const STATUS_TEXT = [
        self::STATUS_UNVERIFIED => 'Unverified',
        self::STATUS_ACTIVE =>  'Active',
        self::STATUS_FREEZE =>  'Freeze',
    ];

    protected $fillable = [
        'student_id',
        'phone_number',
        'image',
        'name',
        'email',
        'password',
        'role',
        'status',
        'otp_code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'student_id', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{ 

    protected $fillable = [
        'student_id',
        'room_id',
        'rate', 
        'comments',
    ];

    public function student()
    {
        return $this->hasOne(Student::class, 'id', 'student_id');
    }

}

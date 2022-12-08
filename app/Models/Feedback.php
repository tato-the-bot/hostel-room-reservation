<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{ 

    protected $fillable = [
        'agent_id',
        'rate', 
        'comments',
    ];

    public function agent()
    {
        return $this->hasOne(Agent::class, 'id', 'agent_id');
    }

}

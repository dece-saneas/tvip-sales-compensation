<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'reward_id', 'quantity', 'status',
    ];
    
    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }
    
    public function reward()
    {
    	return $this->belongsTo('App\Models\Reward');
    }
}

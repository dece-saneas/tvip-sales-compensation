<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reward extends Model
{
    protected $fillable = [
        'photo', 'title', 'product_id', 'target', 'period_start', 'period_end',
    ];
    
    protected $dates = ['period_start', 'period_end'];
    
    public function product()
    {
    	return $this->belongsTo('App\Models\Product');
    }
    
    public function leaderboard()
    {
    	return $this->hasMany('App\Models\Leaderboard');
    }
    
    public function claim()
    {
    	return $this->hasMany('App\Models\Claim');
    }
}

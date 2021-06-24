<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'photo', 'brand', 'variant', 'stock',
    ];
    
    public function supply()
    {
    	return $this->hasMany('App\Models\Supply');
    }
    
    public function reward()
    {
    	return $this->hasMany('App\Models\Reward');
    }
}

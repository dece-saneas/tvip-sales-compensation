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
        'photo', 'brand', 'variant', 'price', 'stock',
    ];
    
    public function supply()
    {
    	return $this->hasMany('App\Models\Supply');
    }
    
    public function reward()
    {
    	return $this->hasMany('App\Models\Reward');
    }
    
    public function cart()
    {
    	return $this->hasMany('App\Models\Cart');
    }
}

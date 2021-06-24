<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supply extends Model
{
    protected $table = 'supplies';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'stock', 'notes',
    ];
    
    public function product()
    {
    	return $this->belongsTo('App\Models\Product');
    }
    
    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }
}

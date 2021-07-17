<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'product_id', 'quantity', 'invoice_id',
    ];
    
    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }
    
    public function product()
    {
    	return $this->belongsTo('App\Models\Product');
    }
    
    public function invoice()
    {
    	return $this->belongsTo('App\Models\Invoice');
    }
}

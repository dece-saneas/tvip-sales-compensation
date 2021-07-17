<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'user_id', 'payment', 'total',  'attachment',  'bank_name',  'bank_account_name',  'bank_account',  'telp',  'address',  'status',
    ];
    
    public function user()
    {
    	return $this->belongsTo('App\Models\User');
    }
    
    public function cart()
    {
    	return $this->hasMany('App\Models\Cart');
    }
}

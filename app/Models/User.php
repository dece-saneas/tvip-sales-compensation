<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
	use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'photo',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function supply()
    {
    	return $this->hasMany('App\Models\Supply');
    }
    
    public function invoice()
    {
    	return $this->hasMany('App\Models\Invoice');
    }
    
    public function cart()
    {
    	return $this->hasMany('App\Models\Cart');
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

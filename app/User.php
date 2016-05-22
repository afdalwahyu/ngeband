<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','location','instrument','genre',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function bandmember()
    {
        return $this->hasMany('App\Bandmember');
    }

    public function Band()
    {
        return $this->hasMany('App\Band');
    }

    public function reqjoin()
    {
        return $this->hasMany('App\Reqjoin');
    }

    public function friend()
    {
        return $this->hasMany('App\Friend');
    }

    public function scopeGetStatusFriendRequest($query,$type)
    {
        return $query->friend->where('user_id_response',$type);
    }

    public function scopeGetStatusBandRequest($query)
    {
        return $query->reqjoin;
    }
}

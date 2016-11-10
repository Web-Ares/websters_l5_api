<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password','google_token','refresh_google_token','expires','created_at','updated_at'
    ];

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function positions()
    {
        return $this->belongsToMany('App\Position','user_position');
    }


    public function hasRole($role)
    {
        if($this->role()->where('name',$role)->first()){
            return true;
        }
        return false;
    }

}

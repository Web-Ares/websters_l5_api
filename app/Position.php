<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{

    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany('App\User','user_position');
    }

    public function technologies()
    {
        return $this->hasMany('App\Technology');
    }

}


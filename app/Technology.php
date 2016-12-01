<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    public $timestamps = false;

    public function users()
    {
        return $this->belongsToMany('App\Users','user_technology');
    }

    public function position()
    {
        return $this->belongsTo('App\Position');
    }
    
}


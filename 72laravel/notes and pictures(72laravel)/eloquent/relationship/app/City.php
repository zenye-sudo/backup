<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function posts(){
        return $this->hasManyThrough('App\article','App\User','city_id','user_id');
    }
}

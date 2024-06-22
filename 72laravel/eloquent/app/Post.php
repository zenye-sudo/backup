<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function Posts(){
        return $this->morphMany('App\Comment','commendable');
    }
}
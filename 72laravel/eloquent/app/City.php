<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
 public function Posts(){
     return $this->hasManyThrough('App\Post','App\ThoneThu','city_id','user_id');
 }
}

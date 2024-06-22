<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ThoneThu extends Model
{
    protected $fillable=['name','email','password'];
    public function ranks(){
        return $this->belongsToMany('App\Roll');
    }
    public function Posts(){
        return $this->hasMany('App\Post');
    }
}
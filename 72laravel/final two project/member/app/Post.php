<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Comments;

class Post extends Model
{
    protected $fillable=['title','content','user_id','cat_id','slug'];
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function comment(){
        return $this->morphMany('App\Comments','commendable');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class article extends Model
{
  protected $fillable=['user_id','title','content'];
  public function user(){
      return $this->belongsTo('App\User');
  }
    public function comments(){
        return $this->morphMany('App\Comments','Commendable');
    }
}

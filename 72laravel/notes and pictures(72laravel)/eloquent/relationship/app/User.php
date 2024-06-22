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
        'name', 'email', 'password',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function posts(){
        return $this->hasMany('App\article');
    }
    public function city(){
        return $this->hasOne('App\City');
    }
    public function rank(){
        return $this->belongsToMany('App\role');
    }
    public function comments(){
        return $this->morphMany('App\Comments','Commendable');
    }
}

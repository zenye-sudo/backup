<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function commendable(){
        return $this->morphTo();
    }
}

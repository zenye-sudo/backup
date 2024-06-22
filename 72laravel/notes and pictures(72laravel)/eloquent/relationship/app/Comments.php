<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public function commendable(){
        return $this->morphTo();
    }
}

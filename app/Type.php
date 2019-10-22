<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    //
    public function tailles(){
        return $this->hasMany('App\Taille');
    }
}

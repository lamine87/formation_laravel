<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CommandeProduit extends Pivot
{
    //
    //Recuperer la taille du produit coommandé
    public function taille(){
        return $this->belongsTo('App\Taille');
    }
}

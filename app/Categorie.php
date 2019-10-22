<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Categorie extends Model
{
    //
    use SoftDeletes;

    //Recuperer les produits d'une categorie
    public function produits(){
    return $this->hasMany('App\produit');
}
   //Recuperer la categorie parente d'une catégorie
   public function parent(){
        return $this->belongsTo('App\Categorie');
   }
   //Recuperer les categories enfant d'une catégorie
    public function enfants(){
        return $this->hasMany('App\Categorie','parent_id');
    }
}

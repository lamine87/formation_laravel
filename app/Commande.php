<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    // Recuperer l'adresse d'une commande

    public function adresse(){
        return $this->belongsTo('App\Adresse');

    }

    // Récuperer l'acheteur d'une commande
    public function user(){
        return $this->belongsTo('App\User');

    }
   public function produits(){
       return $this->belongsToMany('App\Adresse','commande_produits')
           ->withTimestamps()
           ->using('App\CommandeProduit')
           ->withPivot('qte','prix_unitaire_ttc','prix_unitaire_ht','prix_total_ht','prix_total_ttc','taille_id');

   }

}

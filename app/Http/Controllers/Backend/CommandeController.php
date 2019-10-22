<?php

namespace App\Http\Controllers\Backend;

use App\Commande;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    //
    public function index(){
        $commandes  = Commande::orderBy('id','desc')->paginate(2);
        return view('backend.commande.index',['commandes'=>$commandes]);
    }

    //Afficher le detail de la commande
    public function show(){
        $commande = Commande::find($request->id);

        return view('backend.commande.show',['commande'=>$commande]);
    }
}

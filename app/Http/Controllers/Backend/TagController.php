<?php

namespace App\Http\Controllers\Backend;

use App\Categorie;
use App\Http\Controllers\Controller;
use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    //
    public function index()
    {
        $tags = Tag::all();
        $categories = Categorie::where("parent_id",'=',null)->paginate(5);
        return view('backend.tag.index', ['tags' => $tags,'categories'=>$categories]);
    }

    public function add()
    {
        return view('backend.tag.add');
    }
    public function store(Request $request){
        // Validation de fom
        $request->validate(['nom'=>'required|max:255']);
        // Creation de l'objet Tab
        $tag = new Tag();
        $tag->nom = $request->nom;

        //Sauvegarde dans la db
        $tag->save();
        //Redirection vers la page qui liste les tags
        return redirect()->route('backend_tags_index')->with('notice','Le tag<trong>'.$tag->nom.'</trong> a bien été ajouté');

    }

    // Modifier un tag
    public function edit(Request $request){
          // Recuperer dans la db le tag a modifier
          // (on récupère le parametre du tag via l'uri definie dans la route
        $tag = Tag::find($request->id);
        return view('backend.tag.edit',['tag'=>$tag]);
    }
    //Exécution de la modif
    public  function update(Request $request){
        $request->validate(['nom'=>'required|max:255']);
        $tag = Tag::find($request->id);
        $tag->nom = $request->nom;
        $tag->save();
        return redirect()->route('backend_tags_index')->with('notice','Le tag <trong>'.$tag->nom.'</trong> a été modifier');
    }
    public function delete(Request $request){
        $tag = Tag::find($request->id);
        $tag->delete();
        return redirect()->route('backend_tags_index')->with('notice','Le tag <trong>'.$tag->nom.'</trong> a été supprimer');


    }
}

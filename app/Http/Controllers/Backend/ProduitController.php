<?php

namespace App\Http\Controllers\Backend;

use App\Categorie;
use App\Http\Controllers\Controller;
use App\Produit;
use App\Tag;
use App\Taille;
use App\Type;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    //
    public function index()
    {
        $produits = Produit::all();
        return view('backend.produits.index', ['produits' => $produits]);
    }

    public function add()
    {
        $produits = Produit::all();
        $produits_recommandes = Produit::all();
        $tags = Tag::all();
        $categories = Categorie::all();
        return view('backend.produits.ajout_produit',
            ['categories' => $categories, 'produits_recommandes' => $produits_recommandes, 'tags' => $tags,'produits'=>$produits]);
    }

    public function store(Request $request)
    {

        $request->validate(
            ['nom'=>'required | max:255',
                'prix_ht'=>'required',
                'description'=>'required | max:900',
                'qte'=>'required',
                'categorie_id'=>'required','photo_principale'=>'required|image|max:1999']
        );
        if ($request->hasFile('photo_principale')) {

            //Recuperer le nom de l'image saisi par l'utilisateur
            $fileName = $request->file('photo_principale')->getClientOriginalName();
            //Telechargement de l'image
            $request->file('photo_principale')->storeAs('public/uploads',$fileName);

            // Imprimer l'icon sur l'image
            $img = Image::make($request->file('photo_principale')->getRealPath());

            $img->insert(public_path('img/favicon.png'), 'bottom-right', 5, 5);

            $img->save('storage/uploads/' .$fileName);


                }

        $produit = new Produit();
        $produit->nom = $request->nom;
        $produit->prix_ht = $request->prix_ht;
        $produit->description = $request->description;
        $produit->photo_principale = $fileName;
        $produit->qte = $request->qte;
        $produit->categorie_id = $request->categorie_id;
        $produit->save();

       if($request->tags){
        foreach($request->tags as $id) {
            $produit->tags()->attach($id);
        }
        }
       if ($request->produits_recommandes) {
           foreach ($request->produits_recommandes as $id) {
               $produit->recommandations()->attach($id);
           }
       }
        return redirect()->route('backend_homepage')->with('notice','Le Produit <strong>'. $produit->nom. '</strong> a bien été ajouté');
    }
    public function edit(Request $request){
        $produits = Produit::all();
        $tags = Tag::all();
        $categories = Categorie::all();
        //dd($request->id);
        $produit = Produit::find($request->id);
        $tags_id = [];
        foreach ($produit->tags as $t) {
            $tags_id [] = $t->id;
        }
        $produit_recommandations = [];
        foreach ($produit->recommandations as $r) {
            $produit_recommandations [] = $r->id;
        }
//        dd($tags_id);

        return view ('backend.produits.edit',[
            'tags'=>$tags,
            'categories'=>$categories,
            'produits'=>$produits,
            'produit'=>$produit,
            'tags_id'=>$tags_id,
            'produit_recommandations'=>$produit_recommandations
        ]);
    }
   public function update(Request $request)
   {
       $produit = Produit::find($request->id);
       $request->validate(
           ['nom' => 'required | max:255',
               'prix_ht' => 'required',
               'description' => 'required | max:900',
               'qte' => 'required',
               'categorie_id' => 'required']);
       if ($request->hasFile('photo_principale')) {

           $fileName = $request->file('photo_principale')->getClientOriginalName();

           $request->file('photo_principale')->storeAs('public/uploads', $fileName);
           // Imprimer l'icon sur l'image
           $img = Image::make($request->file('photo_principale')->getRealPath());

           $img->insert(public_path('img/favicon.png'), 'bottom-right', 5, 5);

           $img->save('storage/uploads/' . $fileName);
           $produit->photo_principale = $fileName;

       }
       $produit->nom = $request->nom;
       $produit->prix_ht = $request->prix_ht;
       $produit->description = $request->description;

       $produit->qte = $request->qte;
       $produit->categorie_id = $request->categorie_id;
       $produit->save();

//       foreach ($request->tags as $id) {
//           $produit->tags()->attach($id);
//       }
         $produit->tags()->sync($request->tags);
         $produit->recommandations()->sync($request->produits_recommandes);

         return redirect()->route('backend_homepage')->with('notice','Le Produit <strong>'.$produit->nom. '</strong> a bien été Modifier');

   }
   public function delete(Request $request){
        $produit = Produit::find($request->id);
        $produit->delete();
        return redirect()->route('backend_homepage')->with('notice','Le produit <strong>'.$produit->nom.'</strong> a été supprimé');
   }
   public function addSize(Request $request){
        $produit = Produit::find($request->id);
        $types = Type::all();

        return view('backend.produits.add_size',['produit'=>$produit,'types'=>$types]);

   }
   //Recuperer les tailles liées au type sélectionné (AJAX)
    public function selectSizeAjax(Request $request){
        $type_id = $request->type_id;
        $type = Type::find($type_id);

        $produit = Produit::find($request->produit_id);
        $tailles_produit = $produit->tailles;
        $tailles_produit_ids =[];
        foreach ($tailles_produit as $taille_produit){
            $tailles_produit_ids[] = $taille_produit->id;
        }
        return view('backend.produits.select_tailles_ajax',['tailles'=>$type->tailles,'tailles_produit_ids'=>$tailles_produit_ids]);
    }
      //Stocker la taille et le produit selectionné

    public function storeSize(Request $request){

        $produit = Produit::find($request->id);

        //Association de la taille et la quantité liée au produit
        $produit->tailles()->attach($request->taille_id,['qte'=>$request->qte]);
        return redirect()->route('backend_produit_add_size',['id'=>$produit->id])->with('notice','La taille pour le produit <strong>'.$produit->nom.'</strong> abien été ajoutée');
    }

    // Retirer l'association entre une taille et un produit
    public function removeSizeAjax(Request $request){
        $produit = Produit::find($request->produit_id);
        $produit->tailles()->detach($request->taille_id);
        $taille = Taille::find($request->taille_id);


        return 'La taille <strong>'.$taille->nom.'</strong> a bien été retirée';
    }
}

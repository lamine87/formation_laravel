@extends('shop')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('Homepage')}}">Accueil</a></li>

            @if($produit->categorie && $produit->categorie->parent)
            <li class="breadcrumb-item">
                <a href="{{route('view_by_cat',['id'=>$produit->categorie->parent->id])}}">{{$produit->categorie->parent->nom}}</a>
            </li>
            @endif
            @if($produit->categorie)
            <li class="breadcrumb-item active" aria-current="page">
                <a href="{{route('view_by_cat',['id'=>$produit->categorie->id])}}">{{$produit->categorie->nom}}</a>
               </li>
                @endif
        </ol>
    </nav>

    <main role="main">


        <div class="container">
            <div class="row justify-content-between">


                <div class="col-6">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top" src="{{asset('storage/uploads/'.$produit->photo_principale)}}" alt="Card image cap">

                    </div>
                </div>
                <div class="col-6">

                    <h1 class="jumbotron-heading">{{$produit->nom}}</h1>
                    <h5>29.00 €</h5>
                    <p class="lead text-muted">{{$produit->description}}</p>
                    <hr>

                    <form action="{{route('add_product_cart',['id'=>$produit->id])}}" method="POST">
                       @csrf

                    @if(count($produit->tailles) >0)
                    <label for="size">Choisissez votre taille</label>
                    <select data-produit_id="{{$produit->id}}" name="size" id="size" class="form-control change_size">
                        @foreach($produit->tailles as $taille)
                        <option value="{{$taille->id}}">{{$taille->nom}}</option>
                          @endforeach
                           </select>
                            <div class="load_qte"></div>
                            @endif
                    <p>

                        @if(count($produit->tailles) == 0)
                        @if($produit->qte >0)
                            <label for="qte">quantité</label>
                            <input type="number" min="1" max="{{$produit->qte}}" name="qte" autocomplete="off" value="1" class="form-control">

                            <button class="btn btn-cart my-2 btn-block"><i class="fas fa-shopping-cart"></i> Ajouter au panier</button>
                            @else
                            <button disabled class="btn btn-cart my-2 btn-block"><i class="fas fa-shopping-cart"></i> En rupture de stock !!!</button>
                            @endif
                            @endif
                    </p>
                    </form>
                </div>
            </div>
        </div>


        <div class="album py-5 bg-light">
            <div class="container">
                <div class="row">
                    <h3>Vous aimerez aussi :</h3>
                </div>
                <div class="row">
        @foreach($produit->recommandations as $recommandation)
                    <div class="col-md-4">
                        <div class="card mb-4 box-shadow">
                            <img src="{{asset('storage/uploads/'.$recommandation->photo_principale)}}" class="card-img-top img-fluid" alt="Responsive image">

                            <div class="card-body">
                                <div class="d-flex justify-content-end">
                                    <div class="btn-group">
                                        <a href="{{route('view_product',['id'=>$recommandation->id])}}" class="btn btn-sm btn-outline-secondary"><i class="fas fa-eye"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
      @endforeach
                </div>


            </div>
        </div>

    </main>

@endsection

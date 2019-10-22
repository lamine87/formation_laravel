@extends('backend')
@section('content')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Commande N° {{$commande->id}}</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a href="{{route('backend_commande_index')}}" class="btn btn-sm btn-outline-secondary">Lister les commandes</a>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <div class="jumbotron">
                <h1 class="display-6">{{$commande->user->nom}} </h1>
                <p class="lead">Adresse de livraison</p>
                <p>{{$commande->adresse->adresse}}<br>
                    {{$commande->adresse->adresse2}} <br>
                    {{$commande->adresse->code_postal}} -
                    {{$commande->adresse->ville}} -
                    {{$commande->pays}}</p>
                <p>Numéro de transaction Stripe: </p>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr><th>N°</th>
                    <th>{{$commande->produit}}</th>
                    <th>{{$commande->qte}}</th>
                    <th>{{$commande->prix_unitaire_ttc}}</th>
                    <th class="text-right">{{$commande->total}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($commandes as $commande)
                <tr>
                    <td>{{++$loop->index}}</td>
                    <td>
                        <strong>{{$produit->nom}} -
                            @if($produit->pivot->taille)
                                {{$produit->pivot->taile->nom}}
                                @endif
                        </strong> <br>
                    </td>
                    <td>{{$produit->pivot->qte}}</td>
                    <td>{{ number_format($produit->pivot->prix_unitaire_ttc,2)}} € TTC</td>
                    <td class="text-right">{{ number_format($produit->pivot->prix_total_ttc,2)}} € TTC</td>
                </tr>
                    @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td colspan="3"></td>
                    <td>Sous-Total HT:</td>
                    <td class="text-right">{{number_format($commande->total_ht,2)}} € </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>TVA({{$commande->taux_tva}}%) € </td>
                    <td class="text-right">{{number_format($commande->tva,2)}}€ </td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td>TOTAL</td>
                    <td class="text-right">{{number_format($commande->total_ttc,2)}} €  </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </main>
    @endsection

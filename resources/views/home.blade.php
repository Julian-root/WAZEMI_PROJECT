@extends('layouts/master')

@section('content')
<div class="row" style="margin: 0 auto;">
    <div class="col-12 p-4">
        <div class="jumbotron ">
                <h1 >Bienvenue, <strong>{{ Auth::user()->prenom }} </strong></h1>
                <p>Avec <strong>WAZEMI</strong>, accédez facilement aux transports, aux achats à d’autres besoins</p>
                <hr class="my-4">
                <p class="lead">Appuyez sur un bouton et un chauffeur viendra vous chercher sur un moto-taxi ou dans une voiture et vous emmènera là où vous le souhaiter.</p>
                <p class="lead"> 
                    {{-- can client --}}
                    @can("client")
                    <a class="btn btn-primary btn-lg" style="margin-right: 50px" href="{{ route('client.commande.commandes') }}" role="button">Faire une réservation</a>
                    @endcan
                    {{-- can conducteur --}}
                    @can("conducteur")
                        <a class="btn btn-primary btn-lg" href="{{ route('conducteur.current.view') }}" role="button">Actualiser votre localisation</a>
                    @endcan
                </p>
        </div>
    </div>
</div>
@stop 
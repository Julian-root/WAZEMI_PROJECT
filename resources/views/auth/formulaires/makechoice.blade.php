{{--
@extends('layouts/master')

@section('content')
<div class="row" style="margin: 0 auto;">
    <div class="col-12 p-4">
        <div class="jumbotron ">
            <h1 class="display-3">Welcome, <strong>{{ Auth::user()->prenom }} </strong></h1>
            <p class="lead">This is a simple hero unit, a simple jumbotron-style component for calling extra attention
                to featured content or information.</p>
            <hr class="my-4">
            <p>It uses utility classes for typography and spacing to space content out within the larger container.</p>
            <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>
</div>
@stop --}}


<h4 class="mt-4 mb-2"></h4>
<div class="row">
    

    <div class="col-md-1"></div>
    <div class="col-md-5">

        <div class="card direct-chat direct-chat-success">
            <div class="card-header bg-success">
                <h3 class="card-title text-center">Register as a customer</h3>
            </div>

            <div class="card-body">
                <img style="width: 400px; height:345px" class="contacts-list-img" src="{{ asset('img/hero.png') }}" alt="User Avatar">
            </div>

            <div class="card-footer">
                <button type="button" wire:click.prevent="goToAddClient()" class="btn btn-outline-success btn-block">
                    <i class="fa fa-bell"></i>
                    <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                        REGISTER
                    </font>
                    </font>
                </button>
            </div>

        </div>

    </div>

    

    <div class="col-md-5">

        <div class="card card-warning   direct-chat direct-chat-success">
            <div class="card-header">
                <h3 class="card-title text-center">Register as a driver</h3>
            </div>

            <div class="card-body">
                <img style="width: 400px; height:345px" class="contacts-list-img" src="{{ asset('img/hero.png') }}" alt="User Avatar">
            </div>

            <div class="card-footer">
                <button type="button" wire:click.prevent="goToAddConducteur()" class="btn btn-outline-warning btn-block">
                    <i class="fa fa-bell"></i>
                    <font style="vertical-align: inherit;">
                    <font style="vertical-align: inherit;">
                    REGISTER
                    </font>
                    </font>
                </button>
            </div>

        </div>
        <div class="col-md-3"></div>

    </div>
    <div class="col-md-1"></div>

    

</div>

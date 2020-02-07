@extends('layout.header')

@section('alertMessage')

    <nav class="navbar navbar-expand-sm navbar-dark indigo">
        <a href="{{ route('indexVisitors') }}" class="comfortaa" style="margin-left: -10px; margin-right: 10px;">
            <img src="{{ URL::asset('assets/images/deblaa.png') }}" width="50" alt="logo">
        </a>
        <a class="navbar-brand comfortaa cyan-text font-weight-bold" href="{{ route('indexVisitors') }}">
            Deblaa - Universite
        </a>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-12 col-sm-12"></div>
            <div class="col-lg-8 col-md-12 col-sm-12">
                <br /><br /><br /><br />
                <h2 class="text-danger text-center">
                    <i class="icofont icofont-exclamation-tringle"></i> Opération non autorisée !
                </h2>

                <div class="text-center">
                    <p>
                        <strong>
                            Vous avez épuisé le nombre de messages de bonus que vous aviez.
                            Il est à présent impossible d'effectuer cette action.
                            Passez en compte professionnel illimité pour résoudre ce problème en nous contactant.
                        </strong>
                    </p>

                    <h3 class="text-center">
                        <a href="tel:+22891019245">0022891019245</a> / <a href="tel:+22897531717">0022897531717</a>
                    </h3><br /><br />

                    <a href="{{ route('indexUniversite') }}" class="btn btn-indigo btn-md rounded">
                        Retour à l'accueil
                    </a>
                </div>
                <br /><br /><br /><br /><br /><br /><br />
            </div>

            <div class="col-12 text-center font-size-14 border-top"><br />
                <strong>Deblaa &copy; 2019 | Tous droits reservés</strong><br>
                <strong>Produit de <a href="#!">IBTAGroup</a></strong><br><br>
            </div>
        </div>
    </div>
@endsection

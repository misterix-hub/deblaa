@extends('layout.sideBarStructure')

@section('content')
    <div class="">
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12" style="border-right: 1px solid #CCC;">
                    
                    <div class="row">
                        <div class="col-12">
                            <div class="text-right mt-3">
                                <a href="{{ route('sEnvoyerMessage') }}">
                                    <i class="icofont-facebook-messenger"></i>
                                    <b>Envoyer un message</b>
                                </a>
                            </div><br />

                            @if($message = Session::get('success'))
                                <div class="alert alert-success">
                                    {{ $message }}
                                </div>
                            @endif <br />
                            
                            @if ($message = Session::get('successDemande'))    
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h5>Demande envoyée avec succès !</h5>
                                    Nous prendrons contact avec vous très bientôt pour la suite de
                                    l'opération.
                                </div>
                            @endif

                            @if ($message = Session::get('warningDemande'))    
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <h5>Demande non envoyée !</h5>
                                    Une demande de cette provenance a déjà été enregisrée !
                                </div>
                            @endif
                            
                            @if (session()->get('pro') == 0) 
                            
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title comfortaa">
                                            Bienvenue, {{ session()->get('sigle') }}
                                        </h4>
                                        <p class="card-text black-text" style="text-align: justify;">
                                            Le compte que vous utilisez est un compte d'essai avec un nombre limité de messages
                                            à envoyer à un nombre de destinataires limité. <a href="#!" data-toggle="modal" data-target="#compteProModal">Chargez votre compte</a>
                                            pour utiliser Deblaa sans restrictions.
                                        </p>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <a class="btn btn-green ml-0 rounded btn-block" href="#!" data-toggle="modal" data-target="#compteProModal" role="button">
                                                    <i class="icofont-refresh"></i>
                                                    Charger le compte
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div><br /><br /><br /><br /><br /><br /><br />
                            @else    
                                <br /><br /><br />
                                <h1 class="mb-1 comfortaa text-center grey-text">
                                    <i class="icofont-attachment icofont-3x"></i><br />
                                    Espace de travail
                                </h1><br /><br /><br /><br /><br /><br /><br /><br />
                            @endif
        
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 menu-item-sm-hide">
                    
                    @include('included.sideBarRight')

                </div>
                <div class="col-12 text-center font-size-14 border-top"><br />
                    <b>Deblaa &copy; 2019 | Tous droits réservés</b><br />
                    <b>Produit de <a target="_blank" href="#!">IBTAGroup</a></b><br /><br />
                </div>
            </div>
        </div>

    </div>
@endsection
@extends('layout.sideBarStructure')

@section('content')
    <div class="">
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12" style="border-right: 1px solid #CCC;">

                    <div class="row menu-item-sm-show">
                        <div class="col-12">
                            <a class="btn btn-green btn-md m-0 btn-block mt-2 z-depth-0" href="#!" data-toggle="modal" data-target="#compteProModal"
                            role="button" style="border-radius: 5px;">
                                <i class="icofont-refresh"></i>
                                Charger le compte
                            </a>
                            <div class="mt-2"></div>
                            <div class="card border-warning" style="font-size: 13px;">
                                <div class="card-header text-center">
                                    Messages en réserve
                                </div>
                                <div class="card-body text-center p-2">
                                    <p class="card-text"  style="font-size: 13px;">
                                        Il vous reste {{ session()->get('message_bonus') }} message(s) sur votre compte.
                                    </p>
                                </div>
                            </div><br />
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-12">
                            
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
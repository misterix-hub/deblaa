@extends('layout.sideBarStructure')

@section('content')
    <div class="">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12" style="border-right: 1px solid #CCC;">

                    @if($errors->any())
                        <ul class="alert alert-danger list-unstyled mt-3 alert-dismissible fade show" role="alert">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </ul>
                    @endif

                    <div class="row menu-item-sm-show">
                        <div class="col-12">
                            <div class="mt-2"></div>
                            @if(session()->get('pro') == 0)
                                <div class="card border-warning font-size-14">
                                    <div class="card-header">
                                        Messages en réserve
                                    </div>
                                    <div class="card-body text-center">
                                        <h4 class="card-title text-center">
                                            {{ session()->get('message_bonus') }}
                                        </h4>
                                        <p class="card-text">
                                            Il vous reste {{ session()->get('message_bonus') }} {{ \Illuminate\Support\Str::plural('message', session()->get('message_bonus')) }} bonus sur votre compte.
                                        </p>
                                    </div>
                                </div>
                            @endif<br />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">

                            @if($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif <br />

                            @if($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
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

                            @if (session()->get('pro') == 0 && session()->get('message_bonus') != 0)
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title comfortaa">
                                            Bienvenue, {{ session()->get('sigle') }}
                                        </h4>
                                        <p class="card-text black-text" style="text-align: justify;">
                                            Le compte que vous utilisez est un compte d'essai avec un nombre limité de messages
                                            à envoyer à un nombre de destinataires limité. Pour passez en compte professionnel
                                            illimité, contactez nous.

                                            <h4 class="text-center">
                                                <a href="tel:+22891019245">0022891019245</a> / <a href="tel:+22897531717">0022897531717</a>
                                            </h4>
                                        </p>
                                    </div>
                                </div><br /><br /><br /><br /><br /><br /><br />

                            @elseif (session()->get('message_bonus') == 0 && session()->get('pro') == 0)
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title comfortaa text-danger">
                                            <i class="icofont icofont-exclamation-tringle"></i> ALERTE <i class="icofont icofont-exclamation-tringle"></i><br>
                                        </h4>
                                        <p class="card-text black-text" style="text-align: justify;">
                                            {{ session()->get('sigle') }}, Vous avez épuisé le nombre de messages d'essai que vous aviez.
                                            Il est à présent impossible d'envoyer des messages ou d'ajouter des membres.
                                            Passez en compte professionnel illimité pour résoudre ce problème en nous contactant.

                                            <h4 class="text-center">
                                                <a href="tel:+22891019245">0022891019245</a> / <a href="tel:+22897531717">0022897531717</a>
                                            </h4>
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

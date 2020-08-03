@extends('layout.header')

@section('alertMessage')

    <nav class="navbar navbar-expand-sm navbar-dark indigo">
        <a href="{{ route('indexStructure') }}" class="comfortaa" style="margin-left: -10px; margin-right: 10px;">
            <img src="{{ URL::asset('assets/images/deblaa.png') }}" width="50" alt="logo">
        </a>
        <a class="navbar-brand comfortaa cyan-text font-weight-bold" href="{{ route('indexStructure') }}">
            Deblaa - Structure
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

                @if (Session::get('message_alert') == 0)
                    <div class="text-center">
                        <p>
                            <strong>
                                Vous avez épuisé le nombre de messages d'essai que vous aviez.
                                Il est à présent impossible d'effectuer cette action.
                                Passez en compte professionnel illimité pour résoudre ce problème en nous contactant.
                            </strong>
                        </p>

                        <h3 class="text-center">
                            <a href="tel:+22891019245">0022891019245</a> / <a href="tel:+22897531717">0022897531717</a>
                        </h3><br /><br />

                        <a href="{{ route('indexStructure') }}" class="btn btn-indigo btn-md rounded">
                            Retour à l'accueil
                        </a>
                    </div>
                @else
                    <div class="text-center">
                        <p>
                            <strong>
                                Vous avez épuisé le nombre de messages MMS que vous aviez.
                                Veuillez recharger votre compte pour pouvoir envoyer de messages.
                            </strong>
                        </p>

                        <button type="button" class="btn btn-md rounded btn-primary" data-toggle="modal" data-target="RechargeCompte">Recharger mon compte</button>

                        <a href="{{ route('indexStructure') }}" class="btn btn-indigo btn-md rounded">
                            Retour à l'accueil
                        </a>
                    </div>
                @endif
                <br /><br /><br /><br /><br /><br /><br />
            </div>

            <!-- Modal de recharge de compte -->
            <form action="{{ route('codeTicket') }}" method="post">
                <div class="modal fade" id="rechargeCompte" tabindex="-1" role="dialog" aria-labelledby="rechargeCompteLabel"
                aria-hidden="true">

                <!-- Add .modal-dialog-centered to .modal-dialog to vertically center the modal -->
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        @csrf

                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="rechargeCompteTitle"><span class="icofont-credit-card"></span> Recharge</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="text" name="ticket_code" autocomplete="off" id="ticket_code" class="form-control" placeholder="Tapez le code de votre ticket ici...">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light btn-sm" data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-success btn-sm">Valider</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <div class="col-12 text-center font-size-14 border-top"><br />
                <strong>Deblaa &copy; 2019 | Tous droits reservés</strong><br>
                <strong>Produit de <a href="#!">IBTAGroup</a></strong><br><br>
            </div>
        </div>
    </div>
@endsection

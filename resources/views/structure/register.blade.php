@extends('layout.header')

@section('css')
    <style>
        .comfortaa {
            font-family: comfortaa;
        }

        @font-face {
            font-family: comfortaa;
            src: url(../fonts/Comfortaa-Regular.ttf);
        }
    </style>
@endsection

@section('connexion')

    @include('included.menuVisitors')

    <ol class="breadcrumb font-size-14">
        <li class="breadcrumb-item"><a href="{{ route('indexVisitors') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Inscription structure</li>
    </ol>

    <br /><br /><br />
    <div class="container comfortaa">
        <div class="row">

            <div class="col-lg-5 col-md-12 col-sm-12 font-size-14">

                <div style="border-left: 4px solid #CCC;" class="pl-4">

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @endif

                    <h5 class="comfortaa text-muted">
                        Création de compte
                    </h5>

                    <form action="{{ route('sRegisterProcessing') }}" method="post">
                        @csrf

                        <label for="nom" class="font-size-14"><b>Nom de la structure</b></label>
                        <input type="text" id="nom" name="nom"  required minlength="5" maxlength="100" class="form-control" placeholder="Saisir dans le champs ...">
                        <div class="mt-3"></div>
                        <label for="sigle" class="font-size-14"><b>Sigle</b></label>
                        <input type="text" id="sigle" name="sigle" required minlength="2" maxlength="10"  class="form-control" placeholder="Saisir dans le champs ...">
                        <div class="mt-3"></div>
                        <label for="email" class="font-size-14"><b>Email</b></label>
                        <input type="text" id="email" name="email" required maxlength="50"  class="form-control" placeholder="Saisir dans le champs ...">
                        <div class="mt-3"></div>
                        <button type="submit" class="btn btn-md btn-indigo float-right rounded mr-0">
                            S'incrire
                        </button><br />



                        <b>Déjà membre ? <a href="{{ route('sLogin') }}">Connectez-vous</a></b>
                    </form><br />
                </div><br />

            </div>
            <div class="col-lg-1 col-md-12 col-sm-12"></div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <h1>
                    <div class="deblaa comfortaa">
                        <span class="indigo-text">Deb</span><span class="orange-text">laa</span> - Structure
                    </div>
                </h1>
                <br />
                <h5 style="line-height: 35px; text-align: justify;" class="comfortaa">
                    Pour les entreprises, cabinets, instutitions privées et publiques, boutiques, magasins, individus ou groupes individuels etc.
                </h5>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="registerModel" tabindex="-1" role="dialog" aria-labelledby="regiterModel" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered" role="document">
            <div class="modal-content" style="border-radius: 25px;">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="icofont-question-circle"></i>
                        <b>Le compte sera créé pour ...</b>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12"><br />
                            <a href="">
                                <div class="card text-white bg-primary text-center" style="border-radius: 15px;">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <i class="icofont-university icofont-2x"></i><br />
                                            Une université
                                        </h4>
                                        <p class="card-text white-text">
                                            Pour les universités, istituts universitaires, écoles professionnelles etc.
                                        </p>
                                    </div>
                                </div>
                            </a><br />
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12"><br />
                            <a href="">
                                <div class="card text-white orange text-center" style="border-radius: 15px;">
                                    <div class="card-body">
                                        <h4 class="card-title">
                                            <i class="icofont-building icofont-2x"></i><br />
                                            Une structutre
                                        </h4>
                                        <p class="card-text white-text">
                                            Pour les entreprises, boutiques, individu ou groupes individuels etc.
                                        </p>
                                    </div>
                                </div>
                            </a><br />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br />

    @include('included.footerVisitors')

@endsection

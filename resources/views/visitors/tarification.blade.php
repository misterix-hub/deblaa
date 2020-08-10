@extends('layout.header')

@section('css')
    <style>
        .comfortaa {
            font-family: comfortaa;
        }
    </style>
@endsection

@section('home')
    @include('..included.navbar')
    <div class="container comfortaa">
        <div class="row" id="tarifications">
            <div class="col-12 text-center">
                <br />
                <h1 class="comfortaa">
                    <i class="icofont-money icofont-2x brown-text"></i>
                    <div class="mt-2"></div>
                    Tarifications
                </h1>
                <br /><br />
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card orange card-body">
                    <h6 class="font-weight-bold text-center comfortaa">
                        300 sms
                    </h6>
                    <div class="text-center comfortaa">
                        <h5 class="font-weight-bold white-text border-1 z-depth-2 p-3">10 000 F CFA</h5>
                    </div>
                    <div class="text-center mt-1">
                        <i class="icofont-thin-down white-text icofont-2x"></i>
                    </div>
                    <a href="" class="btn btn-block rounded btn-md btn-white z-depth-0 mt-1 disabled">
                        <b>PERSO</b>
                    </a>
                </div>
                <div class="card card-body">
                    <ul class="font-size-14 pl-4">
                        <li>
                            Possibilité de joindre des fichiers
                            <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                        </li>
                        <li>
                            sms perssonnalisé
                            <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                        </li>
                        <li>
                            Envois groupés
                            <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                        </li>
                        <li>
                            Envois uniques
                            <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                        </li>
                        <li>
                            Assistance
                            <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                        </li>
                    </ul>
                    
                </div><br />
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card blue card-body">
                    <h6 class="font-weight-bold text-center comfortaa">
                        1 200 sms
                    </h6>
                    <div class="text-center comfortaa">
                        <h5 class="font-weight-bold white-text border-1 z-depth-2 p-3">50 000 F CFA</h5>
                    </div>
                    <div class="text-center mt-2">
                        <i class="icofont-thin-down white-text icofont-2x"></i>
                    </div>
                    <a href="" class="btn btn-block rounded btn-md btn-white z-depth-0 mt-2 disabled">
                        <b>Pro</b>
                    </a>
                </div>
                <div class="card card-body">
                    <ul class="font-size-14 pl-4">
                        <li>
                            Possibilité de joindre des fichiers
                            <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                        </li>
                        <li>
                            sms perssonnalisé
                            <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                        </li>
                        <li>
                            Envois groupés
                            <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                        </li>
                        <li>
                            Envois uniques
                            <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                        </li>
                        <li>
                            Assistance
                            <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                        </li>
                    </ul>
                    
                </div><br />
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card green card-body">
                    <h6 class="font-weight-bold text-center comfortaa">
                        3 000 sms
                    </h6>
                    <div class="text-center comfortaa">
                        <h5 class="font-weight-bold white-text border-1 z-depth-2 p-3">100 000 F CFA</h5>
                    </div>
                    <div class="text-center mt-1">
                        <i class="icofont-thin-down white-text icofont-2x"></i>
                    </div>
                    <a href="" class="btn btn-block rounded btn-md btn-white z-depth-0 mt-1 disabled">
                        <b>Pro max</b>
                    </a>
                </div>
                <div class="card card-body">
                    <ul class="font-size-14 pl-4">
                        <li>
                            Possibilité de joindre des fichiers
                            <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                        </li>
                        <li>
                            sms perssonnalisé
                            <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                        </li>
                        <li>
                            Envois groupés
                            <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                        </li>
                        <li>
                            Envois uniques
                            <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                        </li>
                        <li>
                            Assistance
                            <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                        </li>
                    </ul>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-12">
                <h4 class="text-center">Inscrivez-vous et bénéficiez gratuitement de 3 sms pour commencer !</h4><br />
            </div>
            <div class="col-12">
                <center>
                    <div class="dropdown">                                                                                                                                                                                                                                                                                                                              <a href="#!" class="btn btn-orange btn-lg ml-0 rounded" id="triggerId" data-toggle="dropdown" aria-haspopu$                                            aria-expanded="false">                                                                                                                                                  <span style="font-size: 13px;">                                                                                                                                             <small>Essai gratuit !</small>                                                                                                                                      </span>                                                                                                                                                             </a>                                                                                                                                                                                                                                                                                                                                            <div class="dropdown-menu" aria-labelledby="triggerId">                                                                                                                     <a class="dropdown-item" href="{{ route('uRegister') }}">                                                                                                                   Créer un compte université                                                                                                                                          </a>                                                                                                                                                                    <a class="dropdown-item" href="{{ route('sRegister') }}">                                                                                                                   Créer un compte structure                                                                                                                                           </a>                                                                                                                                                                </div>                                                                                                                                                              </div>
                </center>
            </div>
        </div>
    </div>
    <br><br><br><br>
    @include('..included.footer')
@endsection

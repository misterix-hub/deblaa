@extends('layout.header')

@section('home')

<style>
    div.deblaa {
        font-size: 94px;
        font-family: comfortaa;
        margin-top: 75px;
    }

    div.slogan {
        font-size: 20px;
        font-weight: bold;
        line-height: 35px;
        font-family: comfortaa;
    }

    .comfortaa {
        font-family: comfortaa;
    }

    .logo {
        width: 100%;
    }

    .sm-btn-cover {
        display: none;
    }

    @font-face {
        font-family: comfortaa;
        src: url(fonts/Comfortaa-Regular.ttf);
    }

    @media(max-width: 720px) {
        .logo {
            width: 50%;
        }
        div.deblaa {
            text-align: center;
            font-size: 60px;
            margin-top: 30px;
        }
        div.slogan {
            text-align: center;
            font-size: 14px;
            line-height: 25px;
        }
        .lg-btn-cover {
            display: none;
        }
        .sm-btn-cover {
            display: block;
            text-align: center;
        }
        .sm-btn-cover a.btn {
            padding-left: 15px;
            padding-right: 15px;
            border-radius: 6px;
        }
        .footer-deb {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 10px;
        }
    }

    .bg-body {
        /*background-image: url(assets/images/1.jpg);
        background-size: contain;
        position: absolute; top: 0; right: 0; left: 0; bottom: 0;*/
    }
</style>

<div class="bg-body indigo lighten-5">

    <nav class="navbar navbar-expand-sm navbar-dark indigo">
        <a href="{{ route('indexVisitors') }}" class="comfortaa" style="margin-left: -10px; margin-right: 10px;">
            <img src="{{ URL::asset('assets/images/deblaa.png') }}" width="50" alt="logo">
        </a>
        <a class="navbar-brand comfortaa cyan-text font-weight-bold" href="{{ route('indexVisitors') }}">
            Deblaa
        </a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
            aria-expanded="false" aria-label="Toggle navigation">
            <i class="icofont-navigation-menu"></i>
        </button>
        <div class="collapse navbar-collapse comfortaa" id="collapsibleNavId">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0 font-size-14">

            </ul>
            <form class="form-inline my-2 my-lg-0" style="font-size: 13px;">

                <a class="nav-link white-text" href="#accueil"><b>Accueil</b></a>

                <a class="nav-link white-text" href="#tarifications"><b>Tarification</b></a>
		<a class="nav-link white-text" href="#contacts"><b>Contactez-nous</b></a>

                <div class="dropdown">
                    <a class="nav-link white-text" href="#" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">Créer un compte</a>

                    <div class="dropdown-menu" aria-labelledby="triggerId">
                        <a class="dropdown-item" href="{{ route('uRegister') }}">
                            Créer un compte université
                        </a>
                        <a class="dropdown-item" href="{{ route('sRegister') }}">
                            Créer un compte structure
                        </a>
                    </div>
                </div>

                <div class="dropdown">
                    <a href="{{ route('sLogin') }}" class="btn btn-white btn-md mr-0" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                        <i class="icofont-sign-in"></i>
                        <small><b>Connexion</b></small>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                        <a class="dropdown-item" href="{{ route('uLogin') }}">
                            Connexion université
                        </a>
                        <a class="dropdown-item" href="{{ route('sLogin') }}">
                            Connexion structure
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </nav>

    <div class="container">
        <div class="row" id="accueil">

            <div class="col-lg-7 col-md-12 col-sm-12">

                <div class="deblaa">
                    <span class="indigo-text">Deb</span><span class="orange-text">laa</span>
                </div><br />

                <div class="slogan">
                    Dotez-vous désormais d'une gouvernance et d'une gestion d'informations
                    professionnelles appropriées à votre contexte d'affaire
                </div><br />

                <div class="lg-btn-cover comfortaa">
                    <table>
                        <tr>
                            <td>
                                <div class="dropdown">

                                    <a href="#!" class="btn btn-orange btn-lg ml-0 rounded" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <span style="font-size: 13px;">
                                            Créer un compte
                                        </span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="{{ route('uRegister') }}">
                                            Créer un compte université
                                        </a>
                                        <a class="dropdown-item" href="{{ route('sRegister') }}">
                                            Créer un compte structure
                                        </a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="dropdown">

                                    <a href="#!" class="btn btn-indigo btn-lg ml-0 rounded" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <span style="font-size: 13px;">
                                            Connexion
                                        </span>
                                    </a>

                                    <div class="dropdown-menu" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="{{ route('uLogin') }}">
                                            Connexion université
                                        </a>
                                        <a class="dropdown-item" href="{{ route('sLogin') }}">
                                            Connexion structure
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="sm-btn-cover comfortaa">

                    <center>
                        <table>
                            <tr>
                                <td>
                                    <div class="dropdown">

                                        <a href="#!" class="btn btn-orange btn-md ml-0 rounded"style="width: 150px;" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <span style="font-size: 13px;">
                                                <small>Créer un compte</small>
                                            </span>
                                        </a>

                                        <div class="dropdown-menu" aria-labelledby="triggerId">
                                            <a class="dropdown-item" href="{{ route('uRegister') }}">
                                                Créer un compte université
                                            </a>
                                            <a class="dropdown-item" href="{{ route('sRegister') }}">
                                                Créer un compte structure
                                            </a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="dropdown">

                                        <a href="#!" class="btn btn-white btn-md ml-0 rounded"style="width: 150px;" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <span style="font-size: 13px;">
                                                <small>Connexion</small>
                                            </span>
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                            <a class="dropdown-item" href="{{ route('uLogin') }}">
                                                Connexion université
                                            </a>
                                            <a class="dropdown-item" href="{{ route('sLogin') }}">
                                                Connexion structure
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </center>

                </div>

            </div>

            <div class="col-lg-5 col-md-12 col-sm-12"><br /><br /><br />
                <!--<img src="{{ URL::asset('assets/images/chat.svg') }}" alt="" width="40%">-->
                <img src="{{ URL::asset('assets/images/transfer.png') }}" alt="" width="100%">
            </div>

        </div>
    </div>

</div>

<div class="container comfortaa">
    <div class="row">
        <div class="col-12 text-center">
            <br /><br />
            <h1 class="comfortaa font-weight-bold">
                En savoir plus sur Deblaa
            </h1>
            <br />
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 text-center">
            <h5><span class="font-weight-bold">Envois de messages groupés</span></h5>
            <div class="font-size-14">
                Envoyez un seul message pour un groupe de plusieurs contacts
                <br /><br />

                <div class="text-center">
                    <img src="{{ URL::asset('assets/images/team.svg') }}" alt="" width="70%">
                </div>
            </div><br />
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 text-center">
            <h5><span class="font-weight-bold">Personnalisation de massages</span></h5>
            <div class="font-size-14">
                Rendez vos sms plus professionnels en les personnalisant au nom de votre entreprise.
                <div class="text-center"><br /><br />
                    <img src="{{ URL::asset('assets/images/mail.svg') }}" alt="" width="55%">
                </div>
            </div><br /><br />
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 text-center">
            
            <h5 class="comfortaa font-weight-bold mb-3">Association de fichiers</h5>
            <span class="font-size-14">
                Joignez à vos sms des fichiers multimedia en pièce jointe directement accessible en ligne à travers votre téléphone mobile.
            </span>
            <br /><br />
            <h1><i class="icofont-attachment orange-text icofont-4x"></i></h1><br /><br />
        </div>
	<div class="col-lg-2 col-md-12 col-sm-12">
	</div>
    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
        <br /><br />
        <h5 class="comfortaa font-weight-bold mb-3">
            Plus de sécurité ...
        </h5>
        <span class="font-size-14">
            Sécurisez vos informations grâce à la disponibilité d'une interface personnelle et confidentielle.
        </span>
        <br /><br />
        <h1><i class="icofont-lock green-text icofont-4x"></i></h1><br /><br />
    </div>
	<div class="col-lg-4 col-md-12 col-sm-12 text-center">
    <br /><br />
        <h5><span class="font-weight-bold">Rapport et confirmation</span></h5>
        <div class="font-size-14">
            Suivez vos messages et consultez les rapports et confirmation de lecture
            <div class="text-center"><br /><br />
                <img src="{{ URL::asset('assets/images/mail2.svg') }}" alt="" width="55%" class="mt-3">
            </div>
        </div>
    </div>
	<div class="col-lg-2 col-md-6 col-sm-12">
	</div>
    </div>
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
                    1 000 messages
                </h6>
                <div class="text-center comfortaa">
                    <h5 class="font-weight-bold white-text">20 000 F CFA</h5>
                    <small class="white-text">20 F CFA par message</small>
                </div>
                <div class="text-center mt-2">
                    <i class="icofont-thin-down white-text icofont-2x"></i>
                </div>
                <a href="" class="btn btn-block rounded btn-md btn-white z-depth-0 mt-2 disabled">
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
                        Message perssonnalisé
                        <i class="icofont-close-line red-text"></i><i class="icofont-close-line red-text"></i>
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
                        <i class="icofont-close-line red-text"></i><i class="icofont-close-line red-text"></i>
                    </li>
                </ul>
		        <div class="dropdown">                                                                                                                                                                                                                                                                                                                              <a href="#!" class="btn btn-orange btn-md ml-0 rounded btn-block" id="triggerId" data-toggle="dropdown" aria-haspopu$                                            aria-expanded="false">
                        <span style="font-size: 13px;">
                            <small>Sélectionner</small>
                        </span>                                                                                                                                                             </a>                                                                                                                                                                                                                                                                                                                                            <div class="dropdown-menu" aria-labelledby="triggerId">                                                                                                                     <a class="dropdown-item" href="{{ route('uRegister') }}">
                            Compte université
                        </a>
                        <a class="dropdown-item" href="{{ route('sRegister') }}">
                            Compte structure
                        </a>
                    </div>
                </div>
            </div><br />
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="card blue card-body">
                <h6 class="font-weight-bold text-center comfortaa">
                    10 000 messages
                </h6>
                <div class="text-center comfortaa">
                    <h5 class="font-weight-bold white-text">150 000 F CFA</h5>
                    <small class="white-text">15 F CFA par message</small>
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
                        Message perssonnalisé
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
		        <div class="dropdown">                                                                                                                                                                                                                                                                                                                              <a href="#!" class="btn btn-blue btn-md ml-0 rounded btn-block" id="triggerId" data-toggle="dropdown" aria-haspopu$                                            aria-expanded="false">
                        <span style="font-size: 13px;">
                            <small>Sélectionner</small>
                        </span>                                                                                                                                                             </a>                                                                                                                                                                                                                                                                                                                                            <div class="dropdown-menu" aria-labelledby="triggerId">                                                                                                                     <a class="dropdown-item" href="{{ route('uRegister') }}">
                            Compte université
                        </a>
                        <a class="dropdown-item" href="{{ route('sRegister') }}">
                            Compte structure
                        </a>
                    </div>
                </div>
            </div><br />
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="card green card-body">
                <h6 class="font-weight-bold text-center comfortaa">
                    50 000 messages
                </h6>
                <div class="text-center comfortaa">
                    <h5 class="font-weight-bold white-text">500 000 F CFA</h5>
                    <small class="white-text">10 F CFA par message</small>
                </div>
                <div class="text-center mt-2">
                    <i class="icofont-thin-down white-text icofont-2x"></i>
                </div>
                <a href="" class="btn btn-block rounded btn-md btn-white z-depth-0 mt-2 disabled">
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
                        Message perssonnalisé
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
		<div class="dropdown">                                                                                                                                                                                                                                                                                                                              <a href="#!" class="btn btn-green btn-md ml-0 rounded btn-block" id="triggerId" data-toggle="dropdown" aria-haspopu$                                            aria-expanded="false">                                                                                                                                                  <span style="font-size: 13px;">                                                                                                                                             <small>Sélectionner</small>                                                                                                                                      </span>                                                                                                                                                             </a>                                                                                                                                                                                                                                                                                                                                            <div class="dropdown-menu" aria-labelledby="triggerId">                                                                                                                     <a class="dropdown-item" href="{{ route('uRegister') }}">                                                                                                                   Compte université                                                                                                                                          </a>                                                                                                                                                                    <a class="dropdown-item" href="{{ route('sRegister') }}">                                                                                                                  Compte structure                                                                                                                                           </a>                                                                                                                                                                </div>                                                                                                                                                              </div>
            </div>
        </div>
	<div class="col-12 text-center"><br />
	    <h4>Inscrivez-vous et bénéficiez gratuitement de 10 messages pour commencer !</h4><br />
	    <center>
		<div class="dropdown">                                                                                                                                                                                                                                                                                                                              <a href="#!" class="btn btn-orange btn-lg ml-0 rounded" id="triggerId" data-toggle="dropdown" aria-haspopu$                                            aria-expanded="false">                                                                                                                                                  <span style="font-size: 13px;">                                                                                                                                             <small>Essai gratuit !</small>                                                                                                                                      </span>                                                                                                                                                             </a>                                                                                                                                                                                                                                                                                                                                            <div class="dropdown-menu" aria-labelledby="triggerId">                                                                                                                     <a class="dropdown-item" href="{{ route('uRegister') }}">                                                                                                                   Créer un compte université                                                                                                                                          </a>                                                                                                                                                                    <a class="dropdown-item" href="{{ route('sRegister') }}">                                                                                                                   Créer un compte structure                                                                                                                                           </a>                                                                                                                                                                </div>                                                                                                                                                              </div>
	    </center>
	</div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-6 text-center">
            <br /><br /><br /><br />
            <h3 class="comfortaa">
                <img src="{{ URL::asset('assets/images/deblaa.png') }}" alt="logo" width="100">
                <div class="mt-2"></div>
                Commencer avec Deblaa
            </h3>
            <br />
            <div class="dropdown">

                <a href="#!" class="btn btn-orange btn-lg ml-0 rounded" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span style="font-size: 13px;">
                        <small>Créer un compte</small>
                    </span>
                </a>

                <div class="dropdown-menu" aria-labelledby="triggerId">
                    <a class="dropdown-item" href="{{ route('uRegister') }}">
                        <b>Créer un compte université</b>
                    </a>
                    <a class="dropdown-item" href="{{ route('sRegister') }}">
                        <b>Créer un compte structure</b>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <br /><br />

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            <h3 class="comfortaa">Nous contacter</h3>
            <hr>
            <form action="{{ route('messageSendByUsers') }}" id="contacts" method="post" class="comfortaa">
                @csrf
               <div class="form-row mb-2">
                   <div class="col">
                       <label for="sigle">Sigle:</label>
                       <input type="text" name="sigle" id="sigle" class="form-control" value="{{ old('sigle') }}" required>
                   </div>
                   <div class="col">
                       <label for="email">E-mail:</label>
                       <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                   </div>
               </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea name="message" id="message" cols="30" rows="10" class="form-control" style="min-height: 200px;" ></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-blue" id="sendMessage">ENVOYER</button>
                </div>
            </form>
            <div>
                <i class="icofont icofont-google-map icofont-2x"></i><span class="mr-3"> Agoè, Togo</span>
                <i class="icofont icofont-android-nexus icofont-2x"></i><span> 00228 91 01 92 45 | 97 53 17 17</span>
            </div>
        </div>
    </div>
</div><br /><br /><br /><br />

<div class="font-size-14">

    <div class="container">
        <div class="row">
            <div class="col-12">
                <span class="font-weight-bold">Deblaa &copy; 2020</span><br />
                <a href="">
                    <i class="icofont-license"></i>
                    <b>Termes et conditions</b>
                </a>&nbsp;&nbsp;&nbsp;
                <a href="">
                    <i class="icofont-lock"></i>
                    <b>Confidentialités</b>
                </a>
                <span class="float-right">
                    Produit de :
                    <a target="_blank" href="#!">
                        <b>IBTAGroup</b>
                    </a>
                </span>
            </div>
        </div>
    </div>

</div><br />

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('a[href^="#"]').click(function (evt) {
                evt.preventDefault();
                let target = $(this).attr('href');

                $('html, body').stop().animate({scrollTop: $(target).offset().top}, 1000);
            });
        });
    </script>
@endsection

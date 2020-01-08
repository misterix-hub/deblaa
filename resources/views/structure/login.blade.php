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
        <li class="breadcrumb-item active">Connexion structure</li>
    </ol>

    <br /><br /><br />
    <div class="container">
        <div class="row">
            
            <div class="col-lg-5 col-md-12 col-sm-12 font-size-14">

                <div style="border-left: 4px solid #CCC;" class="pl-4">
                    
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @endif

                    @if ($messageReset = Session::get('successReset'))
                        <div class="alert alert-success">
                            {{ $messageReset }}
                        </div>
                    @endif

                    <h5 class="comfortaa text-muted">                    
                        Connexion à un compte
                    </h5>
    
                    <form action="{{ route('sLoginProcessing') }}" method="post">
                        @csrf
    
                        <label for="email" class="font-size-14">Email</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="Saisir dans le champs ..." value="{{ old('email') }}">
                        <div class="mt-3"></div>
                        <label for="password" class="font-size-14">Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Saisir dans le champs ...">
                        <div class="mt-3"></div>
                        <button type="submit" class="btn btn-md btn-indigo float-right rounded mr-0">
                            Se connecter
                        </button><br />
    
                        <a href="{{ route('sResetPassword') }}">
                            <b>Mot de passe oublié ?</b>
                        </a><hr />
    
                        <b>Pas encore de compe ? <a href="{{ route('sRegister') }}">Créer un compte</a></b>
                    </form><br />
                </div><br /><br />

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
                    Si vous n'avez pas encore de compte, n'attendez pas plus longtemps pour vous inscrire.
                    C'est gratuit et en plus ça prend moins de 2 minutes.
                </h5>
                <a href="{{ route('sRegister') }}" class="float-right mr-0 btn btn-lg btn-orange rounded">
                    Créer un compte
                </a>
            </div>
        </div>
    </div>
    
    @include('included.footerVisitors')

@endsection

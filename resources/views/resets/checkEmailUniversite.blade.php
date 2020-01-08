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

@section('resetPassword')

    @include('included.menuVisitorsUniv')

    <ol class="breadcrumb font-size-14">
        <li class="breadcrumb-item"><a href="{{ route('indexVisitors') }}">Accueil</a></li>
        <li class="breadcrumb-item"><a href="{{ route('uLogin') }}">Connexion université</a></li>
        <li class="breadcrumb-item active">Réinitialiser mot de passe</li>
    </ol>

    <br /><br />

    <div class="container mb-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-4 col-md-12 col-sm-12 font-size-14 mb-5">

                <h4 class="text-center"><i class="icofont-refresh icofont-2x mb-2"></i></h4>
                <h4 class="text-muted text-center">
                   <b>Réinitialisation mot de passe</b>
                </h4>
                <br />

                <p>Veuillez renseigner votre adresse électronique dans le champs ci-dessous.
                    Un mot de passe vous sera envoyé à cette adresse vous permettant de vous connecter.</p>

                @if( $message = Session::get('error'))
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @endif

                <form action="{{ route('uResetPasswordProcessing') }}" method="post">
                    @csrf

                    <input type="text" id="email" name="email" required class="form-control" placeholder="Saisir votre adresse email ....." value="{{ old('email') }}">
                    <button type="submit" class="btn btn-md btn-indigo float-right rounded mr-0">
                        Valider
                    </button><br />

                </form>

            </div>
        </div>
    </div>

    @include('included.footerVisitorsUniv')

@endsection

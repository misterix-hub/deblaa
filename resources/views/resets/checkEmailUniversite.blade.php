@extends('layout.header')

@section('resetPassword')

    @include('included.menuVisitorsUniv')

    <ol class="breadcrumb font-size-14">
        <li class="breadcrumb-item"><a href="#">Accueil</a></li>
        <li class="breadcrumb-item active">Réinitialiser mot de passe</li>
    </ol>

    <br /><br /><br />

    <div class="container mb-5">
        <div class="row justify-content-center mb-5">
            <div class="col-lg-6 col-md-12 col-sm-12 font-size-14 mb-5">

                @if( $message = Session::get('error'))
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @endif

                <h3 class="text-muted text-center">
                    <div class="deblaa comfortaa">
                        <span class="indigo-text">Deb</span><span class="orange-text">laa</span> - Université
                    </div>
                    <br />
                    Processus de réinitialisation mot de passe
                </h3>
                <br />

                <p>Veuillez renseigner votre adresse électronique dans le champs ci-dessous.
                    Un mot de passe vous sera envoyé à cette adresse vous permettant de vous connecter.</p>

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

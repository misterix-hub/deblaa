@extends('layout.header')

@section('connexion')

    <div class="indigo pt-1 pb-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <img src="{{ URL::asset('assets/images/deblaa.png') }}" alt="logo-deblaa" width="55">
                </div>
            </div>
        </div>
    </div>
    <br /><br /><br />
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12">

            </div>
            <div class="col-lg-4 col-md-12 col-sm-12 font-size-14">

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @endif

                <div class="card card-body border border-primary">
                    <div>
                        <h5>
                            <span class="font-weight-bold">Connexion</span> -
                            <span class="red-text">compte utilisateur</span>
                        </h5>
                    </div><br />

                    <form action="{{ route('mLoginProcessing') }}" method="post">
                        @csrf

                        <label for="telephone" class="font-size-14">Numéro de téléphone</label>
                        <input type="text" id="telephone" name="telephone" class="form-control" placeholder="Saisir dans le champs ...">
                        <div class="mt-3"></div>
                        <label for="password" class="font-size-14">Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Saisir dans le champs ...">
                        <div class="mt-3"></div>
                        <button type="submit" class="btn btn-md btn-primary float-right rounded mr-0">
                            Se connecer
                        </button><br /><br />

                        <a href="">
                            Mot de passe oublié ?
                        </a><hr />

                        Si vous n'avez pas encore de compte, <a href="">cliquez ici</a>
                        Pour vous informer de comment avoir un compte.

                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">

            </div>
        </div>
    </div>

@endsection

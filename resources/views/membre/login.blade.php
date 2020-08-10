@extends('layout.header')

@section('connexion')

    <div class="div indigo">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div>
                        <table width="100%">
                            <tr>
                                <td class="pt-2">
                                    <a href="{{ route('indexVisitors') }}" class="comfortaa" style="margin-left: -10px;">
                                        <img src="{{ URL::asset('assets/images/deblaa.png') }}" width="50" alt="logo">
                                    </a>
                                </td>
                                <td class="text-right">
                                    <a href="#!" class="black-text" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                        <i class="icofont-navigation-menu white-text" style="font-size: 24px;"></i>
                                    </a>
                                    <div class="dropdown-menu font-size-14">
                                        <a class="dropdown-item" href="{{ route('eLogin') }}">
                                            <i class="icofont-university brown-text"></i>
                                            Espace université
                                        </a>
                                        <a class="dropdown-item" href="{{ route('mLogin') }}">
                                            <i class="icofont-building yellow-text"></i>
                                            Espace structure
                                        </a>
                                    <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">
                                            <i class="icofont-info-circle cyan-text"></i>
                                            À porpos de nous
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="icofont-google-map red-text"></i>
                                            Où nous trouver ?
                                        </a>
                                        <a class="dropdown-item" href="#">
                                            <i class="icofont-handshake-deal"></i>
                                            Partenaires
                                        </a>
                                    </div>
                                    <!-- Basic dropdown -->
                                </td>
                            </tr>
                        </table>
                    </div>
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

                @if($errors->any())
                    <ul class="alert alert-danger alert-dismissible list-unstyled fade show" role="alert">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">x</span>
                        </button>
                    </ul>
                @endif

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

                    <form action="{{ route('mLoginProcessing') }}" method="post" id="mLoginProcessingForm">
                        @csrf

                        <label for="telephone" class="font-size-14">Numéro de téléphone</label>
                        <input type="text" id="telephone" name="telephone" class="form-control" placeholder="Exemple: +22891019245">
                        <div class="mt-3"></div>
                        <label for="password" class="font-size-14">Mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Saisir dans le champs ...">
                        <div class="mt-3"></div>
                        <button type="submit" class="btn btn-md btn-primary float-right rounded mr-0" id="mLoginProcessingButton">
                            Se connecter
                        </button><br /><br />

                        <a href="">
                            Mot de passe oublié ?
                        </a><hr />

                        Si vous n'avez pas encore de compte, <a href="#">cliquez ici</a>
                        Pour vous informer de comment avoir un compte.

                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">

            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#mLoginProcessingForm').on('submit', function() {
                $('#mLoginProcessingButton').attr('disabled', true);
            });
        });
    </script>
    
@endsection

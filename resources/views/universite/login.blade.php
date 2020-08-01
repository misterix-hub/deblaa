@extends('layout.header')

@section('css')
    <style>
        .comfortaa {
            font-family: comfortaa;
        }

        @font-face {
            font-family: comfortaa;
            src: url('{{ URL::asset('fonts/Comfortaa-Regular.ttf') }}');
        }
    </style>
@endsection

@section('connexion')

    @include('included.menuVisitorsUniv')

    <ol class="breadcrumb font-size-14">
        <li class="breadcrumb-item"><a href="{{ route('indexVisitors') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Connexion université</li>
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

                    @if ($messageReset = Session::get('successReset'))
                        <div class="alert alert-success">
                            {{ $messageReset }}
                        </div>
                    @endif

                    <h5 class="comfortaa text-muted">
                        Connexion à un compte
                    </h5>

                    <form action="{{ route('uLoginProcessing') }}" method="post">
                        @csrf

                        <label for="email" class="font-size-14">Email</label>
                        <input type="text" id="email" name="email" class="form-control" placeholder="Saisir dans le champs ..." value="{{ (session()->has('email')) ? session()->get('email') : '' }}">
                        <div class="mt-3"></div>
                        <div class="form-group">
                            <label for="password" class="font-size-14">Mot de passe</label>
                            <div class="input-group">
                                <div class="input-group-append">
                                    <div class="input-group-text firstEye py-1" style="cursor: pointer;"><i class="icofont-eye-alt"></i></div>
                                    <div class="input-group-text secondEye py-1" style="display:none; cursor: pointer;"><i class="icofont-eye-blocked"></i></div>
                                </div>
                                <input type="password" id="password" name="password" class="form-control" placeholder="Saisir dans le champs ...">
                            </div>
                        </div>
                        <div class="mt-3"></div>
                        <button type="submit" class="btn btn-md btn-indigo float-right rounded mr-0 spinnerShower">
                            Se connecter
                        </button><br />

                        <a href="{{ route('uResetPassword') }}">
                            <b>Mot de passe oublié ?</b>
                        </a><hr />

                        <b>Pas encore de compe ? <a href="{{ route('uRegister') }}">Créer un compte</a></b>
                    </form><br />
                </div><br /><br />

            </div>
            <div class="col-lg-1 col-md-12 col-sm-12"></div>
            <div class="col-lg-6 col-md-12 col-sm-12">
                <h1>
                    <div class="deblaa comfortaa">
                        <span class="indigo-text">Deb</span><span class="orange-text">laa</span> - Université
                    </div>
                </h1>
                <br />
                <h5 style="line-height: 35px; text-align: justify;" class="comfortaa">
                    Si vous n'avez pas encore de compte, n'attendez pas plus longtemps pour vous inscrire.
                    C'est gratuit et en plus ça prend moins de 2 minutes.
                </h5>
                <a href="{{ route('uRegister') }}" class="float-right mr-0 btn btn-lg btn-orange rounded">
                    Créer un compte
                </a>
            </div>
        </div>
    </div><br />

    @include('included.footerVisitorsUniv')

@endsection

@section('scriptJs')
    <script !src="">
        $(document).ready(function () {
            $('.firstEye').click(function () {
                $(this).css('display', 'none');
                $('.secondEye').css('display', 'block');
                $('#password').attr('type', 'text')
            });

            $('.secondEye').click(function () {
                $(this).css('display', 'none');
                $('.firstEye').css('display', 'block');
                $('#password').attr('type', 'password')
            })
        })
    </script>
@endsection

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

    @include('included.menuVisitors')

    <ol class="breadcrumb font-size-14">
        <li class="breadcrumb-item"><a href="{{ route('indexVisitors') }}">Accueil</a></li>
        <li class="breadcrumb-item active">Inscription université</li>
    </ol>

    <br /><br /><br />
    <div class="container comfortaa">
        <div class="row">

            <div class="col-lg-5 col-md-12 col-sm-12 font-size-14">

                <div style="border-left: 4px solid #CCC;" class="pl-4">

                    @if($errors->any())
                        <ul class="alert alert-danger alert-dismissible list-unstyled fade show" role="alert">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                            <button type="button" data-dismiss="alert" class="close" aria-label="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </ul>
                    @endif

                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                            {{ $message }}
                            <button type="button" class="close" aria-label="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <h5 class="comfortaa text-muted">
                        Création de compte
                    </h5>

                    <form action="{{ route('uRegisterProcessing') }}" method="post" class="uRegisterProcessingForm">
                        @csrf

                        <label for="nom" class="font-size-14"><b>Nom de l'université</b></label>
                        <input type="text" id="nom" name="nom"  required minlength="1" maxlength="100" class="form-control" placeholder="Saisir dans le champs ...">
                        <div class="mt-3"></div>
                        <label for="sigle" class="font-size-14"><b>Sigle</b></label>
                        <input type="text" id="sigle" name="sigle" required minlength="2" maxlength="11"  class="form-control" placeholder="Saisir dans le champs ...">
                        <small class="small">Votre sigle doit être entre 2 et 11 caractères</small>
                        <div class="mt-3"></div>
                        <label for="email" class="font-size-14"><b>Email</b></label>
                        <input type="text" id="email" name="email" required maxlength="50"  class="form-control" placeholder="Saisir dans le champs ...">
                        <div class="mt-3"></div>
                        <button type="submit" class="btn btn-md btn-indigo float-right rounded mr-0 spinnerShower uRegisterProcessingButton">
                            S'incrire
                        </button><br />



                        <b>Déjà membre ? <a href="{{ route('uLogin') }}" class="uRegisterProcessingButton">Connectez-vous</a></b>
                    </form><br />
                </div><br />

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
                    Universités, Instituts universitaires, Écoles, Centres de formations, Etablissements d'études, Écoles professionnelles etc.
                </h5>
            </div>
        </div>
    </div><br />

    @include('included.footerVisitors')

@endsection


@section('scriptJs')
    <script>
        $(document).ready( function () {
            $('#sigle').keypress( function () {
                let maxlength = $('#sigle').attr('maxlength');
                let sigle = $(this).val().length
                if ( parseInt(maxlength) === sigle ) {
                    alert('Le nombre maximal de caractères pour le sigle est atteint');
                }
            });
            $('#sigle').focusout( function () {
                let minlength = $('#sigle').attr('minlength');
                let sigle = $(this).val().length
                if ( parseInt(minlength) > sigle ) {
                    alert('Votre sigle doit avoir au moins deux caractères');
                }
            });

            $('#uRegisterProcessingForm').on('submit', function() {
                $('.RegisterProcessingButton').attr('disabled', true);
            });
        })
    </script>
@endsection

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('mdb/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('mdb/css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('icofont/icofont.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('dataTable/dataTable.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('mdb/css/style.css') }}">
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/deblaa.png') }}" type="image/x-icon">
    <title>Deblaa</title>
</head>
<style>

    div.deblaa {
        
        font-size: 94px;
        font-family: comfortaa;
        margin-top: 70px;
    }

    .mmsText {
        font-size: 60px;
        font-family: comfortaa;
    }

    .comfortaa {
        font-family: comfortaa;
    }

    @font-face {
        font-family: comfortaa;
        src: url(fonts/Comfortaa-Regular.ttf);
    }
    
    @media(max-width: 720px) {
        div.deblaa {
            font-size: 60px;
            font-family: comfortaa;
            margin-top: 130px;
        }

        .mmsText {
            font-size: 25px;
            font-family: comfortaa;
        }
    }

    body {
        background-image: url(assets/images/1.jpg);
    }
</style>
<body>
    @include('..included.navbar')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="deblaa text-center">
                    <span class="indigo-text">Deb</span><span class="orange-text">laa</span>
                </div>

                <div class="mmsText text-center text-white">
                    <span>Professionnal Connection Gate</span>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <div class="dropdown">

                <a href="#!" class="btn btn-orange btn-md ml-0 rounded"style="width: 150px;" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span style="font-size: 13px;">
                        <small>Créer un compte</small>
                    </span>
                </a>

                <div class="dropdown-menu" aria-labelledby="triggerId">
                    <a class="dropdown-item spinnerShower" href="{{ route('uRegister') }}">
                        Créer un compte université
                    </a>
                    <a class="dropdown-item spinnerShower" href="{{ route('sRegister') }}">
                        Créer un compte structure
                    </a>
                </div>
            </div>

            <div class="dropdown">

                <a href="#!" class="btn btn-white btn-md ml-0 rounded"style="width: 150px;" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <span style="font-size: 13px;">
                        <small>Connexion</small>
                    </span>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                    <a class="dropdown-item spinnerShower" href="{{ route('uLogin') }}">
                        Connexion université
                    </a>
                    <a class="dropdown-item spinnerShower" href="{{ route('sLogin') }}">
                        Connexion structure
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{ URL::asset('mdb/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('mdb/js/popper.js') }}"></script>
    <script src="{{ URL::asset('mdb/js/mdb.min.js') }}"></script>
    <script src="{{ URL::asset('mdb/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('dataTable/jquery.dataTable.min.js') }}"></script>
    <script src="{{ URL::asset('dataTable/dataTable.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('.spinnerShower').click( function () {
                $('#spinner').fadeIn();
            })
            $('#example').DataTable();

            $('.allNiveaux0').change(function () {
                $('.niveauCheckBox0').prop("checked", $(this).prop("checked"));
            });
        })
    </script>
    @yield('script')
    @yield('scriptJs')
</body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ URL::asset('mdb/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('mdb/css/mdb.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('icofont/icofont.min.css') }}">

    <link rel="stylesheet" href="{{ URL::asset('dataTable/dataTable.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('mdb/css/style.css') }}">
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/deblaa.png') }}" type="image/x-icon">
    <style>
        .comfortaa {
            font-family: comfortaa;
        }
    
        @font-face {
            font-family: comfortaa;
            src: url(fonts/Comfortaa-Regular.ttf);
        }
    </style>
    @yield('css')
    <title>Deblaa</title>
</head>
<body class="body">

    @yield('sideBar')
    @yield('inboxs')
    @yield('connexion')
    @yield('home')
    @yield('resetPassword')
    @yield('alertMessage')

    {{-- Spinner --}}
    <div id="spinner" style="display: none; position: absolute; top: 0; bottom: 0; line-height:100%; left: 0; right: 0; background-color: rgba(0,0,0, 0.5)">
        <div class="text-center" style="margin-top: 200px;">
            <img src="{{ URL::asset('assets/spinner.svg') }}" alt="loading ..." width="100px;">
        </div>
    </div>
    {{-- /.Spinner --}}


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

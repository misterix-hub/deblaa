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
    @yield('css')
    <title>Deblaa | Université</title>
</head>
<body>

    @yield('sideBar')
    @yield('inboxs')
    @yield('connexion')
    @yield('home')

    <script src="{{ URL::asset('mdb/js/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('mdb/js/popper.min.js') }}"></script>
    <script src="{{ URL::asset('mdb/js/mdb.min.js') }}"></script>
    <script src="{{ URL::asset('mdb/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('dataTable/jquery.dataTable.min.js') }}"></script>
    <script src="{{ URL::asset('dataTable/dataTable.bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('ckeditor/ckeditor.js') }}"></script>
    @yield('script')
    
</body>
</html>

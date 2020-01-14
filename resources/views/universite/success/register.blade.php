@extends('layout.header')

@section('css')
    <style>
        .comfortaa {
            font-family: comfortaa;
        }

        @font-face {
            font-family: comfortaa;
            src: url(../../fonts/Comfortaa-Regular.ttf);
        }
    </style>
@endsection

@section('connexion')
    
    @include('included.menuVisitors')

    <br /><br /><br /><br />
    <div class="container">
        <div class="row">

            @if($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif
            
            <div class="col-lg-3 col-md-12 col-sm-12 font-size-14"></div>
            <div class="col-lg-6 col-md-12 col-sm-12 text-center">
                <div class="alert alert-success font-size-14" role="alert">
                    <i class="icofont-envelope icofont-3x"></i><br />
                    <h4><b>Vérifiez votre boite mail</b></h4>
                    <b>Un mail vient d'être envoyé à l'adresse que vous avez saisi. Vérifiez votre boite mail
                    pour la suite de l'opération.</b>
                </div>
            </div>
            <div class="col-lg-3 col-md-12 col-sm-12"></div>
        </div>
    </div><br /><br /><br /><br /><br /><br /><br /><br />

    @include('included.footerVisitors')

@endsection

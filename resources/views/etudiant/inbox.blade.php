@extends('layout.sideBarEtudiant')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12">
                <h3>Titre du message ici à cet endroit</h3>

                <div>
                    Lorem ipsum dolor sit amet, cons
                    ectetur adipisicing elit. Neque
                    aperiam error, quos dolores cupi
                    ditate perspiciatis. Ad minima
                    incidunt fugiat quibusdam quas
                    ducimus nisi nihil maxime.
                    Doloribus expedita est quo quis?
                </div><br />
                <small>
                    <i class="icofont-history"></i>
                    Date d'envoi : 2019-05-10 15:45
                </small>
            </div>
            <div class="col-lg-4 col-md-12 col-sm-12">
                <i class="icofont-paper-clip"></i>
                <b class="font-weight-bold">
                    Pièce jointe
                </b><br /><br />
                <img src="{{ URL::asset('db/logos/universite/logo.jpg') }}" alt="logo-université" width="100%">
                <a download href="" class="btn btn-md btn-orange btn-block">
                    <i class="icofont-download"></i>
                    Télécharger [2.04 <span style="text-transform: capitalize;">Mo</span>]
                </a><br /><br />
                Type de fichier: <b>Image</b><br />
                Taille : <b>2.04 Mo</b><br />
            </div>
        </div>
    </div>
@endsection
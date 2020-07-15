@extends('layout.sideBarStructure')

@section('content')
    <div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-12 col-sm-12 col-12 mt-4">
                    <div class="bg-info text-white py-2 px-3 border border-light mb-3">
                        <i class="icofont-exclamation-circle"></i><span class="font-italic">Voici les listes des groupes renfermant vos contacts. Veuillez cliquer sur le groupe que vous voulez et sélectionner ses contacts.</span>
                    </div>
                    @foreach($groupes as $groupe)
                        <div class="list-group">
                            <div class="list-group-item d-block d-lg-none mb-4">
                                <a href="{{ route('sListContactByDepartment', $groupe->id) }}" class="text-center text-dark text-decoration-none">{{ $groupe->nom }}</a>
                            </div>
                            <div class="list-group-item d-none d-lg-block mb-4">
                                <i class="icofont-2x icofont-arrow-right"></i>
                                <a href="{{ route('sListContactByDepartment', $groupe->id) }}" class="px-5 py-4 icofont-2x text-center text-dark text-decoration-none">{{ $groupe->nom }}</a>
                            </div>
                        </div>
                    @endforeach
                    <a href="{{ route('sListeGroupe') }}" class="btn btn-light btn-md float-right px-5">Retour</a>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12  menu-item-sm-hide">

                    @include('included.sideBarRight')

                </div>
                <div class="col-12 text-center font-size-14 border-top"><br />
                    <b>Deblaa &copy; 2019 | Tous droits réservés</b><br />
                    <b>Produit de <a href="#!">IBTAGroup</a></b><br /><br />
                </div>
            </div>
        </div>
    </div>
@endsection

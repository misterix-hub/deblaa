@extends('layout.sideBarUniversite')

@section('content')

    <div class="">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12" style="border-right: 1px solid #CCC;">

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            @if($errors->any())
                                <ul class="alert alert-danger list-unstyled mt-3 alert-dismissible fade show" role="alert">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </ul>
                            @endif

                            @if($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" aria-label="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" aria-label="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <br />
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="float-right">
                                        <a href="{{ route('uListeEtudiant') }}" class="btn btn-grey btn-sm"><i class="icofont-listine-dots"></i> Liste des étudiants</a>
                                        <a href="#!" data-toggle="modal" data-target="#filiereModal" class="btn btn-primary btn-sm"><i class="icofont-plus-circle"></i> Ajouter une filière</a>
                                    </div>

                                </div>
                            </div>
                            <h3><i class="icofont-listine-dots"></i> Liste des filières</h3>

                            <table class="table table-hover table-bordered table-sm table-responsive-sm" width="100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <b>Nom de la filière</b>
                                        </th>
                                        <th width="200">
                                            <b>Niveaux</b>
                                        </th>
                                        <th width="250">
                                            <b>Opération</b>
                                        </th>
                                        <th class="text-center" width="120">
                                            <b>Action</b>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($filieres as $filiere)
                                        <tr>
                                            <td>
                                                <b>{{ $filiere->nom }}</b>
                                            </td>
                                            <td>
                                                <ul class="m-0">
                                                    @foreach ($filiere_niveaux as $filiere_niveau)
                                                        @if ($filiere_niveau->filiere_id == $filiere->id)
                                                            <li>
                                                                {{ $filiere_niveau->nom }}
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('uCreateEtudiant', $filiere->id) }}" class="btn btn-success btn-sm">Ajouter membre</a>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('uDetailsFiliere', $filiere->id) }}" class="btn btn-sm btn-outline-grey rounded z-depth-0 pl-2 pr-2">
                                                    <i class="icofont-plus"></i>
                                                </a>
                                                <a href="{{ route('uModifierFiliere', $filiere->id) }}" class="btn btn-sm btn-outline-blue rounded z-depth-0 pl-2 pr-2">
                                                    <i class="icofont-edit"></i>
                                                </a>
                                                <a href="{{ route('uSupprimerFiliere', $filiere->id) }}" onclick="return confirm('Êtes-vous sur(e) de vouloir supprimer {{ $filiere->nom }} ? Tous les étudiants de cette filière seront également supprimés.')"
                                                    class="btn btn-sm btn-outline-danger rounded z-depth-0 pl-2 pr-2">
                                                    <i class="icofont-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <b>Pas de filière</b>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <b>Nom de la filière</b>
                                        </th>
                                        <th width="200">
                                            <b>Niveaux</b>
                                        </th>
                                        <th width="250">
                                            <b>Opération</b>
                                        </th>
                                        <th class="text-center" width="120">
                                            <b>Action</b>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-12 col-sm-12  menu-item-sm-hide">

                    @include('included.sideBarRightUniv')

                </div>
                <div class="col-12 text-center font-size-14 border-top"><br />
                    <b>Deblaa &copy; 2019 | Tous droits réservés</b><br />
                    <b>Produit de <a href="#!">IBTAGroup</a></b><br /><br />
                </div>
            </div>
        </div>

    </div>

@endsection

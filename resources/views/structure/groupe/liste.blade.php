@extends('layout.sideBarStructure')

@section('content')
    <div class="">
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12" style="border-right: 1px solid #CCC;">
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
            
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    {{ $message }}
                                </div>
                            @endif
            
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @endif
                            <br />
                            <h6>
                                <i class="icofont-listine-dots"></i>
                                <b>Liste des groupes</b>
                            </h6>
            
                            <table class="table table-hover table-bordered table-sm" width="100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <b>Nom du groupe</b>
                                        </th>
                                        <th class="text-center" width="120">
                                            <b>Action</b>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($groupes as $groupe)
                                        <tr>
                                            <td>
                                                {{ $groupe->nom }}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('sDetailsGroupe', $groupe->id) }}" class="btn btn-sm btn-outline-grey rounded z-depth-0 pl-2 pr-2">
                                                    <i class="icofont-plus"></i>
                                                </a>
                                                <a href="{{ route('sModifierGroupe', $groupe->id) }}" class="btn btn-sm btn-outline-blue rounded z-depth-0 pl-2 pr-2">
                                                    <i class="icofont-edit"></i>
                                                </a>
                                                <a href="{{ route('sSupprimerGroupe', $groupe->id) }}" onclick="return confirm('Êtes-vous sur(e) de vouloir supprimer {{ $groupe->nom }} ? Tous les membres de ce groupe seront également supprimés.')"
                                                    class="btn btn-sm btn-outline-danger rounded z-depth-0 pl-2 pr-2">
                                                    <i class="icofont-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">
                                                <b>Pas de groupe</b>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <b>Nom du groupe</b>
                                        </th>
                                        <th class="text-center">
                                            <b>Action</b>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-12 col-sm-12  menu-item-sm-hide">
                    
                    @include('included.sideBarRight')

                </div>
                <div class="col-12 text-center font-size-14 border-top"><br />
                    <b>Deblaa &copy; 2019 | Tous droits réservés</b><br />
                    <b>Produit de <a href="">IBTAGroup</a></b><br /><br />
                </div>
            </div>
        </div>

    </div>
@endsection

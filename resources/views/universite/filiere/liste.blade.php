@extends('layout.sideBarUniversite')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-listine-dots"></i> Liste filières</h3>
            </div>
            <div class="col-lg-10 col-md-12 col-sm-12"><br />

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

                <table class="table table-hover table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>
                                <b>Nom de la filière</b>
                            </th>
                            <th width="200">
                                <b>Niveaux</b>
                            </th>
                            <th class="text-center" width="250">
                                <b>Action</b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($filieres as $filiere)
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
                                    <a href="{{ route('uDetailsFiliere', $filiere->id) }}" class="btn btn-sm btn-white">
                                        <i class="icofont-plus"></i>
                                    </a>
                                    <a href="{{ route('uModifierFiliere', $filiere->id) }}" class="btn btn-sm btn-blue">
                                        <i class="icofont-edit"></i>
                                    </a>
                                    <a href="{{ route('uSupprimerFiliere', $filiere->id) }}" onclick="return confirm('Êtes-vous sur(e) de vouloir supprimer {{ $filiere->nom }} ?')" class="btn btn-sm btn-danger">
                                        <i class="icofont-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    <b>Aucune filière</b>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
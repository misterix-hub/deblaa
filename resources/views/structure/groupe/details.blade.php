@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if($errors->any())
                    <ul class="alert alert-danger list-unstyled mt-3 alert-dismissible fade show" role="alert">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">x</span>
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
                <h6><i class="icofont-edit"></i> Détails groupe</h6>
                <div class="btn-group">
                    <button type="button" class="btn btn-success btn-sm">Ajouter membre</button>
                    <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{ $groupe->pathAddMembersByList() }}">Mes contacts</a>
                        <a class="dropdown-item" href="{{ $groupe->pathAddMember() }}">Nouveau</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12"><br />
                Nom du groupe :
                <b class="font-weight-bold">{{ $groupe->nom }}</b><br /><br />

                Nombre de membres :
                <b class="font-weight-bold">{{ count(\App\User::where('departement_id', $groupe->id)->get()) }}</b><br /><br />

                <b>Membres</b> : <br>
                    <table class="table table-sm table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Noms et Prénoms</th>
                                <th width="100">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\User::where('departement_id', $groupe->id)->orderByDesc('id')->get() as $groupe_nom)
                                <tr>
                                    <td class="text-uppercase font-weight-bold">{{ $groupe_nom->name }}</td>
                                    <form action="{{ route('sDeleteMemberByDepartment', [$groupe_nom->telephone, $groupe->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <td class="text-center">
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded z-depth-0 pl-2 pr-2" onclick="return confirm('Êtes-vous sur(e) de vouloir supprimer {{ $groupe_nom->name }} dans ce groupe ?')">
                                                <i class="icofont-trash"></i> Suprrimer
                                            </button>
                                        </td>
                                    </form>
                                </tr>
                            @endforeach
                        </tbody> 
                    </table>
                <br><br>
                <div>
                    <a href="{{ $groupe->pathModifier() }}" class="btn btn-md btn-indigo ml-0 rounded">
                        Modifier
                    </a>
                    <a href="{{ route('sListeGroupe') }}" class="btn btn-md btn-light rounded">
                        Retour
                    </a>
                </div>

            </div>
        </div>
    </div>
@endsection

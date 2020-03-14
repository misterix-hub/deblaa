@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h6><i class="icofont-edit"></i> Détails groupe</h6>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12"><br />
                Nom du groupe :
                <b class="font-weight-bold">{{ $groupe->nom }}</b><br /><br />

                Nombre de membres :
                <b class="font-weight-bold">{{ count(\App\User::where('departement_id', $groupe->id)->get()) }}</b><br /><br />

                <b>Membres</b> : <br>
                    <table class="table table-sm table-striped table-bordered">
                        @foreach(\App\User::where('departement_id', $groupe->id)->get() as $groupe_nom)
                            <tr>
                                <td class="text-uppercase font-weight-bold">{{ $groupe_nom->name }}</td>
                            </tr>
                        @endforeach
                    </table>
                <br><br>
                <div>
                    <a href="{{ route('sModifierGroupe', $groupe->id) }}" class="btn btn-md btn-indigo ml-0 rounded">
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

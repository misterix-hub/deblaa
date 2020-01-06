@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h6><i class="icofont-edit"></i> Détails groupe</h6>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12"><br />
                Nom du groupe<br />
                <b class="font-weight-bold">{{ $groupe->nom }}</b><br /><br />

                <div>
                    <a href="{{ route('sModifierGroupe', $groupe->id) }}" class="btn btn-md btn-indigo ml-0 rounded">
                        Modifier
                    </a>
                </div>
                
            </div>
        </div>
    </div>
@endsection

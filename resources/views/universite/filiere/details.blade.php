@extends('layout.sideBarUniversite')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-edit"></i> Détails filière</h3>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12"><br />

                @foreach ($filieres as $filiere)    
                    Nom de la filière<br />
                    <b class="font-weight-bold">{{ $filiere->nom }}</b><br /><br />

                    Niveaux de la filière<br />
                    <ul>
                        @foreach ($filiere_niveaux as $filiere_niveau)
                            @if ($filiere_niveau->filiere_id == $filiere->id)    
                                <li>
                                    <b>{{ $filiere_niveau->nom }}</b>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <div>
                        <a href="{{ route('uModifierFiliere', $filiere->id) }}" class="btn btn-md btn-indigo ml-0 rounded">
                            Modifier
                        </a>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
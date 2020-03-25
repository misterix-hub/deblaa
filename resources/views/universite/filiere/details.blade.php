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
                    <div class="mb-4">
                        <a href="{{ route('uCreateEtudiant', $filiere->id) }}" class="btn btn-success btn-sm">Ajouter membre</a>
                    </div>
                    Nom de la filière<br />
                    <b class="font-weight-bold">{{ $filiere->nom }}</b><br /><br />

                    Acronyme de la filière <br>
                    <b class="font-weight-bold"> {{ $filiere->acronyme }} </b><br><br>

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
                    <table class="table table-responsive-sm table-striped table-sm">
                        <thead>
                            <tr>
                                <th class="font-weight-bold">Nom</th>
                                <th class="font-weight-bold">Telephone</th>
                                <th class="font-weight-bold">Niveau</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                                <tr class="text-uppercase font-weight-bolder">
                                    <td><b>{{ $user->name }}</b></td>
                                    <td><b>+{{ $user->telephone }}</b></td>
                                    <td>
                                        <b>
                                            @foreach($niveaux as $niveau)
                                                @if($niveau->id === $user->niveau_id)
                                                    {{ $niveau->nom }}
                                                @endif
                                            @endforeach
                                        </b>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">Aucun étudiant dans cette filière</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @endforeach

                <div>
                    <a href="{{ route('uModifierFiliere', $filiere->id) }}" class="btn btn-md btn-indigo ml-0 rounded">
                        Modifier
                    </a>
                    <a href="{{ route('uListeFiliere') }}" class="btn btn-md btn-light ml-0 rounded">
                        Retour
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

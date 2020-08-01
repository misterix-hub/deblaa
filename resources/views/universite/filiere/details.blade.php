@extends('layout.sideBarUniversite')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-edit"></i> Détails filière</h3>
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12"><br />

                @foreach ($filieres as $filiere)
                    <div> Nom de la filière :
                        <b class="font-weight-bold">{{ $filiere->nom }}</b>
                    </div>
                    <br />
                    <div> Acronyme de la filière :
                        <b class="font-weight-bold"> {{ $filiere->acronyme }} </b>
                    </div><br>
                    <div> Niveaux de la filière :
                        <ul>
                            @foreach ($filiere_niveaux as $filiere_niveau)
                                @if ($filiere_niveau->filiere_id == $filiere->id)
                                    <li>
                                        <b>{{ $filiere_niveau->nom }}</b>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div><br />


                @endforeach
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12">
                <p class="text-center jumbotron p-0" style="font-size: 2rem;">Liste des étudiants</p>
                <div class="mb-3">
                    <p class="text-muted"><em>sélectionner pour trier les étudiants</em></p>
                    <select name="selectSpinneret" id="selectSpinneret" class="form-control filterSpinneret">
                        <option value="{{ $filiere->id . "0" }}">Tous les étudiants</option>
                        @foreach ($filiere_niveaux as $filiere_niveau)
                                @if ($filiere_niveau->filiere_id == $filiere->id)
                                    <option value="{{ $filiere->id.$filiere_niveau->id }}">
                                        <b>{{ $filiere->acronyme.$filiere_niveau->id }}</b>
                                    </option>
                                @endif
                            @endforeach
                    </select>
                </div>
                <table id="example" class="table table-responsive-sm table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th class="font-weight-bold">Nom</th>
                            <th class="font-weight-bold">Telephone</th>
                            <th class="font-weight-bold">Niveau</th>
                        </tr>
                    </thead>
                    <tbody class="data">
                        @forelse($usersBySpinnerets as $userBySpinneret)
                            <tr class="text-uppercase font-weight-bolder">
                                <td><b>{{ $userBySpinneret->name }}</b></td>
                                <td><b>+{{ $userBySpinneret->telephone }}</b></td>
                                <td>
                                    <b>
                                        @foreach($niveaux as $niveau)
                                            @if($niveau->id === $userBySpinneret->niveau_id)
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
            </div>
        </div>

        <div class="d-flex justify-content-center mt-4">
            <a href="{{ $filiere->pathModifier() }}" class="btn btn-md btn-indigo rounded px-5">
                Modifier
            </a>
            <a href="{{ route('uListeFiliere') }}" class="btn btn-md btn-light rounded px-5">
                Retour
            </a>
        </div>

    </div>
@endsection

@section('scriptJs')
    <script>
        $(document).ready(function () {
            $('#example').DataTable();

            $('.filterSpinneret').change(function() {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('ajaxListStudentInShowBlade') }}',
                    data: {
                        'donnees': $(this).val()
                    },
                    success: function(status) {
                        $('.data').html(status)
                    }
                })
            })
        })
    </script>
@endsection

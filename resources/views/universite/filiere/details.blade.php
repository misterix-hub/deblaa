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
                <p class="text-center jumbotron p-0" style="font-size: 2rem;">Liste des étudiants</p>
                <div class="mb-3">
                    <p class="text-muted"><em>sélectionner pour trier les étudiants</em></p>
                    <select name="selectSpinneret" id="selectSpinneret" class="form-control filterSpinneret">
                        <option value="{{ $filiere->id . "0" }}">Tous les étudiants</option>
                        @foreach ($filiere_niveaux as $filiere_niveau)
                                @if ($filiere_niveau->filiere_id == $filiere->id)
                                    <option value="{{ $filiere->id.$filiere_niveau->id }}">
                                        <b>{{ $filiere_niveau->nom }}</b>
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
                            <th class="font-weight-bold">Action</th>
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
                                <form action="{{ route('uDeleteStudentBySpinneret', [$userBySpinneret->telephone, $filiere->id, $userBySpinneret->niveau_id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <td class="text-center">
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded z-depth-0 pl-2 pr-2" onclick="return confirm('Êtes-vous sur(e) de vouloir supprimer {{ $userBySpinneret->name }} dans cette filière ?')">
                                                <i class="icofont-trash"></i> Suprrimer
                                            </button>
                                        </td>
                                    </form>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Aucun étudiant dans cette filière</td>
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

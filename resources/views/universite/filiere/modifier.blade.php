@extends('layout.sideBarUniversite')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-edit"></i> Modifier filière</h3>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12"><br />

                @foreach ($filieres as $filiere)
                    <form action="{{ route('uUpdateFiliere', $filiere->id) }}" method="post">
                        @csrf
                        <label class="" for="nom"><b>Nom de la filière</b></label>
                        <input type="text" name="nom" id="nom" class="form-control" value="{{ $filiere->nom }}"><br  />
                        <b>Niveaux de la filière</b>
                        <ul>
                            @foreach ($filiere_niveaux as $filiere_niveau)
                                @if ($filiere_niveau->filiere_id == $filiere->id)
                                    <li>
                                        {{ $filiere_niveau->nom }}
                                    </li>
                                @endif
                            @endforeach
                        </ul>

                        <div>
                            <i class="icofont-sort-alt"></i>
                            <b>Sélectionner les niveaux</b><br />
                        </div><br />

                        <input type="checkbox" id="allNiveaux1" class="allNiveaux1">
                        <label for="allNiveaux1"><b>Tous les niveaux</b></label><br /><br />

                        @foreach ($niveaux as $niveau)
                            <input type="checkbox" name="niveaux[]" class="niveauCheckBox1" id="niveau{{ $niveau->id }}" value="{{ $niveau->id }}">
                            <label for="niveau{{ $niveau->id }}"><b>{{ $niveau->nom }}</b></label>&nbsp;&nbsp;&nbsp;
                        @endforeach<br /><br />

                        <div>
                            <a href="{{ route('uListeFiliere') }}" class="btn btn-md btn-light ml-0 rounded">
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-md btn-indigo ml-0 rounded">
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                @endforeach

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.allNiveaux1').change(function () {
                $('.niveauCheckBox1').prop("checked", $(this).prop("checked"));
            });
        });
    </script>
@endsection

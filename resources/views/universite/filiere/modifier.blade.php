@extends('layout.sideBarUniversite')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-edit"></i> Modifier filière</h3>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12"><br />

                <form action="{{ route('uUpdateFiliere', 1) }}" method="post">
                    @csrf
                    <label class="" for="nom"><b>Nom de la filière</b></label>
                    <input type="text" name="nom" id="nom" class="form-control" placeholder="Saisir la filière ..."><br  />
                    <div class="text-right">
                        <i class="icofont-sort-alt"></i>
                        <b>Sélectionner les niveaux</b><br />
                    </div><br />

                    <input type="checkbox" name="allNiveaux" id="allNiveaux">
                    <label for="allNiveaux"><b>Tous les niveaux</b></label><br /><br />

                    @for ($i = 0; $i < 5; $i++)
                        <input type="checkbox" name="{{ $i }}" id="niveau{{ $i }}">
                        <label for="niveau{{ $i }}"><b>Licence {{ $i + 1 }}</b></label>&nbsp;&nbsp;&nbsp;
                    @endfor<br /><br />

                    <div class="text-right">
                        <button type="submit" class="btn btn-md btn-indigo mr-0 rounded">
                            Mettre à jour
                        </button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>
@endsection
@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-edit"></i> Modifier groupe</h3>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12"><br />

                <form action="{{ route('sUpdateGroupe', $groupe->id) }}" method="post">
                    @csrf
                    <label class="" for="nom"><b>Nom du groupe</b></label>
                    <input type="text" name="nom" id="nom" value="{{ $groupe->nom }}" class="form-control" placeholder="Saisir le groupe ..."><br  />

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

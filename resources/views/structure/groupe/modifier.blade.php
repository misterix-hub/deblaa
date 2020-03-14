@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h6><i class="icofont-edit"></i> <b>Modifier groupe</b></h6>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12"><br />

                @if($errors->any())
                    <ul class="alert alert-danger list-unstyled mt-3 alert-dismissible fade show" role="alert">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span>
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

                <form action="{{ route('sUpdateGroupe', $groupe->id) }}" method="post">
                    @csrf
                    <label class="" for="nom"><b>Nom du groupe</b></label>
                    <input type="text" name="nom" id="nom" value="{{ $groupe->nom }}" class="form-control" placeholder="Saisir le groupe ...">

                    <div class="mt-2">
                        <button type="submit" class="btn btn-md btn-indigo ml-0 rounded">
                            Mettre à jour
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

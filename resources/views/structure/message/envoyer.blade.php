@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-envelope-open"></i> Envoyer message</h3>
            </div>
            <div class="col-12"><br />

                @if($message = Session::get('error'))
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @endif

                <form action="{{ route('sEnvoyerMessageForm') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label for="titre"><b>Titre du message</b></label>
                            <input type="text" name="titre" id="titre" placeholder="Saisir le titre ici" value="{{ old('titre') }}" class="form-control"><br />
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label for="titre"><b>Pièce jointe</b></label>
                            <input type="file" name="fichier" id="fichier"  value="{{ old('fichier') }}" class="form-control"><br />
                        </div>
                    </div>

                    <label for="editor"><b>Contenu du message</b></label>
                    <textarea name="message" id="editor"></textarea><br />

                    <input type="checkbox" class="allGroupes0" id="all">
                    <label for="all" class="font-weight-bold"><b>Envoyer à tous les membres</b></label><br /><br />

                    <div class="row">
                        @foreach($groupes as $groupe)
                            <div class="col-lg-2 col-md-3 col-sm-12 text-left">
                                <input type="checkbox" name="groupes[]" id="groupe{{ $groupe->id }}" value="{{ $groupe->id }}" class="groupeCheckBox0">
                                <label for="groupe{{ $groupe->id }}"><b>{{ $groupe->nom }}</b></label>
                            </div>
                        @endforeach
                    </div><br />

                    <button type="submit" class="btn btn-indigo btn-md rounded ml-0">
                        Envoyer
                    </button>

                </form>

            </div>
        </div>
    </div><br /><br /><br />
@endsection

@section('script')
    <script>
        CKEDITOR.replace('editor');

        $(document).ready(function () {
            $(".allGroupes0").change(function () {
                $(".groupeCheckBox0").prop("checked", $(this).prop("checked"));
            });
        });
    </script>
@endsection

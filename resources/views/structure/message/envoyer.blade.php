@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h6>
                    <i class="icofont-envelope-open"></i>
                    Envoyer message
                </h6>
            </div>
            <div class="col-12"><br />

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
                    <div class="alert alert-success">
                        {!! $message !!}
                    </div>
                @endif

                @if($message = Session::get('error'))
                    <div class="alert alert-danger">
                        {!! $message !!}
                    </div>
                @endif

                <form action="{{ route('sEnvoyerMessageForm') }}" method="post" enctype="multipart/form-data" id="sEnvoyerMessageForm">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label for="titre"><b>Titre du message</b></label>
                            <input type="text" maxLength="191"  name="titre" id="titre" placeholder="Saisir le titre ici" class="form-control"><br />
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <br />
                            <div class="form-group">
                                <label for="file">
                                    <i class="icofont-paperclip"></i>
                                    <b>Pièce jointe</b>
                                </label>&nbsp;&nbsp;&nbsp;
                                <input type="file" multiple name="fichier[]" id="fichier"  value="{{ old('fichier') }}">
                            </div>
                        </div>
                    </div>

                    <label for="editor"><b>Contenu du message</b></label>
                    <textarea name="message" id="editor"></textarea><br />

                    @if (count($groupes) != 0)
                        <input type="checkbox" class="allGroupes0" id="all">
                        <label for="all" class="font-weight-bold"><b>Envoyer à tous les membres</b></label><br /><br />
                    @endif


                    <div class="row">
                        @foreach($groupes as $groupe)
                            <div class="col-lg-2 col-md-3 col-sm-12 text-left">
                                <input type="checkbox" name="groupes[]" id="groupe{{ $groupe->id }}" value="{{ $groupe->id }}" class="groupeCheckBox0">
                                <label for="groupe{{ $groupe->id }}"><b>{{ $groupe->nom }}</b></label>
                            </div>
                        @endforeach
                    </div><br />
                    {!! (count($groupes)) == 0 ? '<span class=\'red-text\'>Impossible d\'envoyer sans ancun groupe</span>' : '' !!}<br />
                    <button type="submit" id="submitButtonForm" class="btn btn-indigo upload btn-md rounded ml-0 {{ (count($groupes)) == 0 ? 'disabled' : '' }}">
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

            $("#sEnvoyerMessageForm").on("submit", function () {
                $("#submitButtonForm").attr("disabled", true);
            });
        });
	/* VICTOR SI TU ARRIVES ICI TU PEUX LAISSER, C'EST DEJA FAIT */

	$('#titre').keyup(function(){
	    var titre_val = $(this).val().substring(0, 190);
	    if($(this).val().length > 190) {
		$(this).val(titre_val);
		alert('Nombre maximal de caratères atteint');
	    }
	});
	/* MASTO N'EST PAS BON !!! */



    </script>
@endsection

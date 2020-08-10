@extends('layout.sideBarUniversite')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        {{ $message }}
                        <button type="button" class="close" aria-label="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if ($message = Session::get('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                        {{ $message }}
                        <button type="button" class="close" aria-label="close" data-dismiss="alert">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <h3><i class="icofont-envelope-open"></i> Envoyer message</h3>
            </div>
            <div class="col-12"><br />

                <form action="{{ route('uEnvoyerMessageForm') }}" method="post" enctype="multipart/form-data" id="uEnvoyerMessageForm">
                    @csrf

                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label for="titre"><b>Idée générale <small class="text-muted">caratère max : 190</small></b></label>
                            <input type="text" maxLength="191"  required name="titre" id="titre" placeholder="Saisir le titre ici" class="form-control"><br />
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <br />
                            <div class="form-group">
                                <label for="file">
                                    <i class="icofont-paperclip"></i>
                                    <b>Pièce jointe</b>
                                </label>&nbsp;&nbsp;&nbsp;
                                <input type="file" multiple name="fichier[]" id="fichier">
                            </div>
                        </div>
                    </div>

                    <label for="editor"><b>Contenu du message</b></label>
                    <textarea name="message" id="editor"></textarea><br />

                    @if (count($filieres) != 0)
                        <input type="checkbox" class="allNiveaux0" id="all">
                        <label for="all" class="font-weight-bold"><b>Envoyer à tous les étudiants</b></label><br /><br />
                    @endif


                    <div class="row">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($filieres as $filiere)
                            <div class="col-lg-2 col-md-3 col-sm-12 text-left">
                                <!--<input type="checkbox" value="{{ $filiere->id }}" name="filieres[]" class="niveauCheckBox0" id="filiere{{ $filiere->id }}">-->
                                <input type="hidden" name="filiere{{ $i }}" value="{{ $filiere->id }}">
                                <label for="filiere{{ $filiere->id }}"><b>{{ $filiere->nom }}</b></label>

                                <div class="ml-3">
                                    @php
                                        $j = 0;
                                    @endphp
                                    @foreach ($filiere_niveaux as $filiere_niveau)
                                        @if ($filiere_niveau->filiere_id == $filiere->id)
                                            <input type="checkbox" value="{{ $filiere_niveau->niveau_id }}" class="niveauCheckBox0" name="niveaux{{ $i . $j }}" id="niveaux{{ $filiere->id . $filiere_niveau->id }}">
                                            <label for="niveaux{{ $filiere->id . $filiere_niveau->id }}">{{ $filiere_niveau->nom }}</label><br />
                                            @php
                                                $j += 1;
                                            @endphp
                                        @endif
                                    @endforeach
                                    <input type="hidden" name="index{{ $i }}" value="{{ $j }}">
                                </div>
                            </div>
                            @php
                                $i += 1;
                            @endphp
                        @endforeach
                        <input type="hidden" name="index" value="{{ $i }}">
                    </div><br />
                    {!! (count($filieres)) == 0 ? '<span class=\'red-text\'>Impossible d\'envoyer sans ancune filière</span>' : '' !!}<br />
                    <button type="submit" class="btn btn-indigo btn-md rounded ml-0 {{ (count($filieres)) == 0 ? 'disabled' : '' }}" id="uEnvoyerMessageButton">
                        Envoyer
                    </button>

                </form>

            </div>
        </div>
    </div><br /><br /><br />
@endsection

@section('scriptJs')
    <script>
        CKEDITOR.replace('editor');

        $(document).ready(function () {
            $('.allNiveaux0').change(function () {
                $('.niveauCheckBox0').prop("checked", $(this).prop("checked"));
            });
        });

        $('#uEnvoyerMessageForm').on('submit', function() {
            $('#uEnvoyerMessageButton').attr('disabled', true);
        });
	 /* VICTOR SI TU ARRIVES ICI TU PEUX LAISSER, C'EST DEJA FAIT */

        $('#titre').keyup(function(){
            var titre_val = $(this).val().substring(0, 190);
	    if($(this).val().length > 190) {
		$(this).val(titre_val);
                alert('Nombre maximal de caratères atteint');
            }
        });
        /* AHOCO EST MAUVAIS !!! */

    </script>
@endsection

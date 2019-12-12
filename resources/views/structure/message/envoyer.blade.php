@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-envelope-open"></i> Envoyer message</h3>
            </div>
            <div class="col-12"><br />

                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label for="titre"><b>Titre du message</b></label>
                            <input type="text" name="titre" id="titre" placeholder="Saisir le titre ici" class="form-control"><br />
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <label for="titre"><b>Pièce jointe</b></label>
                            <input type="file" name="titre" id="titre" placeholder="Saisir le titre ici" class="form-control"><br />
                        </div>
                    </div>

                    <label for="editor"><b>Contenu du message</b></label>
                    <textarea name="message" id="editor"></textarea><br />

                    <input type="checkbox" name="filiere" id="all">
                    <label for="all" class="font-weight-bold"><b>Envoyer à tous les membres</b></label><br /><br />

                    <div class="row">
                        @for ($i = 0; $i < 6; $i++)
                            <div class="col-lg-2 col-md-3 col-sm-12 text-left">
                                <input type="checkbox" name="filiere" id="filiere{{ $i }}">
                                <label for="filiere{{ $i }}"><b>Groupe {{ $i + 1 }}</b></label>
                            </div>
                        @endfor
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
    </script>
@endsection
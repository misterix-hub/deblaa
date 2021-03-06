@extends('layout.header')

@section('inboxs')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="mt-2">
                    <table style="margin-left: -8px;">
                        <tr>
                            <td>
                                <a href="{{ route('inboxsEtudiant') }}" class="black-text">
                                    <i class="icofont-arrow-left" style="font-size: 28px;"></i>
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('inboxsEtudiant') }}" class="black-text">
                                    <b>Boite de réception</b>
                                </a>
                            </td>
                        </tr>
                    </table><br />

                    @foreach ($messages as $message)    
                        <div class="col-12 pl-0 pr-0">
                            <h3>{{ $message->titre }}</h3>

                            <div>
                                {!! $message->contenu !!}
                            </div><br />
                            <small>
                                <i class="icofont-history"></i>
                                Date d'envoi : {{ $message->created_at }}
                            </small>
                        </div>
                    @endforeach


                        <div class="col-12 pl-0 pr-0">
                            <div class="row justify-content-center">
                                @foreach($fichier_messages as $fichier_message)
                                    <div class="col-11 mb-3">
                                        @if ($fichier_message->fichier != "")
                                            <i class="icofont-paper-clip"></i>
                                            <b class="font-weight-bold">
                                                Pièce jointe
                                            </b><br /><br />

                                            @switch($fichier_message->format)

                                                @case("pdf")
                                                <img src="{{ URL::asset('assets/images/file.png') }}" alt="PDF-joint" width="100%">
                                                @break

                                                @case("doc")
                                                <img src="{{ URL::asset('assets/images/doc.png') }}" alt="Word-joint" width="100%">
                                                @break

                                                @case("mp3")
                                                <img src="{{ URL::asset('assets/images/mp.png') }}" alt="Audio-jointe" width="100%">
                                                @break

                                                @case("mp4")
                                                <img src="{{ URL::asset('assets/images/film.png') }}" alt="Vidéo-jointe" width="100%">
                                                @break

                                                @case("png")
                                                <img src="{{ URL::asset('db/messages/universites/fichier/'.$fichier_message->fichier) }}" alt="Image-jointe" width="100%">
                                                @break

                                                @case("jpg")
                                                <img src="{{ URL::asset('db/messages/universites/fichier/'.$fichier_message->fichier) }}" alt="Image-jointe" width="98%">
                                                @break

                                                @case("jpeg")
                                                <img src="{{ URL::asset('db/messages/universites/fichier/'.$fichier_message->fichier) }}" alt="Image-jointe" width="100%">
                                                @break

                                                @default

                                            @endswitch

                                            <a download href="{{ URL::asset('db/messages/universites/fichier/' . $fichier_message->fichier) }}" class="btn btn-sm btn-green btn-block">
                                                <i class="icofont-download"></i>
                                                Télécharger [{{ substr($fichier_message->taille, 0, 5) }} <span style="text-transform: capitalize;">Mo</span>]
                                            </a><br /><br />
                                            Type de fichier: <b>{{ $fichier_message->format }}</b><br />
                                            Taille : <b>{{ substr($fichier_message->taille, 0, 5) }} Mo</b><br />
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>
                </div>


                </div>
            </div>
        </div>
    </div>
@endsection

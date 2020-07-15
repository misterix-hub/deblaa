@extends('layout.sideBarUniversite')

@section('content')
    <br /><br />
    <div class="container-fluid">
        <div class="row">
            @foreach ($messages as $message)
                <div class="col-12">
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <h4>
                        <b>{{ $message->titre }}</b>
                    </h4>

                    {!! $message->contenu !!}<br />

                    <small>
                        <i class="icofont-history"></i>
                        Date : {{ $message->created_at }}
                    </small><br /><br /><br />

                    <div class="row">
                        @foreach($fichier_messages as $fichier_message)
                            <div class="col-lg-3 col-md-12 col-sm-12 mb-4">
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

                                    <a download href="{{ URL::asset('db/messages/universites/fichier/' . $fichier_message->fichier) }}" class="btn btn-md btn-green btn-block">
                                        <i class="icofont-download"></i>
                                        Télécharger [{{ substr($fichier_message->taille, 0, 5) }} <span style="text-transform: capitalize;">Mo</span>]
                                    </a><br /><br />
                                    Type de fichier: <b>{{ $fichier_message->format }}</b><br />
                                    Taille : <b>{{ substr($fichier_message->taille, 0, 5) }} Mo</b><br />
                                @endif
                            </div>
                        @endforeach
                    </div>


                    <a href="" class="btn btn-md btn-danger ml-0" data-toggle="modal" data-target="#basicExampleModal">
                        Rapport de livraison
                    </a><br /><hr /><br />

                    <b class="font-weight-bold">Cible du message</b><br />

                    <div class="row">
                        <div class="col-12">
                            <div style="line-height: 30px;">
                                @foreach ($cible_messages as $cible_message)

                                    @foreach ($filieres as $filiere)
                                        @if ($filiere->id == $cible_message->filiere_id)
                                            <b> - {{ $filiere->nom }} : </b>
                                        @endif
                                    @endforeach
                                    @foreach ($niveaux as $niveau)
                                        @if ($niveau->id == $cible_message->niveau_id)
                                            <b>{{ $niveau->nom }}</b>
                                        @endif
                                    @endforeach<br />

                                @endforeach
                            </div>
                        </div>
                    </div>

            @endforeach
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="border-radius: 25px;">
                <div class="modal-header">
                    <h6 class="modal-title" id="exampleModalLabel">Rapport de livraison</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <b class="font-weight-bold">Message lu par {{ count($users) }} personnes</b>

                    <div class="card card-body border rounded">

                        <table id="example" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Nom complet</th>
                                    <th width="100">Téléphone</th>
                                    <th width="60" class="text-center">Statut</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td class="text-right">+{{ $user->telephone }}</td>
                                        <td class="text-center">
                                            @if(count($message_lus) == 0)
                                                <i class="icofont-check grey-text"></i>
                                                <i class="icofont-check grey-text"></i>
                                            @else

                                                @if (count(DB::table('users')
                                                ->join('message_lus', 'message_lus.user_id', '=', 'users.id')
                                                ->join('message_universites', 'message_universites.id', '=', 'message_lus.message_universite_id')
                                                ->where('message_universites.id', $id)
                                                ->where('users.id', $user->id)
                                                ->where('users.telephone', $user->telephone)
                                                ->get()) == 1)
                                                    <i class="icofont-check green-text icofont-2x"></i>
                                                    <i class="icofont-check green-text icofont-2x"></i>
                                                @else
                                                    <i class="icofont-check grey-text icofont-2x"></i>
                                                    <i class="icofont-check grey-text icofont-2x"></i>
                                                @endif


                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Nom complet</th>
                                    <th>Téléphone</th>
                                    <th>Status</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

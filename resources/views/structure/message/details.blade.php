@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            @foreach($messages as $message)
                <div class="col-lg-8 col-md-12 col-sm-12">
                    <h4>
                        <b>{{ $message->titre }}</b>
                    </h4>

                    {!! $message->contenu !!}<br />

                    <small>
                        <i class="icofont-history"></i>
                        Date : {{ $message->created_at }}
                    </small><br /><br /><br />

                    <a href="" class="btn btn-md btn-danger ml-0" data-toggle="modal" data-target="#basicExampleModal">
                        Rapport de livraison
                    </a><br /><hr /><br />

                    <b class="font-weight-bold">Cible(s) du message</b><br />

                    <div class="row">
                        <div class="col-12">
                            <div style="line-height: 30px;">
                                @foreach ($cible_messages as $cible_message)

                                    @foreach ($groupes as $groupe)
                                        @if ($groupe->id == $cible_message->departement_id)
                                            <b> - {{ $groupe->nom }} </b> <br />
                                        @endif
                                    @endforeach

                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-12 col-sm-12">

                    @if ($message->fichier != "")
                        <i class="icofont-paper-clip"></i>
                        <b class="font-weight-bold">
                            Pièce jointe
                        </b><br /><br />

                        @switch($message->format)
                            @case("Image")
                            <img src="{{ URL::asset('db/messages/structures/fichier/' . $message->fichier) }}" alt="Image-jointe" width="100%">
                            @break

                            @case("Video")

                            @break
                            @case("Audio")

                            @break

                            @case("Document PDF")

                            @break


                            @default

                        @endswitch

                        <a download href="{{ URL::asset('db/messages/structures/fichier/' . $message->fichier) }}" class="btn btn-md btn-orange btn-block">
                            <i class="icofont-download"></i>
                            Télécharger [{{ substr($message->taille, 0, 5) }} <span style="text-transform: capitalize;">Mo</span>]
                        </a><br /><br />
                        Type de fichier: <b>{{ $message->format }}</b><br />
                        Taille : <b>{{ substr($message->taille, 0, 5) }} Mo</b><br />
                    @endif

                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal -->
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
                                    <td class="text-right">{{ $user->telephone }}</td>
                                    <td class="text-center">
                                        <i class="icofont-check green-text"></i>
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

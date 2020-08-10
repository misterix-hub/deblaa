@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-md-12 col-sm-12">
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
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if($message = Session::get('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                        {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

            </div>
            @foreach($messages as $message)
                <div class="col-lg-10 col-md-12 col-sm-12">
                    <h5 style="font-weight: 100;">
                        {{ $message->titre }}
                    </h5>

                    {!! $message->contenu !!}<br />

                    <small>
                        Date d'envoi : {{ $message->created_at }}
                    </small><br /><br />

                        <div class="row">
                            @foreach($fichier_messages as $fichier_message)
                                <div class="col-lg-3 col-md-6 col-sm-12 mb-2">
                                    @if ($fichier_message->fichier != "")

                                        @switch($fichier_message->format)

                                            @case("pdf")
                                                <div style="height: 100px; overflow: hidden; line-height: 120px;" class="text-center grey lighten-1 rounded">
                                                    <i class="icofont-file-pdf icofont-3x red-text"></i>
                                                </div>
                                            @break

                                            @case("doc")
                                                <div style="height: 100px; overflow: hidden; line-height: 120px;" class="text-center grey lighten-1 rounded">
                                                    <i class="icofont-file-word icofont-3x indigo-text"></i>
                                                </div>
                                            @break

                                            @case("docx")
                                                <div style="height: 100px; overflow: hidden; line-height: 120px;" class="text-center grey lighten-1 rounded">
                                                    <i class="icofont-file-word icofont-3x indigo-text"></i>
                                                </div>
                                            @break

                                            @case("mp3")
                                                <div style="height: 100px; overflow: hidden; line-height: 120px;" class="text-center grey lighten-1 rounded">
                                                    <i class="icofont-file-mp3 icofont-3x brown-text"></i>
                                                </div>
                                            @break

                                            @case("mp4")
                                                <div style="height: 100px; overflow: hidden; line-height: 120px;" class="text-center grey lighten-1 rounded">
                                                    <i class="icofont-file-video icofont-3x blue-text"></i>
                                                </div>
                                            @break

                                            @case("png")
                                                <div style="height: 100px; overflow: hidden;" class="rounded">
                                                    <img src="{{ URL::asset('db/messages/structures/fichier/'.$fichier_message->fichier) }}" alt="Image-jointe" width="100%">
                                                </div>
                                            @break

                                            @case("jpg")
                                                <div style="height: 100px; overflow: hidden;" class="rounded">
                                                    <img src="{{ URL::asset('db/messages/structures/fichier/'.$fichier_message->fichier) }}" alt="Image-jointe" width="100%">
                                                </div>
                                            @break

                                            @case("jpeg")
                                                <div style="height: 100px; overflow: hidden;" class="rounded">
                                                    <img src="{{ URL::asset('db/messages/structures/fichier/'.$fichier_message->fichier) }}" alt="Image-jointe" width="100%">
                                                </div>
                                            @break

                                            @default
                                                <div style="height: 100px; overflow: hidden; line-height: 120px;" class="text-center grey lighten-1 rounded">
                                                    <i class="icofont-file-alt icofont-3x"></i>
                                                </div>
                                        @endswitch

                                        <a download href="{{ URL::asset('db/messages/structures/fichier/' . $fichier_message->fichier) }}">
                                            <div class="text-center black-text pt-2 pb-2 mb-1" style="background-color: rgba(255, 255, 255, 0.5); margin-top: -35px; position: relative;">
                                                <i class="icofont-download"></i>
                                                <b>[{{ substr($fichier_message->taille, 0, 5) }} <span style="text-transform: capitalize;">Mo</span>]</b>
                                            </div>
                                        </a>
                                        <div style="font-size: 13px;">
                                            Type de fichier: <b>{{ $fichier_message->format }}</b><br />
                                            Taille : <b>{{ substr($fichier_message->taille, 0, 5) }} Mo</b><br />
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div><br />


                    <a href="" class="btn btn-md btn-danger ml-0 rounded" data-toggle="modal" data-target="#basicExampleModal">
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

                    <b class="font-weight-bold">Message lu par {{ count($message_lus) . " " . \Illuminate\Support\Str::plural('personne', count($message_lus)) }}</b>

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
                                            ->join('message_structures', 'message_structures.id', '=', 'message_lus.message_structure_id')
                                            ->where('message_structures.id', $id)
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

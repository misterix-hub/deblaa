@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="">
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card brown z-depth-1 mb-3" style="border-radius: 15px;">
                        <div class="card-body">
                            <a href="{{ route('sListeGroupe') }}">
                                <h4 class="text-light" style="font-weight: 300;">
                                    <i class="icofont-bag-alt"></i>
                                    Groupes <span class="float-right">{{ count($groupes) }}</span>
                                </h4>
                                <div class="white-text pt-2" style="font-weight: 300;">
                                    <i class="icofont-plus"></i>
                                    Plus de détails
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card orange z-depth-1 mb-3" style="border-radius: 15px;">
                        <div class="card-body">
                            <a href="{{ route('sListeMembre') }}">
                                <h4 class="text-light" style="font-weight: 300;">
                                    <i class="icofont-graduate-alt"></i>
                                    Membres <span class="float-right">{{ count($users) }}</span>
                                </h4>
                                <div class="white-text pt-2" style="font-weight: 300;">
                                    <i class="icofont-plus"></i>
                                    Plus de détails
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12">
                    <div class="card blue z-depth-1 mb-3" style="border-radius: 15px;">
                        <div class="card-body">
                            <a href="{{ route('sListeMessage') }}">
                                <h4 class="text-light" style="font-weight: 300;">
                                    <i class="icofont-envelope"></i>
                                    Messages <span class="float-right">{{ count($messages) }}</span>
                                </h4>
                                <div class="white-text pt-2" style="font-weight: 300;">
                                    <i class="icofont-plus"></i>
                                    Plus de détails
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12"><br />
                    <table width="100%">
                        <tr>
                            <td>
                                <i class="icofont-history"></i>
                                <span class="font-weight-bold">Historique des messages envoyés</span>
                            </td>
                            <td class="text-right">
                                <a href="{{ route('sEnvoyerMessage') }}">
                                    <i class="icofont-facebook-messenger"></i>
                                    <b>Envoyer message</b>
                                </a>
                            </td>
                        </tr>
                    </table>
                    <br />

                    @if($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif <br />

                    <div class="card card-body border rounded">
                        <table id="example" class="table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Titre</th>
                                    <th width="130">Date d'envoi</th>
                                    <th width="100">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($messages as $message)
                                    <tr>
                                        <td>{{ $message->titre }}</td>
                                        <td>{{ $message->created_at }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('sDetailsMessage', $message->id) }}" class="blue-text">
                                                <i class="icofont-plus"></i>
                                                Détails
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            <tfoot>
                                <tr>
                                    <th>Titre</th>
                                    <th>Date d'envoi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

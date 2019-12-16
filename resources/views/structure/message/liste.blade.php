@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-listine-dots"></i> Liste des messages</h3>
            </div>
            <div class="col-12"><br />

            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            @if ($message = Session::get('error'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            <div>
                <table class="table table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>Titre message</th>
                            <th width="180">Date d'envoi</th>
                            <th width="100" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($messages as $message)
                            <tr>
                                <td>{{ $message->titre }}</td>
                                <td class="text-right">{{ $message->created_at }}</td>
                                <td class="text-center">
                                    <a href="{{ route('sDetailsMessage', $message->id) }}" class="blue-text">
                                        <i class="icofont-plus"></i>
                                        Détails
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="3">
                                    <b>Pas de message envoyé !</b>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Titre message</th>
                            <th width="100">Date d'envoi</th>
                            <th width="100" class="text-center">Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            </div>
        </div>
    </div>
@endsection
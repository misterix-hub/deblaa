@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-listine-dots"></i> Liste membres</h3>
            </div>
            <div class="col-12"><br />

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @endif

                <div class="card card-body border rounded">
                    <table id="example" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nom complet</th>
                                <th>Téléphone</th>
                                <th>Groupe</th>
                                <th>Rôle</th>
                                <th width="100" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->telephone }}</td>
                                    <td>
                                        @foreach ($groupes as $groupe)
                                            @if ($groupe->id == $user->departement_id)
                                                {{ $groupe->nom }}
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>{{ $user->fonction }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('sSupprimerMembre', $user->id) }}" onclick="return confirm('Êtes-vous sur(e) de vouloir supprimer {{ $user->name }} ?')" class="red-text">
                                            <i class="icofont-trash"></i>
                                            Supprimer
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nom complet</th>
                                <th>Téléphone</th>
                                <th>Groupe</th>
                                <th>Rôle</th>
                                <th width="100" class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

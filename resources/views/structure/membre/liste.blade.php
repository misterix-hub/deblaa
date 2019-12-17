@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-listine-dots"></i> Liste des membres</h3>
            </div>
            <div class="col-12"><br />
                <?php $send_message = 0; ?>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                        @if ($message == "Membre ajouté avec succès !")
                            <?php $send_message = 1; ?>
                        @endif
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
                                <th width="130" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
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
                            @empty
                            <tr>
                                <td class="text-center" colspan="5"><b>Aucun membre</b></td>
                            </tr>
                            @endforelse
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

@section('script')
    <script>
        $(document).ready(function() {
	    $('#example').DataTable();
            var send_message = "{{ $send_message }}";
            if (send_message == 1) {
                $.ajax ({
                   url: "https://www.easysendsms.com/sms/bulksms-api/bulksms-api?username=debldebl2019&password=esm13343&from=Deblaa&to={{ session()->get('msg_tel') }}&text={{ session()->get('msg_pwd') }}&type=0" ,
                   type : 'GET'
                });
            }
        });
    </script>
@endsection

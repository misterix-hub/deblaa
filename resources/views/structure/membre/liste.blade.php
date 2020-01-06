@extends('layout.sideBarStructure')

@section('content')
    <div class="">
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12" style="border-right: 1px solid #CCC;">
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
            
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
                            <br />
                            <h6>
                                <i class="icofont-listine-dots"></i>
                                <b>Liste des membres</b>
                            </h6>

                            <br />
                                <table id="example" class="table table-stripped table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Nom complet</th>
                                            <th>Téléphone</th>
                                            <th>Groupe</th>
                                            <th>Rôle</th>
                                            <th width="40" class="text-center">Action</th>
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
                                                    <a href="{{ route('sSupprimerMembre', $user->id) }}" onclick="return confirm('Êtes-vous sur(e) de vouloir supprimer {{ $user->name }} ?')"
                                                        class="btn btn-sm btn-outline-danger rounded z-depth-0 pl-2 pr-2">
                                                        <i class="icofont-trash"></i>
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
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            <br />
                            
                        </div>
                    </div><br /><br /><br />

                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 menu-item-sm-hide">
                   
                    @include('included.sideBarRight')

                </div>
                <div class="col-12 text-center font-size-14 border-top"><br />
                    <b>Deblaa &copy; 2019 | Tous droits réservés</b><br />
                    <b>Produit de <a href="">IBTAGroup</a></b><br /><br />
                </div>
            </div>
        </div>

    </div>
    <br />
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

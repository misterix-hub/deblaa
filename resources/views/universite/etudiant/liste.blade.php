@extends('layout.sideBarUniversite')

@section('content')
    <div class="">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12" style="border-right: 1px solid #CCC;">

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            <?php $send_message = 0; ?>
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show my-4" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" aria-label="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    
                                </div>
                            @endif

                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show my-4" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" aria-label="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <br />
                            <h6>
                                <i class="icofont-listine-dots"></i>
                                <b>Liste des étudiants</b>
                            </h6>

                            <br />

                            <div class="row">
                                <div class="col-12 col-md-4 mb-3 mb-2">
                                    <label for="filter"><b>Trier :</b></label><br>
                                    <select name="filter" id="filter" class="form-control filter">
                                        <option value="">Tout</option>
                                        @foreach ($filieres as $filiere)
                                            @foreach ($fil_nivos as $fil_nivo)
                                                @if($filiere->id === $fil_nivo->filiere_id)
                                                    @switch($fil_nivo->niveau_id)
                                                        @case(7)
                                                            <option value="{{ $filiere->id . $fil_nivo->niveau_id }}"> {{ $filiere->acronyme ." BTS1"}} </option>
                                                            @break
                                                        @case(8)
                                                            <option value="{{ $filiere->id . $fil_nivo->niveau_id }}"> {{ $filiere->acronyme ." BTS2"}} </option>
                                                            @break
                                                        @default
                                                            <option value="{{ $filiere->id . $fil_nivo->niveau_id }}"> {{ $filiere->acronyme ." " . $fil_nivo->niveau_id }} </option>
                                                    @endswitch
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <table id="example" class="table table-responsive-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th class="font-weight-bold">Nom complet</th>
                                        <th class="font-weight-bold">Téléphone</th>
                                        <th class="font-weight-bold">Filière</th>
                                        <th class="font-weight-bold">Niveau</th>
                                        <th width="100" class="text-center font-weight-bold">Action</th>
                                    </tr>
                                </thead>
                                <tbody class="datadrop">
                                    @forelse($users as $user)
                                        <tr class="display">
                                            <td>{{ $user->name }}</td>
                                            <td>+{{ $user->telephone }}</td>
                                            <td>
                                                @foreach ($filieres as $filiere)
                                                    @if ($filiere->id == $user->filiere_id)
                                                        {{ $filiere->acronyme }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach ($niveaux as $niveau)
                                                    @if ($niveau->id == $user->niveau_id)
                                                        {{ $niveau->nom }}
                                                    @endif
                                                @endforeach
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('uSupprimerEtudiant', $user->telephone) }}" onclick="return confirm('Êtes-vous sur(e) de vouloir supprimer {{ $user->name }} ?')" class="red-text">
                                                    <i class="icofont-trash"></i>
                                                    Supprimer
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">Pas de données d'étudiants diponibles </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Nom complet</th>
                                        <th>Téléphone</th>
                                        <th>Filière</th>
                                        <th>Niveau</th>
                                        <th width="100" class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <br />

                            <div class="d-flex justify-content-center">
                                <a class="btn btn-light btn-md mt-5 px-5 py-3 text-dark" href="{{ route('uListeFiliere') }}">
                                    <i class="icofont-arrow-left"></i>
                                    Retour
                                </a>
                            </div>

                        </div>
                    </div><br /><br /><br />

                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 menu-item-sm-hide">

                    @include('included.sideBarRightUniv')

                </div>
                <div class="col-12 text-center font-size-14 border-top"><br />
                    <b> Deblaa &copy; 2019 | Tous droits réservés</b><br />
                    <b>Produit de <a href="">IBTAGroup</a></b><br /><br />
                </div>
            </div>
        </div>

    </div>
    <br />

    <br />
@endsection

@section('scriptJs')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
            /*$('#example').DataTable({
                'searching': false,
                'paging': false,
                'info': false
            });*/
                let send_message = "{{ $send_message }}";
                if (parseInt(send_message, 10) === 1) {
                    $.ajax({
                        type: "GET",
                        url: "https://api.smszedekaa.com/api/v2/SendSMS?SenderId=Deblaa&Message={{ session()->get('msg_pwd') }}&MobileNumbers={{ session()->get('msg_tel') }}&ApiKey=yAYu1Q7C9FKy/1dOOBSHvpcrTldsEHGHtM2NjcuF4iU=&ClientId=4460f3b0-3a6a-49f4-8cce-d5900b86723d",
                    });
                }

            $('.filter').change(function () {

                $.ajax({
                    type: 'GET',
                    url: '{{ route('ajaxListStudent') }}',
                    data: {
                        'data': $(this).val()
                    },
                    success: function(status) {
                        $('.datadrop').html(status)
                    }
                });
            });
        });
    </script>
@endsection

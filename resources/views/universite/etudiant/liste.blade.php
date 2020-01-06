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
                                <b>Liste des étudiants</b>
                            </h6>

                            <br />
                            <?php $send_message = 0; ?>
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    {{ $message }}
                                    @if ($message == "Étudiant ajouté avec succès !")
                                        <?php $send_message = 1; ?>
                                    @endif
                                </div>
                            @endif

                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @endif

                            <table id="example" class="table table-responsive" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Nom complet</th>
                                        <th>Téléphone</th>
                                        <th>Filière</th>
                                        <th>Niveau</th>
                                        <th width="100" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)    
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->telephone }}</td>
                                            <td>
                                                @foreach ($filieres as $filiere)
                                                    @if ($filiere->id == $user->filiere_id)
                                                        {{ $filiere->nom }}
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
                                                <a href="{{ route('uSupprimerEtudiant', $user->id) }}" onclick="return confirm('Êtes-vous sur(e) de vouloir supprimer {{ $user->name }} ?')" class="red-text">
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
                                        <th>Filière</th>
                                        <th>Niveau</th>
                                        <th width="100" class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <br />
                            
                        </div>
                    </div><br /><br /><br />

                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 menu-item-sm-hide">
                   
                    @include('included.sideBarRightUniv')

                </div>
                <div class="col-12 text-center font-size-14 border-top"><br />
                    <b>Deblaa &copy; 2019 | Tous droits réservés</b><br />
                    <b>Produit de <a href="">IBTAGroup</a></b><br /><br />
                </div>
            </div>
        </div>

    </div>
    <br />

    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-listine-dots"></i> Liste étudiants</h3>
            </div>
            <div class="col-12"><br />

                <?php $send_message = 0; ?>
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                        @if ($message == "Étudiant ajouté avec succès !")
                            <?php $send_message = 1; ?>
                        @endif
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @endif

                <table id="example" class="table table-responsive" style="width:100%">
                    <thead>
                        <tr>
                            <th>Nom complet</th>
                            <th>Téléphone</th>
                            <th>Filière</th>
                            <th>Niveau</th>
                            <th width="100" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)    
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->telephone }}</td>
                                <td>
                                    @foreach ($filieres as $filiere)
                                        @if ($filiere->id == $user->filiere_id)
                                            {{ $filiere->nom }}
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
                                    <a href="{{ route('uSupprimerEtudiant', $user->id) }}" onclick="return confirm('Êtes-vous sur(e) de vouloir supprimer {{ $user->name }} ?')" class="red-text">
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
                            <th>Filière</th>
                            <th>Niveau</th>
                            <th width="100" class="text-center">Action</th>
                        </tr>
                    </tfoot>
                </table>
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
@extends('layout.sideBarUniversite')

@section('content')

    <div class="">

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12" style="border-right: 1px solid #CCC;">

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">

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

                            <?php $send_message = 0; ?>
                            @if($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" aria-label="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if($message = Session::get('successStudent'))
                                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" aria-label="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    @if (session()->has('msg_tel') && session()->has('msg_pwd'))
                                        <?php $send_message = 1;
                                            session()->pull('msg_tel');
                                            session()->pull('msg_pwd');
                                         ?>
                                    @endif
                                </div>
                            @endif

                            @if($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" aria-label="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <br />
                            <div class="row mb-4">
                                <div class="col-12">
                                    <div class="float-right">
                                        <a href="{{ route('uListeEtudiant') }}" class="btn btn-grey btn-sm"><i class="icofont-listine-dots"></i> Liste des étudiants</a>
                                        <a href="#!" data-toggle="modal" data-target="#filiereModal" class="btn btn-primary btn-sm"><i class="icofont-plus-circle"></i> Ajouter une filière</a>
                                    </div>

                                </div>
                            </div>
                            <h3><i class="icofont-listine-dots"></i> Liste des filières</h3>

                            <?php $firstNiveau=0; ?>

                            <table class="table table-hover table-bordered table-responsive-sm table-sm">
                                <thead>
                                    <tr>
                                        <th>
                                            <b>Nom de la filière</b>
                                        </th>
                                        <th style="width: 300px;">
                                            <b>Niveaux</b>
                                        </th>
                                        <th>
                                            <b>Opération</b>
                                        </th>
                                        <th class="text-center">
                                            <b>Action</b>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($filieres as $filiere)
                                        @foreach (\App\Models\FiliereNiveau::where('filiere_id', $filiere->id)->get() as $item)
                                            <?php $firstNiveau = $item->niveau_id; ?>
                                            @break
                                        @endforeach
                                        <tr>
                                            <td>
                                                <b>{{ $filiere->nom }}</b>
                                            </td>
                                            <td class="justify-content-center">
                                                <select name="niveau" id="niveau" class="form-control niveau" style="width: 12rem;">
                                                    @foreach (\App\Models\FiliereNiveau::where('filiere_id', $filiere->id)->get() as $item)
                                                        <option value="{{ $filiere->id.$item->niveau_id }}"> {{ \App\Models\Niveau::where('id', $item->niveau_id)->get('nom')->first()->nom }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="text-center spinneretData">
                                                
                                                <a href="#!" class="btn btn-success btn-sm px-1"  style="width:10rem;" type="button" data-toggle="dropdown" id="contactDropDown" >Ajouter étudiant</a>
                                                <div class="dropdown-menu" aria-labelledby="contactDropDown">
                                                    <a class="dropdown-item" href="{{ $filiere->pathAddStudentsByList($firstNiveau) }}">Mes contacts</a>
                                                    <a class="dropdown-item" href="{{ $filiere->pathAddStudent($firstNiveau) }}">Nouveau</a>
                                                </div>
                                                
                                            </td>
                                            <td class="text-center" style="width: 6rem;">
                                                <div class="btn-group">
                                                    <a href="{{ $filiere->pathDetails() }}" class="btn btn-sm btn-outline-grey rounded z-depth-0 pl-2 pr-2 mr-2">
                                                        <i class="icofont-plus"></i>
                                                    </a>
                                                    <a href="{{ $filiere->pathModifier() }}" class="btn btn-sm btn-outline-blue rounded z-depth-0 pl-2 pr-2 mr-2 ">
                                                        <i class="icofont-edit"></i>
                                                    </a>
                                                    <a href="{{ $filiere->pathSupprimer() }}" onclick="return confirm('Êtes-vous sur(e) de vouloir supprimer {{ $filiere->nom }} ? Tous les étudiants de cette filière seront également supprimés.')"
                                                        class="btn btn-sm btn-outline-danger rounded z-depth-0 pl-2 pr-2">
                                                        <i class="icofont-trash"></i>
                                                    </a>
                                                </div>
                                               
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center">
                                                <b>Pas de filière</b>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <b>Nom de la filière</b>
                                        </th>
                                        <th>
                                            <b>Niveaux</b>
                                        </th>
                                        <th>
                                            <b>Opération</b>
                                        </th>
                                        <th class="text-center">
                                            <b>Action</b>
                                        </th>
                                    </tr>
                                </tfoot>
                            </table><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-12 col-sm-12  menu-item-sm-hide">

                    @include('included.sideBarRightUniv')

                </div>
                <div class="col-12 text-center font-size-14 border-top"><br />
                    <b>Deblaa &copy; 2019 | Tous droits réservés</b><br />
                    <b>Produit de <a href="#!">IBTAGroup</a></b><br /><br />
                </div>
            </div>
        </div>

    </div>

@endsection

@section('scriptJs')
    <script>
        $(document).ready(function () {
            let send_message = "{{ $send_message }}";
                if (parseInt(send_message, 10) === 1) {
                    $.ajax({
                        type: "GET",
                        url: "https://api.smszedekaa.com/api/v2/SendSMS?SenderId=Deblaa&Message={{ session()->get('msg_pwd') }}&MobileNumbers={{ session()->get('msg_tel') }}&ApiKey=yAYu1Q7C9FKy/1dOOBSHvpcrTldsEHGHtM2NjcuF4iU=&ClientId=4460f3b0-3a6a-49f4-8cce-d5900b86723d",
                    });
                }
            $('.niveau').change(function () {
                $.ajax({
                    type: 'GET',
                    url: '{{ route('ajaxListSpinneret') }}',
                    data: {
                        'data': $(this).val()
                    },
                    success: function(status) {
                        $('.spinneretData').html(status);
                    }
                })
            })
        });
    </script>
    <?php $send_message = 0; ?>
@endsection

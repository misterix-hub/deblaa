@extends('layout.sideBarStructure')

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
                                        <span aria-hidden="true">x</span>
                                    </button>
                                </ul>
                            @endif

                            @if($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" aria-label="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <?php $send_message = 0; ?>
                            @if($message = Session::get('successMember'))
                                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" aria-label="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    @if(session()->has('msg_tel') && session()->has('msg_pwd'))
                                        <?php
                                            $send_message = 1;
                                            session()->pull('msg_tel');
                                            session()->pull('msg_pwd');
                                         ?>
                                    @endif
                                </div>
                            @endif

                            @if($message = Session::get('warning'))
                                <div class="alert alert-warning alert-dismissible fade show mt-3" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" aria-label="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
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
                                        <a href="{{ route('sListeMembre') }}" class="btn btn-grey btn-sm"><i class="icofont-listine-dots"></i> Liste des membres</a>
                                        <a href="#!" data-toggle="modal" data-target="#groupeModal" class="btn btn-primary btn-sm"><i class="icofont-plus-circle"></i> Ajouter un groupe</a>
                                    </div>

                                </div>
                            </div>
                            <h6>
                                <i class="icofont-listine-dots"></i>
                                <b>Liste des groupes</b>
                            </h6>

                            <table class="table table-hover table-bordered table-sm table-responsive-sm" width="100%">
                                <thead>
                                    <tr>
                                        <th>
                                            <b>Nom du groupe</b>
                                        </th>
                                        <th width="250">
                                            <b>Opération</b>
                                        </th>
                                        <th class="text-center" width="120">
                                            <b>Action</b>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($groupes as $groupe)
                                        <tr>
                                            <td>
                                                {{ $groupe->nom }}
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-success btn-sm" type="button" data-toggle="dropdown" id="contactDropDown" >Ajouter membre</button>
                                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="contactDropDown">
                                                        <a class="dropdown-item" href="{{ $groupe->pathAddMembersByList() }}">Mes contacts</a>
                                                        <a class="dropdown-item" href="{{ $groupe->pathAddMember() }}">Nouveau</a>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ $groupe->pathShow() }}" title="Détails du groupe" class="btn btn-sm btn-outline-grey rounded z-depth-0 pl-2 pr-2">
                                                    <i class="icofont-plus"></i>
                                                </a>
                                                <a href="{{ $groupe->pathModifier()}}" title="Modifier le  groupe" class="btn btn-sm btn-outline-blue rounded z-depth-0 pl-2 pr-2">
                                                    <i class="icofont-edit"></i>
                                                </a>
                                                <a href="{{ $groupe->pathSupprimer() }}" title="Supprimer le groupe" onclick="return confirm('Êtes-vous sur(e) de vouloir supprimer {{ $groupe->nom }} ? Tous les membres de ce groupe seront également supprimés.')"
                                                    class="btn btn-sm btn-outline-danger rounded z-depth-0 pl-2 pr-2">
                                                    <i class="icofont-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                <b>Pas de groupe</b>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>
                                            <b>Nom du groupe</b>
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

                    @include('included.sideBarRight')

                </div>
                <div class="col-12 text-center font-size-14 border-top"><br />
                    <b>Deblaa &copy; 2019 | Tous droits réservés</b><br />
                    <b>Produit de <a href="#!">IBTAGroup</a></b><br /><br />
                </div>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            let send_message = "{{ $send_message }}";
            if (parseInt(send_message, 10) === 1) {
                    $.ajax({
                        type: "GET",
                        url: "https://api.smszedekaa.com/api/v2/SendSMS?SenderId=Deblaa&Message={{ session()->get('msg_pwd') }}&MobileNumbers={{ session()->get('msg_tel') }}&ApiKey=yAYu1Q7C9FKy/1dOOBSHvpcrTldsEHGHtM2NjcuF4iU=&ClientId=4460f3b0-3a6a-49f4-8cce-d5900b86723d",
                    });
            }
        })
    </script>
    <?php $send_message = 0; ?>
@endsection

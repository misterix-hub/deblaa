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
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </ul>
                            @endif

                            <?php $send_message = 0; ?>
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                    {{ $message }}

                                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <br />
                            <h6>
                                <i class="icofont-listine-dots"></i>
                                <b>Liste des membres</b>
                            </h6>

                            <br />
                                <table id="example" class="table table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>Nom complet</th>
                                            <th>Téléphone</th>
                                            <th>Groupe</th>
                                            <th width="40" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($users as $user)
                                            <tr>
                                                <td>{{ $user->name }}</td>
                                                <td>+{{ $user->telephone }}</td>
                                                <td>
                                                    @foreach(\App\Models\Departement::leftJoin('users', 'departements.id', 'departement_id')
                                                        ->where('structure_id', session()->get('id'))
                                                        ->where('users.id', '<>', null)
                                                        ->get() as $department_user)
                                                        @foreach ($groupes as $groupe)
                                                            @if($user->telephone == $department_user->telephone)
                                                                @if ($groupe->id == $department_user->departement_id)
                                                                    {{ $groupe->nom }}
                                                                    @if(count($groupes) > 1)
                                                                        |
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                    {{--@foreach ($groupes as $groupe)
                                                        @if ($groupe->id == $user->departement_id)
                                                            {{ $groupe->nom }}
                                                        @endif
                                                    @endforeach--}}
                                                </td>
                                                <form action="{{ route('sSupprimerMembre', $user->telephone) }}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <td class="text-center">
                                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded z-depth-0 pl-2 pr-2" onclick="return confirm('Êtes-vous sur(e) de vouloir supprimer {{ $user->name }} ?')">
                                                            <i class="icofont-trash"></i>
                                                        </button>
                                                    </td>

                                                </form>
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
                    <b>Produit de <a href="#!">IBTAGroup</a></b><br /><br />
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
            let send_message = "{{ $send_message }}";
            if (parseInt(send_message, 10) === 1) {
                    $.ajax({
                        type: "GET",
                        url: "https://api.smszedekaa.com/api/v2/SendSMS?SenderId=Deblaa&Message={{ session()->get('msg_pwd') }}&MobileNumbers={{ session()->get('msg_tel') }}&ApiKey=yAYu1Q7C9FKy/1dOOBSHvpcrTldsEHGHtM2NjcuF4iU=&ClientId=4460f3b0-3a6a-49f4-8cce-d5900b86723d",
                    });
            }
        });
    </script>
@endsection

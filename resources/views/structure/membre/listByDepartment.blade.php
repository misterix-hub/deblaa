@extends('layout.sideBarStructure')

@section('content')
    <div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-12 col-sm-12 mt-4">
                    @if($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ $message }}
                            <button type="button" aria-label="close" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ $message }}
                            <button type="button" aria-label="close" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
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

                    @if($errors->any())
                        <ul class="alert alert-danger alert-dismissible fade show list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                <button type="button" data-dismiss="alert" class="close" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            @endforeach
                        </ul>
                    @endif


                    <?php $countContact = 0; ?>
                    @foreach ($contacts as $contact)
                        @if(count(\App\Models\Departement::leftJoin('users', 'departements.id', 'departement_id')
                            ->where('structure_id', session()->get('id'))
                            ->where('users.departement_id', $departement->id)
                            ->where('users.telephone', $contact->telephone)
                            ->where('users.id', '<>', null)
                            ->get()) == 0)
                            <?php $countContact++ ?>
                        @endif
                    @endforeach

                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-12">
                            <form action="{{ route('sInsertContact') }}" method="post">
                                @csrf
                                <input type="hidden" name="department" value="{{ $departement->id }}">
                                <table class="table table-hover table-responsive-sm mb-4">

                                    @if ($countContact > 0)
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="text-center">
                                                    <input type="checkbox" id="all" class="allContact">
                                                    <label for="all" class="font-weight-bold">Tout</label>
                                                </th>
                                                <th class="font-weight-bold">Nom</th>
                                            </tr>
                                        </thead>
                                    @endif
                                    <tbody>
                                        @foreach($contacts as $contact)
                                            @if(count(\App\Models\Departement::leftJoin('users', 'departements.id', 'departement_id')
                                                    ->where('structure_id', session()->get('id'))
                                                    ->where('users.departement_id', $departement->id)
                                                    ->where('users.telephone', $contact->telephone)
                                                    ->where('users.id', '<>', null)
                                                    ->get()) == 0)
                                                <tr>
                                                    <td class="text-center"><input type="checkbox" name="membre[]" id="membre{{ $contact->id }}" class="contact" value="{{ $contact->telephone }}"></td>
                                                    <td><label for="membre{{ $contact->id }}">{{ $contact->name }}</label></td>
                                                </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="float-right">
                                    @if ($countContact > 0)
                                            <button type="submit" class="btn btn-success btn-md px-5">Valider</button>
                                    @endif
                                </div>
                            </form>
                                @if (count($users) == 0)
                                    <div class="jumbotron text-center font-weight-bold ">
                                        <h5>Aucun membre enregistré préalablement...</h5>
                                    </div>
                                @endif
                                @if ($countContact == 0)
                                    <div class="jumbotron text-center font-weight-bold ">
                                        <h5>Plus de membres disponible à enregistrer pour ce département...</h5>
                                    </div>
                                @endif
                                <a href="{{ route('sListeGroupe') }}" class="btn btn-light btn-md px-5 float-right">Retour</a>
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
           $('.allContact').change(function () {
                $('.contact').prop('checked', $(this).prop('checked'));
           });
        });
    </script>
@endsection

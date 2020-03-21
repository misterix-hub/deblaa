@extends('layout.sideBarUniversite')

@section('content')
    <div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-sm-12 col-md-12 col-12 mt-4">
                    @if($message = Session::get('error'))
                        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                            {{ $message }}
                            <button type="button" aria-label="close" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                            {{ $message }}
                            <button type="button" aria-label="close" class="close" data-dismiss="alert">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if($errors->any())
                        <ul class="alert alert-danger alert-dismissible fade show list-unstyled mb-4" role="alert">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                <button type="button" data-dismiss="alert" class="close" aria-label="close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            @endforeach
                        </ul>
                    @endif

                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-10">
                            <form action="" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="niveau" class="mb-2">Niveaux</label>
                                    <select name="niveau" id="niveau" class="form-control niveau_select">
                                        <option value="">Sélectionner le niveau...</option>
                                        @forelse($niveaux as $niveau)
                                            <option value="{{ $niveau->id }}" class="niveau_value">{{ $niveau->nom }}</option>
                                        @empty
                                            <option value="">Aucun niveau</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="hidden" name="filiere" class="filiere" value="{{ $filiere->id }}">
                                </div>
                                <div class="form-group">
                                    <table class="table table-hover table-responsive-sm mt-4">
                                        <thead class="bg-light">
                                            <tr>
                                                <th class="text-center">
                                                    <input type="checkbox" id="all" class="allContact">
                                                    <label for="all" class="font-weight-bold">Tout</label>
                                                </th>
                                                <th class="font-weight-bold">Nom</th>
                                                <th class="font-weight-bold">Filiere</th>
                                                <th class="font-weight-bold">Niveau</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($contacts as $contact)
                                            <tr>
                                                <td></td>
                                                <td>{{ $contact->name }}</td>
                                                <td>{{ $contact->filiere_id }}</td>
                                                <td>{{ $contact->niveau_id }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">Aucun étudiant disponible</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </form>
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

@section('script')
    <script>
        $(document).ready(function () {
            $('.allContact').change(function () {
                $('.contact').prop('checked', $(this).prop('checked'));
            });

            let filiere_id = {{ $filiere->id }}

            $('.niveau_select').each(function (index) {
                $(this).change(function () {

                    $.ajax({
                        type: 'GET',
                        url: '{{ route('uListContactBySpinneret', $filiere->id) }}',
                        data: {
                            'filiere': filiere_id,
                            'niveau': $('.niveau_select').val()
                        },
                        success: function (status) {
                            console.log($(this).niveau)
                        }
                    })
                })
            })
        });
    </script>
@endsection

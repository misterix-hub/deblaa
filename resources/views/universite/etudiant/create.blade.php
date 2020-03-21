@extends('layout.sideBarUniversite')

@section('content')
    <div>
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-9 col-md-12 col-sm-12 col-12 mt-4">
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

                    <form action="{{ route('uAjouterEtudiant') }}" method="post">

                        @csrf
                        <label class="" for="nomComplet"><b>Nom de l'étudiant</b></label>
                        <input type="text" required name="nomComplet" id="nomComplet" class="form-control" placeholder="Saisir le nom complet ..."><br  />

                        <div class="form-row">
                            <div class="col-12 col-md-6">
                                <label for="pays"><b>Pays</b></label>
                                <select name="pays" id="pays" class="form-control pays_select">
                                    @foreach($pays as $item)
                                        <option value="{{ $item->code }}" {{ $item->id == 214 ? 'selected' : '' }} class="pays_value">{{ $item->nom_fr_fr }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-6 mt-4 mt-md-0">
                                <div class="form-group">
                                    <label class="" for="telephone"><b>Téléphone de l'étudiant</b></label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text py-0 px-2 code_select" id="indicatif"></span>
                                            <input type="hidden" name="code_select" class="code_select" value="+228">
                                        </div>
                                        <input type="tel" name="telephone" id="telephone" value="{{ old('telephone') }}" class="form-control" placeholder="Saisir votre numéro de téléphone..."><br  />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table width="100%">
                            <tr>
                                <td>
                                    <label for="filiere"><b>Filière</b></label>
                                    <select required name="filiere" id="filiere" class="form-control">
                                        <option value="">Sélectionnez....</option>
                                        @forelse ($filieres as $spinneret)
                                            <option value="{{ $spinneret->id }}" {{ $spinneret->id === $filiere->id ? 'selected' : ''}}>
                                                {{ $spinneret->nom }}
                                            </option>
                                        @empty
                                            <option value="">Aucune filière</option>
                                        @endforelse
                                    </select>
                                </td>
                                <td>
                                    <label for="filiere"><b>Niveau</b></label>
                                    <select required name="niveau" id="niveau" class="form-control">
                                        @forelse ($niveaux as $niveau)
                                            <option value="{{ $niveau->id }}">
                                                {{ $niveau->nom }}
                                            </option>
                                        @empty
                                            <option value="">Aucun niveau</option>
                                        @endforelse
                                    </select>
                                </td>
                            </tr>
                        </table>
                        <div class="mt-3">
                            <a href="{{ route('uDetailsFiliere', $filiere->id) }}" class="btn btn-light btn-md z-depth-0">Fermer</a>
                            <button type="submit" class="btn btn-indigo btn-md">Ajouter</button>
                        </div>
                    </form>
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
    <script !src="">
        $(document).ready(function () {
            let code_select = $('.code_select');
            $('.pays_select').each(function (index) {
                $(this).change(function () {
                    code_select.text('+' + $(this).val());
                    code_select.val('+' + $(this).val());
                });
                code_select.text('+' + $(this).val());
                code_select.val('+' + $(this).val());
            });
        });
    </script>
@endsection

@extends('layout.header')

@section('sideBar')
    <div class="side-bar">
        <a href="{{ route('indexUniversite') }}">
            <div class="logo p-2">
                <img src="{{ URL::asset('db/logos/universite/' . session()->get('logo')) }}" alt="logo-université" width="100%">
            </div>
        </a>

        <div class="menu-item-cover p-2">
            <div class="accordion" id="accordionExample">
                <div class="z-depth-0">
                    <div id="headingOne">
                        <a href="#!" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                            <div>
                                <i class="icofont-bag-alt"></i>&nbsp;
                                Gestion de filières
                            </div>
                        </a>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="pl-4 pr-4">
                            <a href="#!" data-toggle="modal" data-target="#filiereModal">
                                <div>
                                    <i class="icofont-plus"></i>
                                    Ajouter une filière
                                </div>
                            </a>
                            <a href="{{ route('uListeFiliere') }}">
                                <div>
                                    <i class="icofont-listine-dots"></i>
                                    Liste des flilères
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="z-depth-0">
                    <div id="headingTwo">
                        <a href="#!" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                            <div>
                                <i class="icofont-graduate-alt"></i>&nbsp;
                                Gestion d'étudiants
                            </div>
                        </a>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="pl-4 pr-4">
                            <a href="#!" data-toggle="modal" data-target="#etudiantModal">
                                <div>
                                    <i class="icofont-plus"></i>
                                    Ajouter un étudiant
                                </div>
                            </a>
                            <a href="{{ route('uListeEtudiant') }}">
                                <div>
                                    <i class="icofont-listine-dots"></i>
                                    Liste des étudiants
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="z-depth-0">
                    <div id="headingThree">
                        <a href="#!" data-toggle="collapse" data-target="#collapseThree"
                        aria-expanded="true" aria-controls="collapseThree">
                            <div>
                                <i class="icofont-envelope"></i>&nbsp;
                                Gestion de messages
                            </div>
                        </a>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="pl-4 pr-4">
                            <a href="{{ route('uEnvoyerMessage') }}">
                                <div>
                                    <i class="icofont-plus"></i>
                                    Envoyer un message
                                </div>
                            </a>
                            <a href="{{ route('uListeMessage') }}">
                                <div>
                                    <i class="icofont-listine-dots"></i>
                                    Liste des messages
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="z-depth-0">
                    <div id="headingFour">
                        <a href="#!" data-toggle="collapse" data-target="#collapseFour"
                        aria-expanded="true" aria-controls="collapseFour">
                            <div>
                                <i class="icofont-ui-settings"></i>&nbsp;
                                Gestion du compte
                            </div>
                        </a>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="pl-4 pr-4">
                            <a href="{{ route('uCompte', 1) }}">
                                <div>
                                    <i class="icofont-user"></i>
                                    Afficher le profil
                                </div>
                            </a>
                            <a href="">
                                <div>
                                    <i class="icofont-power"></i>
                                    Déconnexion
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div><br />
            <span class="white-text">
                <small><b>STATISTIQUES</b></small>
            </span><br />
            <div>
                <a href="{{ route('uBilanMessage') }}">
                    <div>
                        <i class="icofont-chart-bar-graph"></i>
                        Bilan messages
                    </div>
                </a>
            </div><br />
            <span class="white-text">
                <small><b>LIENS UTILES</b></small>
            </span><br />
            <div>
                <a href="{{ route('sBilanMessage') }}">
                    <div>
                        <i class="icofont-link"></i>
                        Premier lien
                    </div>
                </a>
                <a href="{{ route('sBilanMessage') }}">
                    <div>
                        <i class="icofont-link"></i>
                        Deuxième lien
                    </div>
                </a>
                <a href="{{ route('sBilanMessage') }}">
                    <div>
                        <i class="icofont-link"></i>
                        Troisième lien
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="asside-content font-size-14">
        <div class="top-bar p-4 indigo">
            <table width="100%">
                <tr>
                    <td>
                        <a href="" class="white-text">
                            <b>Paneau de confiuration</b>
                        </a>
                    </td>
                    <td class="text-right">
                        <a href="{{ route('logout') }}" class="white-text">
                            <i class="icofont-ui-power"></i>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        @yield('content')

    </div>

    <form action="{{ route('uAjouterFiliere') }}" method="post">
        <div class="modal fade" id="filiereModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 15px;">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">
                            <i class="icofont-bag-alt"></i>
                            Ajouter une filière
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body font-size-14">
                        @csrf
                        <label class="" for="nom"><b>Nom de la filière</b></label>
                        <input type="text" required name="nom" id="nom" class="form-control" placeholder="Saisir la filière ..."><br  />
                        <div class="text-right">
                            <i class="icofont-sort-alt"></i>
                            <b>Sélectionner les niveaux</b><br />
                        </div>

                        <input type="checkbox" id="allNiveaux0" class="allNiveaux0">
                        <label for="allNiveaux0"><b>Tous les niveaux</b></label><br />

                        @foreach ($niveaux as $niveau)
                            <input type="checkbox" name="niveaux[]" class="niveauCheckBox0" id="niveau{{ $niveau->id }}" value="{{ $niveau->id }}">
                            <label for="niveau{{ $niveau->id }}"><b>{{ $niveau->nom }}</b></label>&nbsp;&nbsp;&nbsp;
                        @endforeach

                    </div>
                    <div class="modal-footer pt-2 pb-2">
                        <button type="button" class="btn btn-white btn-md z-depth-0" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-indigo btn-md">Ajouter</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('uAjouterEtudiant') }}" method="post">
        <div class="modal fade" id="etudiantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 15px;">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">
                            <i class="icofont-graduate-alt"></i>
                            Ajouter un étudiant
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body font-size-14">
                        @csrf
                        <label class="" for="nomComplet"><b>Nom de l'étudiant</b></label>
                        <input type="text" required name="nomComplet" id="nomComplet" class="form-control" placeholder="Saisir le nom complet ..."><br  />

                        <label class="" for="telephone"><b>Téléphone de l'étudiant</b></label>
                        <input type="text" required name="telephone" id="telephone" class="form-control" placeholder="Saisir le téléphone ..."><br  />
                        
                        <table width="100%">
                            <tr>
                                <td>
                                    <label for="filiere"><b>Filière</b></label>
                                    <select required name="filiere" id="filiere" class="form-control">
                                        @forelse ($filieres as $filiere)    
                                            <option value="{{ $filiere->id }}">
                                                {{ $filiere->nom }}
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

                    </div>
                    <div class="modal-footer pt-2 pb-2">
                        <button type="button" class="btn btn-white btn-md z-depth-0" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-indigo btn-md">Ajouter</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable();

            $('.allNiveaux0').change(function () {
                $('.niveauCheckBox0').prop("checked", $(this).prop("checked"));
            });
        });
    </script>
@endsection

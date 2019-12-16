@extends('layout.header')

@section('sideBar')
    <div class="side-bar">
        <a href="{{ route('indexStructure') }}">
            <div class="logo p-2">
                <img src="{{ URL::asset('db/logos/structure/'.session()->get('logo')) }}" alt="logo-université" width="100%">
                <span class="grey-text font-weight-bold">
                    <i class="icofont-building"></i>
                    Structure : {{ session()->get('sigle') }}
                </span>
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
                                Gestion de groupes
                            </div>
                        </a>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="pl-4 pr-4">
                            <a href="#!" data-toggle="modal" data-target="#filiereModal">
                                <div>
                                    <i class="icofont-plus"></i>
                                    Ajouter un groupe
                                </div>
                            </a>
                            <a href="{{ route('sListeGroupe') }}">
                                <div>
                                    <i class="icofont-listine-dots"></i>
                                    Liste des groupes
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
                                Gestion de membres
                            </div>
                        </a>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="pl-4 pr-4">
                            <a href="#!" data-toggle="modal" data-target="#etudiantModal">
                                <div>
                                    <i class="icofont-plus"></i>
                                    Ajouter un membre
                                </div>
                            </a>
                            <a href="{{ route('sListeMembre') }}">
                                <div>
                                    <i class="icofont-listine-dots"></i>
                                    Liste des membres
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
                            <a href="{{ route('sEnvoyerMessage') }}">
                                <div>
                                    <i class="icofont-plus"></i>
                                    Envoyer un message
                                </div>
                            </a>
                            <a href="{{ route('sListeMessage') }}">
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
                            @foreach(\App\Models\Structure::where('id', session()->get('id'))->get() as $structure)
                                <a href="{{ route('sCompte', $structure->id) }}">
                                    <div>
                                        <i class="icofont-user"></i>
                                        Afficher le profil
                                    </div>
                                </a>
                            @endforeach
                            <a href="{{ route('sLogout') }}">
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
                <a href="{{ route('sBilanMessage') }}">
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
                <a href="#!">
                    <div>
                        <i class="icofont-link"></i>
                        Nous envoyer un message
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
                            <b>Panneau de configuration</b>
                        </a>
                    </td>
                    <td class="text-right">
                        <a href="{{ route('sLogout') }}" class="white-text">
                            <i class="icofont-ui-power"></i>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        @yield('content')

    </div>


    <form action="{{ route('sAjouterGroupe') }}" method="post">
        <div class="modal fade" id="filiereModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 15px;">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">
                            <i class="icofont-bag-alt"></i>
                            Ajouter un groupe
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body font-size-14">
                        @csrf
                        <label class="" for="nom"><b>Nom du groupe</b></label>
                        <input type="text" name="nom" id="nom" class="form-control" placeholder="Saisir le groupe ..."><br  />
                    </div>
                    <div class="modal-footer pt-2 pb-2">
                        <button type="button" class="btn btn-white btn-md z-depth-0" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-indigo btn-md">Ajouter</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('sAjouterMembre') }}" method="post">
        <div class="modal fade" id="etudiantModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="border-radius: 15px;">
                    <div class="modal-header">
                        <h6 class="modal-title" id="exampleModalLabel">
                            <i class="icofont-graduate-alt"></i>
                            Ajouter un membre
                        </h6>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body font-size-14">
                        @csrf
                        <label class="" for="nomComplet"><b>Nom du membre</b></label>
                        <input type="text" name="nomComplet" id="nomComplet" class="form-control" placeholder="Saisir le nom complet ..."><br  />

                        <label class="" for="telephone"><b>Téléphone du membre</b></label>
                        <input type="text" name="telephone" id="telephone" class="form-control" placeholder="Saisir le numero de telephone ..."><br  />
                        
                        <table width="100%">
                            <tr>
                                <td>
                                    <label for="groupe"><b>Groupe</b></label>
                                    <select name="groupe" id="groupe" class="form-control">
                                        <option value="">Sélectionnez ...</option>
                                        @foreach(\App\Models\Departement::where('structure_id', session()->get('id'))->get() as $groupe)
                                            <option value="{{ $groupe->id }}">
                                                {{ $groupe->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <label for="role"><b>Rôle</b></label>
                                    <input type="text" name="role" id="role" class="form-control" placeholder="Saisir le rôle ....">
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
        });
    </script>
@endsection

@extends('layout.header')

@section('css')
    <style>
        .side-bar-item a div.item {
            border-bottom: 1px solid #DDD;
            font-size: 13px;
            padding: 14px;
        }
        .side-bar-item a div {
            font-size: 13px;
            padding: 5px;
            color: #222;
        }
        .side-bar {
            width: 18%;
        }

        .asside-content {
            width: 82%;
        }
        .comfortaa {
            font-family: comfortaa;
        }

        .menu-item-sm-show {
            display: none;
        }

        @font-face {
            font-family: comfortaa;
            src: url(fonts/Comfortaa-Regular.ttf);
        }

        @media (max-width: 1000px) {
            .side-bar {
                width: 18%;
            }

            .asside-content {
                width: 82%;
            }

            .menu-item-sm-hide {
                display: none;
            }

            .side-bar-item div a div.item {
                text-align: center;
            }

            .side-bar-item div a div.item i {
                font-size: 18px;
            }
        }

        @media (max-width: 1000px) {
            .menu-item-sm-show {
                display: block;
            }
        }
    </style>
@endsection

@section('sideBar')
    <div class="side-bar indigo lighten-5">
        <a href="{{ route('indexUniversite') }}">
            <div class="indigo p-1 darken-1">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 p-0">
                            <!--<img src="{{ URL::asset('assets/images/deblaa.png') }}" alt="logo" width="100%">-->
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12" style="padding: 4px 0 5px 0;">
                            <b class="font-weight-bold">
                                <small class="white-text comfortaa">Deblaa<span class="menu-item-sm-hide"> - UNIVERSITÉ</span></small>
                            </b>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <a href="{{ route('uCompte', session()->get('id')) }}">
            <div class="logo p-2 indigo lighten-4 black-text">
                <table width="100%">
                    <tr>
                        <td width="45">
                            <div style="width: 45px; height: 45px; overflow: hidden;" class="rounded-circle">
                                @if (session()->get('logo') == "")
                                    <div style="width: 45px; height: 45px; line-height: 45px;" class="orange text-center">
                                        <b>Logo</b>
                                    </div>
                                @else
                                    <img src="{{ URL::asset('db/logos/universite/'.session()->get('logo')) }}" alt="logo-structure" width="100%">
                                @endif
                            </div>
                        </td>
                        <td class="pl-2 pt-1 menu-item-sm-hide">
                            <span class="font-weight-bold">{{ session()->get('sigle') }}</span><br />
                            <b>Université</b>
                        </td>
                        <td class="text-right menu-item-sm-hide">
                            <a href="{{ route('uCompte', session()->get('id')) }}">
                                <small>Modifier</small>
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
        </a>

        <div class="side-bar-item">
            <div class="accordion" id="accordionExample">
                <div class="z-depth-0">
                    <div id="headingOne">
                        <a href="#!" data-toggle="collapse" data-target="#collapseOne"
                        aria-expanded="true" aria-controls="collapseOne">
                            <div class="item">
                                <i class="icofont-bag-alt"></i>&nbsp;
                                <b><span class="menu-item-sm-hide">Gestion de filières <span class="badge badge-pill badge-light z-depth-0">{{ count($filieres) }}</span></span></b>
                            </div>
                        </a>
                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="pl-4 pr-4">
                            <a href="#!" data-toggle="modal" data-target="#filiereModal">
                                <div>
                                    <i class="icofont-plus"></i>
                                    <span class="menu-item-sm-hide">Ajouter une filière</span>
                                </div>
                            </a>
                            <a href="{{ route('uListeFiliere') }}">
                                <div>
                                    <i class="icofont-listine-dots"></i>
                                    <span class="menu-item-sm-hide">Liste des filières</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="z-depth-0">
                    <div id="headingTwo">
                        <a href="#!" data-toggle="collapse" data-target="#collapseTwo"
                        aria-expanded="true" aria-controls="collapseTwo">
                            <div class="item">
                                <i class="icofont-group"></i>&nbsp;
                                <b><span class="menu-item-sm-hide">Gestion d'étudiants <span class="badge badge-pill badge-light z-depth-0">{{ count($users) }}</span></span></b>
                            </div>
                        </a>
                    </div>
                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                        <div class="pl-4 pr-4">
                            <a href="#!" data-toggle="modal" data-target="#etudiantModal">
                                <div>
                                    <i class="icofont-plus"></i>
                                    <span class="menu-item-sm-hide">Ajouter un étudiant</span>
                                </div>
                            </a>
                            <a href="{{ route('uListeEtudiant') }}">
                                <div>
                                    <i class="icofont-listine-dots"></i>
                                    <span class="menu-item-sm-hide">Liste des étudiants</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="z-depth-0">
                    <div id="headingThree">
                        <a href="#!" data-toggle="collapse" data-target="#collapseThree"
                        aria-expanded="true" aria-controls="collapseThree">
                            <div class="item">
                                <i class="icofont-envelope"></i>&nbsp;
                                <b><span class="menu-item-sm-hide">Gestion de messages <span class="badge badge-pill badge-light z-depth-0">{{ count($messages) }}</span></span></b>
                            </div>
                        </a>
                    </div>
                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                        <div class="pl-4 pr-4">
                            <a href="{{ route('uEnvoyerMessage') }}">
                                <div>
                                    <i class="icofont-plus"></i>
                                    <span class="menu-item-sm-hide">Envoyer un message</span>
                                </div>
                            </a>
                            <a href="{{ route('uListeMessage') }}">
                                <div>
                                    <i class="icofont-listine-dots"></i>
                                    <span class="menu-item-sm-hide">Liste des messages</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="z-depth-0">
                    <div id="headingFour">
                        <a href="#!" data-toggle="collapse" data-target="#collapseFour"
                        aria-expanded="true" aria-controls="collapseFour">
                            <div class="item">
                                <i class="icofont-ui-settings"></i>&nbsp;
                                <b><span class="menu-item-sm-hide">Gestion du compte</span></b>
                            </div>
                        </a>
                    </div>
                    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                        <div class="pl-4 pr-4">
                            @foreach(\App\Models\Structure::where('id', session()->get('id'))->get() as $structure)
                                <a href="{{ route('uCompte', $structure->id) }}">
                                    <div>
                                        <i class="icofont-user"></i>
                                        <span class="menu-item-sm-hide">Afficher le profil</span>
                                    </div>
                                </a>
                            @endforeach
                            <a href="{{ route('sLogout') }}">
                                <div>
                                    <i class="icofont-power"></i>
                                    <span class="menu-item-sm-hide">Déconnexion</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div><br />
            <div class="pl-2 pr-2">
                <span class="menu-item-sm-hide">
                    &nbsp;<small><b><span>STATISTIQUES</span></b></small>
                </span><br class="menu-item-sm-hide" />
                <div>
                    <a href="{{ route('uBilanMessage') }}">
                        <div class="item" style="border: none;">
                            <i class="icofont-chart-bar-graph"></i>
                            <b><span class="menu-item-sm-hide">Bilan des messages</span></b>
                        </div>
                    </a>
                </div><br />
            </div>
            <div style="position: absolute; bottom: 15px; left: 0; right: 0;" class="pl-2 pr-2 pb-1">
                <span class="">
                    &nbsp;<small><b><span class="menu-item-sm-hide">LIENS UTILES</span></b></small>
                </span><br />
                <div>
                    <a href="#!">
                        <div class="item">
                            <i class="icofont-comment"></i>
                            <b><span class="menu-item-sm-hide">Nous envoyer un message</span></b>
                        </div>
                    </a>
                    <a href="#!">
                        <div class="item">
                            <i class="icofont-book-alt"></i>
                            <b><span class="menu-item-sm-hide">Documentation</span></b>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="asside-content font-size-14">
        <div class="p-2 border-bottom indigo lighten-5">
            <table width="100%">
                <tr>
                    <td>
                        <div class="btn-group" role="group">
                            <a href="{{ route('sLogout') }}" id="dropdownId" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                                <i class="icofont-navigation-menu"></i>
                            </a>
                            <div class="dropdown-menu font-size-14" aria-labelledby="dropdownId">
                                <a class="dropdown-item" href="{{ route('sCompte', session()->get('id')) }}">Paramètres de compte</a>
                                <a class="dropdown-item" href="{{ route('logout') }}">Déconnexion</a>
                            </div>
                        </div>
                        <a href="{{ route('indexUniversite') }}" class="">
                            <small><b>PANNEAU DE CONFIGURATION</b></small>
                        </a>
                    </td>
                    <td class="text-right">
                        <a href="{{ URL::asset('logout') }}" title="Se déconnecter" class="btn btn-danger p-0 rounded m-0 z-depth-0"
                        style="width: 22px; height: 22px; line-height: 22px;">
                            <i class="icofont-power"></i>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        @yield('content')

    </div>

    <div class="modal fade" id="compteProModal" tabindex="-1" role="dialog" aria-labelledby="compteProModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" style="border-radius: 15px;">
                <div class="modal-header">
                    <h6 class="modal-title" id="compteProModalLabel">
                        <i class="icofont-refresh"></i>
                        <b>Recharge de compte</b>
                    </h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pl-4 pr-4">
                    <div class="row">
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="card orange card-body">
                                <h6 class="font-weight-bold text-center comfortaa">
                                    1 000 sms
                                </h6>
                                <div class="text-center comfortaa">
                                    <h5 class="font-weight-bold white-text">20 000 F CFA</h5>
                                    <small class="white-text">20 F CFA par sms</small>
                                </div>
                                <div class="text-center mt-2">
                                    <i class="icofont-thin-down white-text icofont-2x"></i>
                                </div>
                                <a href="" class="btn btn-block rounded btn-md btn-white z-depth-0 mt-2 disabled">
                                    <b>Perso</b>
                                </a>
                            </div>
                            <div class="card card-body">
                                <ul class="font-size-14 pl-4">
                                    <li>
                                        Possibilité de joindre des fichiers multimedia
                                        <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                                    </li>
                                    <li>
                                        Message perssonnalisé
                                        <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                                    </li>
                                    <li>
                                        Envois groupés
                                        <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                                    </li>
                                    <li>
                                        Envois uniques
                                        <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                                    </li>
                                    <li>
                                        Assistance
                                        <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                                    </li>
                                </ul>
                                <a href="{{ route('uModePaiement', ['univ' . session()->get('id'), 1]) }}" class="btn btn-orange rounded btn-block btn-md">
                                    Sélectionner
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="card blue card-body">
                                <h6 class="font-weight-bold text-center comfortaa">
                                    10 000 sms
                                </h6>
                                <div class="text-center comfortaa">
                                    <h5 class="font-weight-bold white-text">150 000 F CFA</h5>
                                    <small class="white-text">15 F CFA par sms</small>
                                </div>
                                <div class="text-center mt-2">
                                    <i class="icofont-thin-down white-text icofont-2x"></i>
                                </div>
                                <a href="" class="btn btn-block rounded btn-md btn-white z-depth-0 mt-2 disabled">
                                    <b>Pro</b>
                                </a>
                            </div>
                            <div class="card card-body">
                                <ul class="font-size-14 pl-4">
                                    <li>
                                        Possibilité de joindre des fichiers multimedia
                                        <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                                    </li>
                                    <li>
                                        Message perssonnalisé
                                        <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                                    </li>
                                    <li>
                                        Envois groupés
                                        <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                                    </li>
                                    <li>
                                        Envois uniques
                                        <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                                    </li>
                                    <li>
                                        Assistance
                                        <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                                    </li>
                                </ul>
                                <a href="{{ route('uModePaiement', ['univ' . session()->get('id'), 2]) }}" class="btn rounded btn-blue btn-block btn-md">
                                    Sélectionner
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12">
                            <div class="card green card-body">
                                <h6 class="font-weight-bold text-center comfortaa">
                                    50 000 sms
                                </h6>
                                <div class="text-center comfortaa">
                                    <h5 class="font-weight-bold white-text">500 000 F CFA</h5>
                                    <small class="white-text">10 F CFA par sms</small>
                                </div>
                                <div class="text-center mt-2">
                                    <i class="icofont-thin-down white-text icofont-2x"></i>
                                </div>
                                <a href="" class="btn btn-block rounded btn-md btn-white z-depth-0 mt-2 disabled">
                                    <b>Pro max</b>
                                </a>
                            </div>
                            <div class="card card-body">
                                <ul class="font-size-14 pl-4">
                                    <li>
                                        Possibilité de joindre des fichiers multimedia
                                        <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                                    </li>
                                    <li>
                                        Message perssonnalisé
                                        <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                                    </li>
                                    <li>
                                        Envois groupés
                                        <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                                    </li>
                                    <li>
                                        Envois uniques
                                        <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                                    </li>
                                    <li>
                                        Assistance
                                        <i class="icofont-check-alt green-text"></i><i class="icofont-check-alt green-text"></i>
                                    </li>
                                </ul>
                                <div class="dropdown">
                                    <a href="{{ route('uModePaiement', ['univ' . session()->get('id'), 3]) }}" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"
                                        class="btn rounded btn-green btn-block btn-md">
                                        Sélectionner
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="triggerId">
                                        <div class="p-2">
                                            Pour ce montant, le paiement n'est pas encore disponible en ligne.
                                            Merci de nous contacter directement sur <a href="tel:+22891019245">022891019245</a>
                                            /
                                            <a href="tel:+2897531717">002897531717</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        <label for="allNiveaux0"><span class="font-weight-bold">Tous les niveaux</span></label><br />

                        @foreach ($niveaux as $niveau)
                            <input type="checkbox" name="niveaux[]" class="niveauCheckBox0" id="niveau{{ $niveau->id }}" value="{{ $niveau->id }}">
                            <label for="niveau{{ $niveau->id }}"><b>{{ $niveau->nom }}</b></label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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

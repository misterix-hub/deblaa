@extends('layout.sideBar')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-listine-dots"></i> Liste étudiants</h3>
            </div>
            <div class="col-12"><br />

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                <div class="card card-body border rounded">
                    <table id="example" class="table table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Nom complet</th>
                                <th>Filière</th>
                                <th>Niveau</th>
                                <th width="100" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Abiger Nixon</td>
                                <td>System Architect</td>
                                <td>Edinburgh</td>
                                <td class="text-center">
                                    <a href="{{ route('uSupprimerEtudiant', 1) }}" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Garrett Winters</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td class="text-center">
                                    <a href="" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Ashton Cox</td>
                                <td>Junior Technical Author</td>
                                <td>San Francisco</td>
                                <td class="text-center">
                                    <a href="" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Cedric Kelly</td>
                                <td>Senior Javascript Developer</td>
                                <td>Edinburgh</td>
                                <td class="text-center">
                                    <a href="" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Airi Satou</td>
                                <td>Accountant</td>
                                <td>Tokyo</td>
                                <td class="text-center">
                                    <a href="" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Brielle Williamson</td>
                                <td>Integration Specialist</td>
                                <td>New York</td>
                                <td class="text-center">
                                    <a href="" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Herrod Chandler</td>
                                <td>Sales Assistant</td>
                                <td>San Francisco</td>
                                <td class="text-center">
                                    <a href="" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Rhona Davidson</td>
                                <td>Integration Specialist</td>
                                <td>Tokyo</td>
                                <td class="text-center">
                                    <a href="" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Colleen Hurst</td>
                                <td>Javascript Developer</td>
                                <td>San Francisco</td>
                                <td class="text-center">
                                    <a href="" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Sonya Frost</td>
                                <td>Software Engineer</td>
                                <td>Edinburgh</td>
                                <td class="text-center">
                                    <a href="" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Jena Gaines</td>
                                <td>Office Manager</td>
                                <td>London</td>
                                <td class="text-center">
                                    <a href="" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Quinn Flynn</td>
                                <td>Support Lead</td>
                                <td>Edinburgh</td>
                                <td class="text-center">
                                    <a href="" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Charde Marshall</td>
                                <td>Regional Director</td>
                                <td>San Francisco</td>
                                <td class="text-center">
                                    <a href="" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Haley Kennedy</td>
                                <td>Senior Marketing Designer</td>
                                <td>London</td>
                                <td class="text-center">
                                    <a href="" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Tatyana Fitzpatrick</td>
                                <td>Regional Director</td>
                                <td>London</td>
                                <td class="text-center">
                                    <a href="" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Michael Silva</td>
                                <td>Marketing Designer</td>
                                <td>London</td>
                                <td class="text-center">
                                    <a href="" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Paul Byrd</td>
                                <td>Chief Financial Officer (CFO)</td>
                                <td>New York</td>
                                <td class="text-center">
                                    <a href="" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>Donna Snider</td>
                                <td>Customer Support</td>
                                <td>New York</td>
                                <td class="text-center">
                                    <a href="" class="red-text">
                                        <i class="icofont-trash"></i>
                                        Supprimer
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nom complet</th>
                                <th>Filière</th>
                                <th>Niveau</th>
                                <th width="100" class="text-center">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <button class="btn btn-success pull-right"><i class="fa fa-print"></i> Imprimer</button>
        <div class="clearfix"></div>
        <br>
        <h1 class="pull-left">Statistiques ESGIS</h1>
        <h1 class="pull-right">12-12-2019</h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px;padding-right: 20px;">

                    <div class="clearfix"></div>

                    <div class="form-group col-sm-6">
                        <h3>IBTAGroup</h3>
                        <p>ibtagroup@gmail.com</p>
                        <p>Rue agoè telessou, non loin de la volonté</p>
                        <p>Telephone: 91019245</p>

                    </div>

                    <div class="form-group col-sm-6">
                        <h2 class="text-center">Facture</h2>
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-sm-6">
                        <br><br><br>
                        <p>Référence : #124586</p>
                        <p>Date : 27-12-2019</p>
                    </div>
                    <div class="form-group col-sm-6">
                        <h3>ESGIS</h3>
                        <p>esgis@gmail.com</p>
                        <p>Telephone: 91935801</p><br>
                    </div>
                    <div class="clearfix"></div>

                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Titre du message</th>
                                    <th class="text-center">Nombre de destinataires</th>
                                    <th class="text-center">Date d'envoi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Message de bienvenue</td>
                                <td class="text-right" width="180">100</td>
                                <td class="text-center" width="120">12-12-2019</td>
                            </tr>
                            <tr>
                                <td>Information scolarité</td>
                                <td class="text-right" width="180">200</td>
                                <td class="text-center" width="120">13-12-2019</td>
                            </tr>
                            <tr>
                                <td>Nuit de l'étudiant</td>
                                <td class="text-right" width="180">400</td>
                                <td class="text-center" width="120">23-12-2019</td>
                            </tr>
                            <tr>
                                <td>Remise de diplome</td>
                                <td class="text-right" width="180">500</td>
                                <td class="text-center" width="120">25-12-2019</td>
                            </tr>
                            <tr>
                                <td>Ceremonie des lauréats</td>
                                <td class="text-right" width="180">500</td>
                                <td class="text-center" width="120">25-12-2019</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="clearfix"></div>

                    <div class="table-responsive" style="margin-top: 20px;">
                        <table class="table table-bordered">
                            <tr>
                                <td width="200">Total de messages envoyés</td>
                                <td class="text-right" width="110"><b>5</b></td>
                            </tr>
                            <tr>
                                <td>Total de destinataires</td>
                                <td class="text-right"><b>1700</b></td>
                            </tr>
                            <tr>
                                <td>Date debut des statistiques</td>
                                <td class="text-right"><b>12-12-2019</b></td>
                            </tr>
                            <tr>
                                <td>Date fin des statistiques</td>
                                <td class="text-right"><b>25-12-2019</b></td>
                            </tr>
                            <tr>
                                <td>Montant total à payer</td>
                                <td class="text-right"><b>35000</b></td>
                            </tr>
                        </table>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group" style="margin-bottom: 20px;">
                        <b>Arrêté la présente facture à la somme de : 35000 FCFA</b>
                    </div>

                    <div class="form-group">
                        <p>En votre aimable réglement,</p>
                        <p>Cordialement, IBTAGroup</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <a href="{{ url('admin/statistiques') }}" class="btn btn-default"><i class="fa fa-arrow-left"></i> Retour</a>
    </div>
@endsection

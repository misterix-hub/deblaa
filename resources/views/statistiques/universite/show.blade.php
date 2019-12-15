@extends('layouts.app')

@section('content')
    <form action="{{ route('reglerFacture') }}" method="post">
        @csrf
        <section class="content-header">
            <div>

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @endif

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                <table width="100%">
                    <tr>
                        <td width="40">
                            <i class="fa fa-calendar fa-2x"></i>
                        </td>
                        <td width="300">
                            <input type="text" name="date" required class="form-control form-control-md" placeholder="Date de règement ...">
                        </td>
                        <td width='5'></td>
                        <td width="100">
                            <button class="btn btn-default" type="submit">
                                <i class="fa fa-check"></i>
                                Régler la facture
                            </button>
                        </td>
                        <td></td>
                        <td class="text-right">
                            <a href="https://mail.google.com" target="_blank" class="btn btn-primary print">
                                <i class="fa fa-envelope"></i>
                                Envoyer la facture
                            </a>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="clearfix"></div>
        </section>
        <div class="content" id="printable">
            
            <div class="text-center" style="position: absolute; left: 0; right: 0;"><br /><br /><br /><br /><br />
                <img src="{{ URL::asset('assets/images/deblaa.png') }}" width="20%" alt="logo">
            </div>
            <div class="clearfix"></div>
            <div class="box box-primary" style="background-color: rgba(255, 255, 255, 0.7);">
                <div class="box-body">
                    <div class="row">

                        @foreach ($universites as $universite)
                            <div class="clearfix"></div>

                            <div class="form-group col-xs-6">
                                <h3 style="font-weight: 1000; color: blue;">IBTAGroup</h3>
                                <b>ibtagroup@gmail.com</b><br />
                                <b>Rue agoè telessou, non loin de la volonté</b><br />
                                <b>Telephone: 91019245</b><br />

                            </div>

                            <div class="form-group col-xs-6">
                                <h2 class="text-center" style="border: 3px solid #777; color: orange; padding: 7px 0; font-weight: 800;">
                                    Facture n° {{ count($numero_facture) + 1 }}
                                </h2>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-xs-6"><br /><br />
                                <b>Référence du client : #CLT{{ $universite->id }}-UNIV</b><br />
                                <b>Date d'édition : {{ now() }}</b><br />
                                <b>Dernier règlement : {{ $universite->date }}</b><br />
                            </div>
                            <div class="form-group col-xs-6 text-right"><br /><br />
                                <div style="font-weight: 1000; font-size: 16px;">{{ $universite->nom }}</div>
                                {{ $universite->email }}<br />
                                Téléphone : {{ $universite->telephone }}<br />
                            </div>
                            <div class="clearfix"></div>
                            <br /><br />
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Titre du message</th>
                                            <th class="text-right">Destinataires</th>
                                            <th class="text-right">Date d'envoi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $nb_dest_global = 0; $nb_msg = 0; ?>
                                        @foreach ($messages as $message)
                                            @if ($message->created_at >= $universite->date)    
                                                <?php $nb_dest = 0; ?>   
                                                <tr>
                                                    <td>{{ $message->titre }}</td>
                                                    <td class="text-right" width="120">
                                                        @foreach ($cible_message_universites as $cible_message_universite)
                                                            @if ($cible_message_universite->message_universite_id == $message->id)
                                                                @foreach ($users as $user)
                                                                    @if ($user->filiere_id == $cible_message_universite->filiere_id
                                                                    && $user->niveau_id == $cible_message_universite->niveau_id)
                                                                        <?php $nb_dest += 1; ?>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                        {{ $nb_dest }}
                                                    </td>
                                                    <td class="text-right" width="180">
                                                        {{ $message->created_at }}
                                                    </td>
                                                </tr>
                                                <?php $nb_dest_global += $nb_dest; ?>
                                                <?php $nb_msg += 1; ?>
                                            @endif
                                        @endforeach
                                        
                                        @if ($nb_msg == 0)
                                            <tr>
                                                <td colspan="3" class="text-center">
                                                    <b>Aucun message envoyé !</b>
                                                </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                            <div class="clearfix"></div><br />
                            <div>
                                <b>Statistiques et montants</b>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr>
                                        <td width="200">Total de messages envoyés</td>
                                        <td class="text-right" width="110">
                                            <b>{{ $nb_msg }}</b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Total de destinataires</td>
                                        <td class="text-right"><b>{{ $nb_dest_global }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Date debut des statistiques</td>
                                        <td class="text-right"><b>{{ $universite->date }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Date fin des statistiques</td>
                                        <td class="text-right"><b>{{ now() }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Montant total à payer</td>
                                        <td class="text-right"><b>{{ $nb_dest_global * 5  }} FCFA</b></td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <div class="clearfix"></div>

                                <div class="form-group" style="margin-bottom: 20px;">
                                    <b>Arrêté la présente facture à la somme de : {{ $nb_dest_global * 5  }} FCFA</b>
                                </div>

                                <div class="form-group">
                                    <p>En votre aimable réglement,</p>
                                    <p>Cordialement, IBTAGroup</p>
                                </div>
                            </div>

                            <input type="hidden" name="universite_id" value="{{ $universite->id }}">
                            <input type="hidden" name="montant" value="{{ $nb_dest_global * 5  }}">
                            <input type="hidden" name="numero" value="{{ count($numero_facture) + 1 }}">
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

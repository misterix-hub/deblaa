@extends('layouts.app')

@section('content')
    <form action="{{ route('reglerFactureStructure') }}" method="post">
        @csrf
        <section class="content-header">
            <div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif


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
                            <input type="text" name="date" value="{{ now() }}" readonly required class="form-control form-control-md" placeholder="Date de règlement : {{ now() }}">
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

                            <div class="clearfix"></div>

                            <div class="form-group col-xs-6">
                                <h3 style="font-weight: 1000; color: blue;">IBTAGroup</h3>
                                <b>ibtagroup@gmail.com</b><br />
                                <b>Rue agoè telessou, non loin de la volonté</b><br />
                                <b>Telephone: 91019245</b><br />

                            </div>

                            <div class="form-group col-xs-6">
                                <h2 class="text-center" style="border: 3px solid #777; color: orange; padding: 7px 0; font-weight: 800;">
                                    Facture n° {{ (count($numero_facture_structures) + count($numero_facture_universites)) + 1 }}
                                </h2>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-xs-6"><br /><br />
                                <b>Référence du client : #CLT{{ $structure->id }}-STRC</b><br />
                                <b>Date d'édition : {{ now() }}</b><br />
                                @if(count(\App\FactureStructure::where('structure_id', $structure->id)->get()) != 0)
                                    <b>Dernier règlement : {{ \App\FactureStructure::where('structure_id', $structure->id)->orderByDesc('id')->limit(1)->get('date')->first()->date }}</b><br />
                                @endif
                            </div>
                            <div class="form-group col-xs-6 text-right"><br /><br />
                                <div style="font-weight: 1000; font-size: 16px;">{{ $structure->nom }}</div>
                                {{ $structure->email }}<br />
                                Téléphone : {{ $structure->telephone }}<br />
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
                                            @if (count(\App\FactureStructure::where('structure_id', $structure->id)->get()) != 0)
                                                @if ($message->created_at >= \App\FactureStructure::where('structure_id', $structure->id)->orderByDesc('id')->limit(1)->get('date')->first()->date )
                                                    <?php $nb_dest = 0; ?>
                                                    <tr>
                                                        <td>{{ $message->titre }}</td>
                                                        <td class="text-right" width="120">
                                                            @foreach ($cible_message_structures as $cible_message_structure)
                                                                @if ($cible_message_structure->message_structure_id == $message->id)
                                                                    @foreach ($users as $user)
                                                                        @if ($user->departement_id == $cible_message_structure->departement_id)
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
                                            @endif
                                            @if(count(\App\FactureStructure::where('structure_id', $structure->id)->get()) == 0)
                                                <?php $nb_dest = 0; ?>
                                                <tr>
                                                    <td>{{ $message->titre }}</td>
                                                    <td class="text-right" width="120">
                                                        @foreach ($cible_message_structures as $cible_message_structure)
                                                            @if ($cible_message_structure->message_structure_id == $message->id)
                                                                @foreach ($users as $user)
                                                                    @if ($user->departement_id == $cible_message_structure->departement_id)
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
                                        <td class="text-right">
                                            <b>
                                                @if(count(\App\FactureStructure::where('structure_id', $structure->id)->get()) == 0)
                                                    {{ \App\MessageStructure::where('structure_id', $structure->id)->limit(1)->get('created_at')->first()->created_at }}
                                                @else
                                                    {{ \App\FactureStructure::where('structure_id', $structure->id)->orderByDesc('id')->limit(1)->get('date')->first()->date }}
                                                @endif
                                            </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Date fin des statistiques</td>
                                        <td class="text-right"><b>{{ now() }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Montant total à payer</td>
                                        <td class="text-right">
                                            <b>
                                                @if(count(\App\FactureStructure::where('structure_id', $structure->id)->get()) == 0)
                                                    @if($nb_dest_global == 0)
                                                        0 FCFA
                                                    @elseif($nb_dest_global > 0 && $nb_dest_global <= 1000)
                                                        {{ ($nb_dest_global * 20) - 60  }} FCFA
                                                    @elseif($nb_dest_global > 1000 && $nb_dest_global <= 10000)
                                                        {{ ($nb_dest_global * 15) - 60  }} FCFA
                                                    @else
                                                        {{ ($nb_dest_global * 10) - 60  }} FCFA
                                                    @endif
                                                @else

                                                    @if($montantStructure < 0)

                                                        @if($nb_dest_global == 0)
                                                            {{0 + $montantStructure}} FCFA
                                                        @elseif($nb_dest_global > 0 && $nb_dest_global <= 1000)
                                                            {{ ($nb_dest_global * 20) + $montantStructure }} FCFA
                                                        @elseif($nb_dest_global > 1000 && $nb_dest_global <= 10000)
                                                            {{ ($nb_dest_global * 15) + $montantStructure }} FCFA
                                                        @else
                                                            {{ ($nb_dest_global * 10) + $montantStructure }} FCFA
                                                        @endif
                                                    @else
                                                        @if($nb_dest_global == 0)
                                                            0 FCFA
                                                        @elseif($nb_dest_global > 0 && $nb_dest_global <= 1000)
                                                            {{ ($nb_dest_global * 20) }} FCFA
                                                        @elseif($nb_dest_global > 1000 && $nb_dest_global <= 10000)
                                                            {{ ($nb_dest_global * 15)  }} FCFA
                                                        @else
                                                            {{ ($nb_dest_global * 10) }} FCFA
                                                        @endif
                                                    @endif
                                                @endif
                                            </b>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div>
                                <div class="clearfix"></div>

                                <div class="form-group" style="margin-bottom: 20px;">
                                    <b>Arrêté la présente facture à la somme de :
                                        @if(count(\App\FactureStructure::where('structure_id', $structure->id)->get()) == 0)
                                            @if($nb_dest_global == 0)
                                                0 FCFA
                                            @elseif($nb_dest_global > 0 && $nb_dest_global <= 1000)
                                                {{ ($nb_dest_global * 20) - 60  }} FCFA
                                            @elseif($nb_dest_global > 1000 && $nb_dest_global <= 10000)
                                                {{ ($nb_dest_global * 15) - 60  }} FCFA
                                            @else
                                                {{ ($nb_dest_global * 10) - 60  }} FCFA
                                            @endif
                                        @else

                                            @if($montantStructure < 0)

                                                @if($nb_dest_global == 0)
                                                    {{0 + $montantStructure}} FCFA
                                                @elseif($nb_dest_global > 0 && $nb_dest_global <= 1000)
                                                    {{ ($nb_dest_global * 20) + $montantStructure }} FCFA
                                                @elseif($nb_dest_global > 1000 && $nb_dest_global <= 10000)
                                                    {{ ($nb_dest_global * 15) + $montantStructure }} FCFA
                                                @else
                                                    {{ ($nb_dest_global * 10) + $montantStructure }} FCFA
                                                @endif
                                            @else
                                                @if($nb_dest_global == 0)
                                                    0 FCFA
                                                @elseif($nb_dest_global > 0 && $nb_dest_global <= 1000)
                                                    {{ ($nb_dest_global * 20) }} FCFA
                                                @elseif($nb_dest_global > 1000 && $nb_dest_global <= 10000)
                                                    {{ ($nb_dest_global * 15)  }} FCFA
                                                @else
                                                    {{ ($nb_dest_global * 10) }} FCFA
                                                @endif
                                            @endif
                                        @endif
                                    </b>
                                </div>

                                <div class="form-group">
                                    <p>En votre aimable réglement,</p>
                                    <p>Cordialement, IBTAGroup</p>
                                </div>
                            </div>

                            <input type="hidden" name="structure_id" value="{{ $structure->id }}">
                            <input type="hidden" name="montant" value="
                                @if(count(\App\FactureStructure::where('structure_id', $structure->id)->get()) == 0)

                                    @if($nb_dest_global > 0 && $nb_dest_global <= 1000)
                                        {{ ($nb_dest_global * 20) - 60  }}
                                    @elseif($nb_dest_global > 1000 && $nb_dest_global <= 10000)
                                        {{ ($nb_dest_global * 15) - 60  }}
                                    @else
                                        {{ ($nb_dest_global * 10) - 60  }}
                                    @endif
                                @else

                                    @if($montantStructure < 0)

                                        @if($nb_dest_global > 0 && $nb_dest_global <= 1000)
                                            {{ ($nb_dest_global * 20) + $montantStructure }}
                                        @elseif($nb_dest_global > 1000 && $nb_dest_global <= 10000)
                                            {{ ($nb_dest_global * 15) + $montantStructure }}
                                        @else
                                            {{ ($nb_dest_global * 10) + $montantStructure }}
                                        @endif
                                    @else

                                        @if($nb_dest_global > 0 && $nb_dest_global <= 1000)
                                            {{ ($nb_dest_global * 20) }}
                                        @elseif($nb_dest_global > 1000 && $nb_dest_global <= 10000)
                                            {{ ($nb_dest_global * 15)  }}
                                        @else
                                            {{ ($nb_dest_global * 10) }}
                                        @endif
                                    @endif
                                @endif
                                ">
                            <input type="hidden" name="numero" value="{{ (count($numero_facture_structures) + count($numero_facture_universites)) + 1 }}">
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection

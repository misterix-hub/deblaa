@extends('layout.sideBarUniversite')

@section('content')
    <div class="">
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12" style="border-right: 1px solid #CCC;">
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" aria-label="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" aria-label="close" data-dismiss="alert">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <br />
                            <h6>
                                <i class="icofont-listine-dots"></i>
                                <b>Liste des messages</b>
                            </h6>

                            <table class="table table-bordered table-sm" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="150">Date d'envoi</th>
                                        <th>Message</th>
                                        <th>Destinataires</th>
                                        <th width="60" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bilan_messages as $bilan_message)
                                        <tr>
                                            <td>
                                                <small>{{ $bilan_message->created_at }}</small>s
                                            </td>
                                            <td>{{ $bilan_message->titre }}</td>
                                            <td class="text-right">{{ $bilan_message->nb_destinataire }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('uDetailsMessage', [$bilan_message->message_universite_id, \Illuminate\Support\Str::slug($bilan_message->titre)]) }}" class="btn btn-sm btn-outline-grey m-0 rounded z-depth-0 pl-2 pr-2">
                                                    <i class="icofont-plus"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                    <tr>
                                        <td class="text-center" colspan="5"><b>Pas de message</b></td>
                                    </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Date d'envoi</th>
                                        <th>Message</th>
                                        <th>Destinataires</th>
                                        <th width="60" class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                            </table><br /><br />
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 menu-item-sm-hide">
                    
                    @include('included.sideBarRightUniv')

                </div>
                <div class="col-12 text-center font-size-14 border-top"><br />
                    <b>Deblaa &copy; 2019 | Tous droits réservés</b><br />
                    <b>Produit de <a href="#!">IBTAGroup</a></b><br />
                </div>
            </div>
        </div>

    </div>
    <br />
@endsection
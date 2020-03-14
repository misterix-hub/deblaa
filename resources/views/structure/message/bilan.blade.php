@extends('layout.sideBarStructure')

@section('content')
    <div class="">
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12" style="border-right: 1px solid #CCC;">
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">

                            @if($errors->any())
                                <ul class="alert alert-danger list-unstyled mt-3 alert-dismissible fade show" role="alert">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                                        <span aria-hidden="true">x</span>
                                    </button>
                                </ul>
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
                            <br />
                            <h6>
                                <i class="icofont-listine-dots"></i>
                                <b>Liste des membres</b>
                            </h6>

                            <table class="table table-bordered table-sm" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="150">Date d'envoi</th>
                                        <th>Message</th>
                                        <th>Dest.</th>
                                        <th width="60" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($bilan_messages as $bilan_message)
                                        <tr>
                                            <td>
                                                <small>{{ $bilan_message->created_at }}</small>
                                            </td>
                                            <td>{{ $bilan_message->titre }}</td>
                                            <td class="text-right">{{ $bilan_message->nb_destinataire }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('sDetailsMessage', $bilan_message->id) }}" class="btn btn-sm btn-outline-grey m-0 rounded z-depth-0 pl-2 pr-2">
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
                                        <th>Dest.</th>
                                        <th width="60" class="text-center">Action</th>
                                    </tr>
                                </tfoot>
                            </table><br /><br />
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 menu-item-sm-hide">
                    
                    @include('included.sideBarRight')

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
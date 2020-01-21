@extends('layout.sideBarUniversite')

@section('content')

    <div class="">
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12" style="border-right: 1px solid #CCC;">
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
            
                            <?php $send_message = 0; ?>
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    {{ $message }}
                                    @if ($message == "Membre ajouté avec succès !")
                                        <?php $send_message = 1; ?>
                                    @endif
                                </div>
                            @endif

                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @endif
                            <br />
                            <h6>
                                <i class="icofont-listine-dots"></i>
                                <b>Liste des messages</b>
                            </h6>

                            <table width="100%">
                                <tbody>
                                    @forelse($messages as $message)
                                        <tr>
                                            <td>
                                                <a href="{{ route('uDetailsMessage', $message->id) }}">
                                                    <div class="indigo lighten-5 pt-2 pb-2 pr-3 pl-3 mb-1 mt-1 text-muted float-right"
                                                    style="border-radius: 25px;">
                                                        <b>{{ $message->titre }}</b><br />
                                                        <small style="font-size: 9px;" class="float-right grey-text">{{ $message->created_at }}</small>
                                                    </div>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center">
                                                <b>Pas de message envoyé !</b>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table><br /><br />

                            <a href="{{ route('uEnvoyerMessage') }}">
                                <i class="icofont-facebook-messenger"></i>
                                <b>Envoyer un nouveau message</b>
                            </a><br /><br />
                            
                        </div>
                    </div><br /><br /><br /><br />

                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 menu-item-sm-hide">
                    
                    @include('included.sideBarRightUniv')

                </div>
                <div class="col-12 text-center font-size-14 border-top"><br />
                    <b>Deblaa &copy; 2019 | Tous droits réservés</b><br />
                    <b>Produit de <a href="#!">IBTAGroup</a></b><br /><br />
                </div>
            </div>
        </div>

    </div>
    <br />
@endsection

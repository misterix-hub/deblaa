<div class="indigo white-text pt-1 pb-1 pl-1 pr-2">
    <table width="100%">
        <tr>
            <td width="50">
                <img src="{{ URL::asset('assets/images/deblaa.png') }}" alt="logo" width="100%">
            </td>
            <td class="pl-1">
                <a href="" class="white-text indigo darken-3 pt-2 pb-2 pl-3 pr-3" style="border-radius: 15px; font-size: 13px;">
                    <b>{{ session()->get('nom_complet') }}</b>
                </a>
            </td>
            <td class="text-right">
                <a href="{{ route('inboxsEtudiant') }}">
                    <i class="icofont-envelope white-text" style="font-size: 18px;"></i>
                    @if ((count($cible_message_universites) - count($message_lus)) > 0)    
                        <span class="badge badge-danger z-depth-0" style="height: 15px; border-radius: 2px; margin-left: -5px;">
                            {{ count($cible_message_universites) - count($message_lus) }}
                        </span>
                    @endif
                </a>
            </td>
	    <td width="20" class="text-right pl-2">
                <a href="{{ route('logout') }}" id="dropdownMenuButton">
                    <i class="icofont-sign-out white-text" style="font-size: 22px;"></i>
                </a>
            </td>
        </tr>
    </table>
</div>

@forelse ($cible_message_universites as $cible_message_universite)
    @if (in_array( $cible_message_universite->message_universite_id, $tab_id))
        <a href="{{ route('eSDetailsMessage', $cible_message_universite->message_universite_id) }}">
            <div class="p-2 border-bottom">
                <table width="100%">
                    <tr>
                        <td width="36px">
                            <div style="border-radius: 100%; padding: 13px;"
                            class="white-text text-center grey lighten-1">
                                <i class="icofont-envelope-open"></i>
                            </div>
                        </td>
                        <td style="line-height: 15px;" class="pl-1 text-truncate">
                            <b class="black-text">
                                {{ (strlen($cible_message_universite->titre) > 35) ? substr($cible_message_universite->titre, 0, 35) . " ..." : $cible_message_universite->titre ." ..." }}
                            </b><br />
                            <small class="text-muted">{{ $cible_message_universite->created_at }}</small>
                        </td>
                    </tr>
                </table> 
            </div>
        </a>
    @else
        <a href="{{ route('eSDetailsMessage', $cible_message_universite->message_universite_id) }}" class="message-select">
            <div class="p-2 border-bottom">
                <table width="100%">
                    <tr>
                        <td width="36px">
                            <div style="border-radius: 100%; padding: 10px 13px;"
                            class="white-text text-center green">
                                <i class="icofont-envelope"></i>
                            </div>
                        </td>
                        <td style="line-height: 20px;" class="pl-1 text-truncate">
                            <b class="black-text font-weight-bold">
                                {{ $cible_message_universite->titre }}
                            </b><br />
                            <small class="text-muted">{{ $cible_message_universite->created_at }}</small>
                        </td>
                    </tr>
                </table> 
            </div>
        </a>
    @endif
@empty

    <div class="text-center">
        <b>Aucun message !</b>
    </div>

@endforelse

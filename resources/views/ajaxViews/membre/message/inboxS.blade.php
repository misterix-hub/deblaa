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
                <a href="{{ route('inboxsMembre') }}">
                    <i class="icofont-envelope white-text" style="font-size: 18px;"></i>
                    @if ((count($cible_message_structures) - count($message_lus)) > 0)
                        <span class="badge badge-danger z-depth-0" style="height: 15px; border-radius: 2px; margin-left: -5px;">
                            {{ count($cible_message_structures) - count($message_lus) }}
                        </span>
                    @endif
                </a>&nbsp;&nbsp;
            </td>
            <td width="20" class="text-right">
                <a href="{{ route('logout') }}" id="dropdownMenuButton">
                    <i class="icofont-power white-text" style="font-size: 18px;"></i>
                </a>
            </td>
        </tr>
    </table>
</div>

@forelse ($cible_message_structures as $cible_message_structure)
    @if (in_array( $cible_message_structure->message_structure_id, $tab_id))

        <div class="pt-2 pb-2 pr-2 pl-2 border-bottom">
            <table width="100%">
                <tr>

                    <td width="45px">
                        <div style="width: 45px; height: 45px; border-radius: 100%; line-height: 50px;"
                             class="white-text text-center grey lighten-1">
                            <i style="font-size: 18px;" class="icofont-envelope-open"></i>
                        </div>
                    </td>
                    <td style="line-height: 15px;" class="pl-1 pt-1">
                        <a href="{{ route('mSDetailsMessage', $cible_message_structure->message_structure_id) }}">
                            <b class="black-text">
                                {{ (strlen($cible_message_structure->titre) > 10) ? substr($cible_message_structure->titre, 0, 10) . " ..." : $cible_message_structure->titre . " ..." }}
                            </b><br />
                            <small>{{ $cible_message_structure->created_at }}</small><br><br>
                            @foreach($structures as $structure)
                                @if($structure->id == $cible_message_structure->structure_id)
                                    <div class="font-weight-bold"><b>{{ $structure->sigle }}</b></div>
                                @else

                                @endif
                            @endforeach
                        </a>
                    </td>

                    <td width="100">
                        <a href="{{ route('mSDetailsMessage', $cible_message_structure->message_structure_id) }}" class="text-uppercase btn btn-sm btn-success">Voir tout le message</a>
                    </td>
                </tr>
            </table>
        </div>
    @else

        <div class="pt-2 pb-2 pr-2 pl-2 border-bottom">
            <table width="100%">
                <tr>
                    <td width="45px">
                        <div style="width: 45px; height: 45px; border-radius: 100%; line-height: 50px;"
                             class="white-text text-center green">
                            <i style="font-size: 18px;" class="icofont-envelope"></i>
                        </div>
                    </td>
                    <td style="line-height: 15px;" class="pl-1 pt-1">
                        <a href="{{ route('mSDetailsMessage', $cible_message_structure->message_structure_id) }}">
                            <b class="black-text font-weight-bold">
                                {{ (strlen($cible_message_structure->titre) > 10) ? substr($cible_message_structure->titre, 0, 10) . " ..." : $cible_message_structure->titre . " ..." }}
                            </b><br />
                            <small>{{ $cible_message_structure->created_at }}</small><br><br>
                            @foreach($structures as $structure)
                                @if($structure->id == $cible_message_structure->structure_id)
                                    <div class="font-weight-bold"><b>{{ $structure->sigle }}</b></div>
                                @else

                                @endif
                            @endforeach
                        </a>
                    </td>
                    <td width="100">
                        <a href="{{ route('mSDetailsMessage', $cible_message_structure->message_structure_id) }}" class="btn btn-sm btn-success text-uppercase">Voir tout le message</a>
                    </td>
                </tr>
            </table>
        </div>
    @endif
@empty

    <div class="text-center">
        <b>Aucun message !</b>
    </div>

@endforelse

@extends('layout.header')

@section('inboxs')
    <div class="indigo white-text pt-1 pb-1 pl-1 pr-2">
        <table width="100%">
            <tr>
                <td width="50">
                    <img src="{{ URL::asset('assets/images/deblaa.png') }}" alt="logo" width="100%">
                </td>
                <td class="pl-1">
                    <a href="" class="white-text indigo darken-3 pt-2 pb-2 pl-3 pr-3" style="border-radius: 15px; font-size: 13px;">
                        <b>Nom complet de ici</b>
                    </a>
                </td>
                <td class="text-right">
                    <a href="">
                        <i class="icofont-alarm white-text" style="font-size: 18px;"></i>
                        <small style="margin-left: -8px;"><span class="badge badge-danger rounded z-depth-0">15</span></small>
                    </a>&nbsp;&nbsp;
                    <a href="">
                        <i class="icofont-navigation-menu white-text" style="font-size: 18px;"></i>
                    </a>
                </td>
            </tr>
        </table>
    </div>

    @for ($i = 0; $i < 15; $i++)
        <a href="">
            <div class="p-2 border-bottom">
                @if ($i < 2)
                    <table width="100%">
                        <tr>
                            <td width="36">
                                <div style="width: 36px; height: 36px; border-radius: 100%; line-height: 38px;"
                                class="white-text text-center green">
                                    <i class="icofont-envelope"></i>
                                </div>
                            </td>
                            <td style="line-height: 15px;" class="pl-1 pt-1">
                                <b class="font-weight-bold black-text">
                                    Titre du message ici s'il ...
                                </b><br />
                                <small>2019-05-12 15:40</small>
                            </td>
                        </tr>
                    </table>
                @else    
                    <table width="100%">
                        <tr>
                            <td width="36">
                                <div style="width: 36px; height: 36px; border-radius: 100%; line-height: 38px;"
                                class="white-text text-center grey lighten-1">
                                    <i class="icofont-envelope-open"></i>
                                </div>
                            </td>
                            <td style="line-height: 15px;" class="pl-1 pt-1">
                                <b class="black-text">
                                    Titre du message ici s'il ...
                                </b><br />
                                <small>2019-05-12 15:40</small>
                            </td>
                        </tr>
                    </table>
                @endif
            </div>
        </a>
    @endfor

@endsection
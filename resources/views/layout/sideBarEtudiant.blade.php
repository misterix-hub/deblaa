@extends('layout.header')

@section('sideBar')

    <div class="side-bar white" style="border-right: 1px solid #CCC;">
        <div class="indigo white-text text-center pt-2 pb-2">
            <small><b>BOITE DE RÉCEPTION</b></small> <span class="badge badge-danger rounded z-depth-0">15</span>
        </div>
        <div class="p-2 indigo lighten-5" style="border-bottom: 1px solid #CCC;">
            <table>
                <tr>
                    <td>
                        <div style="width: 40px; height: 40px;">
                            <img src="{{ URL::asset('assets/images/deblaa.png') }}" alt="logo" width="100%">
                        </div>
                    </td>
                    <td class="pl-2 pt-1" style="line-height: 15px;">
                        <a href="">
                            <b class="font-weight-bold">Nom complet de l'étudiant</b>
                        </a><br />
                        <small>Filière</small>
                    </td>
                </tr>
            </table>
        </div>

        @for ($i = 0; $i < 9; $i++)
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

    </div>
    <div class="asside-content font-size-14">
        <div class="top-bar pt-3 pb-3 pl-4 pr-4 border-bottom">
            <table width="100%">
                <tr>
                    <td>
                        <a href="" class="">
                            <b>Inbox</b>
                        </a>
                    </td>
                    <td class="text-right">
                        <a href="" class="red-text">
                            <i class="icofont-ui-power"></i>
                        </a>
                    </td>
                </tr>
            </table>
        </div>

        @yield('content')

    </div>

@endsection
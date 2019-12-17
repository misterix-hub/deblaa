@extends('layout.header')

@section('content')
    <div class="indigo pt-1 pb-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div>
                        <table width="100%">
                            <tr>
                                <td>
                                    <a href="{{ route('indexVisitors') }}">
                                        <img src="{{ URL::asset('assets/images/deblaa.png') }}" alt="logo-deblaa" width="55">
                                    </a>
                                </td>
                                <td class="text-right">
                                    <a href="#!" class="black-text" data-toggle="dropdown"
                                       aria-haspopup="true" aria-expanded="false">
                                        <i class="icofont-navigation-menu icofont-2x pr-5"></i>
                                    </a>
                                    <div class="dropdown-menu font-size-14">
                                        <a class="dropdown-item" href="{{ route('eLogin') }}">
                                            <i class="icofont-university brown-text"></i>
                                            Espace université
                                        </a>
                                        <a class="dropdown-item" href="{{ route('mLogin') }}">
                                            <i class="icofont-building yellow-text"></i>
                                            Espace structure
                                        </a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="{{ route('about') }}">
                                            <i class="icofont-info-circle cyan-text"></i>
                                            À porpos de nous
                                        </a>
                                        <a class="dropdown-item" href="{{ route('location') }}">
                                            <i class="icofont-google-map red-text"></i>
                                            Où nous trouver ?
                                        </a>
                                        <a class="dropdown-item" href="{{ route('partners') }}">
                                            <i class="icofont-handshake-deal"></i>
                                            Partenaires
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12 mt-5 text-center">
                <span class="red-text" style="font-size: 3rem;">Page en cours de développement ...</span>
            </div>
        </div>
    </div>
@endsection

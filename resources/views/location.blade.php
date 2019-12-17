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
            <div class="col-lg-10 col-md-12 col-sm-12 mt-5">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.408956761869!2d1.1769050144397224!3d6.209668928455595!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1021584ead60792b%3A0x2880b392b6f7baff!2sLA%20VOLONTE!5e0!3m2!1sfr!2stg!4v1576605473010!5m2!1sfr!2stg" width="100%" height="500" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
            </div>
        </div>
    </div>



@endsection

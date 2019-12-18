@extends('layout.header')

@section('home')

<style>
    div.deblaa {
        font-size: 84px;
        font-family: comfortaa;
    }

    div.slogan {
        font-size: 40px;
        font-family: comfortaa;
    }

    .comfortaa {
        font-family: comfortaa;
    }

    .logo {
        width: 100%;
    }

    .sm-btn-cover {
        display: none;
    }

    @font-face {
        font-family: comfortaa;
        src: url(fonts/Comfortaa-Regular.ttf);
    }

    @media(max-width: 720px) {
        .logo {
            width: 50%;
        }
        div.deblaa {
            text-align: center;
            font-size: 54px;
        }
        div.slogan {
            text-align: center;
            font-size: 18px;
        }
        .lg-btn-cover {
            display: none;
        }
        .sm-btn-cover {
            display: block;
            text-align: center;
        }
        .sm-btn-cover a.btn {
            padding-left: 15px;
            padding-right: 15px;
            border-radius: 6px;
        }
        .footer-deb {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 10px;
        }
    }
</style>

<div class="container">
    <div class="row">

        <div class="col-12">
            <div>
                <table width="100%">
                    <tr>
                        <td class="pt-2">
                            <a href="{{ route('indexVisitors') }}" class="comfortaa" style="margin-left: -10px;">
                                <img src="{{ URL::asset('assets/images/deblaa.png') }}" width="50" alt="logo">
                            </a>
                        </td>
                        <td class="text-right">
                            <a href="#!" class="black-text" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                                <i class="icofont-navigation-menu" style="font-size: 24px;"></i>
                            </a>
                            <div class="dropdown-menu font-size-14">
                                <a class="dropdown-item" href="#">
                                    <i class="icofont-university brown-text"></i>
                                    Espace université
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="icofont-building yellow-text"></i>
                                    Espace structure
                                </a>
                            <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    <i class="icofont-info-circle cyan-text"></i>
                                    À porpos de nous
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="icofont-google-map red-text"></i>
                                    Où nous trouver ?
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="icofont-handshake-deal"></i>
                                    Partenaires
                                </a>
                            </div>
                            <!-- Basic dropdown -->
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <div class="col-lg-5 col-md-12 col-sm-12 text-center"><br />

            <img src="{{ URL::asset('assets/images/deblaa.png') }}" class="logo" alt="logo">
            
        </div>
        <div class="col-lg-1 col-md-12 col-sm-12"></div>

        <div class="col-lg-6 col-md-12 col-sm-12"><br />

            <div class="deblaa">
                <span class="indigo-text">Deb</span><span class="orange-text">laa</span>
            </div>

            <div class="slogan">
                Ma boite à informations professionelle, sûre et rapide !
            </div><br />

            <div class="lg-btn-cover">
                <a href="{{ route('eLogin') }}" class="btn btn-orange btn-lg ml-0">
                    Espace universités
                </a>
    
                <a href="{{ route('mLogin') }}" class="btn btn-indigo btn-lg ml-0">
                    Espace structures
                </a>
            </div>

            <div class="sm-btn-cover">
                <a href="{{ route('eLogin') }}" class="btn btn-orange m-0">
                    Espace universités
                </a>
    
                <a href="{{ route('mLogin') }}" class="btn btn-indigo m-0">
                    Espace structures
                </a>
            </div><br /><br />
            
        </div>

    </div>
</div><br />
<div class="font-size-14 border-top pt-2 pl-2 pr-1 footer-deb">
    <div class="text-center">
        <b>
            Deblaa &copy; 2019 Copyright | Tous droits réservés<br />
            Produit de <a href="">IBTAGroup</a>
        </b>
    </div>
</div>

@endsection

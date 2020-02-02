@extends('layout.sideBarStructure')

@section('content')
    <div class="">
        
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 col-md-12 col-sm-12" style="border-right: 1px solid #CCC;">
                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12"><br />

                            <small><b>RECHARGE DE {{ $nbm }} MESSAGES </b></small><br /><br />
                            <div>
                                <ul>
                                    <li>
                                        <b>Sélectionnez votre mode de paiement</b>
                                    </li>
                                </ul>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-sm-12">
                                    <a target="_blank" href="https://paygateglobal.com/v1/page?token=152d2723-c203-4fd1-8a10-818345d8ce62&amount={{ $montant }}&description=Recharge de message {{ session()->get('sigle') }}&identifier={{ $id . '-' . time() }}">
                                        <table width="100%">
                                            <tr>
                                                <td width="50%">
                                                    <img src="{{ URL::asset('assets/images/logoflooz.jpg') }}" alt="logo-paygate" width="100%">
                                                </td>
                                                <td width="50%">
                                                    <img src="{{ URL::asset('assets/images/logotmoney.jpg') }}" alt="logo-paygate" width="100%">
                                                </td>
                                            </tr>
                                        </table><br /><br />
                                    </a>
                                </div>
                                <div class="col-lg-6 col-sm-12">
                                    <div class="dropdown">
                                        <a href="#!" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            <img src="{{ URL::asset('assets/images/logovisa.jpg') }}" alt="logo-paygate" width="160">
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="triggerId">
                                            <div class="text-center">
                                                Ce moyen de paiement n'est pas encore disponible. Contactez-nous directement
                                                sur
                                                <b>
                                                    <a href="tel:+22891019245">0022891019245</a>
                                                    <span class="black-text">/</span>
                                                    <a href="tel:+2897531717">002897531717</a>
                                                </b>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <h5 style="line-height: 35px;">
                                    Si vous avez des difficultés ou si ne retrouvez pas votre mode de paiement,
                                    contactez-nous directement sur le
                                    <b>
                                        <a href="tel:+22891019245">0022891019245</a>
                                        <span class="black-text">/</span>
                                        <a href="tel:+2897531717">002897531717</a>
                                    </b><br />
                                    <b class="font-weight-bold">7 J / 7, 24 H / 24</b>
                                </h5>
                            </div>
                            
                        </div>
                    </div><br /><br /><br /><br />

                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 menu-item-sm-hide">
                    
                    @include('included.sideBarRight')

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
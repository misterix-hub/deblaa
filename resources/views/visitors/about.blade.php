@extends('layout.header')

@section('css')
    <style>
        .comfortaa {
            font-family: comfortaa;
        }
    </style>
@endsection

@section('home')
    @include('..included.navbar')
   <div class="container comfortaa">
    <div class="row">
        <div class="col-12 text-center">
            <br /><br />
            <h1 class="comfortaa font-weight-bold">
                En savoir plus sur Deblaa
            </h1>
            <br />
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 text-center">
            <h5><span class="font-weight-bold">Envois de sms groupés</span></h5>
            <div class="font-size-14">
                Envoyez un seul sms pour un groupe de contacts
                <br /><br />

                <div class="text-center">
                    <img src="{{ URL::asset('assets/images/team.svg') }}" alt="" width="70%">
                </div>
            </div><br />
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12 text-center">
            <h5><span class="font-weight-bold">Personnalisation des sms</span></h5>
            <div class="font-size-14">
                Rendez vos sms plus professionnels en les personnalisant au nom de votre entreprise.
                <div class="text-center"><br /><br />
                    <img src="{{ URL::asset('assets/images/mail.svg') }}" alt="" width="55%">
                </div>
            </div><br /><br />
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 text-center">

            <h5 class="comfortaa font-weight-bold mb-3">Association de fichiers</h5>
            <span class="font-size-14">
                Joignez à vos sms des fichiers multimedia en pièce jointe directement accessible sur téléphone, tablette ou ordinateur.
            </span>
            <br /><br />
            <h1><i class="icofont-attachment orange-text icofont-4x"></i></h1><br /><br />
        </div>
	<div class="col-lg-2 col-md-12 col-sm-12">
	</div>
    <div class="col-lg-4 col-md-6 col-sm-12 text-center">
        <br /><br />
        <h5 class="comfortaa font-weight-bold mb-3">
            Plus de sécurité ...
        </h5>
        <span class="font-size-14">
            Sécurisez vos informations grâce à la disponibilité d'une interface de gestion, de rédaction et d'envoi personnelle et confidentielle
        </span>
        <br /><br />
        <h1><i class="icofont-lock green-text icofont-4x"></i></h1><br /><br />
    </div>
	<div class="col-lg-4 col-md-12 col-sm-12 text-center">
    <br /><br />
        <h5><span class="font-weight-bold">Rapport et confirmation</span></h5>
        <div class="font-size-14">
            Suivez vos sms et consultez les rapports et confirmation de lecture
            <div class="text-center"><br /><br />
                <img src="{{ URL::asset('assets/images/mail2.svg') }}" alt="" width="55%" class="mt-3">
            </div>
        </div>
    </div>
	<div class="col-lg-2 col-md-6 col-sm-12">
	</div>
</div>
    
    <br /><br /><br /><br /> 

@include('..included.footer')
@endsection

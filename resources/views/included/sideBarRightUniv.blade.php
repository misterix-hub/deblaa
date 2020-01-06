<div class="mt-2 mb-2"></div>

@if (session()->get('pro') == 0)
    <a class="btn btn-danger btn-md m-0 btn-block z-depth-0" href="#!" data-toggle="modal" data-target="#compteProModal"
    role="button" style="border-radius: 5px;">
        <i class="icofont-diamond"></i>
        Passer en compte pro
    </a>
    <div class="mt-2"></div>
    <div class="card border-warning font-size-14">
        <div class="card-header">
            Messages d'essai
        </div>
        <div class="card-body">
            <h4 class="card-title text-center">
                {{ 10 - session()->get('message_bonus') }}
            </h4>
            <p class="card-text">
                Il vous reste {{ 10 - session()->get('message_bonus') }} message(s) sur votre compte d'essai.
            </p>
        </div>
        <div class="card-footer text-muted">
            <a href="#!" data-toggle="modal" data-target="#compteProModal">
                <i class="icofont-diamond"></i>
                Passer en compte pro
            </a>
        </div>
    </div><br />
@else
    <div class="pt-1 pb-1 pr-2 pl-2 border border-success mb-2 rounded text-center">
        <a href="" class="green-text">
            <i class="icofont-briefcase"></i>
            <b>Compte professionnel</b>
        </a>
    </div>
@endif

<div class="card border-primary">
    <div class="card-header">
        <i class="icofont-chart-bar-graph"></i>
        Statistiques
    </div>
    <div class="card-body">
        <div class="list-group">
            <a href="{{ route('uListeMessage') }}" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ count($messages) }}</h5>
                    <small>Détails</small>
                </div>
                <p class="mb-1">Messages envoyés</p>
                <small>Plus de détails</small>
            </a>
            <a href="{{ route('uListeEtudiant') }}" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ count($users) }}</h5>
                    <small>Détails</small>
                </div>
                <p class="mb-1">Étudiants</p>
                <small>Plus de détails</small>
            </a>
            <a href="{{ route('uListeFiliere') }}" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ count($filieres) }}</h5>
                    <small>Détails</small>
                </div>
                <p class="mb-1">Filières</p>
                <small>Plus de détails</small>
            </a>
        </div>
    </div>
    <div class="card-footer text-muted">
        <a href="{{ route('uBilanMessage') }}">
            Bilan des messages
        </a>
    </div>
</div><br />

<div class="card border-success">
    <div class="card-body">
        <h4 class="card-title">Infos compte</h4>
        <p class="card-text">
            Sigle : {{ session()->get('sigle') }}<br />
            Email : email@email.com
        </p>

        @if (session()->get('logo') == "")
            <div style="height: 100px; line-height: 100px;" class="orange text-center rounded">
                <b>Votre logo</b>
            </div>
        @else
            <img src="{{ URL::asset('db/logos/structure/'.session()->get('logo')) }}" alt="logo-structure" width="100%">
        @endif

        <div class="text-center">
            <br />
            <a href="{{ route('sCompte', session()->get('id')) }}">
                <i class="icofont-pencil"></i>Modifier le profil
            </a>
        </div>
    </div>
</div><br /><br />
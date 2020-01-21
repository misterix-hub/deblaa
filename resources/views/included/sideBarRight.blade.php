<div class="mt-2 mb-2"></div>

<a class="btn btn-green btn-md m-0 btn-block z-depth-0" href="#!" data-toggle="modal" data-target="#compteProModal"
role="button" style="border-radius: 5px;">
    <i class="icofont-refresh"></i>
    Charger le compte
</a>
<div class="mt-2"></div>
<div class="card border-warning font-size-14">
    <div class="card-header">
        Messages en réserve
    </div>
    <div class="card-body text-center">
        <h4 class="card-title text-center">
            {{ session()->get('message_bonus') }}
        </h4>
        <p class="card-text">
            Il vous reste {{ session()->get('message_bonus') }} message(s) sur votre compte.
        </p>
    </div>
</div><br />

<div class="card border-primary">
    <div class="card-header">
        <i class="icofont-chart-bar-graph"></i>
        Statistiques
    </div>
    <div class="card-body">
        <div class="list-group">
            <a href="{{ route('sListeMessage') }}" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ count($messages) }}</h5>
                    <small>Détails</small>
                </div>
                <p class="mb-1">Messages envoyés</p>
                <small>Plus de détails</small>
            </a>
            <a href="{{ route('sListeMembre') }}" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ count($users) }}</h5>
                    <small>Détails</small>
                </div>
                <p class="mb-1">Membres</p>
                <small>Plus de détails</small>
            </a>
            <a href="{{ route('sListeGroupe') }}" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ count($groupes) }}</h5>
                    <small>Détails</small>
                </div>
                <p class="mb-1">Groupes</p>
                <small>Plus de détails</small>
            </a>
        </div>
    </div>
    <div class="card-footer text-muted">
        <a href="{{ route('sBilanMessage') }}">
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
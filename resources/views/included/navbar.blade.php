<nav class="navbar navbar-expand-sm navbar-dark indigo comfortaa">
    <a href="{{ route('indexVisitors') }}" class="comfortaa" style="margin-left: -10px; margin-right: 10px;">
        <img src="{{ URL::asset('assets/images/deblaa.png') }}" width="50" alt="logo">
    </a>
    <a class="navbar-brand comfortaa white-text font-weight-bold" href="{{ route('indexVisitors') }}">
        Deblaa
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <i class="icofont-navigation-menu"></i>
    </button>
    <div class="collapse navbar-collapse comfortaa" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 font-size-14">

        </ul>
        <form class="form-inline my-2 my-lg-0" style="font-size: 13px;">

            <a class="nav-link white-text" href="{{ route('indexVisitors') }}"><b>Accueil</b></a>

            <a class="nav-link white-text" href="{{ route('visitors.about') }}"><b>En savoir plus</b></a>

            <a class="nav-link white-text" href="{{ route('visitors.tarification') }}"><b>Tarification</b></a>

            <a class="nav-link white-text" href="{{ route('visitors.contact') }}"><b>Contactez-nous</b></a>

            <div class="dropdown">
                <a class="nav-link white-text" href="#" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">Créer un compte</a>

                <div class="dropdown-menu" aria-labelledby="triggerId">
                    <a class="dropdown-item spinnerShower" href="{{ route('uRegister') }}">
                        Créer un compte université
                    </a>
                    <a class="dropdown-item spinnerShower" href="{{ route('sRegister') }}">
                        Créer un compte structure
                    </a>
                </div>
            </div>

            <div class="dropdown d-none d-md-block">
                <a href="{{ route('sLogin') }}" class="btn btn-white btn-md mr-0" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                    <i class="icofont-sign-in"></i>
                    <small><b>Connexion</b></small>
                </a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                    <a class="dropdown-item spinnerShower" href="{{ route('uLogin') }}">
                        Connexion université
                    </a>
                    <a class="dropdown-item spinnerShower" href="{{ route('sLogin') }}">
                        Connexion structure
                    </a>
                </div>
            </div>

            <div class="dropdown d-block d-md-none">
                <a href="{{ route('sLogin') }}" class="btn btn-white btn-md mr-0" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                    <i class="icofont-sign-in"></i>
                    <small><b>Connexion</b></small>
                </a>

                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="triggerId">
                    <a class="dropdown-item spinnerShower" href="{{ route('uLogin') }}">
                        Connexion université
                    </a>
                    <a class="dropdown-item spinnerShower" href="{{ route('sLogin') }}">
                        Connexion structure
                    </a>
                </div>
            </div>
        </form>
    </div>
</nav>
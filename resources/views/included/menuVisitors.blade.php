<nav class="navbar navbar-expand-sm navbar-dark indigo">
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

            <a class="nav-link white-text" href="#"><b>A propos</b></a>

            <div class="dropdown">
                <a class="nav-link white-text" href="#" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">Créer un compte</a>

                <div class="dropdown-menu" aria-labelledby="triggerId">
                    <a class="dropdown-item" href="{{ route('uRegister') }}">
                        <b>Créer un compte université</b>
                    </a>
                    <a class="dropdown-item" href="{{ route('sRegister') }}">
                        <b>Créer un compte structure</b>
                    </a>
                </div>
            </div>
            
            <div class="dropdown">
                <a href="{{ route('sLogin') }}" class="btn btn-white btn-md mr-0" id="triggerId" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                    <i class="icofont-sign-in"></i>
                    <small><b>Connexion</b></small>
                </a>
                
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                    <a class="dropdown-item" href="{{ route('uLogin') }}">
                        <b>Connexion université</b>
                    </a>
                    <a class="dropdown-item" href="{{ route('sLogin') }}">
                        <b>Connexion structure</b>
                    </a>
                </div>
            </div>
        </form>
    </div>
</nav>

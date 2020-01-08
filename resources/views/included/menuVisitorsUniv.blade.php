<nav class="navbar navbar-expand-sm navbar-dark indigo">
    <a href="{{ route('indexVisitors') }}" class="comfortaa" style="margin-left: -10px; margin-right: 10px;">
        <img src="{{ URL::asset('assets/images/deblaa.png') }}" width="50" alt="logo">
    </a>
    <a class="navbar-brand comfortaa cyan-text font-weight-bold" href="{{ route('indexVisitors') }}">
        Deblaa
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId"
        aria-expanded="false" aria-label="Toggle navigation">
        <i class="icofont-navigation-menu"></i>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0 font-size-14">
            <li class="nav-item active">
                <a class="nav-link" href="#"><b>Accueil</b> <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><b>Services</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><b>A propos</b></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><b>Contactez-nous</b></a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0 font-size-14">
            <a href="{{ route('uRegister') }}" class="white-text">
                <i class="icofont-edit"></i>
                <b>Inscription</b>
            </a>&nbsp;&nbsp;&nbsp;

            <a href="{{ route('uLogin') }}" class="btn btn-white btn-sm rounded mr-0 pr-4 pl-4">
                Connexion
            </a>
        </form>
    </div>
</nav>

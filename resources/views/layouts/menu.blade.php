<li class="{{ Request::is('universites*') ? 'active' : '' }}">
    <a href="{{ route('universites.index') }}"><i class="fa fa-university"></i><span>Universites</span></a>
</li>

<li class="{{ Request::is('filieres*') ? 'active' : '' }}">
    <a href="{{ route('filieres.index') }}"><i class="fa fa-briefcase"></i><span>Filieres</span></a>
</li>

<li class="{{ Request::is('niveaux*') ? 'active' : '' }}">
    <a href="{{ route('niveaux.index') }}"><i class="fa fa-sort"></i><span>Niveaux</span></a>
</li>

<li class="{{ Request::is('filiereNiveaus*') ? 'active' : '' }}">
    <a href="{{ route('filiereNiveaus.index') }}"><i class="fa fa-bookmark"></i><span>Filiere niveaux</span></a>
</li>

<li class="{{ Request::is('structures*') ? 'active' : '' }}">
    <a href="{{ route('structures.index') }}"><i class="fa fa-building"></i><span>Structures</span></a>
</li>

<li class="{{ Request::is('departements*') ? 'active' : '' }}">
    <a href="{{ route('departements.index') }}"><i class="fa fa-users"></i><span>Groupes</span></a>
</li>

<li class="{{ Request::is('categorie.tickets*') ? 'active' : ''  }}">
    <a href="{{ route('categorie.tickets.index') }}"><i class="fa fa-tasks"></i>Categories de tickets</a>
</li>

<li class="{{ Request::is('tickets*') ? 'active' : ''  }}">
    <a href="{{ route('tickets.index') }}"><i class="fa fa-barcode"></i>Tickets</a>
</li>

<li>
    <a href="{{ url('admin/statistiques/universites') }}"><i class="fa fa-bar-chart"></i><span>Statistiques universités</span></a>
</li>
<li>
    <a href="{{ url('admin/statistiques/structures') }}"><i class="fa fa-bar-chart"></i><span>Statistiques structures</span></a>
</li>


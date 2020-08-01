
    <div class="btn-group">
        <button type="button" class="btn btn-success btn-sm" type="button" data-toggle="dropdown" id="contactDropDown" >Ajouter étudiant</button>
        <button type="button" class="btn btn-success btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu" aria-labelledby="contactDropDown">
            <a class="dropdown-item" href="{{ $filiere->pathAddStudentsByList($niveau) }}">Mes contacts</a>
            <a class="dropdown-item" href="{{ $filiere->pathAddStudent($niveau) }}">Nouveau</a>
        </div>
    </div>


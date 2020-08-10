
    <a href="#!" class="btn btn-success btn-sm px-1"  style="width:10rem;" type="button" data-toggle="dropdown" id="contactDropDown" >Ajouter étudiant</a>
    <div class="dropdown-menu" aria-labelledby="contactDropDown">
        <a class="dropdown-item" href="{{ $filiere->pathAddStudentsByList($niveau) }}">Mes contacts</a>
        <a class="dropdown-item" href="{{ $filiere->pathAddStudent($niveau) }}">Nouveau</a>
    </div>


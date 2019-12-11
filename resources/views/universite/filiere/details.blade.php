@extends('layout.sideBar')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-edit"></i> Détails filière</h3>
            </div>
            <div class="col-lg-6 col-md-12 col-sm-12"><br />
                Nom de la filière<br />
                <b class="font-weight-bold">Nom de filière ici à cet endroit</b><br /><br />

                Niveaux de la filière<br />
                <ul>
                    <li>
                        <b>Licence I</b>
                    </li>
                    <li>
                        <b>Licence II</b>
                    </li>
                    <li>
                        <b>Licence III</b>
                    </li>
                </ul>
                <div>
                    <a href="{{ route('uModifierFiliere', 1) }}" class="btn btn-md btn-indigo ml-0 rounded">
                        Modifier
                    </a>
                </div>
                
            </div>
        </div>
    </div>
@endsection
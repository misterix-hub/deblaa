@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-listine-dots"></i> Liste groupes</h3>
            </div>
            <div class="col-lg-10 col-md-12 col-sm-12"><br />

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                <table class="table table-hover table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>
                                <b>Nom du groupe</b>
                            </th>
                            <th class="text-center" width="250">
                                <b>Action</b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                Nom du groupe ici là à cet endroit
                            </td>
                            <td class="text-center">
                                <a href="{{ route('uDetailsFiliere', 1) }}" class="btn btn-sm btn-white">
                                    <i class="icofont-plus"></i>
                                </a>
                                <a href="{{ route('uModifierFiliere', 1) }}" class="btn btn-sm btn-blue">
                                    <i class="icofont-edit"></i>
                                </a>
                                <a href="{{ route('uSupprimerFiliere', 1) }}" class="btn btn-sm btn-danger">
                                    <i class="icofont-trash"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
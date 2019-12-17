@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-listine-dots"></i> Liste du (des) groupe(s)</h3>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12"><br />

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
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
                        @forelse($groupes as $groupe)
                            <tr>
                                <td>
                                    {{ $groupe->nom }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('sDetailsGroupe', $groupe->id) }}" class="btn btn-sm btn-white">
                                        <i class="icofont-plus"></i>
                                    </a>
                                    <a href="{{ route('sModifierGroupe', $groupe->id) }}" class="btn btn-sm btn-blue">
                                        <i class="icofont-edit"></i>
                                    </a>
                                    <a href="{{ route('sSupprimerGroupe', $groupe->id) }}" onclick="return confirm('Êtes-vous sur(e) de vouloir supprimer {{ $groupe->nom }} ?')" class="btn btn-sm btn-danger">
                                        <i class="icofont-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">
                                    <b>Pas de groupe</b>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>
                                <b>Nom du groupe</b>
                            </th>
                            <th class="text-center" width="250">
                                <b>Action</b>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="text-center">Nom</th>
                            <th class="text-center">Nombre de messages</th>
                            <th class="text-center">Nombre de destinataires</th>
                            <th class="text-center">Montant</th>
                            <th class="text-center">Date d'envoi</th>
                            <th class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i = 0; $i < 5; $i++)
                            <tr>
                                <td class="text-center">ESGIS</td>
                                <td class="text-center">20</td>
                                <td class="text-center">100</td>
                                <td class="text-center">20000</td>
                                <td class="text-center">12-12-2019</td>
                                <td width="100" class="text-center">
                                    <div class="btn-group">
                                        <a href="{{ url('admin/statistiques/show') }}" class="btn btn-info btn-sm"><i class="fa fa-eye"></i></a>
                                        <button class="btn btn-primary btn-sm"><i class="fa fa-send"></i></button>
                                    </div>

                                </td>
                            </tr>
                        @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

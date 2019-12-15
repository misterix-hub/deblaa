@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <i class="fa fa-bar-chart"></i>
        <span><b>Statistiques de messages universités</b></span>
        <div class="box box-primary">
            <div class="box-body">
                <div class="table-responsive">


                    <table class="table">
                        <thead>
                        <tr>
                            <th>Nom de l'université</th>
                            <th>email</th>
                            <th width="100" class="text-center">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php $tab_cible = array(); $k = 0; $z = 0; ?>
                            @forelse($universites as $universite)
                                <tr>
                                    <td>{{ $universite->nom }}</td>
                                    <td>
                                        {{ $universite->email }}
                                    </td>
                                    <td width="170" class="text-center">
                                        <div class="btn-group">
                                            <a href="{{ url('admin/statistiques/universites/show', $universite->id) }}" class="btn btn-default btn-sm">
                                                <i class="fa fa-list"></i>
                                            </a>
                                            <a href="{{ url('admin/statistiques/universites/show', $universite->id) }}" class="btn btn-default btn-sm">
                                                Afficher les détails
                                            </a>
                                        </div>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center">
                                        <b>Aucune université !</b>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

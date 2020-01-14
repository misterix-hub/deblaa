@extends('layouts.app')

@section('content')
    <div class="Structure" style="margin-bottom: 30px;">
        <section class="content-header">
            <h1>
                Demandes - Structure
            </h1>
        </section>
        <div class="content">

            @if($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif

            <div class="clearfix"></div>
            <div class="box box-primary">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table" id="structures-table">
                            <thead>
                            <tr>
                                <th>Sigle</th>
                                <th>Nom</th>
                                <th>Statut</th>
                                <th>Email</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($demandesStructure as $demandeStructure)
                                <tr>
                                    <td>{{ $demandeStructure->structure->sigle }}</td>
                                    <td>{{ $demandeStructure->structure->nom }}</td>
                                    <td>{{ $demandeStructure->structure->email }}</td>
                                    <td>Freemium</td>
                                    <td width="150" class="text-center">
                                        <form action="{{ route('accordStructureProcessing', $demandeStructure->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class='btn btn-success btn-sm'><i class="fa fa-check"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-danger"><br />
                                        Aucune demande n'a été effectuée !
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="Universite">
        <section class="content-header">
            <h1>
                Demandes - Universite
            </h1>
        </section>
        <div class="content">
            <div class="clearfix"></div>
            <div class="box box-primary">
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table" id="structures-table">
                            <thead>
                            <tr>
                                <th>Sigle</th>
                                <th>Nom</th>
                                <th>Statut</th>
                                <th>Email</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($demandesUniversite as $demandeUniversite)
                                <tr>
                                    <td>{{ $demandeUniversite->universite->sigle }}</td>
                                    <td>{{ $demandeUniversite->universite->nom }}</td>
                                    <td>{{ $demandeUniversite->universite->email }}</td>
                                    <td>Freemium</td>
                                    <td width="150" class="text-center">
                                        <form action="{{ route('accordUniversiteProcessing', $demandeUniversite->id) }}" method="post">
                                            @csrf
                                            <button type="submit" class='btn btn-success btn-sm'><i class="fa fa-check"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-danger"><br />
                                        Aucune demande n'a été éffectuée !
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection

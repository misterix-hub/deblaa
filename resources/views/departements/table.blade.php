<div class="table-responsive">
    <table class="table" id="departements-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Structure</th>
                <th colspan="3" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($departements as $departement)
                <tr>
                    <td>{{ $departement->nom }}</td>
                    <td>{{ $departement->structure->nom }}</td>
                    <td class="text-center" width="150">
                        {!! Form::open(['route' => ['departements.destroy', $departement->id], 'method' => 'delete']) !!}
                        <div class='btn-group'>
                            <a href="{{ route('departements.show', [$departement->id]) }}" class='btn btn-default btn-md'><i class="glyphicon glyphicon-eye-open"></i></a>
                            <a href="{{ route('departements.edit', [$departement->id]) }}" class='btn btn-default btn-md btn-info'><i class="glyphicon glyphicon-edit"></i></a>
                            {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-md', 'onclick' => "return confirm('Êtes-vous sûr(e) ?')"]) !!}
                        </div>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-danger"><br />
                        Pas d'enregistrement !
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

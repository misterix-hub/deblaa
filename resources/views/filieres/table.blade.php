<div class="table-responsive">
    <table class="table" id="filieres-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Universite</th>
                <th colspan="3" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse($filieres as $filiere)
            <tr>
                <td>{{ $filiere->nom }}</td>
                <td>{{ $filiere->universite->nom }}</td>
                <td width="150" class="text-center">
                    {!! Form::open(['route' => ['filieres.destroy', $filiere->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('filieres.show', [$filiere->id]) }}" class='btn btn-default btn-sm'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('filieres.edit', [$filiere->id]) }}" class='btn btn-default btn-sm btn-info'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Êtes-vous sûr(e) ?')"]) !!}
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

<div class="table-responsive">
    <table class="table" id="niveaux-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th colspan="3" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse($niveaux as $niveau)
            <tr>
                <td>{{ $niveau->nom }}</td>
                <td class="text-center" width="150">
                    {!! Form::open(['route' => ['niveaux.destroy', $niveau->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('niveaux.show', [$niveau->id]) }}" class='btn btn-default btn-sm'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('niveaux.edit', [$niveau->id]) }}" class='btn btn-default btn-sm btn-info'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Êtes-vous sûr(e) ?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="2" class="text-center text-danger"><br />
                    Pas d'enregistrement !
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

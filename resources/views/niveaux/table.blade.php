<div class="table-responsive">
    <table class="table" id="niveaux-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th colspan="3" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($niveaux as $niveau)
            <tr>
                <td>{{ $niveau->nom }}</td>
                <td class="text-center" width="100">
                    {!! Form::open(['route' => ['niveaux.destroy', $niveau->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('niveaux.show', [$niveau->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('niveaux.edit', [$niveau->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

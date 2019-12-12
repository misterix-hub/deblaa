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
        @foreach($filieres as $filiere)
            <tr>
                <td>{{ $filiere->nom }}</td>
                <td>{{ $filiere->universite->nom }}</td>
                <td width="100" class="text-center">
                    {!! Form::open(['route' => ['filieres.destroy', $filiere->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('filieres.show', [$filiere->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('filieres.edit', [$filiere->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

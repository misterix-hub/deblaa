<div class="table-responsive">
    <table class="table" id="structures-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Sigle</th>
                <th>Telephone</th>
                <th>Email</th>
                <th>Site Web</th>
                <th>Acces</th>
                <th colspan="3" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($structures as $structure)
            <tr class="{{ $structure->acces == 'Autorisé' ? 'success' : 'warning' }}">
                <td>{{ $structure->nom }}</td>
                <td>{{ $structure->sigle }}</td>
                <td>{{ $structure->telephone }}</td>
                <td>{{ $structure->email }}</td>
                <td>{{ $structure->site_web }}</td>
                <td>{{ $structure->acces }}</td>
                <td width="100" class="text-center">
                    {!! Form::open(['route' => ['structures.destroy', $structure->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('structures.show', [$structure->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('structures.edit', [$structure->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

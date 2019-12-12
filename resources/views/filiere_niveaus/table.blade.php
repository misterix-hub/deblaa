<div class="table-responsive">
    <table class="table" id="filiereNiveaus-table">
        <thead>
            <tr>
                <th>Filiere</th>
                <th>Niveau </th>
                <th class="text-center">Universite </th>
            </tr>
        </thead>
        <tbody>
        @foreach($filiereNiveaus as $filiereNiveau)
            <tr>
                <td>{{ $filiereNiveau->filiere->nom }}</td>
                <td>{{ $filiereNiveau->niveau->nom }}</td>
                <td width="100" class="text-center">{{ $filiereNiveau->filiere->universite->nom }}</td>
                <td>
{{--                    {!! Form::open(['route' => ['filiereNiveaus.destroy', $filiereNiveau->id], 'method' => 'delete']) !!}--}}
{{--                    <div class='btn-group'>--}}
{{--                        <a href="{{ route('filiereNiveaus.show', [$filiereNiveau->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>--}}
{{--                        <a href="{{ route('filiereNiveaus.edit', [$filiereNiveau->id]) }}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>--}}
{{--                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
{{--                    </div>--}}
{{--                    {!! Form::close() !!}--}}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

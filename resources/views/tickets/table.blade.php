<div class="table-responsive">
    <table class="table" id="filieres-table">
        <thead>
            <tr>
                <th>Nom du ticket</th>
                <th>Code du ticket</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse($tickets as $ticket)
            <tr>
                <td>{{ $ticket->categorie->nom }}</td>
                <td>{{ $ticket->code }}</td>
                <td width="150" class="text-center">
                    {!! Form::open(['route' => ['tickets.destroy', $ticket->id], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Êtes-vous sûr(e) ?')"]) !!}
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

<div class="table-responsive">
    <table class="table" id="categorie_tickets-table">
        <thead>
            <tr>
                <th>Nom de la catégorie</th>
                <th>Montant</th>
                <th>Nombre de MMS</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
        @forelse($categorie_tickets as $categorie_ticket)
            <tr>
                <td>{{ $categorie_ticket->nom }}</td>
                <td>{{ $categorie_ticket->montant}}</td>
                <td>{{ $categorie_ticket->nombre_mms}}</td>
                <td width="150" class="text-center">
                    {!! Form::open(['route' => ['categorie.tickets.destroy', $categorie_ticket->id], 'method' => 'delete']) !!}
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

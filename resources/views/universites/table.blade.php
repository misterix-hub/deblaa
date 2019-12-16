<div class="table-responsive">
    <table class="table" id="universites-table">
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
        @forelse($universites as $universite)
            <tr class="{{ $universite->acces == 'Autorisé' ? 'success' : 'warning' }}">
                <td>{{ $universite->nom }}</td>
                <td>{{ $universite->sigle }}</td>
                <td>{{ $universite->telephone }}</td>
                <td>{{ $universite->email }}</td>
                <td>{{ $universite->site_web }}</td>
                <td>{{ $universite->acces }}</td>
                <td class="text-center" width="150">
                    {!! Form::open(['route' => ['universites.destroy', $universite->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('universites.show', [$universite->id]) }}" class='btn btn-default btn-sm'><i class="glyphicon glyphicon-eye-open"></i></a>
                        <a href="{{ route('universites.edit', [$universite->id]) }}" class='btn btn-default btn-info btn-sm'><i class="glyphicon glyphicon-edit"></i></a>
                        {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-sm', 'onclick' => "return confirm('Êtes-vous sûr(e) ?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center text-danger"><br />
                    Pas d'enregistrement !
                </td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>

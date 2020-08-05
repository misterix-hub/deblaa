<div class="table-responsive">
    <table class="table" id="universites-table">
        <thead>
            <tr>
                <th>Nom</th>
            </tr>
        </thead>
        <tbody>
        @forelse($roles as $role)
            <tr>
                <td>{{ $role->nom }}</td>
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

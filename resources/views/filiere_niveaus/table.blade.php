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
            @forelse($filiereNiveaus as $filiereNiveau)
                <tr>
                    <td>{{ $filiereNiveau->filiere->nom }}</td>
                    <td>{{ $filiereNiveau->niveau->nom }}</td>
                    <td width="100" class="text-center">{{ $filiereNiveau->filiere->universite->sigle }}</td>
                    <td>

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

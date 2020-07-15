@forelse($contacts as $contact)
    <tr>
        <td></td>
        <td>{{ $contact->name }}</td>
        <td>{{ $contact->nom }}</td>
        <td>{{ $contact->niveau_id }}</td>
    </tr>
@empty
    <tr>
        <td colspan="4" class="text-center font-weight-bold">Aucun étudiant disponible</td>
    </tr>
@endforelse

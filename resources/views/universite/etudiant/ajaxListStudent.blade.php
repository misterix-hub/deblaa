@forelse($users as $user)
    <tr>
        <td>{{ $user->name }}</td>
        <td>+{{ $user->telephone }}</td>
        <td>
            @foreach ($filieres as $filiere)
                @if ($filiere->id == $user->filiere_id)
                    {{ $filiere->acronyme }}
                @endif
            @endforeach
        </td>
        <td>
            @foreach ($niveaux as $niveau)
                @if ($niveau->id == $user->niveau_id)
                    {{ $niveau->nom }}
                @endif
            @endforeach
        </td>
        <td class="text-center">
            <a href="{{ route('uSupprimerEtudiant', $user->id) }}" onclick="return confirm('Êtes-vous sur(e) de vouloir supprimer {{ $user->name }} ?')" class="red-text">
                <i class="icofont-trash"></i>
                Supprimer
            </a>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="5" class="text-center">Pas de données d'étudiants diponibles </td>
    </tr>
@endforelse

@forelse($usersBySpinnerets as $userBySpinneret)
    <tr class="text-uppercase font-weight-bolder">
        <td><b>{{ $userBySpinneret->name }}</b></td>
        <td><b>+{{ $userBySpinneret->telephone }}</b></td>
        <td>
            <b>
                {{ \App\Models\Niveau::where('id', $userBySpinneret->niveau_id)->get('nom')->first()->nom }}
            </b>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="3" class="text-center">Aucun étudiant dans cette filière</td>
    </tr>
@endforelse

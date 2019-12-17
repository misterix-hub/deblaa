<!-- Nom Field -->
<div class="form-group col-sm-6">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" class="form-control" value="{{ old('nom') ?? $departement->nom }}">
</div>

<!-- Structure Id Field -->
<div class="form-group col-sm-6">
    <label for="structure_id">Structure</label>
    <select name="structure_id" id="structure_id" class="form-control">
        <option value="">Choisir une structure ...</option>
        @foreach($structures as $structure)
            <option value="{{ $structure->id }}" {{ $structure->id == $departement->structure_id ? 'selected' : '' }}>{{ $structure->nom }}</option>
        @endforeach
    </select>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('departements.index') }}" class="btn btn-default">Annuler</a>
</div>

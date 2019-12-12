<!-- Universite Id Field -->
<div class="form-group col-sm-6">
    <label for="universite_id">Universite:</label>
    <select name="universite_id" id="universite_id" class="form-control">
        <option value=""> Choisir une université ...</option>
        @foreach($universites as $universite)
            <option value="{{ $universite->id }}" {{ $universite->id == $filiere->universite_id ? 'selected' : '' }}>{{ $universite->nom }}</option>
        @endforeach
    </select>
</div>

<!-- Nom Field -->
<div class="form-group col-sm-6">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" class="form-control" placeholder="Nom de la filière ..." value="{{ old('nom') ?? $filiere->nom }}">
</div>

<div class="form-group col-sm-6">
    <label for="niveaux">Niveau:</label>
        @foreach($niveaux as $niveau)
            <label class="checkbox-inline">
                <input type="checkbox" value="{{ $niveau->id }}" name="niveaux[]" @foreach($filiere->niveaux as $niv) {{ $niveau->id == $niv->pivot->niveau_id ? 'checked' : '' }} @endforeach>{{ $niveau->nom }}
            </label>
        @endforeach
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('filieres.index') }}" class="btn btn-default">Cancel</a>
</div>

<div class="form-group col-sm-12">
    <input type="text" name="nom" id="nom" placeholder="nom de la catégorie" value="{{ old('nom') }}">
</div>

<div class="form-group col-sm-6">
    <input type="text" name="montant" id="montant" placeholder="Saisir le montant" value="{{ old('montant') }}">
</div>

<div class="form-group col-sm-6">
    <input type="text" name="nombre_mms" id="nombre_mms" placeholder="Saisir le nombre de mms" value="{{ old('nombre_mms') }}">
</div>

<div class="form-group">
    <a href="{{ route('categorie.tickets.index') }}" class="btn btn-md btn-default">Annuler</a>
    <button type="submit" class="btn btn-primary btn-md">Valider la catégorie</button>
</div>

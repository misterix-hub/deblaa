<!-- Nom Field -->
<div class="form-group">
    {!! Form::label('nom', 'Nom:') !!}
    <p>{{ $departement->nom }}</p>
</div>

<!-- Structure Id Field -->
<div class="form-group">
    {!! Form::label('structure_id', 'Structure:') !!}
    <p>{{ $departement->structure->nom }}</p>
</div>


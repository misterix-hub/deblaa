<!-- Nom Field -->
<div class="form-group">
    {!! Form::label('nom', 'Nom:') !!}
    <p>{{ $filiere->nom }}</p>
</div>

<!-- Universite Id Field -->
<div class="form-group">
    {!! Form::label('universite_id', 'Universite:') !!}
    <p>{{ $filiere->universite->nom }}</p>
</div>


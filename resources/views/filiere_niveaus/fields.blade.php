<!-- Filiere Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('filiere_id', 'Filiere Id:') !!}
    {!! Form::number('filiere_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Niveau Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('niveau_id', 'Niveau Id:') !!}
    {!! Form::number('niveau_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('filiereNiveaus.index') }}" class="btn btn-default">Cancel</a>
</div>

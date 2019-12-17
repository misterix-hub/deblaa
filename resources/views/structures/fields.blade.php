<!-- Nom Field -->
<div class="form-group col-sm-6">
    <label for="nom">Nom:</label>
    <input type="text" name="nom" id="nom" class="form-control" value="{{ old('nom') ?? $structure->nom }}">
</div>

<!-- Sigle Field -->
<div class="form-group col-sm-6">
    <label for="sigle">Sigle:</label>
    <input type="text" name="sigle" id="sigle" class="form-control" value="{{ old('sigle') ?? $structure->sigle }}">
</div>

<!-- Logo Field -->
<div class="form-group col-sm-6">
    <label for="logo">Logo:</label>
    <input type="file" name="logo" id="logo" class="form-control" value="{{ old('logo') ?? $structure->logo }}">
</div>

<!-- Telephone Field -->
<div class="form-group col-sm-6">
    <label for="telephone">Telephone:</label>
    <input type="text" name="telephone" id="telephone" class="form-control" value="{{ old('telephone') ?? $structure->telephone }}">
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    <label for="email">Email:</label>
    <input type="email" name="email" id="email" class="form-control" value="{{ old('email') ?? $structure->email  }}">
</div>

{{--<!-- Password Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('password', 'Password:') !!}--}}
{{--    {!! Form::password('password', ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Site Web Field -->
<div class="form-group col-sm-6">
    <label for="site_web">Site web:</label>
    <input type="url" name="site_web" id="site_web" class="form-control" placeholder="https://www.deblaa.com" value="{{ old('site_web') ?? $structure->site_web }}">
</div>

<!-- Acces Field -->
<div class="form-group col-sm-6">
    {!! Form::label('acces', 'Acces:') !!}
    <label class="checkbox-inline">
        {!! Form::hidden('acces', 0) !!}
        {!! Form::checkbox('acces', '1', null) !!}
    </label>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('structures.index') }}" class="btn btn-default">Annuler</a>
</div>

<!-- Nom Field -->
<div class="form-group col-sm-6">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" class="form-control" value="{{ old('nom') ?? $universite->nom }}">
</div>

<!-- Sigle Field -->
<div class="form-group col-sm-6">
    <label for="sigle">Sigle:</label>
    <input type="text" id="sigle" name="sigle" class="form-control" value="{{ old('sigle') ?? $universite->sigle }}">
</div>

<!-- Logo Field -->
<div class="form-group col-sm-6">
    <label for="logo">Logo</label>
    <input type="file" id="logo" name="logo" class="form-control" value="{{ old('logo') ?? $universite->logo }}">
</div>

<!-- Telephone Field -->
<div class="form-group col-sm-6">
    <label for="telephone">Telephone:</label>
    <input type="text" id="telephone" name="telephone" class="form-control" value="{{ old('telephone') ?? $universite->telephone }}">
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" class="form-control" value="{{ old('email') ?? $universite->email }}">
</div>

{{--<!-- Password Field -->--}}
{{--<div class="form-group col-sm-6">--}}
{{--    {!! Form::label('password', 'Password:') !!}--}}
{{--    {!! Form::password('password', ['class' => 'form-control']) !!}--}}
{{--</div>--}}

<!-- Site Web Field -->
<div class="form-group col-sm-6">
    <label for="site_web">Site web:</label>
    <input type="url" id="site_web" name="site_web" class="form-control" placeholder="https://www.google.com" value="{{ old('site_web') ?? $universite->site_web }}">
</div>

<!-- Acces Field -->
<div class="form-group col-sm-6">
    {!! Form::label('acces', 'Acces:') !!}
    <label>
        {!! Form::hidden('acces', 0) !!}
        {!! Form::checkbox('acces', '1', null) !!}
    </label>
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Enregistrer', ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('universites.index') }}" class="btn btn-default">Annuler</a>
</div>

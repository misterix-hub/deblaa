<!-- Nom Field -->
<div class="form-group">
    {!! Form::label('nom', 'Nom:') !!}
    <p>{{ $structure->nom }}</p>
</div>

<!-- Sigle Field -->
<div class="form-group">
    {!! Form::label('sigle', 'Sigle:') !!}
    <p>{{ $structure->sigle }}</p>
</div>

<!-- Logo Field -->
<div class="form-group">
    {!! Form::label('logo', 'Logo:') !!}
    <p><img src="{{ URL::asset("db/logos/structure/".$structure->logo) }}" alt="logo" class="rounded" width="10%"></p>
</div>

<!-- Telephone Field -->
<div class="form-group">
    {!! Form::label('telephone', 'Telephone:') !!}
    <p>{{ $structure->telephone }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $structure->email }}</p>
</div>

<!-- Site Web Field -->
<div class="form-group">
    {!! Form::label('site_web', 'Site Web:') !!}
    <p>{{ $structure->site_web }}</p>
</div>

<!-- Acces Field -->
<div class="form-group">
    {!! Form::label('acces', 'Acces:') !!}
    <p>{{ $structure->acces }}</p>
</div>


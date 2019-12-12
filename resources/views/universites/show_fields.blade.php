<!-- Nom Field -->
<div class="form-group">
    {!! Form::label('nom', 'Nom:') !!}
    <p>{{ $universite->nom }}</p>
</div>

<!-- Sigle Field -->
<div class="form-group">
    {!! Form::label('sigle', 'Sigle:') !!}
    <p>{{ $universite->sigle }}</p>
</div>

<!-- Logo Field -->
<div class="form-group">
    {!! Form::label('logo', 'Logo:') !!}
    <p> <img src="{{ URL::asset('db/logos/universite/'.$universite->logo) }}" alt="logo" class="rounded" width="10%"></p>
</div>

<!-- Telephone Field -->
<div class="form-group">
    {!! Form::label('telephone', 'Telephone:') !!}
    <p>{{ $universite->telephone }}</p>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', 'Email:') !!}
    <p>{{ $universite->email }}</p>
</div>

{{--<!-- Password Field -->--}}
{{--<div class="form-group">--}}
{{--    {!! Form::label('password', 'Password:') !!}--}}
{{--    <p>{{ $universite->password }}</p>--}}
{{--</div>--}}

<!-- Site Web Field -->
<div class="form-group">
    {!! Form::label('site_web', 'Site Web:') !!}
    <p>{{ $universite->site_web }}</p>
</div>

<!-- Acces Field -->
<div class="form-group">
    {!! Form::label('acces', 'Acces:') !!}
    <p>{{ $universite->acces }}</p>
</div>


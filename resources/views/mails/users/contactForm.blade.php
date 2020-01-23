@component('mail::message')
    <h3> AVIS DE {{ $data['sigle'] }}</h3><br /><br />
    <strong>Nom : {{ $data['sigle']}}</strong><br />
    <strong>E-mail : {{ $data['email']}}</strong><br /><br />

    <p>{{ $data['message'] }}</p>
@endcomponent

@extends('layout.header')

@section('css')
    <style>
        .comfortaa {
            font-family: comfortaa;
        }
    </style>
@endsection

@section('home')
    @include('..included.navbar')
    <div class="container comfortaa">
        <div class="row">
            <div class="col-12">
                <br /><br />

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="list-unstyled">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                <h3 class="comfortaa">Nous contacter</h3>
                <hr>
                <form action="{{ route('messageSendByUsers') }}" id="contacts" method="post" class="comfortaa">
                    @csrf
                <div class="form-row mb-2">
                    <div class="col">
                        <label for="sigle">Sigle:</label>
                        <input type="text" name="sigle" id="sigle" class="form-control" value="{{ old('sigle') }}" required>
                    </div>
                    <div class="col">
                        <label for="email">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea name="message" id="message" cols="30" rows="10" class="form-control" style="min-height: 200px;" ></textarea>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="form-group">
                            <button type="submit" class="btn btn-blue px-5 btn-md py-3" id="sendMessage">ENVOYER</button>
                        </div>
                    </div>
                    
                </form>
                <div class="d-flex justify-content-center">
                    <div>
                        <i class="icofont icofont-google-map icofont-2x"></i><span class="mr-3"> Lomé, Togo</span>
                        <i class="icofont icofont-android-nexus icofont-2x"></i><span> 00228 91 01 92 45 | 97 53 17 17</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<br><br><br>
    @include('..included.footer')
@endsection
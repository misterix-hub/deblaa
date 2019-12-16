@extends('layout.sideBarUniversite')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-user"></i> Profil {{ $universite->sigle }}</h3>
            </div>
            <div class="col-lg-10 col-md-12 col-sm-12"><br />

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif

                @if ($message = Session::get('error'))
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @endif
                <form action="{{ route('uCompteUpdate', $universite->id) }}" method="post" enctype="multipart/form-data">

                    @csrf

                    <div class="form-row mb-4">
                        <div class="col">
                            <label for="sigle">Sigle</label>
                            <input type="text" id="sigle" name="sigle" class="form-control" value="{{ $universite->sigle }}">
                        </div>
                        <div class="col">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control" value="{{ $universite->nom }}">
                        </div>
                    </div>

                    <div class="form-row mb-4">
                        <div class="col">
                            <label for="email" class="disabled">Adresse électronique</label>
                            <input type="email" id="email" readonly name="email" class="form-control" value="{{ $universite->email }}">
                        </div>
                        <div class="col">
                            <label for="telephone" class="disabled">Telephone</label>
                            <input type="text" id="telephone" name="telephone" readonly class="form-control" value="{{ $universite->telephone }}">
                        </div>
                    </div>

                    <div class="form-row mb-4">
                        <div class="col">
                            <label for="logo">Logo</label>
                            <input type="file" id="logo" name="logo" class="form-control" value="{{ $universite->logo }}">
                        </div>
                        <div class="col">
                            <label for="site_web">Site Web</label>
                            <input type="text" id="site_web" name="site_web" class="form-control" value="{{ $universite->site_web }}">
                        </div>
                    </div>


                    <!-- Sign up button -->
                    <button class="btn btn-indigo btn-md ml-0" type="submit">Mettre à jour</button>

                </form>

            </div>
        </div>
    </div>
@endsection

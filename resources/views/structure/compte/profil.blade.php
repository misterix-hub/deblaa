@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-building"></i> Profil {{ $structure->sigle }}</h3>
            </div>
            <div class="col-10"><br />

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
                <form action="{{ route('sCompteUpdate', $structure->id) }}" method="post" enctype="multipart/form-data">

                    @csrf

                    <div class="form-row mb-4">
                        <div class="col">
                            <label for="sigle">Sigle</label>
                            <input type="text" id="sigle" name="sigle" class="form-control" value="{{ $structure->sigle }}">
                        </div>
                        <div class="col">
                            <label for="nom">Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control" value="{{ $structure->nom }}">
                        </div>
                    </div>

                    <div class="form-row mb-4">
                        <div class="col">
                            <label for="email" class="disabled">Adresse électronique</label>
                            <input type="email" id="email" readonly name="email" class="form-control" value="{{ $structure->email }}">
                        </div>
                        <div class="col">
                            <label for="telephone" class="disabled">Telephone</label>
                            <input type="text" id="telephone" name="telephone" readonly class="form-control" value="{{ $structure->telephone }}">
                        </div>
                    </div>

                    <div class="form-row mb-4">
                        <div class="col">
                            <label for="logo">Logo</label>
                            <input type="file" id="logo" name="logo" class="form-control" value="{{ $structure->logo }}">
                        </div>
                        <div class="col">
                            <label for="site_web">Site Web</label>
                            <input type="text" id="site_web" name="site_web" class="form-control" value="{{ $structure->site_web }}">
                        </div>
                    </div>


                    <!-- Sign up button -->
                    <button class="btn btn-indigo btn-md ml-0" type="submit">Mettre à jour</button>

                </form>

            </div>
        </div>
    </div>
@endsection

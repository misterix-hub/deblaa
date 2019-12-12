@extends('layout.sideBarUniversite')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3><i class="icofont-user"></i> Profil</h3>
            </div>
            <div class="col-12"><br />

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif<br /><br /><br />

                <h2 class="text-center red-text">En construction ...</h2>

            </div>
        </div>
    </div>
@endsection
@extends('layout.sideBarStructure')

@section('content')
    <br />
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3>
                    <i class="icofont-chart-bar-graph"></i>
                    Bilan de messages
                </h3>
            </div>
            <div class="col-12"><br />

                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif
                <br /><br /><br />
                <h1 style="font-weight: 200;" class="red-text text-center">En cours de développement !</h1>
                <h1 class="red-text text-center"><i class="icofont-settings"></i></h1>

            </div>
        </div>
    </div>
@endsection
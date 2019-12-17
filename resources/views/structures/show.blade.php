@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Structure
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('structures.show_fields')
                    <a href="{{ route('structures.index') }}" class="btn btn-default">retour</a>
                </div>
            </div>
        </div>
    </div>
@endsection

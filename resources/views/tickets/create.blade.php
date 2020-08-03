@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Ticket
        </h1>
    </section>

    @if (Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            {{ Session::get('success') }}
            <button type="button" class="close" aria-label="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (Session::get('error'))
        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
            {{ Session::get('error') }}
            <button type="button" class="close" aria-label="close" data-dismiss="alert">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    @include('tickets.fields')
                </div>
            </div>
        </div>
    </div>
@endsection

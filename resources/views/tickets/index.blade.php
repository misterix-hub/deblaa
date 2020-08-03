@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Tickets</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('tickets.create') }}">Créer un ticket</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

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

        {{--  @include('flash::message')  --}}

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('tickets.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1 class="pull-left">Categorie_tickets</h1>
        <h1 class="pull-right">
           <a class="btn btn-primary pull-right" style="margin-top: -10px;margin-bottom: 5px" href="{{ route('categorie.tickets.create') }}">Créer une catégorie</a>
        </h1>
    </section>
    <div class="content">
        <div class="clearfix"></div>

        @include('flash::message')

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ $message }}
                <button type="button" class="close" aria-label="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if ($message = Session::get('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ $message }}
                <button type="button" class="close" aria-label="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <div class="clearfix"></div>
        <div class="box box-primary">
            <div class="box-body">
                    @include('categorie_tickets.table')
            </div>
        </div>
        <div class="text-center">

        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Ticket
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <form action="{{ route('categorie.tickets.store') }}" method="post">
                        @csrf
                        @include('categorie_tickets.fields')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Universite
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    <form action="{{ route('universites.store') }}" method="post" enctype="multipart/form-data">

                        @csrf

                        @include('universites.fields')

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Filiere
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($filiere, ['route' => ['filieres.update', $filiere->id], 'method' => 'patch']) !!}

                        @include('filieres.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
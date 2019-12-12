@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Niveau
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($niveau, ['route' => ['niveaux.update', $niveau->id], 'method' => 'patch']) !!}

                        @include('niveaux.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Departement
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($departement, ['route' => ['departements.update', $departement->id], 'method' => 'patch']) !!}

                        @include('departements.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Filiere Niveau
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($filiereNiveau, ['route' => ['filiereNiveaus.update', $filiereNiveau->id], 'method' => 'patch']) !!}

                        @include('filiere_niveaus.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection
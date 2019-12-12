@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Structure
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   <form action="{{ route('structures.update', $structure->id) }}" method="post" enctype="multipart/form-data">

                        @csrf
                        @method('PATCH')
                        @include('structures.fields')

                   </form>
               </div>
           </div>
       </div>
   </div>
@endsection

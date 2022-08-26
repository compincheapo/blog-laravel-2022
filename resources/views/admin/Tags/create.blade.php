@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Crear etiqueta</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body"> {{-- Con laravel collective es innecesario colocar el token @csrf --}}
            {!! Form::open(['route' => 'admin.tags.store']) !!}    
                @include('admin.tags.partials.form')
               
            {!! Form::submit('Crear etiqueta', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js') {{-- Incluimos el jquery para poder utilizar la función de slug --}}
<script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>   
<script>
    $(document).ready( function() {         {{-- Utilizamos dicha función para realizar el slug. --}}
    $("#name").stringToSlug({               /* Del input con id name convertimos su contenido en un slug para almacenarlo en el input con id slug. */
      setEvents: 'keyup keydown blur',
      getPut: '#slug',
      space: '-'
    });
  });
</script>

@endsection
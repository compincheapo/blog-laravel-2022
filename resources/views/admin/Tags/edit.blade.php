@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Editar etiqueta</h1>
@stop

@section('content')
    @if(session('info')) {{-- Verificamos si hay un mensaje en la variable info. --}}
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong> {{-- Mostramos el mensaje. --}}
    </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($tag, ['route' => ['admin.tags.update', $tag], 'method' => 'put']) !!}
            @include('admin.tags.partials.form')

            {!! Form::submit('Actualizar etiqueta', ['class' => 'btn btn-primary']) !!}
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
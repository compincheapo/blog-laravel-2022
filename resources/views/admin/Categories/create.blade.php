@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Crear nueva categoria</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' => 'admin.categories.store']) !!}
               
                <div class="form-group"> {{-- Laravel Collective recomienda colocar los elementos como label e input dentro de un div de tipo form-group para la separación. --}}
                    {!! Form::label('name', 'Nombre') !!} {{-- form control es de bootstrap y le da estilo al input. --}}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la categoria']) !!}    
                    
                    @error('name')                                      {{-- En caso de error de validación, enviamos un mensaje de error. --}}
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                    
                </div>

                <div class="form-group"> {{-- Laravel Collective recomienda colocar los elementos como label e input dentro de un div de tipo form-group para la separación. --}}
                    {!! Form::label('slug', 'Slug') !!} {{-- form control es de bootstrap y le da estilo al input. --}}
                    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el slug de la cateoria', 'readonly']) !!}    
                   
                    @error('slug')
                        <span class="text-danger">{{$message}}</span>
                    @enderror

                </div>

                {!! Form::submit('Crear categoría', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>
    </div>
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
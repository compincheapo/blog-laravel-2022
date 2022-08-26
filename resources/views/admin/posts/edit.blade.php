@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <h1>Editar Post</h1>
@stop

@section('content')

    @if(session('info')) {{-- Verificamos si hay un mensaje en la variable info. --}}
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong> {{-- Mostramos el mensaje. --}}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($post,['route' => ['admin.posts.update', $post], 'autocomplete' => 'off', 'files' => true, 'method' => 'put']) !!}
 
            @include('admin.posts.partials.form')
           
            {!! Form::submit('Actualizar post', ['class' => 'btn btn-primary']) !!}


        </div>
    </div>
@stop

@section('css')
   <style>
       .image-wrapper{
           position: relative;
           padding-bottom: 56.25%;

       }
       
       .image-wrapper img{
           position: absolute;
           object-fit: cover;
           width: 100%;
           height: 100%;
       }

   </style>
@stop

@section('js') {{-- Incluimos el jquery para poder utilizar la función de slug --}}
    <script src="{{asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js')}}"></script>   
    <script src="https://cdn.ckeditor.com/ckeditor5/27.1.0/classic/ckeditor.js"></script> {{-- Con esto agregamos funcionalidades para personalizar el texto que ingresemos en los textarea. --}}
    <script>
        $(document).ready( function() {         {{-- Utilizamos dicha función para realizar el slug. --}}
        $("#name").stringToSlug({               /* Del input con id name convertimos su contenido en un slug para almacenarlo en el input con id slug. */
          setEvents: 'keyup keydown blur',
          getPut: '#slug',
          space: '-'
        });
      });

      ClassicEditor
        .create( document.querySelector( '#extract' ) )
        .catch( error => {
            console.error( error );
        } );

        ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );

        //Cambiar imagen
        document.getElementById("file").addEventListener('change', cambiarImagen); /* Ante algun cambio (change) en el elemento con id 'file' se llamará a la función cambiarImagen */

        function cambiarImagen(event){              /* Con esta función al seleccionar otra imágen, esta se visualizará en el formulario. */            
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result); 
            };

            reader.readAsDataURL(file);
        }
    </script>
    
 @endsection
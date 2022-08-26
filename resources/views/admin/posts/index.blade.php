@extends('adminlte::page')

@section('title', 'Blog')

@section('content_header')
    <a class="btn btn-secondary btn-sm float-right" href="{{route('admin.posts.create')}}">Nuevo post</a>
    <h1>Listado de post</h1>
@stop

@section('content')
    @if(session('info')) {{-- Verificamos si hay un mensaje en la variable info. --}}
        <div class="alert alert-success">
            <strong>{{session('info')}}</strong> {{-- Mostramos el mensaje. --}}
        </div>
    @endif
    @livewire('admin.posts-index')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
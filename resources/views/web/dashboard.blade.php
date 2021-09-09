@extends('adminlte::page')

@section('title', 'DaskBoard')

@section('content_header')
    <h3>Sistema de Gestión Educativa</h3>
@stop

@section('content')        

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script src="{{asset('js/app.js')}}"></script> <!--Añadimos el js generado con webpack, donde se encuentra nuestro componente vuejs-->
    <script> console.log('Hit'); </script>
@stop

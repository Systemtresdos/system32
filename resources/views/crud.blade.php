@extends('adminlte::page')

@section('title', 'System32')

@section('content_header')
    <h1 style="text-align: center">Base de datos</h1>
@stop

@section('content')
<div style="overflow-y: auto;">
    @include('adminlte::partials.system32.tabla-pordefecto')
</div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap5.css') }}">
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('js/datatables/jquery-3.7.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables/dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables/dataTables.bootstrap5.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables/bootstrap.bundle.min.js') }}"></script>
    <script>new DataTable('#example');</script>
@stop
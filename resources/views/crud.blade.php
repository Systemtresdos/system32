@extends('adminlte::page')

@section('title', 'System32')

@section('content_header')
    <h1 style="text-align: center">Base de datos</h1>
@stop

@section('content')
<div class="col-md-12" style="overflow-y: auto;">
    @include('adminlte::partials.system32.tabla-pordefecto',[
      'datos' => $datos,
      'arregloDatos' => $arregloDatos,
      'nombre' => $nombre,
      'fk' => $fk,
    ])
    @include('adminlte::partials.system32.modal-crear',[
      'datos' => $datos,
      'arregloDatos' => $arregloDatos,
      'nombre' => $nombre,
      'fk' => $fk,
    ])
    @include('adminlte::partials.system32.modal-editar',[
      'datos' => $datos,
      'arregloDatos' => $arregloDatos,
      'nombre' => $nombre,
      'fk' => $fk,
    ])
</div>
@stop


@section('css')
    <link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bootstrap5.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr/toastr.min.css') }}">
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('js/datatables/jquery-3.7.1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables/dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables/dataTables.bootstrap5.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/datatables/bootstrap.bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/toastr/toastr.min.js') }}"></script>
    <script>
      new DataTable('#datatables');
    </script>
    <script>
      @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error('Error: {{ $error }}')
        @endforeach
      @endif
      @if (session('warning'))
        toastr.warning('Aviso: {{ session('warning') }}')
      @endif
      @if (session('success'))
        toastr.success('{{ session('success') }}')
      @endif
    </script>
    @include('adminlte::partials.system32.modal-editar-js')
@stop
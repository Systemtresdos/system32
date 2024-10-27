@extends('adminlte::page')

@section('title', 'System32')

@section('content_header')
    <h1 style="text-align: center">...</h1>
@stop

@section('content')
<div style="overflow-y: auto;">
    <canvas class="frame" id="canvas" oncontextmenu="event.preventDefault()" tabindex="-1"></canvas>
</div>
@stop

@section('css')

@stop

@section('js')
    <script type="text/javascript" src="{{ asset('dm/doom1-wad.js') }}"></script>
    <script type="text/javascript" src="{{ asset('dm/websockets-doom.js') }}"></script>
@stop
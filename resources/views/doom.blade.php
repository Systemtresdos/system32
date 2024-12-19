@extends('adminlte::page')

@section('title', 'System32')

@section('content_header')
    <h1 style="text-align: center">Base de datos</h1>
@stop

@section('content')
<div class="col-md-12" style="overflow-y: auto;">
    <div class="my-2 d-flex justify-content-center" style="height: 30rem;">
        <canvas class="frame" id="canvas" oncontextmenu="event.preventDefault()" tabindex="-1"></canvas>
    </div>
</div>
@stop


@section('css')
    <link rel="stylesheet" href="{{ asset('css/toastr/toastr.min.css') }}">
@stop

@section('js')
    <script type="text/javascript" src="{{ asset('js/datatables/bootstrap.bundle.min.js') }}"></script>
    <script>
            var commonArgs = ["-iwad", "doom1.wad", "-window", "-nogui", "-nomusic", "-config", "default.cfg", "-servername", "doomflare"];

            var Module = {
                onRuntimeInitialized: () => {
                    callMain(commonArgs);
                },
                noInitialRun: true,
                preRun: () => {
                    Module.FS.createPreloadedFile("", "doom1.wad", "{{ asset('doom/doom1.wad') }}", true, true);
                    Module.FS.createPreloadedFile("", "default.cfg", "{{ asset('doom/default.cfg') }}", true, true);
                },
                printErr: function (text) {
                    if (arguments.length > 1) text = Array.prototype.slice.call(arguments).join(" ");
                    console.error(text);
                },
                canvas: (function () {
                    var canvas = document.getElementById("canvas");
                    canvas.addEventListener(
                        "webglcontextlost",
                        function (e) {
                            alert("WebGL context lost. You will need to reload the page.");
                            e.preventDefault();
                        },
                        false
                    );
                    return canvas;
                })(),
                print: function (text) {
                    console.log(text);
                },
                setStatus: function (text) {
                    console.log(text);
                },
                totalDependencies: 0,
                monitorRunDependencies: function (left) {
                    this.totalDependencies = Math.max(this.totalDependencies, left);
                    Module.setStatus(left ? "Preparing... (" + (this.totalDependencies - left) + "/" + this.totalDependencies + ")" : "All downloads complete.");
                },
            };

            window.onerror = function (event) {
                Module.setStatus("Exception thrown, see JavaScript console");
                Module.setStatus = function (text) {
                    if (text) Module.printErr("[post-exception status] " + text);
                };
            };
        </script>
    <script type="text/javascript" src="{{ asset('doom/websockets-doom.js')}}"></script>
@stop
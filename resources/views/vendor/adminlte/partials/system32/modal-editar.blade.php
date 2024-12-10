<!-- Button trigger modal
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearModal">
    Launch demo modal
</button>
-->

<!-- Modal -->
<div class="modal fade" id="editarModal" tabindex="-1" role="dialog" aria-labelledby="editarModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarModalLabel">Editar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{url()->current().'/editar/?tabla='.$nombre}}" method="POST">
                @csrf
                <div class="modal-body">
                    {{--ID invisible--}}
                    <input type="hidden" name="id" id="editar_id" class = "input_editar"/>

                    <h5 class="login-box-msg">Ingrese los datos de {{ $nombre }}</h5>
                    @foreach ($arregloDatos['data'] as $index)
                        @if ($index['type'] != 'auto')
                            @php
                                $class='';
                                switch ($index['type']){
                                    case 'switch':
                                        $class = 'custom-control custom-switch';
                                }
                            @endphp
                            <div class="form-group mb-3 {{$class}}">
                                @switch ($index['type'])
                                    @case ('switch')
                                        @break
                                    @default
                                        <label for="{{$index['name']}}">{{$index['dName']}}</label>
                                @endswitch
                                @php $extra=''; @endphp
                                @switch($index['type'])
                                    @case('switch')
                                        <input type="checkbox" class="custom-control-input input_editar" name="{{$index['name']}}" id="{{$index['name']}}">
                                        <label class = "custom-control-label" for="{{$index['name']}}">{{$index['dName']}}</label>
                                    @break
                                    @case('textarea')
                                        <textarea class="form-control input_editar" name="{{ $index['name'] }}" rows="3" placeholder="{{ $index['dName'] }}"></textarea>
                                    @break
                                    @case('enum')
                                        <select class="form-control input_editar" id="{{$index['name']}}" name="{{$index['name']}}">
                                            @php $i = 1;@endphp
                                            @foreach ($index['enum'] as $enum)
                                                <option value="{{$i}}">{{$enum['dName']}}</option>
                                                @php $i++;@endphp
                                            @endforeach
                                        </select>
                                    @break
                                    @default
                                        <input id="{{ $index['dName'] }}" name="{{ $index['name'] }}"
                                            type="{{ $index['type'] }}" class="form-control input_editar" {{ $extra }}
                                            placeholder="{{ $index['dName'] }}" />
                                @endswitch
                            </div>
                        @endif
                    @endforeach

                    @foreach ($fk as $index)
                        <div class="form-group mb-3">
                            <label for="{{$index['name']}}">{{$index['name']}}</label>
                            <select class="form-control input_editar" id="{{$index['name']}}" name="{{$index['attr']}}">
                                @foreach ($index['data'] as $data)
                                    <option value="{{$data[$index['fk_id']]}}">{{$data[$index['fk_name']]}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endforeach
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

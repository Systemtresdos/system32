<div class="card card-primary card-outline" style="display: flex;">
    <div class="card-header ui-sortable-handle">
        <h3 class="card-title">
            {{$nombre}}
        </h3>
        @if (Auth::user()->rol->crear_crud)
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#crearModal">
            <i class="fas fa-plus"></i> Agregar
        </button>
        @endif
    </div>
    <div class="card-body">
        <table id="datatables" class="table table-striped">
            <thead>
                <tr>
                    @foreach ($arregloDatos['data'] as $index)
                        <th>{{$index['dName']}}</th>
                    @endforeach
                    @foreach ($fk as $index)
                        <th>{{$index['name']}}</th>
                    @endforeach
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($datos as $dato)
                @php
                    $arreglo = $dato->toArray();
                    if (count($arregloDatos)){
                        $fkarray = $dato->get_fk();
                    }
                @endphp
                    <tr id = "table_{{$arreglo['id']}}">
                        @foreach ($arregloDatos['data'] as $index)
                            <td>{{ $arreglo[$index['name']] }}</td>
                        @endforeach
                        @foreach ($fk as $index)
                            <td>{{ $fkarray[$index['attr']] }}</td>
                        @endforeach
                        <td>
                            <div class="btn-group">
                            @if (Auth::user()->rol->modificar_crud)
                                <button type="button" class="btn btn-info" onclick = "editar_tabla({{ $arreglo['id'] }})" data-toggle="modal" data-target="#editarModal">
                                    <i class="fas fa-wrench"></i>
                                </button>
                            @endif
                            @if (Auth::user()->rol->eliminar_crud)
                                <button type="button" class="btn btn-danger" onclick = "eliminar_tabla({{ $arreglo['id'] }})" data-toggle="modal" data-target="#eliminarModal">
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    @foreach ($arregloDatos['data'] as $index)
                        <th>{{$index['dName']}}</th>
                    @endforeach
                    @foreach ($fk as $index)
                        <th>{{$index['name']}}</th>
                    @endforeach
                    <th>Acciones</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

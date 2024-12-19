<div class="card card-primary card-outline" style="display: flex;">
    <div class="card-header ui-sortable-handle">
        <h3 class="card-title">
            {{$nombre}}
        </h3>
        @if (Auth::user()->rol->crear_crud)
        <button type="button" class="btn btn-primary float-right" onclick = "crearModal()"data-toggle="modal" data-target="#modal-crud">
            <i class="fas fa-plus"></i> Agregar
        </button>
        @endif
    </div>
    <div class="card-body">
        <table id="datatables" class="table table-striped">
            <thead id="crud-table-head">
                <tr id="crud-table-head-row">
                    @foreach ($arregloDatos['data'] as $index)
                        <th id="crud-head-{{$index["name"]}}">{{$index['display-name']}}</th>
                    @endforeach
                    @foreach ($fk as $index)
                        <th id="crud-head-{{$index["attr"]}}">{{$index['name']}}</th>
                    @endforeach
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="crud-table-body">
                @foreach ($datos as $dato)
                @php
                    $dato_arreglo = $dato->toArray();
                    if (count($arregloDatos)){
                        $fkarray = $dato->get_fk();
                    }
                @endphp
                    <tr id = "crud-table-{{$dato_arreglo['id']}}">
                        @foreach ($arregloDatos['data'] as $index)
                            <td>{{ $dato_arreglo[$index['name']] }}</td>
                        @endforeach
                        @foreach ($fk as $index)
                            <td data-fk="{{ $dato_arreglo[$index['attr']] }}">{{ $fkarray[$index['attr']] }}</td>
                        @endforeach
                        <td>
                            <div class="btn-group">
                            @if (Auth::user()->rol->modificar_crud)
                                <button type="button" class="btn btn-info" onclick = "editarModal({{ $dato_arreglo['id'] }})" data-toggle="modal" data-target="#modal-crud">
                                    <i class="fas fa-wrench"></i>
                                </button>
                            @endif
                            @if (Auth::user()->rol->eliminar_crud)
                                <button type="button" class="btn btn-danger" onclick = "eliminar_tabla({{ $dato_arreglo['id'] }})" data-toggle="modal" data-target="#eliminarModal">
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
                        <th>{{$index['display-name']}}</th>
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

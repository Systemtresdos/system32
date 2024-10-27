<div class="card card-primary card-outline" style="display: flex;">
    <div class="card-header ui-sortable-handle">
        <h3 class="card-title">
            {{$nombre}}
        </h3>
        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#crearModal">
            <i class="fas fa-plus"></i> Agregar
        </button>
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
                    <tr>
                        @foreach ($arregloDatos['data'] as $index)
                            <td>{{ $arreglo[$index['name']] }}</td>
                        @endforeach
                        @foreach ($fk as $index)
                            <td>{{ $fkarray[$index['attr']] }}</td>
                        @endforeach
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
                </tr>
            </tfoot>
        </table>
    </div>
</div>

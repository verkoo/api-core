<table id="results" class="table table-striped is-fullwidth">
    <tr>
        <th>#</th>
        <th>Tipo de Iva</th>
        <th>Porcentaje</th>
        <th>Acciones</th>
    </tr>

    @foreach ($taxes as $item)
        <tr data-id="{{ $item->id }}">
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->percentage }}</td>
            <td>
                <span class="fa fa-edit" aria-hidden="true"></span>&nbsp;<a href="{{ route('taxes.edit', $item) }}" id="edit_link">Editar</a>
                {{--@can('destroy', $item)--}}
                    {{--<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<a href="" class="btn-delete">Borrar</a>--}}
                {{--@endcan--}}
            </td>
        </tr>
    @endforeach
</table>
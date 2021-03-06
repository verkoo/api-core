<table id="results" class="table table-striped is-fullwidth">
    <tr>
        <th>#</th>
        <th>Unidad de Medida</th>
        <th>Acciones</th>
    </tr>

    @foreach ($unitsOfMeasure as $item)
        <tr data-id="{{ $item->id }}">
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>
                <span class="fa fa-edit" aria-hidden="true"></span>&nbsp;<a href="{{ route('units-of-measure.edit', $item) }}" id="edit_link">Editar</a>
                {{--@can('destroy', $item)--}}
                    {{--<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<a href="" class="btn-delete">Borrar</a>--}}
                {{--@endcan--}}
            </td>
        </tr>
    @endforeach
</table>
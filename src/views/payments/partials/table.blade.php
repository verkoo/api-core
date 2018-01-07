<table id="results" class="table table-striped is-fullwidth">
    <tr>
        <th>#</th>
        <th>Forma de Pago</th>
        <th>Acciones</th>
    </tr>

    @foreach ($payments as $item)
        <tr data-id="{{ $item->id }}">
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>
                <span class="fa fa-edit" aria-hidden="true"></span>&nbsp;<a href="{{ url("payments/{$item->id}/edit") }}" id="edit_link">Editar</a>
            </td>
        </tr>
    @endforeach
</table>
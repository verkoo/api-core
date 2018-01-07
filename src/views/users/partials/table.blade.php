<table id="results" class="table table-striped is-fullwidth">
    <tr>
        <th>#</th>
        <th>Usuario</th>
        <th>Acciones</th>
    </tr>

    @foreach ($users as $item)
        <tr data-id="{{ $item->id }}">
            <td>{{ $item->id }}</td>
            <td>{{ $item->name }}</td>
            <td>
                <span class="fa fa-pencil-square-o" aria-hidden="true"></span>&nbsp;<a href="{{ url("/users/{$item->id}/edit") }}" id="edit_link">Editar</a>
            </td>
        </tr>
    @endforeach
</table>
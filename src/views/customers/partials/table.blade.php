<table id="results" class="table table-striped is-fullwidth">
    <tr>
        <th>#</th>
        <th>Nombre</th>
        <th>Teléfono</th>
        <th>Acciones</th>
    </tr>

    @foreach ($customers as $customer)
        <tr data-id="{{ $customer->id }}">
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->phone }}</td>
            <td>
                <a href="{{ url("customers/{$customer->id}/edit") }}" id="edit_link"><i class="fa fa-edit fa-2x"></i></a>
                @can('destroy', $customer)
                    <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>&nbsp;<a href="" class="btn-delete">Borrar</a>
                @endcan
            </td>
        </tr>
    @endforeach
</table>
 {!! Form::open(['route' => ['suppliers.destroy', $supplier], 'method' => 'DELETE']) !!}
    <button type="submit" class="btn btn-danger">Eliminar Proveedor</button>
{!! Form::close() !!}
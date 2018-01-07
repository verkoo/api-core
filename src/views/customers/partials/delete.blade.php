 {!! Form::open(['route' => ['customers.destroy', $customer], 'method' => 'DELETE']) !!}
    <button type="submit" class="btn btn-danger">Eliminar Cliente</button>
{!! Form::close() !!}
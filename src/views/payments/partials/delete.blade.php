 {!! Form::open(['url' => ["payments/{$payment->id}"], 'method' => 'DELETE']) !!}
    <button type="submit" class="btn btn-danger">Eliminar Forma de Pago</button>
{!! Form::close() !!}
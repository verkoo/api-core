 {!! Form::open(['url' => ["boxes/{$box->id}"], 'method' => 'DELETE']) !!}
    <button type="submit" class="btn btn-danger">Eliminar Caja</button>
{!! Form::close() !!}
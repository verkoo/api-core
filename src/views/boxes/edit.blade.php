@extends('verkooCommon::layouts.crud_edit', [
    'name' => 'Caja',
    'route' => 'boxes',
    'item' => $box
])

@section('extra_content')
    <div class="section">
        <div class="container">
            <section class="box">
                <h1 class="title">
                    Usuarios
                </h1>
                {!! Form::open(['url' => "boxes/{$box->id}/users", 'method' => 'POST']) !!}
                    <div class="columns">
                        <div class="column">
                            <span class="select">
                                {!! Form::select('user_id', $users) !!}
                            </span>
                        </div>
                        <div class="column">
                            <button type="submit" class="button is-warning">Añadir Usuario</button>
                        </div>
                    </div>
                </form>

                @foreach($box->users as $user)

                <div class="columns">
                        <div class="column">
                            {{ $user->name }}
                        </div>
                        <div class="column">
                            {!! Form::open(['url' => "boxes/{$box->id}/users/{$user->id}", 'method' => 'DELETE']) !!}
                                <button type="submit" class="button is-small is-danger">Borrar</button>
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endforeach
            </section>
        </div>
    </div>
    {{----}}
    {{--<div class="col-md-10 col-md-offset-1 has-top-padding">--}}
        {{--<div class="panel panel-default">--}}
            {{--<div class="panel-heading">Usuarios</div>--}}
            {{--<div class="panel-body">--}}
                {{--<div class="row">--}}
                    {{--{!! Form::open(['url' => "boxes/{$box->id}/users", 'method' => 'POST']) !!}--}}
                    {{--<div class="col-md-6">--}}
                        {{--{!! Form::select('user_id', $users, null, ['class' => 'form-control has-bottom-margin']) !!}--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6">--}}
                        {{--<button type="submit" class="btn btn-warning has-bottom-margin">Añadir Usuario</button>--}}
                    {{--</div>--}}
                    {{--{!! Form::close() !!}--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--<table id="results" class="table table-striped">--}}
                        {{--<tr>--}}
                            {{--<th>#</th>--}}
                            {{--<th>Usuario</th>--}}
                            {{--<th>Acciones</th>--}}
                        {{--</tr>--}}

                        {{--@foreach($box->users as $user)--}}
                            {{--<tr>--}}
                                {{--<td>{{ $user->id }}</td>--}}
                                {{--<td>{{ $user->name }}</td>--}}
                                {{--<td>--}}
                                    {{--{!! Form::open(['url' => "boxes/{$box->id}/users/{$user->id}", 'method' => 'DELETE']) !!}--}}
                                    {{--<button type="submit" class="btn btn-xs btn-danger">Borrar</button>--}}
                                    {{--{!! Form::close() !!}--}}
                                {{--</td>--}}
                            {{--</tr>--}}
                        {{--@endforeach--}}
                    {{--</table>--}}
                {{--</div>--}}

            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
@endsection
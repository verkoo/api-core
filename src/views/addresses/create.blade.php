@extends('app')

@section('content')
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Nueva Dirección para {{ $customer->name }}
                </h1>
            </div>
        </div>
    </section>

    @include('verkooCommon::partials.messages')

    <div class="container">
        {!! Form::open(['id' => 'form','url' => ["customers/{$customer->id}/addresses"], 'method' => 'POST']) !!}
        <div class="section">
            <div class="box">
                @include('verkooCommon::addresses.partials.fields')
            </div>
        </div>
        <button type="submit" class="button is-warning">Crear Dirección</button>
        {!! Form::close() !!}
        <a href="/customers/{{ $customer->id }}/edit" class="button is-info crud-button" id="back_link">Volver</a>
    </div>
@endsection

{{--@section('content')--}}
    {{--<div class="container">--}}
        {{--@include('partials.messages')--}}
        {{--<div class="row">--}}
            {{--<div class="col-md-10 col-md-offset-1">--}}
                {{--<div class="panel panel-default">--}}
                    {{--<div class="panel-heading">Nueva Dirección para {{ $customer->name }}</div>--}}
                    {{--<div class="panel-body">--}}
                        {{--{!! Form::open(['id' => 'form','url' => ["customers/{$customer->id}/addresses"], 'method' => 'POST']) !!}--}}
                        {{--@include('addresses.partials.fields')--}}
                        {{--<button type="submit" class="btn btn-warning">Crear Dirección</button>--}}
                        {{--{!! Form::close() !!}--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--@endsection--}}

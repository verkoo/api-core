@extends('app')

@section('content')
    <section class="hero is-primary">
        <div class="hero-body">
            <div class="container">
                <h1 class="title">
                    Editar Dirección: {{ $address->address }}
                </h1>
            </div>
        </div>
    </section>

    @include('verkooCommon::partials.messages')

    <div class="container">
        {!! Form::model($address, [ 'id' => 'form', 'url' => ["customers/{$customer->id}/addresses/{$address->id}"], 'method' => 'PUT']) !!}
        <div class="section">
            <div class="box">
                @include('verkooCommon::addresses.partials.fields')
            </div>
        </div>
        <button type="submit" class="button is-warning crud-button">Editar Dirección</button>
        {!! Form::close() !!}
        <a href="/customers/{{ $customer->id }}/edit" class="button is-info crud-button" id="back_link">Volver</a>
    </div>
    @include('verkooCommon::addresses.partials.delete')
@endsection

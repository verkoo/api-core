@extends('app')

@section('content')
        @include('verkooCommon::partials.messages')

        <section class="hero is-primary">
                <div class="hero-body">
                        <div class="container">
                                <h1 class="title">
                                        Reporte de Ventas
                                </h1>
                        </div>
                </div>
        </section>
        <div class="section">
                <form method="POST" action="/reports/orders">
                        {{ csrf_field() }}
                        <div class="has-text-centered has-padding-10">
                                <button type="submit" class="button is-success">Generar Informe</button>
                        </div>
                        <reports></reports>
                </form>
        </div>
@endsection
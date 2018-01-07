<div class="section">
    <div class="container">
        <section class="box">
            <h1 class="title">
                Direcciones
            </h1>
            <h2 class="subtitle has-padding-10">
                <a class="button is-small is-info" href="{{ url("customers/{$customer->id}/addresses/create") }}">Nueva</a>
            </h2>
            <table id="results" class="table is-striped">
                <tr>
                    <th>#</th>
                    <th>Dirección</th>
                    <th>C. Postal</th>
                    <th>Ciudad</th>
                    <th>Provincia</th>
                    <th>Fav</th>
                    <th>Opciones</th>
                </tr>

                @foreach($customer->addresses as $address)
                    <tr data-id="{{ $address->id }}">
                        <td>{{ $address->id }}</td>
                        <td>{{ $address->address }}</td>
                        <td>{{ $address->postcode }}</td>
                        <td>{{ $address->city }}</td>
                        <td>{{ $address->provinceName }}</td>
                        <td>
                            @if($address->default)
                                <i class="fa fa-check" aria-hidden="true"></i>
                            @endif
                        </td>
                        <td>
                            <span class="fa fa-edit" aria-hidden="true"></span>&nbsp;<a href="{{ url("customers/{$customer->id}/addresses/{$address->id}/edit") }}" id="edit_link">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </section>
    </div>
</div>


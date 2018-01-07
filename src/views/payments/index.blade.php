@include('verkooCommon::layouts.crud_index', [
    'name' => 'Formas de Pago',
    'button' => 'Nueva Forma de Pago',
    'route' => 'payments',
    'items' => $payments,
])

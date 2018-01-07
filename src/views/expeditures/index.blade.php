@include('verkooCommon::layouts.crud_index', [
    'name' => 'Gastos',
    'button' => 'Nuevo Gasto',
    'route' => 'expeditures',
    'items' => $expeditures,
    'filter' => true,
])
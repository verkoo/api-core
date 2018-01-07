@include('verkooCommon::layouts.crud_index', [
    'name' => 'Cajas',
    'button' => 'Nueva Caja',
    'route' => 'boxes',
    'items' => $boxes,
])

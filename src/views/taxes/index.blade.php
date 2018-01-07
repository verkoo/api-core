@include('verkooCommon::layouts.crud_index', [
    'name' => 'Tipos de Iva',
    'button' => 'Nuevo Tipo de Iva',
    'route' => 'taxes',
    'items' => $taxes,
])

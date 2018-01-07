@include('verkooCommon::layouts.crud_index', [
    'name' => 'Tipos de Gasto',
    'button' => 'Nuevo Tipo de Gasto',
    'route' => 'expediture-types',
    'items' => $expeditureTypes,
    'filter' => true,
])
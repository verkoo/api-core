@include('verkooCommon::layouts.crud_index', [
    'name' => 'Unidades de Medida',
    'button' => 'Nueva Unidad de Medida',
    'route' => 'units-of-measure',
    'items' => $unitsOfMeasure,
    'filter' => true,
])
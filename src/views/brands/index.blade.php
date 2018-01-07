@include('verkooCommon::layouts.crud_index', [
    'name' => 'Marcas',
    'button' => 'Nueva Marca',
    'route' => 'brands',
    'items' => $brands,
    'filter' => true,
])
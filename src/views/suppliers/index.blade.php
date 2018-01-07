@include('verkooCommon::layouts.crud_index', [
    'name' => 'Proveedores',
    'button' => 'Nuevo Proveedor',
    'route' => 'suppliers',
    'items' => $suppliers,
    'filter' => true,
])
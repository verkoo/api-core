@include('verkooCommon::layouts.crud_index', [
    'name' => 'Usuarios',
    'button' => 'Nuevo Usuario',
    'route' => 'users',
    'items' => $users,
])

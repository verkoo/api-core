@extends('verkooCommon::layouts.crud_index', [
    'name' => 'Clientes',
    'button' => 'Nuevo Cliente',
    'route' => 'customers',
    'items' => $customers,
    'appends' => 'customer',
    'filter' => true,
])

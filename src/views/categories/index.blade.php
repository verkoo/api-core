@extends('verkooCommon::layouts.crud_index', [
    'name' => 'Categorías',
    'button' => 'Nueva Categoría',
    'route' => 'categories',
    'items' => $categories,
    'filter' => true,
])

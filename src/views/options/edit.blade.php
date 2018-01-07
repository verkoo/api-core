@extends('verkooCommon::layouts.crud_edit', [
    'name' => 'Opciones',
    'route' => 'options',
    'item' => $options,
    'hideDeleteButton' => true,
    'hideBackButton' => true
])
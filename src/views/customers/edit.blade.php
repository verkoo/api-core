@extends('verkooCommon::layouts.crud_edit', [
    'name' => 'Cliente',
    'route' => 'customers',
    'item' => $customer
])
@section('extra_content')
    <customer-pending-amount
            :customer="{{ $customer->id }}"
            :pending-amount="{{ $customer->getPendingAmount() }}"
    ></customer-pending-amount>
    @include('verkooCommon::addresses.index')
@endsection


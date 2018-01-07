<?php

namespace Verkoo\Common\Http\Controllers;

use Verkoo\Common\Entities\Address;
use Verkoo\Common\Entities\Customer;
use Verkoo\Common\Http\Requests\AddressRequest;

class AddressesController extends Controller
{
    public function create(Customer $customer)
    {
        return view('verkooCommon::addresses.create', compact('customer'));
    }
    
    public function store(Customer $customer, AddressRequest $request)
    {
        $address = new Address($request->all());
        $customer->addresses()->save($address);

        return redirect("customers/{$customer->id}/edit");
    }

    public function edit(Customer $customer, Address $address)
    {
        return view('verkooCommon::addresses.edit', compact('customer', 'address'));
    }

    public function update(Customer $customer, Address $address, AddressRequest $request)
    {
        $address->update($request->all());
        return redirect("customers/{$customer->id}/edit");
    }

    public function destroy(Customer $customer, Address $address)
    {
        $address->delete();
        return redirect("customers/{$customer->id}/edit");
    }
}

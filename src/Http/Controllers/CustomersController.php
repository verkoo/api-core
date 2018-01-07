<?php

namespace Verkoo\Common\Http\Controllers;

use Verkoo\Common\Entities\Customer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function index()
    {
        $customers = Customer::searchByName()
            ->orderBy('name', 'ASC')
            ->paginate();

        return view('verkooCommon::customers.index', compact('customers'));
    }

    public function create()
    {
        return view('verkooCommon::customers.create');
    }

    public function store(Request $request)
    {
        $request['dni'] = substr($request['dni'], 0, 9);
        $this->validate($request,[
            'name' => 'required',
            'dni' => 'unique:customers,dni'
        ]);
        Customer::create($request->all());

        return redirect('customers')->withMessage('Cliente añadido con éxito');
    }

    public function edit (Customer $customer)
    {
        return view('verkooCommon::customers.edit', compact('customer'));
    }

    public function update (Customer $customer, Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'dni' => 'unique:customers,dni,' . $customer->id
        ]);

        $customer->update($request->all());

        return redirect('customers')->withMessage('Cliente actualizado con éxito');
    }

    public function destroy (Customer $customer)
    {
        try {
            $customer->delete();
        }
        catch ( QueryException $e) {
            return redirect("customers/{$customer->id}/edit")->withErrors([
                'error' => 'No es posible eliminar el regitro. Es posible que el cliente tenga algún documento asociado'
            ]);
        }

        return redirect('customers')->withMessage('Cliente eliminado con éxito');
    }
}

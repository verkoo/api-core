<?php

namespace Verkoo\Common\Http\Controllers;

use Verkoo\Common\Entities\Supplier;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::searchByName()->orderBy('name', 'ASC')->paginate();

        return view('verkooCommon::suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('verkooCommon::suppliers.create');
    }

    public function edit (Supplier $supplier)
    {
        return view('verkooCommon::suppliers.edit', compact('supplier'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'email',
        ]);

        Supplier::create($request->all());

        return redirect('suppliers')->withMessage('Proveedor añadido con éxito');
    }

    public function update (Supplier $supplier, Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'email',
        ]);

        $supplier->update($request->all());

        return redirect('suppliers')->withMessage('Proveedor actualizado con éxito');
    }

    public function destroy (Supplier $supplier)
    {
        $supplier->delete();

        return redirect('suppliers')->withMessage('Proveedor eliminado con éxito');
    }
}

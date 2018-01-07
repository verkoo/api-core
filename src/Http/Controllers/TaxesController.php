<?php

namespace Verkoo\Common\Http\Controllers;

use Verkoo\Common\Entities\Tax;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class TaxesController extends Controller
{
    public function index()
    {
        $taxes = Tax::orderBy('name', 'ASC')->paginate();
        return view('verkooCommon::taxes.index', compact('taxes'));
    }

    public function create()
    {
        return view('verkooCommon::taxes.create');
    }

    public function edit (Tax $tax)
    {
        return view('verkooCommon::taxes.edit', compact('tax'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'percentage' => 'required|numeric',
        ]);
        Tax::create($request->all());

        return redirect('taxes')->withMessage('Tipo de IVA añadido con éxito');
    }

    public function update (Tax $tax, Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'percentage' => 'required|numeric',
        ]);

        $tax->update($request->all());

        return redirect('taxes')->withMessage('Tipo de IVA actualizado con éxito');
    }

    public function destroy (Tax $tax)
    {
        try {
            $tax->delete();
        } catch ( QueryException $e) {
            return redirect("taxes/{$tax->id}/edit")->withErrors([
                'error' => 'No es posible eliminar el regitro. Es posible que esté en uso.'
            ]);
        }

        return redirect('taxes')->withMessage('Tipo de IVA eliminado con éxito');
    }
}

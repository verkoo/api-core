<?php

namespace Verkoo\Common\Http\Controllers;

use Verkoo\Common\Entities\Expediture;
use Verkoo\Common\Entities\ExpeditureType;
use Verkoo\Common\Http\Requests\ExpeditureRequest;

class ExpedituresController extends Controller
{
    public function index()
    {
        $expeditures = Expediture::searchByName()->orderBy('name', 'ASC')->paginate();
        return view('verkooCommon::expeditures.index', compact('expeditures'));
    }

    public function create()
    {
        $expediture_types = ExpeditureType::all()->pluck('name', 'id')->toArray();
        return view('verkooCommon::expeditures.create', compact('expediture_types'));
    }

    public function edit (Expediture $expediture)
    {
        $expediture_types = ExpeditureType::all()->pluck('name', 'id')->toArray();
        return view('verkooCommon::expeditures.edit', compact('expediture', 'expediture_types'));
    }

    public function store(ExpeditureRequest $request)
    {
        Expediture::create($request->all());

        return redirect('expeditures')->withMessage('Gasto añadido con éxito');
    }

    public function update (Expediture $expediture, ExpeditureRequest $request)
    {
        $expediture->update($request->all());

        return redirect('expeditures')->withMessage('Gasto actualizado con éxito');
    }

    public function destroy (Expediture $expediture)
    {
        $expediture->delete();

        return redirect('expeditures')->withMessage('Gasto eliminado con éxito');
    }
}

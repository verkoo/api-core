<?php

namespace Verkoo\Common\Http\Controllers;

use Verkoo\Common\Entities\ExpeditureType;
use Verkoo\Common\Http\Requests\ExpeditureTypeRequest;

class ExpeditureTypesController extends Controller
{
    public function index()
    {
        $expeditureTypes = ExpeditureType::searchByName()->orderBy('name', 'ASC')->paginate();
        return view('verkooCommon::expediture-types.index', compact('expeditureTypes'));
    }

    public function create()
    {
        $expeditureTypes = ExpeditureType::all()->pluck('name', 'id')->toArray();

        return view('verkooCommon::expediture-types.create', compact('expeditureTypes'));
    }

    public function edit (ExpeditureType $expeditureType)
    {
        $expeditureTypes = ExpeditureType::all()->pluck('name', 'id')->toArray();

        return view('verkooCommon::expediture-types.edit', compact('expeditureType', 'expeditureTypes'));
    }

    public function store(ExpeditureTypeRequest $request)
    {
        ExpeditureType::create($request->all());

        return redirect('expediture-types')->withMessage('Tipo de Gasto añadido con éxito');
    }

    public function update (ExpeditureType $expeditureType, ExpeditureTypeRequest $request)
    {
        $expeditureType->update($request->all());

        return redirect('expediture-types')->withMessage('Tipo de Gasto actualizado con éxito');
    }

    public function destroy (ExpeditureType $expeditureType)
    {
        $expeditureType->delete();

        return redirect('expediture-types')->withMessage('Tipo de Gasto eliminado con éxito');
    }
}

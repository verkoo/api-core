<?php

namespace Verkoo\Common\Http\Controllers;

use Verkoo\Common\Entities\UnitOfMeasure;
use Illuminate\Http\Request;

class UnitsOfMeasureController extends Controller
{
    public function index()
    {
        $unitsOfMeasure = UnitOfMeasure::searchByName()->orderBy('name', 'ASC')->paginate();
        return view('verkooCommon::units-of-measure.index', compact('unitsOfMeasure'));
    }

    public function create()
    {
        return view('verkooCommon::units-of-measure.create');
    }

    public function edit (UnitOfMeasure $units_of_measure)
    {
        return view('verkooCommon::units-of-measure.edit', compact('units_of_measure'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        UnitOfMeasure::create($request->all());

        return redirect('units-of-measure')->withMessage('Unidad de Medida añadida con éxito');
    }

    public function update (UnitOfMeasure $units_of_measure, Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);

        $units_of_measure->update($request->all());

        return redirect('units-of-measure')->withMessage('Unidad de Medida actualizada con éxito');
    }

    public function destroy (UnitOfMeasure $units_of_measure)
    {
        $units_of_measure->delete();

        return redirect('units-of-measure')->withMessage('Unidad de Medida eliminada con éxito');
    }
}

<?php

namespace Verkoo\Common\Http\Controllers;

use Verkoo\Common\Entities\Brand;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    public function index()
    {
        $brands = Brand::searchByName()->orderBy('name', 'ASC')->paginate();
        return view('verkooCommon::brands.index', compact('brands'));
    }

    public function create()
    {
        return view('verkooCommon::brands.create');
    }

    public function edit (Brand $brand)
    {
        return view('verkooCommon::brands.edit', compact('brand'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        Brand::create($request->all());

        return redirect('brands')->withMessage('Marca añadida con éxito');
    }

    public function update (Brand $brand, Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);

        $brand->update($request->all());

        return redirect('brands')->withMessage('Marca actualizada con éxito');
    }

    public function destroy (Brand $brand)
    {
        try {
            $brand->delete();
        } catch (QueryException $e) {
            return redirect("brands/{$brand->id}/edit")->withErrors([
                'error' => 'No es posible eliminar el regitro. Es posible que tenga productos asociados.'
            ]);
        }

        return redirect('brands')->withMessage('Marca eliminada con éxito');
    }
}

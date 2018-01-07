<?php

namespace Verkoo\Common\Http\Controllers;

use Verkoo\Common\Entities\Category;
use Verkoo\Common\Entities\Tax;
use Verkoo\Common\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::searchByName()
            ->orderBy('name', 'ASC')
            ->paginate();

        return view('verkooCommon::categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all()->pluck('name', 'id')->toArray();
        $taxes = Tax::all()->pluck('name', 'id')->toArray();
        $category = new Category();
        return view('verkooCommon::categories.create', compact('categories', 'category', 'taxes'));
    }

    public function edit (Category $category)
    {
        $categories = Category::where('id', '<>', $category->id)->pluck('name', 'id')->toArray();
        $taxes = Tax::all()->pluck('name', 'id')->toArray();

        return view('verkooCommon::categories.edit', compact('category', 'categories', 'taxes'));
    }

    public function store(CategoryRequest $request)
    {
        Category::create($request->all());

        return redirect('categories')->withMessage('Categoría añadida con éxito');
    }

    public function update (Category $category, CategoryRequest $request)
    {
        $category->fill($request->all());

        if ($request->has('delete_photo')) {
            File::delete(storage_path() . '/app/public/' . $category->photo);
            $category->photo = null;
        }

        $category->save();

        return redirect('categories')->withMessage('Categoría actualizada con éxito');
    }

    public function destroy (Category $category)
    {
        try {
            $category->delete();
        } catch ( QueryException $e) {
            return redirect("categories/{$category->id}/edit")->withErrors([
                'error' => 'No es posible eliminar el regitro. Es posible que tenga productos asociados.'
            ]);
        }

        return redirect('categories')->withMessage('Categoría eliminada con éxito');
    }
}

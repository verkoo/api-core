<?php

namespace Verkoo\Common\Http\Controllers\Api;

use Verkoo\Common\Entities\Category;
use Verkoo\Common\Entities\Settings;
use Illuminate\Support\Facades\Input;

class CategoriesController extends ApiController
{

    public function index()
    {
        $limit = Input::get('limit') ?: Settings::get('pagination');
        $categories = Category::whereNull('parent')->paginate($limit);

        return $this->respondWithPagination($categories, [
            'data' => $categories->all()
        ]);
    }

    public function show(Category $category)
    {
        $limit = Input::get('limit') ?: Settings::get('pagination');
        $categories = Category::whereParent($category->id)->paginate($limit);

        return $this->respondWithPagination($categories, [
            'data' => $categories->all()
        ]);
    }
}

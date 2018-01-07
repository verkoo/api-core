<?php

namespace Verkoo\Common\Http\Controllers\Api;

use Verkoo\Common\Entities\Supplier;

class SuppliersController extends ApiController
{
    public function index()
    {
        return Supplier::searchByName()->orderBy('name', 'ASC')->get();
    }
}

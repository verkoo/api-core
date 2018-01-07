<?php

namespace Verkoo\Common\Http\Controllers;

class StatisticsController extends Controller
{
    public function suppliers()
    {
        return view('verkooCommon::statistics.suppliers');
    }

    public function customers()
    {
        return view('verkooCommon::statistics.customers');
    }

    public function products()
    {
        return view('verkooCommon::statistics.products');
    }
}

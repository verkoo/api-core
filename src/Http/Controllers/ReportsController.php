<?php

namespace Verkoo\Common\Http\Controllers;

use Verkoo\Common\Entities\Customer;
use Verkoo\Common\Entities\Product;

class ReportsController extends Controller
{
    public function products()
    {
        $products =  Product::withRecountableCategory()->withStock()->where('priority', '>', 0)->orderBy('priority', 'ASC')->get();

        $pdf = \PDF::loadView('verkooCommon::pdf.products', compact('products'));
        return $pdf->inline('products_report.pdf');
    }
//    public function allergens()
//    {
//        $allergens = Allergen::all();
//        $products = Product::all();
//        $products->load('allergens');
//        $products = $products->chunk(20);
//
//        $pdf = \PDF::loadView('pdf.allergens', compact('allergens', 'products'));
//        return $pdf->setOrientation('landscape')->download('allergens.pdf');
//    }

    public function cashPending()
    {
        $this->validate(request(), [
            'amount' => 'required',
            'items' => 'required',
            'customer' => 'required',
            'pending' => 'required',
        ]);

        $customer =  Customer::findOrFail(request('customer'));
        $data = request(['amount', 'items', 'pending']);

        $pdf = \PDF::loadView('verkooCommon::pdf.cash-pending', compact('customer', 'data'));

        if (request()->ajax()) {
            $fileName = time() . '.pdf';

            $pdf->save(public_path("cash_recipes/{$fileName}"));

            return ["url" => $fileName];
        }

        return $pdf->inline('cash_pending_report.pdf');
    }
}

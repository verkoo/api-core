<?php

namespace Verkoo\Common\Http\Controllers;


use Carbon\Carbon;
use Verkoo\Common\Entities\Order;

class ReportOrdersController extends Controller
{
    public function index()
    {
        return view('verkooCommon::reports.index');
    }

    public function store()
    {
        $this->validate(request(), [
            'date_from' => 'required|date_format:"d/m/Y"',
            'date_to' => 'required|date_format:"d/m/Y"',
        ]);

        $orders =  Order::whereDate('date', '>=',  Carbon::createFromFormat('d/m/Y', request('date_from'))->toDateString())
            ->whereDate('date', '<=',  Carbon::createFromFormat('d/m/Y', request('date_to'))->toDateString())
            ->get();

        $pdf = \PDF::loadView('verkooCommon::pdf.orders', [
            'date_from' => request('date_from'),
            'date_to' => request('date_to'),
            'orders' => $orders,
        ]);
        return $pdf->download('orders_report.pdf');
    }
}

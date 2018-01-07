<?php

namespace Verkoo\Common\Http\Controllers;

use Verkoo\Common\Entities\Payment;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::orderBy('name', 'ASC')->paginate();
        return view('verkooCommon::payments.index', compact('payments'));
    }

    public function create()
    {
        return view('verkooCommon::payments.create');
    }

    public function edit (Payment $payment)
    {
        return view('verkooCommon::payments.edit', compact('payment'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);
        Payment::create($request->all());

        return redirect('payments')->withMessage('Forma de Pago añadida con éxito');
    }

    public function update (Payment $payment, Request $request)
    {
        $this->validate($request,[
            'name' => 'required'
        ]);

        $payment->update($request->all());

        return redirect('payments')->withMessage('Forma de Pago actualizada con éxito');
    }

    public function destroy (Payment $payment)
    {
        try {
            $payment->delete();
        } catch ( QueryException $e) {
            return redirect("payments/{$payment->id}/edit")->withErrors([
                'error' => 'No es posible eliminar el regitro. Es posible que esté siendo usado en algún pedido.'
            ]);
        }

        return redirect('payments')->withMessage('Forma de Pago eliminada con éxito');
    }
}

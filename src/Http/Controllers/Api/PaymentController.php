<?php

namespace Verkoo\Common\Http\Controllers\Api;

use Verkoo\Common\Entities\Payment;

class PaymentController extends ApiController
{
    public function index()
    {
        return Payment::all();
    }
}

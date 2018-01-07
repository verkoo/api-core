<?php

namespace Verkoo\Common\Http\Controllers\Api;

use Verkoo\Common\Entities\Customer;

class CustomerDeliveryNotesController extends ApiController
{
    public function index(Customer $customer)
    {
        $amount = request('amount') ?: 0;

        return $customer->getCashableDeliveryNotes($amount);
    }

    public function store(Customer $customer)
    {
        $amount = request('amount') ?: 0;

        $customer->cashDeliveryNotes($amount);

        return $this->respond(['success' => true]);

    }
}

<?php

namespace Verkoo\Common\Http\Controllers\Api;

use Verkoo\Common\Entities\Customer;

class CustomerController extends ApiController
{
    public function index()
    {
        $customers = Customer::searchByName()->orderBy('name', 'ASC')->get();

        return $customers->load('defaultDeliveryNote');
    }
}

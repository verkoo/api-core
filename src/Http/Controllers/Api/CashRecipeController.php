<?php

namespace Verkoo\Common\Http\Controllers\Api;

use Verkoo\Common\Factories\TicketFactory;
use Illuminate\Http\Request;

class CashRecipeController extends ApiController
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required',
            'items' => 'required',
            'customer' => 'required',
            'pending' => 'required',
        ]);

        app(TicketFactory::class)->createCashRecipeTicket($request)->printTicket();
    }
}

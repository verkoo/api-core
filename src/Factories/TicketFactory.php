<?php

namespace Verkoo\Common\Factories;

use Illuminate\Http\Request;
use Verkoo\Common\Tickets\CashRecipeTicket;
use Verkoo\Common\Tickets\CashTicket;
use Verkoo\Common\Tickets\KitchenTicket;
use Verkoo\Common\Tickets\OpenDrawerTicket;
use Verkoo\Common\Tickets\ProformaTicket;

class TicketFactory
{
    public function createProforma($event)
    {
        return new ProformaTicket($event);
    }

    public function createTicket($event)
    {
        return new CashTicket($event);
    }
    
    public function createKitchenTicket($lines, $table) 
    {
        return new KitchenTicket($lines, $table);
    }

    public function createOpenDrawerTicket()
    {
        return new OpenDrawerTicket();
    }

    public function createCashRecipeTicket(Request $request)
    {
        return new CashRecipeTicket($request);
    }
}
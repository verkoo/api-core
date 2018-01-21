<?php

namespace Verkoo\Common\Tickets;

use Verkoo\Common\Entities\Settings;

class OpenDrawerTicket extends Ticket
{
    protected function getText()
    {
        return $this->openDrawer();
    }

    protected function getPrinter()
    {
        return Settings::get('default_printer');
    }
}
<?php

namespace Verkoo\Common\Tickets;

use Verkoo\Common\Entities\Settings;

class OpenDrawerTicket extends Ticket
{
    protected function getText()
    {
        $text = $this->openDrawer();
        
        return $text;
    }

    protected function getPrinter()
    {
        return Settings::get('default_printer');
    }
}
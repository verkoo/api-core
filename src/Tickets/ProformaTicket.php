<?php

namespace Verkoo\Common\Tickets;

use Verkoo\Common\Entities\Settings;
use Verkoo\Common\Events\TicketButtonPressed;

class ProformaTicket extends Ticket
{
    protected $event;

    public function __construct(TicketButtonPressed $event)
    {
        $this->event = $event;
    }

    protected function getText()
    {
        $text = $this->header();

        if ($table = $this->event->order->table) {
            $text .= $this->normalFont()
                ->align('center')
                ->doubleHeight()
                ->newLine("MESA {$table->name}");
        }

        $text .= $this->newEmptyLine();

        $text .= $this->normalFont()
                ->align('center')
                ->newLine("Ticket n {$this->event->order->number} {$this->getDate()}");

        $text .= $this->newEmptyLine();

        $text.= $this->lines($this->event->order->lines, $this->event->order->menus);

        if (Settings::get('break_down_taxes_in_ticket')) {
            $text .= $this->taxes($this->event->order->taxes);
        }

        $text .= $this->footer();

        $text .= $this->cutPaper();

        return $text;
    }

    protected function getPrinter()
    {
        return Settings::get('default_printer');
    }
}
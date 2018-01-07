<?php

namespace Verkoo\Common\Tickets;

use Verkoo\Common\Entities\Settings;
use Verkoo\Common\Events\OrderCashed;

class CashTicket extends Ticket
{
    protected $event;

    public function __construct(OrderCashed $event)
    {
        $this->event = $event;
    }

    protected function getText()
    {
        $text = $this->header();

        $isCashCustomer = ($this->event->order->customer_id == Settings::get('cash_customer'));

        if ($table = $this->event->order->table) {
            $text .= $this->normalFont()
                ->align('center')
                ->doubleHeight()
                ->newLine("MESA {$table->name}");
        }
        $text .= $this->newEmptyLine();

        if($invoice = $this->event->order->getInvoice()) {
            $text .= $this->normalFont()
                ->align('center')
                ->newLine(sprintf(
                    "Factura. %s n %s-%s %s",
                    $isCashCustomer ? "Simp." : "",
                    $invoice->serie,
                    $invoice->number,
                    $this->getDate())
                );
        }

        if($deliveryNote = $this->event->order->getDeliveryNote()) {
            $text .= $this->normalFont()
                ->align('center')
                ->newLine("Nota de Entrega. n {$deliveryNote->serie}-{$deliveryNote->number} {$this->getDate()}");
            $text .= $this->newLine("ENTREGA:  {$deliveryNote->cashed_amount}");
        }

        $text .= $this->newEmptyLine();

        $text.= $this->lines($this->event->order->lines, $this->event->order->menus);

        if (Settings::get('break_down_taxes_in_ticket')) {
            $text .= $this->taxes($this->event->order->taxes);
        }

        $text .= $this->newEmptyLine();

        if ($diners = $this->event->diners) {
            $text .= $this->normalFont()
                ->align('center')
                ->newLine("Comensales:  {$diners}");
            $text .= $this->newLine(sprintf("%s EUR por comensal",
                number_format($this->event->order->total / $diners, 2, ',','.')));
        }

        $text .= $this->footer();

        if (!$isCashCustomer) {
            $text .= $this->getCustomerData($text);
        }

        $text .= $this->cutPaper();

        return $text;
    }

    protected function getPrinter()
    {
        return Settings::get('default_printer');
    }

    protected function getCustomerData()
    {
        $text = $this->newEmptyLine();
        $text .= $this->align('center')->newLine($this->event->order->customer->name);
        $text .= $this->align('center')->newLine($this->event->order->customer->default_address->address);
        $text .= $this->align('center')->newLine($this->event->order->customer->default_address->postcode
                . ' - ' . $this->event->order->customer->default_address->city . ' (' .
                $this->event->order->customer->default_address->province_name) . ')';
        $text .= $this->align('center')->newLine($this->event->order->customer->dni);
        $text .= $this->newEmptyLine();

        return $text;
    }
}
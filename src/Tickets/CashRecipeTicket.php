<?php

namespace Verkoo\Common\Tickets;

use Illuminate\Http\Request;
use Verkoo\Common\Entities\Customer;
use Verkoo\Common\Entities\Settings;

class CashRecipeTicket extends Ticket
{
    protected $items;
    protected $customer;
    protected $amount;
    protected $pending;

    public function __construct(Request $request)
    {
        $this->items = $request->items;
        $this->customer = Customer::findOrFail($request->customer);
        $this->amount = $request->amount;
        $this->pending = $request->pending;
    }

    protected function getText()
    {
        $text = $this->header();

        $text .= $this->getCustomerData($text);

        $text .= $this->newLine("ENTREGA A CUENTA: {$this->amount} €");
        $text .= $this->newEmptyLine();


        if (count($this->items['full'])) {
            $text .= $this->newLine("PAGO COMPLETADO DE:");
            foreach ($this->items['full'] as $item) {
                $text .= $this->newLine("{$item["date"]} - {$item["number"]}");
            }
            $text .= $this->newEmptyLine();
        }

        if (count($this->items['partial'])) {
            $text .= $this->newLine("PAGO PARCIAL DE:");
            foreach ($this->items['partial'] as $item) {
                $text .= $this->newLine("{$item["date"]} - {$item["number"]}");
            }
            $text .= $this->newEmptyLine();
        }

        $text .= $this->newLine("IMPORTE PENDIENTE DE PAGO: {$this->pending} €");

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
        $text .= $this->align('center')->newLine($this->customer->name);
        $text .= $this->align('center')->newLine($this->customer->default_address->address);
        $text .= $this->align('center')->newLine($this->customer->default_address->postcode
                . ' - ' . $this->customer->default_address->city . ' (' .
                $this->customer->default_address->province_name) . ')';
        $text .= $this->align('center')->newLine($this->customer->dni);
        $text .= $this->newEmptyLine();

        return $text;
    }
}
<?php

namespace Verkoo\Common\Traits;


use Verkoo\Common\Entities\DeliveryNote;
use Verkoo\Common\Entities\Order;

trait Copiable
{
    public function copyLinesFromDeliveryNotes(array $deliveryNoteIds)
    {
        foreach ($deliveryNoteIds as $id) {
            $this->storeNewLinesFrom(DeliveryNote::findOrFail($id));
        }
    }

    public function copyLinesFromOrder(Order $order)
    {
        foreach ($order->lines as $line) {
            $newLine = $line->replicate();
            $newLine->order_number = $order->id;
            $this->lines()->save($newLine);
            $line->customer_invoice_number = $this->id;
            $line->save();
        }
    }

    protected function storeNewLinesFrom(DeliveryNote $deliveryNote)
    {
        $deliveryNote->cash($deliveryNote->getPendingAmount());

        foreach ($deliveryNote->lines as $line) {
            $newLine = $line->replicate();
            $newLine->customer_delivery_note_number = "{$deliveryNote->serie}-{$deliveryNote->number}";
            $this->lines()->save($newLine);
            $line->customer_invoice_number = "{$this->serie}-{$this->number}";
            $line->save();
        }
    }
}
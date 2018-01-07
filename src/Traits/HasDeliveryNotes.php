<?php

namespace Verkoo\Common\Traits;


trait HasDeliveryNotes
{
    public function getPendingDeliveryNotesAttribute()
    {
        return $this->deliveryNotes->filter(function($deliveryNote) {
            return $deliveryNote->hasPendingAmount();
        })->sortBy('date');
    }

    public function getPendingAmount()
    {
        return $this->pendingDeliveryNotes->sum(function ($filteredDeliveryNote) {
            return $filteredDeliveryNote->getPendingAmount();
        });
    }

    public function getCashableDeliveryNotes($amount)
    {
        $full = [];
        $partial = [];
        $pending = [];

        foreach($this->pendingDeliveryNotes as $deliveryNote) {
            $pendingAmount = $deliveryNote->getPendingAmount();
            $info = [
                'id'  => $deliveryNote->id,
                'number'  => $deliveryNote->number,
                'date'    => $deliveryNote->date,
                'pending' => $pendingAmount
            ];

            if ($pendingAmount <= $amount) {
                array_push($full, $info);
            } else if ($amount > 0) {
                array_push($partial, $info);
            } else {
                array_push($pending, $info);
            }
            $amount = $amount - $pendingAmount;
        }

        return compact('full', 'partial', 'pending');
    }

    public function cashDeliveryNotes($amount)
    {
        $this->pendingDeliveryNotes->each(function ($deliveryNote) use (&$amount) {
            if ($amount > 0) {
                $pending = $deliveryNote->getPendingAmount();
                $deliveryNote->cash($amount);
                $amount = $amount - $pending;
            }
        });
    }
}
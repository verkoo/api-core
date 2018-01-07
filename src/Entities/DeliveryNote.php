<?php

namespace Verkoo\Common\Entities;

use Verkoo\Common\Traits\Copiable;
use Verkoo\Common\Traits\Dateable;
use Verkoo\Common\Traits\Documentable;
use Verkoo\Common\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class DeliveryNote extends Model
{
    use Dateable, Documentable, Searchable, Copiable;

    protected $fillable = ['date', 'customer_id', 'serie', 'cashed_amount', 'discount'];

    protected $appends = ['customer_name', 'total', 'invoiceNumber'];

    public static function boot()
    {
        parent::boot();

        static::updating(function ($deliveryNote) {
            if ($deliveryNote->hasBeenBilled()) {
                throw new \Exception('No puede editar un albarán que ha sido pasado a factura');
            }
        });

        static::deleting(function ($deliveryNote) {
            if ($deliveryNote->hasBeenBilled()) {
                throw new \Exception('No puede eliminar un albarán que ha sido pasado a factura');
            }
        });
    }

    public function getInvoiceNumberAttribute()
    {
        if (!$line = $this->lines->first()) return null;

        return $line->customer_invoice_number;
    }

    public function hasBeenBilled()
    {
        return !! $this->fresh()->invoiceNumber;
    }

//    public function hasPendingAmount()
//    {
//        return $this->getOriginal('cashed_amount') < $this->totalInCents;
//    }

    public function getPendingAmount()
    {
        return ($this->totalInCents - $this->getOriginal('cashed_amount')) / 100;
    }

    public function cash($amount)
    {
        $amount = $amount > $this->getPendingAmount() ? $this->getPendingAmount() : $amount;
        $this->cashed_amount = $this->cashed_amount + $amount;
        $this->save();
    }
}

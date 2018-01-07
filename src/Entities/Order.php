<?php

namespace Verkoo\Common\Entities;

use Verkoo\Common\Traits\Dateable;
use Verkoo\Common\Traits\Documentable;
use Verkoo\Common\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use Dateable, Documentable, Searchable;
    
    protected $fillable = ['date', 'customer_id', 'user_id', 'table_id', 'payment_id', 'session_id', 'serie', 'cashed_amount', 'discount'];
    protected $appends = ['total', 'total_cashed', 'customer_name'];
    protected $with = ['lines'];

    public function getTaxesAttribute()
    {
        $taxes = $this->lines->groupBy('vat')->map(function ($item) {
            $totalVat = $item->sum(function ($line) {
                $taxRate = $line->vat / 100;
                $price = $line->getOriginal('price') / 100;
                $quantity = $line->quantity ?: 1;
                $tax = ($price * $quantity) / (1 + $taxRate) * $taxRate;
                return round($tax,2);
            });

            $totalBase = $item->sum(function ($line) {
                $taxRate = $line->vat / 100;
                $quantity = $line->quantity ?: 1;
                $price = $line->getOriginal('price') / 100;
                $total = ($price * $quantity) / (1 + $taxRate);
                return round($total,2);
            });

            return [
                'base' => number_format($totalBase, 2, ',','.'),
                'vat' => number_format($totalVat, 2, ',','.'),
            ];
        });

        return $taxes->all();
    }

    public function scopeNotCashed($query)
    {
        return $query->whereNull('payment_id');
    }

    public function markAsCashed($payment, $amount)
    {
        $this->payment_id = $payment;
        $this->cashed_amount = $amount;
        $this->save();
    }

    public function getTotalAttribute()
    {
        return $this->getTotal();
    }

    public function getTotalDtoAttribute()
    {
        $dto = env('DTO_REPORTS', 0);
        $dto = (100 - $dto) / 100;

        return number_format($this->getTotal() * $dto,2);
    }

    public function getTotalCashedAttribute()
    {
        if (! $this->payment_id) {
            return 0;
        }

        if ($this->payment_id !== Settings::get('payment_id')) {
            return 0;
        }

        return $this->getTotal();
    }

    protected function getTotal()
    {
        $total = 0;

        foreach ($this->lines as $line) {
            $total += $line->quantity * (float) str_replace(',','.',$line->price);
        }

        return $total - $this->discount;
    }

    public function getInvoice()
    {
        $line = Line::where('lineable_type', Invoice::class)->where('order_number', $this->id)->first();

        if (!$line) return false;

        return $line->lineable;
    }

    public function getDeliveryNote()
    {
        $line = Line::where('lineable_type', DeliveryNote::class)->where('order_number', $this->id)->first();

        if (!$line) return false;

        return $line->lineable;
    }
}

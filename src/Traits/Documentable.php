<?php

namespace Verkoo\Common\Traits;

use Verkoo\Common\Entities\Customer;
use Verkoo\Common\Entities\Line;
use Verkoo\Common\Entities\Supplier;

trait Documentable
{
    public static function bootDocumentable()
    {
        static::created(function ($document) {
            $table = $document->getTable();

            if ($table == 'default_delivery_notes') return;

            $document->number = getNextNumber($table, $document->serie);
            $document->save();
        });

        static::deleted(function ($document) {
            foreach ($document->lines as $line) {
                $line->delete();
            }
        });
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function lines()
    {
        return $this->morphMany(Line::class, 'lineable');
    }

    public function getCustomerNameAttribute()
    {
        return $this->customer->name;
    }

    public function getSupplierNameAttribute()
    {
        return $this->supplier->name;
    }

    public function getTotalAttribute()
    {
        return number_format($this->totalInCents / 100, 2, ',', '.');
    }

    public function getSubtotalAttribute()
    {
        return number_format($this->subtotalInCents / 100, 2, ',', '.');
    }

    public function getTotalInCentsAttribute()
    {
        return $this->subtotalInCents - $this->getOriginal('discount');
    }

    public function getSubtotalInCentsAttribute()
    {
        return $this->lines->sum(function ($line) {
            $price = $line->getOriginal('price');
            $quantity = $line->quantity ?: 0;
            return ($price * $quantity);
        });
    }

    public function setCashedAmountAttribute($cashed_amount)
    {
        $this->attributes['cashed_amount'] = toCents($cashed_amount);
    }

    public function getCashedAmountAttribute($value)
    {
        return $value / 100;
    }

    public function hasPendingAmount()
    {
        return $this->getOriginal('cashed_amount') < $this->totalInCents;
    }

    public function getDiscountAttribute($discount)
    {
        return (float) number_format($discount / 100,2,'.','');
    }

    public function setDiscountAttribute($discount)
    {
        $this->attributes['discount'] = toCents($discount);
    }

    public function getAllergenIconsAttribute()
    {
        return $this->lines->map(function($line) {
            return $line->allergens;
        })->flatten()->pluck('icon')->values()->unique();
    }
}
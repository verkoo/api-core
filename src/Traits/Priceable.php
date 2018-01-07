<?php

namespace Verkoo\Common\Traits;


trait Priceable
{
    public function getPriceAttribute()
    {
        return number_format($this->attributes['price'] / 100,2,',','');
    }

    public function setPriceAttribute($price)
    {
        $this->attributes['price'] = toCents($price);
    }
}
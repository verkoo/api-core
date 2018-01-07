<?php

namespace Verkoo\Common\Entities;

use Verkoo\Common\Traits\Dateable;
use Verkoo\Common\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Expediture extends Model
{
    use Searchable, Dateable;

    protected $guarded = [];

    public function getAmountAttribute()
    {
        return number_format($this->attributes['amount'] / 100,2,',','');
    }

    public function setAmountAttribute($amount)
    {
        $this->attributes['amount'] = toCents($amount);
    }
}

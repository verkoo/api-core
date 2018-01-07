<?php

namespace Verkoo\Common\Traits;


use Carbon\Carbon;

trait Dateable
{
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->format('d/m/Y');
    }

    public function setDateAttribute($date)
    {
        $date = Carbon::createFromFormat('d/m/Y', getDateWithFourDigitsYear($date));
        $this->attributes['date'] = $date->toDateString();
    }
}
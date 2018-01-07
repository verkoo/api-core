<?php

namespace Verkoo\Common\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $fillable = ['initial_cash', 'final_cash', 'box_id'];

    public function box() 
    {
        return $this->belongsTo(Box::class);
    }
    
    public function orders() 
    {
        return $this->hasMany(Order::class);
    }

    public function scopeActive($query)
    {
        return $query->where('open', 1);
    }

    public function getInitialCashAttribute()
    {
        return (float) number_format($this->attributes['initial_cash'] / 100,2,'.','');
    }

    public function setInitialCashAttribute($price)
    {
        $result =  (int) (toFloat($price) * 100);
        $this->attributes['initial_cash'] = $result;
    }

    public function getFinalCashAttribute()
    {
        return (float) number_format($this->attributes['final_cash'] / 100,2,'.','');
    }

    public function setFinalCashAttribute($price)
    {
        $result =  (int) (toFloat($price) * 100);
        $this->attributes['final_cash'] = $result;
    }

    public function getCreatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y H:i:s');
    }

    public function getUpdatedAtAttribute($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d-m-Y H:i:s');
    }
}

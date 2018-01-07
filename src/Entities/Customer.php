<?php

namespace Verkoo\Common\Entities;

use Verkoo\Common\Traits\HasDeliveryNotes;
use Verkoo\Common\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasDeliveryNotes, Searchable;

    protected $fillable = ['name', 'dni', 'phone', 'phone2', 'email', 'comments', 'contact_person'];

    public function setDniAttribute($value){
        if (empty($value)) {
            $this->attributes['dni'] = null;
        }
        else {
            $this->attributes['dni'] = $value;
        }
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function deliveryNotes()
    {
        return $this->hasMany(DeliveryNote::class);
    }

    public function defaultDeliveryNote()
    {
        return $this->hasOne(DefaultDeliveryNote::class);
    }
    
    public function quotes() 
    {
        return $this->hasMany(Quote::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function getDefaultAddressAttribute()
    {
       $address = $this->addresses->where('default', 1)->first();

       if (!$address) return new Address;

       return $address;
    }

    public function getFullAddressAttribute()
    {
        $address = $this->defaultAddress;
        return sprintf('%s, %s - %s (%s)', $address->address, $address->postcode, $address->city, $address->provinceName);
    }
}

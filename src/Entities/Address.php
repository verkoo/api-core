<?php

namespace Verkoo\Common\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Address extends Model
{
    protected $fillable = ['city', 'postcode', 'address', 'province', 'default'];

    public static function boot()
    {
        parent::boot();
        static::creating(function (Address $address) {
            $address->checkForResetDefaults();
        });
        static::updating(function (Address $address) {
            $address->checkForResetDefaults();
        });
    }

    public function getProvinceNameAttribute()
    {
        if (!$this->province) return '';

        $provinces = config('options.provinces');
        return $provinces[$this->province];
    }
    
    public function delete()
    {
        parent::delete();

        $newDefault = false;
        if ($this->default) {
            $newDefault = $this->setNewDefault();
        }

        return $newDefault;
    }

    public function resetDefaultAddresses()
    {
        DB::table('addresses')->where('customer_id', $this->customer_id)->update(['default' => false]);
    }

    private function setNewDefault()
    {
        $address = $this->customer->addresses->first();
        if($address){
            $address->default = true;
            $address->save();
        }
        return ($address ? $address->id : null);
    }

    public function customer ()
    {
        return $this->belongsTo(Customer::class);
    }

    public function checkForResetDefaults()
    {
        if ($this->default){
            $this->resetDefaultAddresses();
        }
        else {
            if ($this->customer->addresses->count()){
                $this->default = false;
            }
            else {
                $this->default = true;
            }
        }
    }
}

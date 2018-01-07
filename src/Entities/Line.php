<?php

namespace Verkoo\Common\Entities;

use Verkoo\Common\Traits\Priceable;
use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    use Priceable;
    
    protected $fillable = [
        'product_id',
        'product_name',
        'quantity',
        'price',
        'discount',
        'kitchen_id',
        'ordered',
        'vat',
        'parent',
    ];

    protected $appends = ['remaining', 'total', 'hasChildren'];

    protected $casts = [
        'quantity' => 'float',
        'ordered' => 'int',
    ];

    public static function boot()
    {
        parent::boot();
        static::saving(function ($line) {
            if($line->product && !$line->comesFromAnotherLine()) {
                $line->product->updateStock(
                    $line->getOriginal('quantity'),
                    ($line->quantity * ($line->isInverse() ? -1 : 1))
                );
            }
        });

        static::deleted(function ($line) {
            if($line->product) {
                $line->product->increaseStock($line->quantity * ($line->isInverse() ? -1 : 1));
            }
            $line->children->each->delete();
        });
    }

    public function lineable()
    {
        return $this->morphTo();
    }

    public function children()
    {
        return $this->hasMany(Line::class, 'parent', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getAllergensAttribute()
    {
        if (!$this->product) return collect();

        return $this->product->allergens;
    }

    public function getHasChildrenAttribute()
    {
        return $this->children->isNotEmpty();
    }

    public static function deleteIfZeroQuantity()
    {
        (new static)::whereQuantity(0)->delete();
    }

    public function getDiscountAttribute()
    {
        return number_format($this->attributes['discount'] / 100,2,',','');
    }

    public function setQuantityAttribute($quantity)
    {
        $this->attributes['quantity'] = str_replace(',','.', $quantity);
    }

    public function setDiscountAttribute($price)
    {
        $this->attributes['discount'] = toFloat($price) * 100;
    }

    public function getRemainingAttribute() {
        return $this->quantity - $this->ordered;
    }
    
    public function getTotalAttribute()
    {
        return number_format(($this->quantity * $this->attributes["price"]) / 100,2,',','');
    }

    public function comesFromAnotherLine()
    {
        return !! $this->customer_delivery_note_number || $this->order_number;
    }

    public function isInverse()
    {
        return ($this->lineable_type === ExpeditureDeliveryNote::class);
    }
}

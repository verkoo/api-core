<?php

namespace Verkoo\Common\Entities;

use Baum\Node;
use Verkoo\Common\Traits\Searchable;

class Category extends Node
{
    use Searchable;

    protected $parentColumn = 'parent';

    protected $casts = [
        'active' => 'bool'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $appends = [
        'products_count'
    ];

    protected $fillable = ['name', 'parent', 'photo', 'recount_stock', 'tax_id'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function tax() {
        return $this->belongsTo(Tax::class);
    }
    
    public function setParentAttribute($value)
    {
        if (!$value) {
            $this->attributes['parent'] = null;
        } else {
            $this->attributes['parent'] = $value;
        }
    }

    public function getProductsCountAttribute()
    {
        return Product::active()
            ->withStock()
            ->categoryOrChildren($this)
            ->get()
            ->count();
    }
}

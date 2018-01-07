<?php

namespace Verkoo\Common\Entities;

use Verkoo\Common\Traits\Priceable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Priceable;

    protected $appends = ['vat', 'quantity', 'product_id', 'product_name'];

    protected $hidden = ['category', 'cost', 'created_at', 'initial_stock', 'priority', 'updated_at'];

    protected $casts = [
      'stock_control' => 'bool',
      'active' => 'bool',
    ];

    protected $fillable = [
        'name',
        'active',
        'category_id',
        'supplier_id',
        'brand_id',
        'unit_of_measure_id',
        'kitchen_id',
        'price',
        'cost',
        'short_description',
        'description',
        'ean13',
        'photo',
        'initial_stock',
        'stock',
        'stock_control',
        'priority',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class)->withPivot('price');
    }

    public function getCostAttribute()
    {
        return number_format($this->attributes['cost'] / 100,2,',','');
    }

    public function setCostAttribute($cost)
    {
        $this->attributes['cost'] = toCents($cost);
    }

    public function getVatAttribute()
    {
        if ($this->category->tax) {
            return $this->category->tax->percentage;
        }

        $options = Options::first();

        if ($options &&  $tax = $options->tax) {
            return $tax->percentage;
        }
    }

    public static function generateBarcode($provider = '00', $category = '00') {
        $pool = '0123456789';
        $randomNumber = substr(str_shuffle(str_repeat($pool, 9)), 0, 9);
        $provider = str_pad($provider, 2, "0", STR_PAD_LEFT);
        $category = str_pad($category, 2, "0", STR_PAD_LEFT);

        return $provider . $category . $randomNumber;
    }

    public static function orderByCategory($categoryId)
    {
        $result = (new static)::join('categories','products.category_id','=','categories.id')
            ->select('products.id', 'products.name', 'categories.name as category');

        if ($categoryId) {
            $result = $result->where('categories.id', $categoryId);
        }

        $result->orderBy('categories.name', 'asc')
        ->orderBy('products.name', 'asc');

        return $result;
    }

    public function reduceStock($quantity)
    {
        $this->stock = $this->stock - $quantity;
        $this->save();
    }

    public function increaseStock($quantity)
    {
        $this->stock = $this->stock + $quantity;
        $this->save();
    }

    public function updateStock($oldQuantity, $newQuantity)
    {
        $value = $oldQuantity - $newQuantity;

        if ($value > 0) {
            $this->increaseStock(abs($value));
        }
        else {
            $this->reduceStock(abs($value));
        }

        $this->save();
    }

    public static function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public static function scopeWithStock($query)
    {
        if (! Settings::get('hide_out_of_stock')) {
            return $query;
        }

        return $query->where('stock', '>', 0);
    }

    public static function scopeWithRecountableCategory($query)
    {
        return $query->whereHas('category', function ($query) {
            $query->where('recount_stock', 1);
        });
    }

    public static function scopeCategoryOrChildren($query, $parent)
    {
        return $query->whereHas('category', function($query) use ($parent) {
            $query->where('lft', '>=', $parent->lft)
                  ->where('lft', '<=', $parent->rgt);
        });
    }

    public function setBrandIdAttribute($value)
    {
        if (!$value) {
            $this->attributes['brand_id'] = null;
        } else {
            $this->attributes['brand_id'] = $value;
        }
    }

    public function setSupplierIdAttribute($value)
    {
        if (!$value) {
            $this->attributes['supplier_id'] = null;
        } else {
            $this->attributes['supplier_id'] = $value;
        }
    }

    public function getPriceFor($customer)
    {
        $customer = Customer::find($customer);

        if (!$customer) return $this->price;

        $product = $customer->products->where('id', $this->id)->first();

        if ($product) {
            return number_format($product->pivot->price / 100,2,',','');
        }

        return $this->price;
    }
}

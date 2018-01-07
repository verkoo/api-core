<?php

namespace Verkoo\Common\Traits;

trait Searchable
{
    public function scopeSearchByName($query)
    {
        $search = request('search');

        return $query->when($search, function ($query) use ($search) {
            return $query->where('name', 'LIKE', "%$search%");
        });
    }

    public function scopeSearchByCustomer($query)
    {
        $search = request('customer_id');

        return $query->when($search, function ($query) use ($search) {
            return $query->where('customer_id', $search);
        });
    }

    public function scopeSearchBySupplier($query)
    {
        $search = request('supplier_id');

        return $query->when($search, function ($query) use ($search) {
            return $query->where('supplier_id', $search);
        });
    }

    public function scopeSearchBySerie($query)
    {
        $search = request('serie');

        return $query->when($search, function ($query) use ($search) {
            return $query->where('serie', $search);
        });
    }

    public function scopeSearchBetweenDates($query, $dateField = 'date')
    {
        return $query->when(request('date_from'), function ($query) use ($dateField) {
            return $query->whereDate($dateField, '>=', request('date_from'));
        })->when(request('date_to'), function ($query) use ($dateField){
            return $query->whereDate($dateField, '<=', request('date_to'));
        });
    }
}
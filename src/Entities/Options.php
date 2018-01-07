<?php

namespace Verkoo\Common\Entities;

use Illuminate\Database\Eloquent\Model;

class Options extends Model
{
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'company_name',
        'address',
        'cif',
        'cp',
        'city',
        'phone',
        'web',
        'default_printer',
        'open_drawer_when_cash',
        'print_ticket_when_cash',
        'hide_out_of_stock',
        'show_stock_in_photo',
        'recount_stock_when_open_cash',
        'break_down_taxes_in_ticket',
        'cash_pending_ticket',
        'default_tpv_serie',
        'pagination',
        'module',
        'manage_kitchens',
        'tax_id',
        'cash_customer',
        'payment_id'
    ];

    public function tax() {
        return $this->belongsTo(Tax::class);
    }

    public static function getKeys()
    {
        return (new static)->fillable;
    }
}

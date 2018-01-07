<?php

namespace Verkoo\Common\Entities;

use Verkoo\Common\Traits\Dateable;
use Verkoo\Common\Traits\Documentable;
use Verkoo\Common\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use Dateable, Documentable, Searchable;

    protected $fillable = ['date', 'customer_id', 'cashed_amount', 'discount'];
    protected $appends = ['customer_name', 'total'];
}

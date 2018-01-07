<?php

namespace Verkoo\Common\Entities;

use Verkoo\Common\Traits\Documentable;
use Verkoo\Common\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class DefaultDeliveryNote extends Model
{
    use Searchable, Documentable;

    protected $fillable = ['customer_id'];

    protected $appends = ['customer_name', 'total'];
}

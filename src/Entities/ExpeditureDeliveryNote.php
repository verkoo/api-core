<?php

namespace Verkoo\Common\Entities;

use Verkoo\Common\Traits\Dateable;
use Verkoo\Common\Traits\Documentable;
use Verkoo\Common\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class ExpeditureDeliveryNote extends Model
{
    use Searchable, Dateable, Documentable;

    protected $fillable = ['date', 'supplier_id', 'reference'];

    protected $appends = ['supplier_name', 'total'];
}

<?php

namespace Verkoo\Common\Entities;

use Verkoo\Common\Traits\Copiable;
use Verkoo\Common\Traits\Dateable;
use Verkoo\Common\Traits\Documentable;
use Verkoo\Common\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use Dateable, Documentable, Searchable, Copiable;
    
    protected $fillable = ['date', 'customer_id', 'serie', 'cashed_amount', 'discount'];
    protected $appends = ['customer_name', 'total'];
}

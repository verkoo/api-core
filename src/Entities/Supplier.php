<?php

namespace Verkoo\Common\Entities;

use Verkoo\Common\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use Searchable;

    protected $guarded = [];
}

<?php

namespace Verkoo\Common\Entities;

use Verkoo\Common\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class ExpeditureType extends Model
{
    use Searchable;

    protected $guarded = [];
}

<?php

namespace Verkoo\Common\Entities;

use Illuminate\Database\Eloquent\Model;
use Verkoo\Common\Traits\Searchable;

class Contact extends Model
{
    use Searchable;

    protected $guarded = [];
}

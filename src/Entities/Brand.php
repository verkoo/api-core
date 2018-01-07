<?php

namespace Verkoo\Common\Entities;

use Verkoo\Common\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use Searchable;

    protected $fillable = ['name'];
}

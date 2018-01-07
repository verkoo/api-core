<?php

namespace Verkoo\Common\Entities;

use Verkoo\Common\Traits\Searchable;
use Illuminate\Database\Eloquent\Model;

class UnitOfMeasure extends Model
{
    use Searchable;

    protected $table = 'units_of_measure';
    protected $fillable = ['name'];
}

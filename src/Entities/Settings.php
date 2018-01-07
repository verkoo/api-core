<?php

namespace Verkoo\Common\Entities;

use Illuminate\Support\Facades\Cache;

class Settings
{
    public static function get($key)
    {
        return Cache::remember($key, 1440 , function() use ($key) {
            $options = Options::first();
            return $options ? Options::first()->$key : null;
        });
    }
}
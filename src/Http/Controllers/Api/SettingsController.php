<?php

namespace Verkoo\Common\Http\Controllers\Api;

use Verkoo\Common\Entities\Options;
use Illuminate\Support\Facades\Cache;

class SettingsController extends ApiController
{
    public function index()
    {
        return Options::first();
    }

    public function update() {
        $options = Options::first();

        $options->update(request()->all());

        $this->clearCache();

        return $this->respond(['ok' => true]);
    }

    protected function clearCache()
    {
        foreach (Options::getKeys() as $key) {
            Cache::forget($key);
        }
    }
}

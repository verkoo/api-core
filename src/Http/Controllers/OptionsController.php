<?php

namespace Verkoo\Common\Http\Controllers;

use Verkoo\Common\Entities\Options;
use Verkoo\Common\Entities\Payment;
use Verkoo\Common\Entities\Tax;
use Verkoo\Common\Http\Requests\OptionRequest;
use Illuminate\Support\Facades\Cache;

class OptionsController extends Controller
{

    public function index()
    {
        $options = Options::first();

        $payments = Payment::all()->pluck('name', 'id');
        $taxes = Tax::all()->pluck('name', 'id');

        return view('verkooCommon::options.edit', compact('options', 'payments', 'taxes'));
    }
    
    public function update(Options $option, OptionRequest $request)
    {
        $this->authorize('update_settings');

        $option->update($request->all());

        $this->clearCache();
        
        return back()->withMessage("Los cambios se han realizado con éxito");
    }
    
    protected function clearCache() {
        
        foreach (Options::getKeys() as $key) {
            Cache::forget($key);
        }
    }
}

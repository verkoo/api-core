<?php

namespace Verkoo\Common\Http\Requests;

use App\Http\Requests\Request;

class AddressRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'city' => 'required',
                'postcode' => 'required',
                'province' => 'required',
                'address' => 'required'
        ];
    }

    public function all()
    {
        $attributes = parent::all();

        if ( ! $this->has('default')) {
            $attributes["default"] = 0;
        }

        return $attributes;
    }
}

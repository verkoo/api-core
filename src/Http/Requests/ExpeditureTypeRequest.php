<?php

namespace Verkoo\Common\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ExpeditureTypeRequest extends FormRequest
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
            'name' => 'required',
            'parent' => 'nullable|exists:expediture_types,id',
        ];
    }

    public function all()
    {
        $attributes = parent::all();

        if ( ! $this->has('parent')) {
            $attributes["parent"] = null;
        }

        return $attributes;
    }
}

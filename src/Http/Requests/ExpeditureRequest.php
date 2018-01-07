<?php

namespace Verkoo\Common\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ExpeditureRequest extends FormRequest
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
            'expediture_type_id' => 'nullable|exists:expediture_types,id',
            'date' => 'required|date_format:d/m/Y',
        ];
    }

    public function all()
    {
        $attributes = parent::all();

        if ( ! $this->has('recurring')) {
            $attributes["recurring"] = 0;
        }

        if ( ! $this->has('expediture_type_id')) {
            $attributes["expediture_type_id"] = null;
        }

        return $attributes;
    }
}

<?php

namespace Verkoo\Common\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'name' => 'required'
        ];
    }

    public function all()
    {
        $attributes = parent::all();

        if ($this->hasFile('photo')) {
            $attributes["photo"] = $this->file('photo')->store('img', 'public');
        }

        if (! $this->has('recount_stock')) {
            $attributes["recount_stock"] = 0;
        }

        if (! $this->has('parent')) {
            $attributes["parent"] = null;
        }

        if (! $this->has('tax_id')) {
            $attributes["tax_id"] = null;
        }

        return $attributes;
    }
}

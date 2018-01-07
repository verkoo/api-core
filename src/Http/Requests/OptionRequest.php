<?php

namespace Verkoo\Common\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OptionRequest extends FormRequest
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
            'payment_id' => 'required',
            'pagination' => 'numeric',
            'tax_id' => 'required',
        ];
    }

    public function all()
    {
        $attributes = parent::all();

        if ( ! $this->has('print_ticket_when_cash')) {
            $attributes["print_ticket_when_cash"] = 0;
        }
        if ( ! $this->has('cash_pending_ticket')) {
            $attributes["cash_pending_ticket"] = 0;
        }

        if ( ! $this->has('open_drawer_when_cash')) {
            $attributes["open_drawer_when_cash"] = 0;
        }

        if ( ! $this->has('hide_out_of_stock')) {
            $attributes["hide_out_of_stock"] = 0;
        }

        if ( ! $this->has('show_stock_in_photo')) {
            $attributes["show_stock_in_photo"] = 0;
        }

        if ( ! $this->has('recount_stock_when_open_cash')) {
            $attributes["recount_stock_when_open_cash"] = 0;
        }

        if ( ! $this->has('break_down_taxes_in_ticket')) {
            $attributes["break_down_taxes_in_ticket"] = 0;
        }

        if ( ! $this->has('manage_kitchens')) {
            $attributes["manage_kitchens"] = 0;
        }

        return $attributes;
    }
}

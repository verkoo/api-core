<?php

namespace Verkoo\Common\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Auth::user()->hasRole('admin')) {
            return true;
        }

        if (Auth::user()->id == $this->getUserId()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:255',
            'role'     => 'required',
            'email' => 'required|email|max:255|unique:users,email,' . $this->getUserId(),
            'username' => 'required|unique:users,username,' . $this->getUserId(),
        ];

        if (! empty($this->get('password')))
        {
            $rules['password'] = 'required|min:6|confirmed'; 
        }

        return $rules;
    }

    protected function getUserId()
    {
        return $this->route()->parameter('user')->id;
    }
}

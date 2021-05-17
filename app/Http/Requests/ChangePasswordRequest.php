<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'current-password' => 'required',
            'new-password' => 'required|min:8',
            'new-password_confirmation' => 'same:new-password',
        ];
    }

    public function messages()
    {
        return [
            'current-password.required' => trans('allclient.old_password_required'),
            'new-password.required' => trans('allclient.new_password_required'),
            'new-password.min' => trans('allclient.new_password_min'),
            'new-password_confirmation.same' => trans('allclient.password_confirm_same')
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
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
            //
            'fullname'=>'required|min:10|max:255',
            'email' =>'required|email|min:10|max:255',
            'phone' =>'required|regex:/(0)[0-9]{9}/',
            'message' => 'max:255',
            'adult'=>'required',
            'kid'=>'required',
            'single_room'=>'required',

        ];
    }
    public function messages()
    {
        return [
            'fullname.required' => trans('booking.required'),
            'fullname.max' => trans('booking.max'),
            'fullname.min' => trans('booking.min'),
            'adult.required' => trans('booking.required'),
            'kid.required' => trans('booking.required'),
            'single_room.required' => trans('booking.required'),
            'email.required' => trans('booking.required'),
            'email.email' => trans('booking.email'),
            'email.min' => trans('booking.min'),
            'email.max' => trans('booking.max'),

            'phone.required' => trans('booking.required'),
            'phone.regex' => trans('booking.regex'),

            'message.max' => trans('booking.max')
        ];
    }
}

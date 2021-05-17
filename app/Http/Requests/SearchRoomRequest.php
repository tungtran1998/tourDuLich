<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class SearchRoomRequest extends FormRequest
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
     public function rules(Request $request)
    { 
        
        return [
            'checkin' => 'required',
            'checkout' => 'required',
            'room_type' => 'required',
            'adult' => 'required',
            'kid' => 'required',
        ];
        
    }
    public function messages()
    {
        return [
            'checkin.required' => trans('allclient.required.checkin'),
            'checkout.required' => trans('allclient.required.checkout'),
            'room_type.required' => trans('allclient.required.room_type'),
            'adult.required' => trans('allclient.required.adult'),
            'kid.required' => trans('allclient.required.kid'),
        ];
    }
}

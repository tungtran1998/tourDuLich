<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class RoomtypeRequest extends FormRequest
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
        
        if($this->method() == 'PUT'){

            return [
                'name'=>'required|max:100|unique:room_types,name,'.$request->get('id').',id,isdeleted,false',
                'star' =>'required',
                'description' => 'required|max:255',
            ];
        }else {
            return [
                'name' => [
                    'required',                
                    Rule::unique('room_types')->ignore($request->name)->where('isdeleted',0),
                    'max:100'
                ],
                'star' =>'required',
                'description' => 'required|max:255',
            ];
        }
        
    }
    public function messages()
    {
        return [
            'name.required' => trans('roomtype.required.name'),
            'name.unique' => trans('roomtype.unique'),
            'name.max' => trans('roomtype.max.name'),
            'star.required' => trans('roomtype.required.star'),
            'description.required' => trans('roomtype.required.description'),
            'description.max' => trans('roomtype.max.description'),
        ];
    }
}

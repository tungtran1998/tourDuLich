<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class ProvinceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

     public function rules(Request $request)
    { 
        
        if($this->method() == 'PUT'){

            return [
                'name'=>'required|max:100|unique:provinces,name,'.$request->get('id').',id,isdeleted,false',
            ];
        }else {
            return [
                'name' => [
                    'required',                
                    Rule::unique('provinces')->ignore($request->name)->where('isdeleted',0),
                    'max:100'
                ],
            ];
        }
        
    }
    public function messages()
    {
        return [
            'name.required' => trans('roomtype.required.name'),
            'name.unique' => trans('roomtype.unique'),
            'name.max' => trans('roomtype.max.name'),
        ];
    }
}

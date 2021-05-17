<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
                'name'=>'required|max:100|unique:services,name,'.$request->get('id').',id,isdeleted,false',
                'description' => 'required|max:255',
            ];
        }else {
            return [
                'name' => [ 
                    'required',                
                    Rule::unique('services')->ignore($request->name)->where('isdeleted',0),
                    'max:100'
                ],
                'description' => 'required|max:255',
            ];
        }


        
    }
    public function messages()
    {
        return [
            'name.required' => trans('service.required.name'),
            'name.unique' => trans('service.unique'),
            'name.max' => trans('service.max.name'),
            'description.required' => trans('service.required.description'),
            'description.max' => trans('service.max.description'),
        ];
    }
}

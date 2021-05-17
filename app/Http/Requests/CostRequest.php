<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class CostRequest extends FormRequest
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
                'name'=>'required|max:100|unique:cost_overrun,name,'.$request->get('id').',id,isdeleted,false',
                'description' => 'required|max:100',
                'price' => 'required',
            ];
        }else {
            return [
                'name' => [ 
                    'required',                
                    Rule::unique('cost_overrun')->ignore($request->name)->where('isdeleted',0),
                    'max:100'
                ],
                'description' => 'required|max:100',
                'price' => 'required',
            ];
        }


        
    }
    public function messages()
    {
        return [
            'name.required' => trans('cost.required.name'),
            'name.unique' => trans('cost.unique'),
            'name.max' => trans('cost.max.name'),
            'description.required' => trans('cost.required.description'),
            'description.max' => trans('cost.max.description'),
            'price.required'=> trans('cost.required.price'),
        ];
    }
}

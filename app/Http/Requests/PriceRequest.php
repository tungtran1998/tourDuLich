<?php

namespace App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class PriceRequest extends FormRequest
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
                'date'=>'required|unique:price_manager,date,'.$request->get('id').',id,isdeleted,false',
                'percent' =>'required',
            ];
        }else {
            return [
                'date' => [ 
                    'required',                
                    Rule::unique('price_manager')->ignore($request->date)->where('isdeleted',0),
                ],
                'percent' =>'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'date.required' => trans('price.date-required'),
            'date.unique' => trans('price.date-unique'),
            'percent.required' => trans('price.percent-required'),
        ];
    }
}

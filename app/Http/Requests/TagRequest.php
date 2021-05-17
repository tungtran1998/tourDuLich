<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
                'tag_name'=>'required|max:100|unique:tags,tag_name,'.$request->get('id').',id,isdeleted,false'
            ];
        }else {
            return [
                'tag_name' => [ 
                    'required',                
                    Rule::unique('tags')->ignore($request->tag_name)->where('isdeleted',0),
                    'max:100',
                ]
            ];
        }
        
    }
    public function messages()
    {
        return [
            'tag_name.required' => trans('tag.required.name'),
            'tag_name.unique' => trans('tag.unique'),
            'tag_name.max' => trans('tag.max.name'),
        ];
    }
}

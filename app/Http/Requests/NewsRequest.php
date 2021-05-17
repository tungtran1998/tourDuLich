<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
                'title'=>'required|max:100|unique:news,title,'.$request->get('id').',id,isdeleted,false',
                'content' =>'required'
            ];
        }else {
            return [
                'title' => [
                    'required',                
                    Rule::unique('news')->ignore($request->title)->where('isdeleted',0),
                    'max:100'
                ],
                'content' =>'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'title.required' => trans('news.required.title'),
            'title.unique' => trans('news.unique'),
            'title.max' => trans('news.max.title'),
            'content.required' => trans('news.required.content'),
        ];
    }
}

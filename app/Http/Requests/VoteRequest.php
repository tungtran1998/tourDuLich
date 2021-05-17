<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VoteRequest extends FormRequest
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
            'star' => 'required',
            'title'=>'required|min:10|max:255',
            'comment' =>'required|min:10|max:255',
        ];
    }
    public function messages()
    {
        return [
            'star.required' => trans('vote.required'),
            
            'title.required' => trans('vote.required'),
            'title.min' => trans('vote.min'),
            'title.max' => trans('vote.max'),

            'comment.required' => trans('vote.required'),
            'comment.min' => trans('vote.min'),
            'comment.max' => trans('vote.max'),
        ];
    }
}

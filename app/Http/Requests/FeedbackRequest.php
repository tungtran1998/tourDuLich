<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FeedbackRequest extends FormRequest
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
            'name'=>'required|max:50',
            'email' =>'required|email',
            'title' =>'required|max:255',
            'content' =>'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => trans('feedback.name-required'),
            'name.max' => trans('feedback.name-max'),
            'email.required' => trans('feedback.email-required'),
            'email.email' => trans('feedback.email-email'),
            'title.required' => trans('feedback.title-required'),
            'title.max' => trans('feedback.title-max'),
            'content.required' => trans('feedback.content-required'),
        ];
    }
}

<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class RoomRequest extends FormRequest
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
                'name'=>'required|max:100|unique:rooms,name,'.$request->get('id').',id,isdeleted,false',
                'room_type_id' =>'required',
                'price' =>'required',
                'description' =>'required|max:255',
                'location' =>'required',
                'adult' =>'required',
                'kid' =>'required',
                'acreage' =>'required',
                'services' => 'required',
                'tags' => 'required',
            ];
        }else {
            return [
                'name' => [ 
                    'required',                
                    Rule::unique('rooms')->ignore($request->name)->where('isdeleted',0),
                    'max:100'
                ],
                'room_type_id' =>'required',
                'price' =>'required',
                'description' =>'required|max:255',
                'location' =>'required',
                'adult' =>'required',
                'kid' =>'required',
                'acreage' =>'required',
                'services' => 'required',
                'tags' => 'required',
            ];
        }
    }
    public function messages()
    {
        return [
            'name.required' => trans('room.required.name'),
            'name.unique' => trans('room.unique'),
            'name.max' => trans('room.max.name'),

            'room_type_id.required' =>trans('room.required.room_type_id'),
            'price.required' => trans('room.required.price'),
            'location.required' => trans('room.required.location'),
            'adult.required' => trans('room.required.adult'),
            'kid.required' => trans('room.required.kid'),
            'acreage.required' => trans('room.required.acreage'),
            'services.required' => trans('room.required.services'),
            'tags.required' => trans('room.required.tags'),
            'description.required' => trans('room.required.description'),
            'description.max' => trans('room.max.description'),
        ];
    }
}

<?php

namespace App\Http\Requests;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class TourRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

     public function rules(Request $request)
    { 
        
        if($this->method() == 'PUT'){

            return [
                'tour_name'=>'required|max:100|unique:tours,tour_name,'.$request->get('id').',id,isdeleted,false',
                'province_id' =>'required',
                'departure_location' =>'required',
                'destination' =>'required',
                'price_adult' =>'required',
                'price_kid' =>'required',
                'single_room_price' =>'required',
                'tour_detail' =>'required',
                'tour_program' =>'required',
                'tour_note' =>'required',
                'number_of_day' =>'required',
                'departure_time' =>'required',
                'departure_date' =>'required',
                'return_date' =>'required',
                'vehicle' =>'required',
                'discount' =>'required',
            ];
        }else {
            return [
                'tour_name' => [ 
                    'required',                
                    Rule::unique('tours')->ignore($request->tour_name)->where('isdeleted',0),
                    'max:100'
                ],
                'province_id' =>'required',
                'departure_location' =>'required',
                'destination' =>'required',
                'price_adult' =>'required',
                'price_kid' =>'required',
                'single_room_price' =>'required',
                'tour_detail' =>'required',
                'tour_program' =>'required',
                'tour_note' =>'required',
                'number_of_day' =>'required',
                'departure_time' =>'required',
                'departure_date' =>'required',
                'return_date' =>'required',
                'vehicle' =>'required',
                'discount' =>'required',
            ];
        }
    }
    public function messages()
    {
        return [
            'name.required' => trans('tour.required.name'),
            'name.unique' => trans('tour.unique'),
            'name.max' => trans('tour.max.name'),
            'province_id.required' => trans('tour.required.price'),
            'departure_location.required' => trans('tour.required.price'),
            'destination.required' => trans('tour.required.price'),
            'price_adult.required' => trans('tour.required.price'),
            'price_kid.required' => trans('tour.required.price'),
            'single_room_price.required' => trans('tour.required.price'),
            'tour_detail.required' => trans('tour.required.price'),
            'tour_program.required' => trans('tour.required.price'),
            'tour_note.required' => trans('tour.required.price'),
            'number_of_day.required' => trans('tour.required.price'),
            'departure_time.required' => trans('tour.required.price'),
            'departure_date.required' => trans('tour.required.price'),
            'return_date.required' => trans('tour.required.price'),
            'vehicle.required' => trans('tour.required.price'),
            
        ];
    }
}

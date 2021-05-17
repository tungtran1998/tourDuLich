<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Province\ProvinceInterface;
use App\Repositories\Tour\TourInterface;
use App\Http\Requests\TourRequest;
use App\Helpers\Helper;
use App\Models\Tour;
use Session;
use Auth;
use Illuminate\Support\Str;
use App\Models\Booktour;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Exports\ToursExport;

class TourController extends Controller
{
    protected $tourRP;
    protected $provinceRP;

    public function __construct(TourInterface $tourInterface, ProvinceInterface $provinceTypeInterface)
    {
        $this->middleware('permission:tours-list|tours-create|tours-edit|tours-delete|tours-show', ['only' => ['index','store']]);
        $this->middleware('permission:tours-create', ['only' => ['create','store']]);
        $this->middleware('permission:tours-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:tours-delete', ['only' => ['destroy']]);
        $this->middleware('permission:tours-show', ['only' => ['show']]);
        $this->tourRP = $tourInterface;
        $this->provinceRP = $provinceTypeInterface;
    }

    public function index()
    {
        $tours = $this->tourRP->getAll();
        return view('admin.tour.index', compact('tours'));
    }


    public function create()
    {
        $provinces = $this->provinceRP->getPluck('name','id');
        return view('admin.tour.create',compact('provinces'));
    }

    public function store(TourRequest $request)
    {
        
        $request->validated();
        $imageName = 'default.png';
        if($request->hasFile('image'))
        {
            $helper = new Helper();
            $imageName = $helper->uploadFile(request('image'));
        }
        $datatour = new Tour;
        $datatour->tour_code = Str::random(10);
        $datatour->count_people = $request->count_people;
        $datatour->tour_name = $request->tour_name;
        $datatour->departure_location = $request->departure_location;
        $datatour->destination = $request->destination;
        $datatour->province_id = $request->province_id;
        $datatour->price_adult = $request->price_adult;
        $datatour->price_kid = $request->price_kid;
        $datatour->single_room_price = $request->single_room_price;
        $datatour->tour_detail = $request->tour_detail;
        $datatour->tour_program = $request->tour_program;
        $datatour->tour_note = $request->tour_note;
        $datatour->number_of_day = $request->number_of_day;
        $datatour->departure_time = $request->departure_time;
        $datatour->departure_date = $request->departure_date;
        $datatour->return_date = $request->return_date;
        $datatour->vehicle = $request->vehicle;
        $datatour->tour_image = $imageName;
        $datatour->discount = $request->discount;
        $datatour->status = $request->status;
        $datatour->isdeleted = false;
        $datatour->created_by = Auth::user()->id;
        $datatour->updated_by = Auth::user()->id;
        $result = $this->tourRP->create($datatour->toArray());

        if ($result){
            return redirect()->route('tour.index')->with('message', trans('message.success-create'));
        }else{
            return back()->with('message',trans('message.save_error'));
        }


    }


    public function show($id)
    {
        $tour = $this->tourRP->find($id);
        $data_Booktour = Booktour::where('tour_id','=',$tour->id)->get();
        $sl_n = 0;
        foreach ($data_Booktour as $value) {
            $sl_n += $value->adult + $value->kid; 
        }
       
        return view('admin.tour.detail',compact('tour','sl_n'));
    }


    public function edit($id)
    {
        $tour = $this->tourRP->find($id);
        $provinces = $this->provinceRP->getPluck('name','id');
        return view('admin.tour.edit',compact('tour','provinces'));
    }


    public function update(TourRequest $request, $id)
    {
        $request->validated();
        $tour = $this->tourRP->find($id);
        $imageName = $tour->tour_image;
        
        if($request->hasFile('image')){
            $helper = new Helper();
            $imageName = $helper->uploadFile(request('image'));
        }
        $tour->count_people = $request->count_people;
        $tour->tour_name = $request->tour_name;
        $tour->departure_location = $request->departure_location;
        $tour->destination = $request->destination;
        $tour->province_id = $request->province_id;
        $tour->price_adult = $request->price_adult;
        $tour->price_kid = $request->price_kid;
        $tour->single_room_price = $request->single_room_price;
        $tour->tour_detail = $request->tour_detail;
        $tour->tour_program = $request->tour_program;
        $tour->tour_note = $request->tour_note;
        $tour->number_of_day = $request->number_of_day;
        $tour->departure_time = $request->departure_time;
        $tour->departure_date = $request->departure_date;
        $tour->return_date = $request->return_date;
        $tour->vehicle = $request->vehicle;
        $tour->tour_image = $imageName;
        $tour->discount = $request->discount;
        $tour->status = $request->status;
        $tour->updated_by = Auth::user()->id;

        $result = $this->tourRP->update($id, $tour->toArray());
        if ($result){
            return redirect()->route('tour.index')->with('message', trans('message.success-edit'));
        }else{
            return back()->with('message',trans('message.update_error'));
        }
    }


    public function destroy($id)
    {
        $tour = $this->tourRP->find($request->id);
        $tour->isdeleted = true;

        $result = $this->tourRP->update($tour->id, $tour->toArray());
        if ($result) { 
            return back()->with('message', trans('message.success-delete'));
        } else {
            return back()->with('message',trans('message.delete_failse'));
        }
    }
    public function export() 
    {
        return Excel::download(new ToursExport, 'listtours.xlsx');
    }
}

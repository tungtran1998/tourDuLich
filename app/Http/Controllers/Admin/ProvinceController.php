<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Province\ProvinceInterface;
use App\Http\Requests\ProvinceRequest;
use App\Models\Province;
use App\Helpers\Helper;
use Carbon\Carbon;
use Auth;

class ProvinceController extends Controller
{

    protected $provinceRP;

    public function __construct(ProvinceInterface $provinceRepository)
    {
        $this->middleware('permission:provinces-list|provinces-create|provinces-edit|provinces-delete|provinces-show', ['only' => ['index','store']]);
        $this->middleware('permission:provinces-create', ['only' => ['create','store']]);
        $this->middleware('permission:provinces-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:provinces-delete', ['only' => ['destroy']]);
        $this->middleware('permission:provinces-show', ['only' => ['show']]);
        
        $this->provinceRP = $provinceRepository;
    }

    public function index()
    {
        $provinces = $this->provinceRP->getAll();
        return view('admin.province.index', compact('provinces'));   
    }


    public function create()
    {
        return view('admin.province.create');
    }


    public function store(ProvinceRequest $request)
    {
        $request->validated();
        $data = new Province([
            'name' => $request->name,
            'isdeleted' => false,
            'created_by' =>  Auth::user()->id,
            'updated_by' =>  Auth::user()->id,
        ]);
        $result = $this->provinceRP->create($data->toArray());
        if ($result){
            return redirect()->route('province.index')->with('message', trans('message.success-create'));
        }else{
            return back()->with('message',trans('message.save_error'));
        }
    }


    public function show($id)
    {
        $province = $this->provinceRP->find($id);
        return view('admin.province.detail', compact('province'));
    }


    public function edit($id)
    {
        $province = $this->provinceRP->find($id);
        return view('admin.province.edit', compact('province'));
    }


    public function update(ProvinceRequest $request, $id)
    {
        $request->validated();
        $province = $this->provinceRP->find($id);
        $province->name = $request->name;
        $province->updated_by = Auth::user()->id;
        $result = $this->provinceRP->update($id, $province->toArray());
        if ($result){
            return redirect()->route('province.index')->with('message', trans('message.success-edit'));
        }else{
            return back()->with('message',trans('message.update_error'));
        }
    }


    public function destroy(Request $request)
    {
        $province = $this->provinceRP->find($request->id);
        $province->isdeleted = true;
        $result = $this->provinceRP->update($province->id, $province->toArray());
        if ($result) { 
            return back()->with('message', trans('message.success-delete'));
        } else {
            return back()->with('message',trans('message.delete_failse'));
        }
    }
}

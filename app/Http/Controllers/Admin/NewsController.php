<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;
use App\Repositories\News\NewsInterface;
use Auth;
use App\Models\Member;
use Mail;
use App\Http\Requests\NewsRequest;
use App\Helpers\Helper;
use App\Repositories\Province\ProvinceInterface;

class NewsController extends Controller
{

    protected $newRP;
    protected $provinceRP;

    public function __construct(NewsInterface $newsRepository, ProvinceInterface $provinceTypeInterface)
    {
        $this->middleware('permission:new-list|new-create|new-edit|new-delete|new-show', ['only' => ['index','store']]);
        $this->middleware('permission:new-create', ['only' => ['create','store']]);
        $this->middleware('permission:new-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:new-delete', ['only' => ['destroy']]);
        $this->middleware('permission:new-show', ['only' => ['show']]);
        $this->newRP = $newsRepository;
        $this->provinceRP = $provinceTypeInterface;
    }

    public function index()
    {
        $news = $this->newRP->getAll();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $provinces = $this->provinceRP->getPluck('name','id');
        return view('admin.news.create',compact('provinces'));
    }

    public function store(NewsRequest $request)
    {
        $request->validated();
        $imageName = 'default.png';
        if($request->hasFile('thumbnail'))
        {
            $helper = new Helper();
            $url = 'administration/imageNews/';
            $imageName = $helper->uploadFileImage($url,request('thumbnail'));
        }
        $data = new News([
            'title' => $request->title,
            'slug' => str_slug($request->title),
            'content' => $request->content,
            'thumbnail' => $imageName,
            'isdeleted' => false,
            'status'=> false,
            'hot'=> $request->hot,
            'province_id'=> $request->province_id,
            'created_by' => Auth::id(),
            'updated_by' => Auth::id(),
        ]);
        $result = $this->newRP->create($data->toArray());
        if ($result){
            //  Mail::send('email.news',[
            //     'title' => $request->title,
            //     'content' => $request->content,
            // ], function($message) use ($data) {
            //     $member = array_unique(Member::pluck('email','email')->toArray());
            //     foreach ($member as $key => $value) {
            //         $message->to($member[$key]);
            //         $message->subject('Quảng cáo');
            //     }  
            // });
            return redirect()->route('news.index')->with('message', trans('message.success-create'));
        }else{
            return back()->with('message',trans('message.save_error'));
        }
    }

    public function show($id)
    {
        $news = $this->newRP->find($id);
        return view('admin.news.detail', compact('news'));
    }

    public function edit($id)
    {
        $news = $this->newRP->find($id);
        $provinces = $this->provinceRP->getPluck('name','id');
        return view('admin.news.edit', compact('news','provinces'));
    }

    public function update(NewsRequest $request, $id)
    {
        $request->validated();
        $news = $this->newRP->find($id);
        $imageName = $news->thumbnail;;
        if($request->hasFile('thumbnail'))
        {
            $helper = new Helper();
            $url = 'administration/imageNews/';
            $imageName = $helper->uploadFileImage($url,request('thumbnail'));
        }
        $news->title = $request->title;
        $news->slug = str_slug($request->title);
        $news->hot = $request->hot;
        $news->province_id = $request->province_id;
        $news->content = $request->content;
        $news->thumbnail = $imageName;
        $news->updated_by = Auth::user()->id;
        $result = $this->newRP->update($id, $news->toArray());

        if ($result){
            return redirect()->route('news.index')->with('message', trans('message.success-edit'));
        }else{
            return back()->with('message',trans('message.update_error'));
        }
    }

    public function destroy(Request $request)
    {
        $news = $this->newRP->find($request->id);
        $news->isdeleted = true;

        $result = $this->newRP->update($news->id, $news->toArray());
        if ($result) { 
            return back()->with('message', trans('message.success-delete'));
        } else {
            return back()->with('message',trans('message.delete_failse'));
        }
    }
}

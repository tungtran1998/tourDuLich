<?php

namespace App\Http\Controllers\Client;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Member;
use App\Models\News;
use Spatie\Searchable\Search;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\SearchRoomRequest;
use Cookie;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{

    private $langActive = [
       'vi',
       'en',
     ];







    //News
    public function news()
    {
        $data = News::whereisdeleted(0)->wherestatus(0)->orderBy('created_at', 'DESC')->paginate(9);
        foreach ($data as $key=> $news) {
            $data[$key]->created_by = Admin::where('id','like',$news->created_by)->value('name');
        }
        return view('client.news.index',compact('data'));
    }

    public function newsDetail($slug)
    {
        $data = News::whereslug($slug)->firstOrFail();
        $data->created_by = Admin::whereid($data->created_by)->value('name');
        return view('client.news.detail',compact('data'));
    }

    //Da Ngon Ngu
    public function changeLang(Request $request, $lang)
    {
       if (in_array($lang, $this->langActive)) {
         $request->session()->put(['lang' => $lang]);
         return redirect()->back();
        }
    }

    //Introduce
    public function introduce(){
        return view('client.introduce.index');
    }

    public function term(){
        return view('client.home.term');
    }

    public function member(EmailRequest $request){
        $member = new Member([
            'email' => $request->email,
        ]);
        $member->save();
        $notification = array(
            'message' => trans('allclient.email_success'),
            'alert-type' => 'success'
            );
        return back()->with($notification);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Carbon\Carbon;
use App\Models\Booktour;
use App\Repositories\News\NewsInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\Province\ProvinceInterface;
use App\Repositories\Tour\TourInterface;
use App\Repositories\BookTour\BookTourInterface;
use Mail;
class HomeController extends Controller
{

  private $langActive = [
    'vi',
    'en',
  ];

  protected $newRP;
  protected $tourRP;
  protected $provinceRP;
  protected $booktourRP;
  protected $userRP;

  public function __construct(NewsInterface $newsRepository,UserInterface $userInterface,TourInterface $tourInterface, ProvinceInterface $provinceTypeInterface,BookTourInterface $booktourInterface)
  {
    $this->newRP = $newsRepository;
    $this->userRP = $userInterface;
    $this->tourRP = $tourInterface;
    $this->provinceRP = $provinceTypeInterface;
    $this->booktourRP = $booktourInterface;
  }

  public function index()
  {
    $news = $this->newRP->countNew();
    $tour_total = $this->tourRP->countTour();
    $user_total = $this->userRP->countUserclient();
    $provinces = $this->provinceRP->countProvince();
    return view('admin.home.index',compact('news','tour_total','user_total','provinces'));
  }

  public function chart()
  {
    $result = array();
    $month = Carbon::now()->month;
    $year=  Carbon::now()->year;
    $arrMonth = array();
    $arrUser = array();
    $arrRevenue = array();

    $arrMonth = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
      for ($i = 1; $i <= 12; $i++) {
        $arrUser[] =  $this->userRP->countUserClientByMonthAndYear($i,$year);
        $arrRevenue[] = $this->booktourRP->countBookTourByMonthYear($i,$year);
      }
    $result = [$arrMonth, $arrUser, $arrRevenue];
    return response()->json($result);
  }

  public function changeLang(Request $request, $lang)
  {
    if (in_array($lang, $this->langActive)) {
      $request->session()->put(['lang' => $lang]);
      return redirect()->back();
    }
  }

  public function error404()
  {
    return view('admin.error.error404');
  }


  public function sendNoti($email){
    $data = array('name'=>"ElaHotel");
    Mail::send('email.sendnoti',$data,function($message) use ($email){
            $message->to($email);
            $message->subject(trans('admin.out'));
    });
    $notification = array(
          'message' => trans('admin.send_noti_success'),
          'alert-type' => 'success'
    );
    return redirect()->back()->with($notification);
  } 
}

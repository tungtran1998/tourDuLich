<?php

namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\Auth;
use App\Events\MyEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use Spatie\Searchable\Search;
use App\Http\Requests\EmailRequest;
use App\Http\Requests\SearchRoomRequest;
use App\Http\Requests\BookingRequest;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Tour;
use Carbon\Carbon;
use Session;
use App\Models\Booktour;
use App\Models\User;
use App\Notifications\BookingNotification;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Mail;
use App\Models\News;
use DB;
use Illuminate\Support\Facades\Input;

class TourController extends Controller
{
	protected $vnp_TmnCode; //Mã website tại VNPAY 
	protected $vnp_HashSecret; //Chuỗi bí mật
	protected $vnp_Url; //URL API cổng thanh toán VNPay
	protected $vnp_Returnurl; // URL trả về
	private $langActive = [
		'vi',
		'en',
	];
	public function __construct()
	{
		$this->vnp_TmnCode = "GQ47CVPT";
		$this->vnp_HashSecret = "HQWGOTZENLADYIGYPEEEOYCJZXXJBXQX";
		$this->vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
		$this->vnp_Returnurl = url('result_paymentt');
	}

	public function home()
	{
		$hot_news = News::wherehot('on')->whereisdeleted(0)->wherestatus(0)->orderBy('id', 'DESC')->limit(6)->get();

		foreach ($hot_news as $key=> $data) {
			$hot_news[$key]->created_by = Admin::where('id','like',$data->created_by)->value('name');
		}
		$daynow = strtotime(str_replace('/', '-', Carbon::now('Asia/Ho_Chi_Minh')));
		$dataTour = Tour::whereisdeleted(0)->wherestatus(0)->where('departure_date','>=',date('Y-m-d', $daynow))->orderBy('created_at', 'desc')->where('discount','==',0)->limit(15)->get();
        $dataPromotion = Tour::orderBy('created_by','desc')->whereisdeleted(0)->wherestatus(0)->where('departure_date','>=',date('Y-m-d', $daynow))->where('discount','!=',0)->limit(3)->get();

	

		return view('client.tour.home', compact('hot_news','dataTour','dataPromotion'));
	}

	public function tourDetail($id)
	{
		$data = Tour::find($id);
		$data_similar = Tour::where('province_id',$data->province_id)->whereisdeleted(0)->wherestatus(0)->orderBy('created_by', 'desc')->limit(4)->get();
		return view('client.tour.detail',compact('data','data_similar'));
	}

    // Kiểm tra giá
	public function check_tour(BookingRequest $request){
		
		$tour = Tour::find($request->id);
		$total_amount =  ($request->adult * $tour->price_adult) + ($request->kid * $tour->price_kid) + ($request->single_room * $tour->single_room_price) ;
		if ($tour->discount) {
			$total_amount_discount = $total_amount - ($total_amount*$tour->discount/100);
			Session::put('total_amount_discount',$total_amount_discount );
		}
		Session::put('total_amount',$total_amount );
		Session::put('adult',$request->adult );
		Session::put('kid',$request->kid );
		Session::put('single_room',$request->single_room);
		Session::put('note',$request->message);
		return view('client.tour.payment', compact('total_amount','tour'));

	}

	public function checkout(Request $request)
	{
		if(Auth::check()){
			$book_code = rand(100000,999999).Carbon::now('Asia/Ho_Chi_Minh')->year.Carbon::now('Asia/Ho_Chi_Minh')->month.Carbon::now('Asia/Ho_Chi_Minh')->day;
			$tour = Tour::find($request->id);
			$total_amount = Session::get('total_amount');
			if (Session::get('total_amount_discount')) {
				$total_amount = Session::get('total_amount_discount');
			}
			$book_tour = new Booktour([
				'book_code' => $book_code,
				'transaction_date' => Carbon::now('Asia/Ho_Chi_Minh'),
				'status' => false,
				'adult' => Session::get('adult'),
				'kid' => Session::get('kid'),
				'total_amount' => $total_amount,
				'payment' => '0',
				'fullname' => $request->fullname,
				'phone' => $request->phone,
				'email' => $request->email,
				'message' => $request->message,
				'single_room'=> Session::get('single_room'),
				'single_room_price' => $tour->single_room_price,
				'price_kid' => $tour->price_kid,
				'price_adult'=> $tour->price_adult,
				'discount'=>$tour->discount,
				'tour_id'=> $tour->id,
				'user_id' => Auth::id(),
				'updated_by'=> Auth::id(),
				'isdeleted' => false,
			]);
			$book_tour->save();

			//Notification
			$resultUser = User::find(Auth::user()->id);
			$notification = [
				'title' => 'There is a new book tour',
				'content'=> 'There is a new book tour',
				'id' => $book_tour->id,
			];
			$resultNotification = $resultUser->notify( new BookingNotification($notification));
			event(new MyEvent('There is a new book tour',$book_tour->id));


			// $booking = Booking::findorFail($booking);
			$qr = QrCode::format('png')->size(200)->generate($book_tour->book_code);

			// Gui mail
			Mail::send('email.tour',[
				'book_code' => $book_tour->book_code,
				'transaction_date' => $book_tour->transaction_date,
				'tour_name' => $tour->tour_name,
				'departure_location' => $tour->departure_location,
				'destination' => $tour->destination,
				'number_of_day' => $tour->number_of_day,
				'departure_time' => $tour->departure_time,
				'departure_date' => $tour->departure_date,
				'return_date' => $tour->return_date,
				'vehicle' => $tour->vehicle,
				'total_amount' => $book_tour->total_amount,
				'discount'=> $tour->discount,
				'png' => $qr

			], function($message) use ($book_tour) {
				$message->to($book_tour->email);
				$message->subject('Đơn đặt tour của bạn');
			});
			

			if($request->payment==1){
				return redirect('/paymenttour/'.$book_tour->id.'?bank_code='.$request->bank_code.'&language='.$request->language);
			}
			$notification = array(
				'message' => trans('allclient.booking_success'),
				'alert-type' => 'success'
			);
			// Xoa gio hang va du lieu lien quan
			Session::forget('total_amount');
			Session::forget('adult');
			Session::forget('kid');
			Session::forget('single_room');
			Session::forget('total_amount_discount');
			return redirect('profile/history/')->with($notification);
		}
		return redirect('client.login')->with('message',trans('allclient.need_login'));
	}

	// Thanh toan VNPay
	public function payment(Request $request,$id)
	{
		$Booktour = Booktour::findOrfail($id);
			// session(['cost_id' => $booking->id]);
			// session(['url_prev' => url()->previous()]);
		$vnp_TmnCode = $this->vnp_TmnCode;
		$vnp_HashSecret = $this->vnp_HashSecret;
		$vnp_Url = $this->vnp_Url;
		$vnp_Returnurl = $this->vnp_Returnurl;
	        $vnp_TxnRef = $Booktour->book_code; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
	        $vnp_OrderInfo = "Thanh toán đơn đặt tour!";
	        $vnp_OrderType = 'billpayment';
	        $vnp_Amount = $Booktour->total_amount * 100;
	        $vnp_Locale = (isset($request->language) ? $request->language : trans('booking.language_payment'));
	        $vnp_IpAddr = request()->ip();
	        $vnp_BankCode = (isset($request->bank_code) ? $request->bank_code : '');
	        $inputData = array(
	        	"vnp_Version" => "2.0.0",
	        	"vnp_TmnCode" => $vnp_TmnCode,
	        	"vnp_Amount" => $vnp_Amount,
	        	"vnp_Command" => "pay",
	        	"vnp_CreateDate" => date('YmdHis'),
	        	"vnp_CurrCode" => "VND",
	        	"vnp_IpAddr" => $vnp_IpAddr,
	        	"vnp_Locale" => $vnp_Locale,
	        	"vnp_OrderInfo" => $vnp_OrderInfo,
	        	"vnp_OrderType" => $vnp_OrderType,
	        	"vnp_ReturnUrl" => $vnp_Returnurl,
	        	"vnp_TxnRef" => $vnp_TxnRef,
	        );

	        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
	        	$inputData['vnp_BankCode'] = $vnp_BankCode;
	        }
	        ksort($inputData);
	        $query = "";
	        $i = 0;
	        $hashdata = "";
	        foreach ($inputData as $key => $value) {
	        	if ($i == 1) {
	        		$hashdata .= '&' . $key . "=" . $value;
	        	} else {
	        		$hashdata .= $key . "=" . $value;
	        		$i = 1;
	        	}
	        	$query .= urlencode($key) . "=" . urlencode($value) . '&';
	        }

	        $vnp_Url = $vnp_Url . "?" . $query;
	        if (isset($vnp_HashSecret)) {
	           // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
	        	$vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
	        	$vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
	        }
	        Session::forget('total_amount');
			Session::forget('adult');
			Session::forget('kid');
			Session::forget('single_room');
			Session::forget('total_amount_discount');
	        return redirect($vnp_Url);
	    }
    	// Sau khi xu li tai VNPay
   	 	//Viet ham xu ly sau
	    public function payment_hardling() {
	    	$vnp_TmnCode = $this->vnp_TmnCode;
	    	$vnp_HashSecret = $this->vnp_HashSecret;
	    	$inputData = array();
	    	$returnData = array();
	    	$data = $_REQUEST;
	    	foreach ($data as $key => $value) {
	    		if (substr($key, 0, 4) == "vnp_") {
	    			$inputData[$key] = $value;
	    		}
	    	}
	    	$vnp_SecureHash = $inputData['vnp_SecureHash'];
	    	unset($inputData['vnp_SecureHashType']);
	    	unset($inputData['vnp_SecureHash']);
	    	ksort($inputData);
	    	$i = 0;
	    	$hashData = "";
	    	foreach ($inputData as $key => $value) {
	    		if ($i == 1) {
	    			$hashData = $hashData . '&' . $key . "=" . $value;
	    		} else {
	    			$hashData = $hashData . $key . "=" . $value;
	    			$i = 1;
	    		}
	    	}
			$vnpTranId = $inputData['vnp_TransactionNo']; //Mã giao dịch tại VNPAY
			$vnp_BankCode = $inputData['vnp_BankCode']; //Ngân hàng thanh toán
			$secureHash = hash('sha256',$vnp_HashSecret . $hashData);
			$Status = 0;
			$orderId = $inputData['vnp_TxnRef'];

			try {
			    //Check Orderid    
			    //Kiểm tra checksum của dữ liệu
				if ($secureHash == $vnp_SecureHash) {
			        //Lấy thông tin đơn hàng lưu trong Database và kiểm tra trạng thái của đơn hàng, mã đơn hàng là: $orderId            
			        //Việc kiểm tra trạng thái của đơn hàng giúp hệ thống không xử lý trùng lặp, xử lý nhiều lần một giao dịch
			        //Giả sử: $order = mysqli_fetch_assoc($result);   
					$order = Booktour::wherebook_code($orderId)->value('payment');
					if ($order != NULL) {
						if ($order != NULL && $order == 0) {
							if ($inputData['vnp_ResponseCode'] == '00') {
								$Status = 1;
								$booking_id = Booktour::wherebook_code($orderId)->value('id');
								$booking = Booktour::findOrfail($booking_id);
								$booking->status = 1;
								$booking->payment = 1;
								$booking->update();
								$tour = Tour::find($booking->tour_id);
				                // Gui mail
								$qr = QrCode::format('png')->size(200)->generate($booking->book_code);
								Mail::send('email.paymenttour',[
									'book_code' => $booking->book_code,
									'transaction_date' => $booking->transaction_date,
									'tour_name' => $tour->tour_name,
									'departure_location' => $tour->departure_location,
									'destination' => $tour->destination,
									'number_of_day' => $tour->number_of_day,
									'departure_time' => $tour->departure_time,
									'departure_date' => $tour->departure_date,
									'return_date' => $tour->return_date,
									'vehicle' => $tour->vehicle,
									'total_amount' => $booking->total_amount,
									'png' => $qr,
									'name' => Auth::user()->username

								], function($message) {
									$message->to(Auth::user()->email);
									$message->subject('Thanh toán thành công!');
								});
							} else {
								$Status = 2;
							}
			                //Cài đặt Code cập nhật kết quả thanh toán, tình trạng đơn hàng vào DB
			                //
			                //
			                //Trả kết quả về cho VNPAY: Website TMĐT ghi nhận yêu cầu thành công                
							$returnData['RspCode'] = '00';
							$returnData['Message'] = 'Confirm Success';
						} else {
							$returnData['RspCode'] = '02';
							$returnData['Message'] = 'Order already confirmed';
						}
					} else {
						$returnData['RspCode'] = '01';
						$returnData['Message'] = 'Order not found';
					}
				} else {
					$returnData['RspCode'] = '97';
					$returnData['Message'] = 'Chu ky khong hop le';
				}
			} catch (Exception $e) {
				$returnData['RspCode'] = '99';
				$returnData['Message'] = 'Unknow error';
			}
			Session::forget('total_amount');
			Session::forget('adult');
			Session::forget('kid');
			Session::forget('single_room');
			Session::forget('total_amount_discount');
		//Trả lại VNPAY theo định dạng JSON
		// echo json_encode($returnData);
		}

	//Show ket qua thanh toan
	public function result_payment(Request $request){
		
		if($request->vnp_ResponseCode){
			$this->payment_hardling();
			return view('client.invoice.result_payment');		
		}
		return redirect('/');
	}

	//Search
    public function search_tour(Request $request)
    {
        //Ham dung de search tour and show all tour
        // Lay tat ca tour sap xep theo created_by 
      
        $daynow = strtotime(str_replace('/', '-', Carbon::now('Asia/Ho_Chi_Minh')));
        
        $data = Tour::orderBy('created_by','desc')->whereisdeleted(0)->wherestatus(0)->where('departure_date','>=',date('Y-m-d', $daynow))->get();
        //Kiem tra yeu cau truy van và loc du lieu
        // Neu co departure_location
        if($request->departure_location){
            $data = $data->where('departure_location',$request->departure_location);
        }
        // Neu co destination
        if($request->destination){
            $data = $data->where('destination',$request->destination);
        }

        $departure_date = strtotime(str_replace('/', '-', $request->departure_date));
        $return_date = strtotime(str_replace('/', '-', $request->return_date));
        // Neu co destination
        if($request->departure_date){
            $data = $data->where('departure_date','>=',date('Y-m-d', $departure_date));
        }

        // Neu co return_date
        if($request->return_date){
            $data = $data->where('return_date','<=',date('Y-m-d', $return_date));
        }
        
        // Xu ly phan trang cho collection
        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
        if($data->isEmpty()){
            $data = Tour::orderBy('created_at','desc')->whereisdeleted(0)->wherestatus(0)->where('departure_date','>=',date('Y-m-d', $daynow))->get();
        }
        $data = (new Collection($data))->paginate(9);

        return view('client.tour.index', compact('data'));
    }

    public function allTour()
    {
    	$daynow = strtotime(str_replace('/', '-', Carbon::now('Asia/Ho_Chi_Minh')));
        
        $data = Tour::orderBy('created_by','desc')->whereisdeleted(0)->wherestatus(0)->where('departure_date','>=',date('Y-m-d', $daynow))->get();

        // Xu ly phan trang cho collection
        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
        $data = (new Collection($data))->paginate(9);

        return view('client.tour.alltour', compact('data'));
    }

    public function tourDiscount()
    {
    	$daynow = strtotime(str_replace('/', '-', Carbon::now('Asia/Ho_Chi_Minh')));
        
        $data = Tour::orderBy('created_by','desc')->whereisdeleted(0)->wherestatus(0)->where('departure_date','>=',date('Y-m-d', $daynow))->where('discount','!=',0)->get();

        // Xu ly phan trang cho collection
        Collection::macro('paginate', function($perPage, $total = null, $page = null, $pageName = 'page') {
            $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

            return new LengthAwarePaginator(
                $this->forPage($page, $perPage),
                $total ?: $this->count(),
                $perPage,
                $page,
                [
                    'path' => LengthAwarePaginator::resolveCurrentPath(),
                    'pageName' => $pageName,
                ]
            );
        });
        $data = (new Collection($data))->paginate(9);

        return view('client.tour.tourDiscount', compact('data'));
    }

    public function searchnew(Request $request)
    {
  
        $dat = Input::get('query');
        $data = DB::table('news')
        ->join('provinces', 'news.province_id', '=', 'provinces.id')
        ->select('news.*', 'provinces.*')   
        ->where('provinces.name','LIKE', '%' .$dat.'%')
        ->orWhere('news.title', 'LIKE', '%' .$dat.'%')
        ->get();
        if ($data->isEmpty()) {
                $notification = array(
                'message' => trans('allclient.cant_find'),
                'alert-type' => 'info'
                );
                return redirect()->back()->with($notification);
            }    

        return view('client.news.resultSearch', compact('data','dat'));
    }
































	}

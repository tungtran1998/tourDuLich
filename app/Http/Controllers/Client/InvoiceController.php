<?php

namespace App\Http\Controllers\Client;

use App\Notifications\BookingNotification;
use App\Events\MyEvent;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use Carbon\Carbon;
use Mail;
use App\Models\User;

class InvoiceController extends Controller
{
	protected $vnp_TmnCode; //Mã website tại VNPAY 
	protected $vnp_HashSecret; //Chuỗi bí mật
	protected $vnp_Url; //URL API cổng thanh toán VNPay
	protected $vnp_Returnurl; // URL trả về
    //
	public function __construct()
	{
		$this->vnp_TmnCode = "GQ47CVPT";
		$this->vnp_HashSecret = "HQWGOTZENLADYIGYPEEEOYCJZXXJBXQX";
		$this->vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
		$this->vnp_Returnurl = url('result_payment');
	}


	// Booking (lưu giỏ hàng, services vào db)
	public function checkout(BookingRequest $request)
	{
		if(Auth::check()){
			if(Cookie::has('item')){
				$cart = unserialize(Cookie::get('item'));
				$count = count($cart);
				$booking_code = rand(100000,999999).Carbon::now('Asia/Ho_Chi_Minh')->year.Carbon::now('Asia/Ho_Chi_Minh')->month.Carbon::now('Asia/Ho_Chi_Minh')->day;
			//Lưu Booking
				$checkin = strtotime(str_replace('/', '-', $request->checkin));
				$checkout = strtotime(str_replace('/', '-', $request->checkout));
				$booking = new Booking([
					'booking_code' => $booking_code,
					'transaction_date' => Carbon::now('Asia/Ho_Chi_Minh'),
					'check_in_date' => date('Y-m-d',$checkin),
					'check_out_date' => date('Y-m-d',$checkout),
					'adult' => Session::get('adult'),
					'kid' => Session::get('kid'),
					'user_id' => Auth::id(),
					'total_amount' => Session::get('total_amount'),
					'payment' => '0',
					'fullname' => $request->fullname,
					'email' => $request->email,
					'phone' => $request->phone,
					'message' => $request->message,
					'status' => false,
				]);
				// dd($booking);
				$booking->save();
			//Notification
				$resultUser = User::find(Auth::user()->id);
				$notification = [
					'title' => 'There is a new reservation',
					'content'=> 'There is a new reservation',
					'id' => $booking->id,
				];
				$resultNotification = $resultUser->notify( new BookingNotification($notification));
				event(new MyEvent('There is a new reservation',$booking->id));

			// Lưu booking detail
				foreach ($cart as $cart) {
					$bookingdetail = new BookingDetail([
						'booking_id' => $booking->id,
						'room_id' => $cart['id'],
						'price' => $cart['price'],
					]);
					$bookingdetail->save();
				}
			// Lưu special day
				if(Session::get('special_day')){
					foreach (Session::get('special_day') as $day) {
						$day = Price::wheredate('date',$day)->first();
						$special_day = new SpecialDay([
							'booking_id' => $booking->id,
							'specialday_id' => $day->id,
							'percent' => $day->percent,
						]);
						$special_day->save();
					}
				}

			// Lưu cost overrun detail
				if(Session::get('cost_overrun')){
					foreach (Session::get('cost_overrun') as $cost) {
						$booking_cost = new Booking_Cost([
							'booking_id' => $booking->id,
							'cost_id' => $cost->id,
							'price' => $cost->price,
						]);
						$booking_cost->save();
					}
				}
				// $booking = Booking::findorFail($booking);
				$qr = QrCode::format('png')->size(200)->generate($booking->booking_code);
        	// Gui mail
				Mail::send('email.content',[
					'booking_code' => $booking->booking_code,
					'transaction_date' => $booking->transaction_date,
					'checkin' => $booking->check_in_date,
					'checkout' => $booking->check_out_date,
					'adult' => $booking->adult,
					'kid' => $booking->kid,
					'total_amount' => $booking->total_amount,
					'message' => $booking->message,
					'png' => $qr

				], function($message) use ($booking) {
					$message->to($booking->email);
					$message->subject('Đơn hàng của bạn');
				});
			// Xoa gio hang va du lieu lien quan
				Cookie::queue(Cookie::forget('item'));
				Session::forget('total_amount');
				Session::forget('adult');
				Session::forget('kid');
				Session::forget('special_day');

				if($request->payment==1){
					return redirect('/payment/'.$booking->id.'?bank_code='.$request->bank_code.'&language='.$request->language);
				}
				$notification = array(
					'message' => trans('allclient.booking_success'),
					'alert-type' => 'success'
				);
				return redirect('profile/history/')->with($notification);
			}
			return redirect()->route('room')->with('message','You need to choose a room');
		}
		return redirect('client.login')->with('message',trans('allclient.need_login'));

	}

	public function quick_checkout(BookingRequest $request, $id){
		
		$room = Room::findOrfail($id);
		$booking_code = rand(100000,999999).Carbon::now('Asia/Ho_Chi_Minh')->year.Carbon::now('Asia/Ho_Chi_Minh')->month.Carbon::now('Asia/Ho_Chi_Minh')->day;
		$checkin = strtotime(str_replace('/', '-', $request->checkin));
		$checkout = strtotime(str_replace('/', '-', $request->checkout));
		// Kiem tra checkin phai nho hon check out
		// Ngay checkin phai lon hon ngay hien tai
		if($checkin >= $checkout){
			return back()->with('message','Please check the date you chose');
		}

		// Kiểm tra phòng có thể đặt không
		$check = BookingDetail::whereroom_id($room->id)->get();
		foreach ($check as $value) {
                if((date('Y-m-d', $checkin) < $value->booking->check_in_date && date('Y-m-d', $checkout) < $value->booking->check_in_date) || (date('Y-m-d', $checkin) > $value->booking->check_out_date && date('Y-m-d', $checkout) > $value->booking->check_out_date) ){
                }else {
						return back()->with('message',trans('allclient.available'));
                }
        }
		for ($currentDate = $checkin; $currentDate <= $checkout;$currentDate += (86400)) 
		{ 
			$array[] = date('Y-m-d', $currentDate); 
		}
		// dd(strtotime($checkin));
		// Tính tiền dịch vụ
		$total_sv = 0;
		if($request->service){
			foreach ($request->service as $cost) {
				$total_sv += Cost::where('id',$cost)->value('price');
			}
		}

		$price = Price::pluck('date','id')->toArray();
		$tongtien= 0;
		foreach ($array as $key=> $value) {
			if(in_array($value, $price)){
				$tongtien+=($room->price+($room->price*Price::where('date',$value)->value('percent')/100))+$total_sv;
			}
			else{
				$tongtien+=$room->price+$total_sv;
			}
		}

		// Lưu đơn đặt phòng
		$booking = new Booking([
			'booking_code' => $booking_code,
			'transaction_date' => Carbon::now('Asia/Ho_Chi_Minh'),
			'check_in_date' => date('Y-m-d', $checkin),
			'check_out_date' => date('Y-m-d', $checkout),
			'adult' => $room->adult,
			'kid' => $room->kid,
			'fullname' => $request->fullname,
			'email' => $request->email,
			'phone' => $request->phone,
			'user_id' => Auth::id(),
			'total_amount' => $tongtien,
			'payment' => '0',
			'message' => $request->message,
			'status' => false,
		]);
		$booking->save();
		// Lưu booking detail
		$bookingdetail = new BookingDetail([
			'booking_id' => $booking->id,
			'room_id' => $room->id,
			'price' => $room->price,
		]);
		$bookingdetail->save();
		// Lưu services
		if($request->service){
			foreach ($request->service as $cost) {
				$booking_cost = new Booking_Cost([
					'booking_id' => $booking->id,
					'cost_id' => $cost,
					'price' => Cost::whereid($cost)->value('price'),
				]);
				$booking_cost->save();
			}
		}
		$qr = QrCode::format('png')->size(200)->generate($booking->booking_code);
		// Gui mail
		Mail::send('email.content',[
			'booking_code' => $booking->booking_code,
			'transaction_date' => $booking->transaction_date,
			'checkin' => $booking->check_in_date,
			'checkout' => $booking->check_out_date,
			'adult' => $booking->adult,
			'kid' => $booking->kid,
			'total_amount' => $booking->total_amount,
			'message' => $booking->message,
			'png' => $qr

		], function($message) use ($booking) {
			$message->to($booking->email);
			$message->subject('Đơn hàng của bạn');
		});
		// Check hinh thuc thanh toan
		if($request->payment==1){
			return redirect('/payment/'.$booking->id.'?bank_code='.$request->bank_code.'&language='.$request->language);
				}
		return redirect('profile/history/');
	}

	// Thanh toan VNPay
	public function payment(Request $request,$id)
	{
		$booking = Booking::findOrfail($id);
			// session(['cost_id' => $booking->id]);
			// session(['url_prev' => url()->previous()]);
		$vnp_TmnCode = $this->vnp_TmnCode;
		$vnp_HashSecret = $this->vnp_HashSecret;
		$vnp_Url = $this->vnp_Url;
		$vnp_Returnurl = $this->vnp_Returnurl;
	        $vnp_TxnRef = $booking->booking_code; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
	        $vnp_OrderInfo = "Thanh toán đơn đặt phòng!";
	        $vnp_OrderType = 'billpayment';
	        $vnp_Amount = $booking->total_amount * 100;
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
					$order = Booking::wherebooking_code($orderId)->value('payment');
					if ($order != NULL) {
						if ($order != NULL && $order == 0) {
							if ($inputData['vnp_ResponseCode'] == '00') {
								$Status = 1;
								$booking_id = Booking::wherebooking_code($orderId)->value('id');
								$booking = Booking::findOrfail($booking_id);
								$booking->status = 1;
								$booking->payment = 1;
								$booking->update();
				                // Gui mail
								$qr = QrCode::format('png')->size(200)->generate($booking->booking_code);
								Mail::send('email.payment',[
									'booking_code' => $booking->booking_code,
									'transaction_date' => $booking->transaction_date,
									'checkin' => $booking->check_in_date,
									'checkout' => $booking->check_out_date,
									'adult' => $booking->adult,
									'kid' => $booking->kid,
									'total_amount' => $booking->total_amount,
									'message' => $booking->message,
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


	// Vote booking
	public function vote($id){
		$booking = Booking::findOrfail($id);
		$vote = Vote::wherebooking_id($id)->first();
		if($booking->user_id==Auth::id()){
			return view('client.invoice.vote', compact('booking','vote'));
		}
		abort(404);
	}

	public function vote_store(VoteRequest $request, $id){
		$check_vote = Vote::wherebooking_id($id)->first();
		if($check_vote){
			$notification = array(
				'message' => trans('allclient.already_vote'),
				'alert-type' => 'info'
			);
			return back()->with($notification);
		}
		$vote = new Vote([
			'star' => $request->star,
			'title' => $request->title,
			'comment' => $request->comment,
			'booking_id' => $id
		]);
		$vote->save();
		return back()->with('message',trans('allclient.vote_success'));
	}

}

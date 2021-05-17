<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\BookTour\BookTourInterface;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Booktour;
use Mail;

class CheckTourController extends Controller
{

    protected $booktourRP;

    public function __construct(BookTourInterface $booktourInterface)
    {
        $this->middleware('permission:checkin-checkout-list|checkin-checkout-edit|checkin-checkout-show', ['only' => ['test']]);

        $this->middleware('permission:checkin-checkout-edit', ['only' => ['store','update']]);
        $this->booktourRP = $booktourInterface;
    }

    public function test()
    {
    	$result = 0;
    	return view('admin.checktour.index',compact('result'));
    }

	public function store(Request $request) 
    {
		$result = $this->booktourRP->getOnBookTourByCode($request->id);
		if ($result) {
			return view('admin.checktour.index',compact('result'));
		}else{
            $notification = array(
            'message' => trans('admin.wrong_booking'),
            'alert-type' => 'info'
            );
            return back()->with($notification);
        }

	}

    public function update(Request $request, $id)
    { 
        $book_tour = $this->booktourRP->find($id);
        $book_tour->status = $request->status;
        $result = $this->booktourRP->update($book_tour->id, $book_tour->toArray());
        if($book_tour->status==3){
            // Gui mail
                $qr = QrCode::format('png')->size(200)->generate(url('vote',$book_tour->id));
                Mail::send('email.vote',[
                    'id' => $book_tour->id,
                    'name' => $book_tour->fullname,
                    'png' => $qr

                ], function($message) use ($book_tour) {
                    $message->to($book_tour->email);
                    $message->subject('Please evaluate the quality of the service');
                });
        }
        return redirect()->route('checktour.test')->with('message', trans('message.success-edit'));
    }
}

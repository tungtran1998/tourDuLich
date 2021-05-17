<?php

namespace App\Http\Controllers\Client;

use App\Helpers\Helper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Session;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Repositories\User\UserInterface;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\BookTour;
class UserController extends Controller
{
	protected $userRP;

    public function __construct(UserInterface $userInterface)
    {
        $this->userRP = $userInterface;
        $this->middleware('verified');
    }

    public function profileUser()
    {
        $user = $this->userRP->find(Auth::id());
    	return view('client.user.userProfile',compact('user'));
    }
    public function profileUpdate(Request $request, $id)
    {
        
        $user = $this->userRP->find($id);

        $imageName = $user->image;

        if($request->hasFile('image')){
                $helper = new Helper();
                $imageName = $helper->uploadFile(request('image'));
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->gender = $request->gender;
        // $user->email = $request->email;
        $user->image = $imageName;
        $user->street = $request->street;
        $user->state = $request->state;
        $user->city = $request->city;
        $user->phone = $request->phone;
        $user->nationality = $request->nationality;
        $user->dateofbirth = $request->dateofbirth;
        
        $result = $this->userRP->update($id, $user->toArray());
        if ($result){
            $notification = array(
            'message' => trans('allclient.update_infor_success'),
            'alert-type' => 'success'
            );
            return back()->with($notification);
        }else{
            return back()->with('err','Update error!');
        }

    }

    public function changePassword()
    {
    	return view('client.user.changePassword');
    }

    public function postPassword (ChangePasswordRequest $request){

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
             $notification1 = array(
            'message' => trans('allclient.changepassword'),
            'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification1);
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            $notification2 = array(
            'message' => trans('allclient.samepassword'),
            'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification2);
        }

        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        $notification3 = array(
            'message' => trans('allclient.success'),
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification3);

    }

    public function history()
    {


        $tour = BookTour::where('user_id',Auth::id())->where('isdeleted',0)->orderBy('status', 'asc')->orderBy('created_at', 'desc')->get();
        return view('client.user.history', compact('tour'));
    }


    public function delete_tour($id)
    {
        $tour =BookTour::findOrfail($id);
        $tour->update([
           'isdeleted' => true,
        ]);
        return redirect()->route('profile.history');
    }

    public function tourDetail($id)
    {
        $user = User::findOrfail(Auth::id());
        $book_tour = BookTour::findOrfail($id);
        $canDeleteBooking = strtotime($book_tour->transaction_date) + (86400 * 4);
        $current = strtotime(Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d'));
        $can = null;
        if ($current <= $canDeleteBooking) {
            if ($book_tour->status == '0') {
                $can = 1;
            }else{
                $can = 0;
            }
        }else{
            $can = 0;
        }
        
        return view('client.user.tour_detail', compact('book_tour','user','can'));
    }


}

<?php
namespace App\Http\Controllers\Client;
use App\Notifications\FeedbackNotification;
use App\Events\MyEvent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Mail;
use App\Http\Requests\FeedbackRequest;
use App\Models\User;
use Auth;
class FeedbackController extends Controller
{
    public function index(){
    	return view('client.feedback.feedback');
    }
    public function store(FeedbackRequest $request){
    	$feedback = new Feedback([
    		'name' => $request->name,
    		'email' => $request->email,
            'title' => $request->title,
            'content' => $request->content,
        ]);
    	$feedback->save();
        //Notification
        $notification = [
            'title' => 'There is a new feedback',
            'content'=> 'There is a new feedback',
            'id' => $feedback->id,
        ];
        $resultNotification = $feedback->notify( new FeedbackNotification($notification));
        event(new MyEvent('There is a new feedback',$feedback->id));
        $notification = array(
            'message' => trans('allclient.success_feedback'),
            'alert-type' => 'success'
        );
        return back()->with($notification);
    }
}

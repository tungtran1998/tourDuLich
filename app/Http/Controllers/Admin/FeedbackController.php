<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\FeedBack\FeedBackInterface;
use App\Repositories\Admin\AdminInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Feedback;
use App\Models\Admin;
use Mail;
use Illuminate\Support\Facades\Auth;
class FeedbackController extends Controller
{

    protected $adminRP;
    protected $feedbackRP;

    public function __construct(AdminInterface $adminInterface, FeedBackInterface $feedBackInterface){
        $this->middleware('permission:feedback-list|feedback-reply|feedback-edit', ['only' => ['index']]);
        $this->middleware('permission:feedback-reply', ['only' => ['reply','update']]);
        $this->adminRP = $adminInterface;
        $this->feedbackRP = $feedBackInterface;   
    }
    
    public function index(){

    	$feedbacks = $this->feedbackRP->getAllFeedBack();

    	foreach ($feedbacks as $key=> $data) {
            $feedbacks[$key]->reply_by = Admin::where('id',$data->reply_by)->value('name');
        }
        return view('admin.feedback.index', compact('feedbacks'));
    }

    public function reply($id){
    	$feedback = $this->feedbackRP->find($id);
    	$feedback->reply_by = Admin::whereid($feedback->reply_by)->value('name');
    	return view('admin.feedback.reply', compact('feedback'));
    }

    public function update($id, Request $request){
    	$feedback = $this->feedbackRP->find($id);
    	$feedback->reply = $request->reply;
    	$feedback->reply_by = Auth::id();
        $result = $this->feedbackRP->update($id, $feedback->toArray());
    	// Gui mail
        Mail::send('email.feedback',[
            'id' => $feedback->id,
            'name' => $feedback->name,
            'mail' => $feedback->email,
            'content' => $feedback->content,
            'reply' => $feedback->reply,
            'reply_by' => $feedback->reply_by,

        ], function($message) use ($feedback) {
            $message->to($feedback->email);
            $message->subject('Phản hồi góp ý');
        });
        if ($result){
            return back()->with('message',trans('message.Reply'));
        }else{
            return back()->with('message',trans('message.update_error'));
        }
    }

}

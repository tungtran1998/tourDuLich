<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\MyEvent;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use App\Models\User;

use App\Repositories\Notification\NotificationInterface;

class NotificationController extends Controller
{

    protected $notificationRP;

    public function __construct(NotificationInterface $notificationInterface)
    {
        $this->notificationRP = $notificationInterface;
    }

    public function show($id)
    {        
        $notification = $this->notificationRP->findNotification($id);
        if ($notification && $notification->type == "App\Notifications\FeedbackNotification") {
            
            $notification->read_at = now();
            $notification->update();
            return redirect()->route('feedback.index');
        }
        if ($notification && $notification->type == "App\Notifications\BookingNotification") {
            
            $notification->read_at = now();
            $notification->update();
            return redirect()->route('booking.index');
        }
        if ($notification && $notification->type == "App\Notifications\TestNotification") {
            
            $notification->read_at = now();
            $notification->update();
            return redirect()->route('booking.indexCheckout');
        }
    }

    public function ShowHight($id)
    {
        $data = auth()->user()->notifications()->get();
        $user = User::get();
        $idResult = null;
        foreach ($user as $value) {
            $b = $value->notifications()->get();
            foreach ($b as $r) {
                if ($r->data['id'] == $id) {
                    $idResult = $r->id;
                }
            }
        }
        $notification = $this->notificationRP->findNotification($idResult);
        if ($notification && $notification->type == "App\Notifications\FeedbackNotification") {
            
            $notification->read_at = now();
            $notification->update();
            return redirect()->route('feedback.index');
        }
        if ($notification && $notification->type == "App\Notifications\BookingNotification") {
            
            $notification->read_at = now();
            $notification->update();
            return redirect()->route('booking.index');
        }
        if ($notification && $notification->type == "App\Notifications\TestNotification") {
            
            $notification->read_at = now();
            $notification->update();
            return redirect()->route('booking.indexCheckout');
        }
    }
}

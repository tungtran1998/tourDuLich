<?php

namespace App\Providers;

use App\Models\Notification;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Notifications\TestNotification;
use App\Events\MyEvent;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('admin.layouts.main', function($view){

            $notifications = DB::table('notifications')->where('read_at', null)->orderBy('created_at', 'desc')->get();
            $view->with('notifications', $notifications);
        });
        
    }
}   

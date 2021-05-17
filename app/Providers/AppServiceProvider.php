<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Illuminate\Support\Facades\Auth;    // Must Must use
use Illuminate\Support\Facades\Blade;   // Must Must use
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\Schema;
use App\Repositories\News\NewsInterface;
use App\Repositories\News\NewsRepository;
use App\Repositories\Admin\AdminInterface;
use App\Repositories\Admin\AdminRepository;
use App\Repositories\FeedBack\FeedBackInterface;
use App\Repositories\FeedBack\FeedBackRepository;
use App\Repositories\Notification\NotificationInterface;
use App\Repositories\Notification\NotificationRepository;
//tour
use App\Repositories\Tour\TourInterface;
use App\Repositories\Tour\TourRepository;
//province
use App\Repositories\Province\ProvinceInterface;
use App\Repositories\Province\ProvinceRepository;
//booktour
use App\Repositories\BookTour\BookTourInterface;
use App\Repositories\BookTour\BookTourRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
        $this->app->bind(
            UserInterface::class,
            UserRepository::class
        );
       
        $this->app->bind(
            NewsInterface::class,
            NewsRepository::class
        );
        
        $this->app->bind(
            AdminInterface::class,
            AdminRepository::class
        );
        
        $this->app->bind(
            FeedBackInterface::class,
            FeedBackRepository::class
        );
       
        $this->app->bind(
            NotificationInterface::class,
            NotificationRepository::class
        );
        
        //province
        $this->app->bind(
            ProvinceInterface::class,
            ProvinceRepository::class
        );
        //tour
        $this->app->bind(
            TourInterface::class,
            TourRepository::class
        );
        //booktour
        $this->app->bind(
            BookTourInterface::class,
            BookTourRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
    }
}

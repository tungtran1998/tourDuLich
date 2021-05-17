<?php
Auth::routes(['verify' => true]);

Route::namespace('Client')->group(function () {
  //Google
  Route::get('auth/google', 'LoginController@redirectToGoogle');
  Route::get('auth/google/callback', 'LoginController@handleGoogleCallback');
  //Da Ngon Ngu
  Route::get('clientlang/{lang}','HomeController@changeLang')->name('clientlang');
  //Login
  Route::get('/login', 'LoginController@showLoginForm')->name('client.login');
  Route::post('/login', 'LoginController@clientLogin')->name('client.login');
  //Logout
  Route::post('/logout', 'LoginController@logout')->name('client.logout');
  Route::get('term','HomeController@term')->name('term');


  //New
  Route::get('news','HomeController@news')->name('news');
  Route::get('news/{slug}','HomeController@newsDetail')->name('news_detail');

  //Feedback
  Route::get('feedback','FeedbackController@index')->name('feedback');
  Route::post('feedback/store','FeedbackController@store')->name('feedback.store');


  //Member
  Route::post('member/store','HomeController@member')->name('member.store');

  //Introduce
  Route::get('introduce','HomeController@introduce')->name('introduce');


  //Search new tour
  Route::get('search-news-tour', 'TourController@searchnew')->name('searchnews');


  
  //Search Tour
   Route::get('search_tour','TourController@search_tour')->name('search_tour');
  //Tour
  Route::get('/', 'TourController@home')->name('home.client');

  //All Tour
   Route::get('tour','TourController@allTour')->name('tour');
  //Discount Tour
   Route::get('tour-discount','TourController@tourDiscount')->name('discount');

  //Tour Detail
  Route::get('tour-detail/{id}/', 'TourController@tourDetail')->name('tour.detail');





  Route::group(['middleware' => ['auth']], function () {

      // Checkout

     

      //tour
       Route::get('paymenttour/{id}','TourController@payment')->name('paymenttour');
      Route::get('result_paymentt','TourController@result_payment')->name('result_paymentt');

      Route::post('check_tour','TourController@check_tour')->name('check_tour')->middleware('verified');
      Route::post('checkouttour','TourController@checkout')->name('checkouttour')->middleware('verified');
      //tour
      //profileUser
		  Route::group(['prefix'=>'profile'],function () {

        Route::get('user', 'UserController@profileUser')->name('profile.profileUser');
        Route::put('updateuser/{id}', 'UserController@profileUpdate')->name('profile.updateuser');

        Route::get('history', 'UserController@history')->name('profile.history');
        //tour
        Route::get('tour_detail/{id}','UserController@tourDetail')->name('tour_detail');
        Route::put('updatetour/{id}','UserController@delete_tour')->name('updatetour.update');
        Route::get('/changePassword', 'UserController@changePassword')->name('profile.changePassword');
        Route::post('/changePass','UserController@postPassword')->name('changePass');
		});
  });
});

    
        



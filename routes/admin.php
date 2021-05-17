<?php
use App\Notification;
use Illuminate\Support\Facades\Route;


Route::namespace('Admin')->group(function () {

	//Da ngon ngu
	Route::get('lang/{lang}','HomeController@changeLang')->name('lang');
	//Login
	Route::get('/login', 'LoginController@showLoginForm')->name('admin.loginadmin');
	Route::post('/login', 'LoginController@adminLogin')->name('admin.login');
	Route::post('logout', 'LoginController@logout')->name('admin.logout');
	Route::get('/error404','HomeController@error404')->name('error404');
	Route::group(['middleware' => ['auth:admin']], function () {

		Route::get('/dashboard', 'HomeController@index')->name('dashboard');
		Route::get('/chart', 'HomeController@chart');

		Route::get('bookingExpire/{email}', 'HomeController@sendNoti')->name('bookingExpire');

	//User
		Route::group(['prefix'=>'user'],function () {
			Route::get('/', 'UserController@index')->name('user.index');
			Route::get('/{id}', 'UserController@show')->name('user.show');
			Route::post('edit/status/{id}', 'UserController@editStatus')->name('user.editStatus');
			Route::get('get/export', 'UserController@export')->name('user.export');
		});
		Route::delete('user_delete', 'UserController@destroy')->name('user_delete');
	//Role
		Route::resource('roles','RoleController');
		Route::delete('role_delete', 'RoleController@destroy')->name('role_delete');
	//Admin	
        Route::resource('admin','AdminController');
        Route::delete('admin_delete', 'AdminController@destroy')->name('admin_delete');
    //Profile Admin
        Route::get('adminProfile/{id}','AdminController@adminProfile')->name('adminProfile');
        Route::post('postchange','AdminController@postchange')->name('postchange');
	//Bookingtour
		Route::group(['prefix'=>'booktour'],function () {
			Route::get('/', 'BooktourController@index')->name('booktour.index');
			Route::get('check-out-listing', 'BooktourController@indexCheckout')->name('booktour.indexCheckout');
			Route::get('/create', 'BooktourController@create')->name('booktour.create');
			Route::post('/','BooktourController@store')->name('booktour.store');
			Route::put('/{id}','BooktourController@update')->name('booktour.update');
			Route::get('/{id}/edit', 'BooktourController@edit')->name('booktour.edit');
			Route::get('/{id}', 'BooktourController@show')->name('booktour.show');
			Route::get('get/export', 'BooktourController@export')->name('booktour.export');
		});
		Route::delete('booktour_delete', 'BooktourController@destroy')->name('booktour_delete');
	//Check Tour
		Route::group(['prefix'=>'checktour'],function () {
			Route::get('test','CheckTourController@test')->name('checktour.test');
			Route::post('/testqr','CheckTourController@store')->name('checktour.qr');
			Route::put('/{id}','CheckTourController@update')->name('checktour.update');
		});

	//Statistics
		Route::group(['prefix'=>'statistic'],function () {
			Route::get('/statistic', 'StatisticalController@statistic')->name('statistic.year');
			Route::get('/revenueStatistics', 'StatisticalController@revenueStatistics');
			Route::get('/statisticMonth', 'StatisticalController@statisticMonth')->name('statistic.month');
			Route::get('/revenueStatisticsMonth', 'StatisticalController@revenueStatisticsMonth');
			Route::get('/calendar', 'StatisticalController@calendar')->name('statistic.calendar');
		});
	//News
		Route::group(['prefix'=>'news'],function () {
			Route::get('/', 'NewsController@index')->name('news.index');
			Route::get('/create', 'NewsController@create')->name('news.create');
			Route::post('/','NewsController@store')->name('news.store');
			Route::put('/{id}','NewsController@update')->name('news.update');
			Route::get('/{id}/edit', 'NewsController@edit')->name('news.edit');
			Route::get('/{id}', 'NewsController@show')->name('news.show');
		});
		Route::delete('news_delete', 'NewsController@destroy')->name('news_delete');
	// Feedback
		Route::group(['prefix'=>'feedback'],function () {
			Route::get('/', 'FeedbackController@index')->name('feedback.index');
			Route::get('/{id}', 'FeedbackController@reply')->name('feedback.reply');
			Route::put('/{id}','FeedbackController@update')->name('feedback.update');
		});
	//Audits
		Route::get('audit','AuditController@index')->name('audit');
		Route::get('audit/{id}', 'AuditController@show')->name('audit.show');
	//Notification
		Route::get('notification/{id}', 'NotificationController@show')->name ('notification.show');
		Route::get('notificationHight/{id}', 'NotificationController@showHight')->name ('notification.showHight');

	//Province
		Route::resource('province','ProvinceController');
		Route::delete('province_delete', 'ProvinceController@destroy')->name('province_delete');

	//Tour
		Route::resource('tour','TourController');
		Route::delete('tour_delete', 'TourController@destroy')->name('tour_delete');
		Route::get('tour/get/export', 'TourController@export')->name('tour.export');














	});
});




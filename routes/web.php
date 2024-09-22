<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* START:Backend */


Route::group(['prefix' => 'backend', 'namespace' => 'Backend', 'as'=>'backend.'], function () {

	/* Auth */
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');
	Route::get('reload-captcha/', 'Auth\LoginController@reloadCaptcha');
	Route::group(['middleware' => ['auth:backend']], function () {


		/*---------- admin account ------*/
		Route::group(['prefix' => 'account', 'as'=>'account.'], function () {
			Route::get('profile', 'Auth\EditProfileController@showForm')->name('profile');
			Route::get('change-password', 'Auth\ChangePasswordController@showForm')->name('change-password');
			Route::post('postEditProfile', 'Auth\EditProfileController@postEditProfile')->name('postEditProfile');
			Route::post('postChangePassword', 'Auth\ChangePasswordController@postChangePassword')->name('postChangePassword');
			Route::post('postUpdateProfilePic', 'Auth\EditProfileController@postUpdateProfilePic')->name('postUpdateProfilePic');
		});


		Route::post('logout', 'Auth\LoginController@logout')->name('logout');
		Route::get('/', 'DashboardController@index')->name('dashboard');

		/* Users */
		Route::resource('users', 'UserController');
		Route::group(['prefix' => 'users', 'as'=>'users.'], function () {
        Route::post('change-status', 'UserController@changeStatus')->name('change-status');  
});

		/* Plan */
		Route::resource('plan', 'PlanController');


		/* Coupon */
		Route::resource('coupon', 'CouponController');

		/*----------------------------- selling -------------------------------*/



		Route::group(['prefix' => 'setting', 'as'=>'setting.'], function () {
       

		/*---- general selling ---*/
        
        Route::get('general', 'Setting\GeneralController@index')->name('general');
	    Route::group(['prefix' => 'general', 'as'=>'general.'], function () {


        Route::get('check_timezone', 'Setting\GeneralController@check_timezone')->name('check_timezone');

        Route::post('update', 'Setting\GeneralController@update')->name('update');

	   });

	   	/*---- mailer selling ---*/

		Route::resource('mailers', 'Setting\MailersController');

		Route::group(['prefix' => 'mailers', 'as'=>'mailers.'], function () {
        Route::post('change-status', 'Setting\MailersController@changeStatus')->name('change-status');  
       });


	 /*------- uploads setting -----*/

		Route::resource('uploads', 'Setting\UploadsController');
		
		Route::group(['prefix' => 'uploads', 'as'=>'uploads.'], function () {
        Route::post('change-status', 'Setting\UploadsController@changeStatus')->name('change-status');  
       });

	 /*------- uploads setting -----*/

		Route::resource('storage-provider', 'Setting\StorageProviderController');

		Route::group(['prefix' => 'storage-provider', 'as'=>'storage-provider.'], function () {
        Route::post('change-status', 'Setting\StorageProviderController@changeStatus')->name('change-status');  
       });


	  /*------- payment gateway setting -----*/

		Route::resource('payment-gateway', 'Setting\PaymentGatewayController');

		Route::group(['prefix' => 'payment-gateway', 'as'=>'payment-gateway.'], function () {
        Route::post('change-status', 'Setting\PaymentGatewayController@changeStatus')->name('change-status');  
       });

       });
	
	});

});
/* END:Backend */


/* START:Frontend */
Route::group(['namespace' => 'Frontend'], function () {

	/* Auth */
	Auth::routes(['verify' => true]);

	/*---------- user auth ------*/

	Route::get('/', 'HomeController@index')->name('home');

	Route::post('file-uploads', 'HomeController@fileUploads')->name('file-uploads');

	Route::group(['middleware' => ['auth:web']], function () {
		
		Route::get('verify-otp', 'Auth\TwoFactorController@verifyOTP')->name('verify-otp');
		Route::post('verify-otp', 'Auth\TwoFactorController@postVerifyOTP');
		Route::get('resend-otp', 'Auth\TwoFactorController@resendOTP')->name('resend-otp');
		Route::post('logout', 'Auth\LoginController@logout')->name('logout');

		Route::group(['middleware' => ['TwoFactor']], function () {

			/*---------- user account ------*/
			/*---- only verify user can able to access ---*/

			Route::group(['prefix' => 'account', 'as'=>'account.','middleware'=>['verified']], function () {
				
				Route::get('profile', 'Auth\EditProfileController@showForm')->name('profile');
				
				Route::get('change-password', 'Auth\ChangePasswordController@showForm')->name('change-password');
				Route::post('postEditProfile', 'Auth\EditProfileController@postEditProfile')->name('postEditProfile');
				Route::post('postChangePassword', 'Auth\ChangePasswordController@postChangePassword')->name('postChangePassword');
				Route::post('postUpdateProfilePic', 'Auth\EditProfileController@postUpdateProfilePic')->name('postUpdateProfilePic');

			});
		});
	});


});
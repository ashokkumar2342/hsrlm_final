<?php

use App\Http\Controllers\Admin\reportGenerateBarcode;
//registration start
// Route::prefix('resitration')->group(function () {
//     Route::get('form', 'AccountController@firststep')->name('student.resitration.firststep');
//      Route::post('form', 'AccountController@studentStore')->name('student.resitration.firststep.store');
//      Route::get('verification/{id}', 'AccountController@verification')->name('student.resitration.verification');
//      Route::post('mobile-verify', 'AccountController@verifyMobile')->name('student.resitration.verifyMobile');
//      Route::post('email-verify', 'AccountController@verifyEmail')->name('student.resitration.verifyEmail');
//      Route::get('resend-otp/{id?}/{otp_type}', 'AccountController@resendOTP')->name('student.resitration.resend.otp');
//      Route::get('resitration-form', 'AccountController@resitrationForm')->name('student.resitration.resitrationForm'); 
//  Route::get('resitration-form1', 'AccountController@resitrationForm')->name('student.resitration.resitrationForm'); 
// });
//registration end 
Route::get('/', 'Auth\LoginController@index')->name('admin.home');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login'); 
Route::get('admin-password/reset', 'Auth\ForgetPasswordController@sendResetLinkEmail')->name('admin.password.email');
Route::get('passwordreset/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
Route::get('logout', 'Auth\LoginController@logout')->name('admin.logout.get');
Route::post('login', 'Auth\LoginController@login');
Route::get('forget-password', 'Auth\LoginController@forgetPassword')->name('admin.forget.password');
Route::post('forget-password-send-link', 'Auth\LoginController@forgetPasswordSendLink')->name('admin.forget.password.send.link');
Route::post('reset-password', 'Auth\LoginController@resetPassword')->name('admin.reset.password');
Route::get('refreshcaptcha', 'Auth\LoginController@refreshCaptcha')->name('admin.refresh.captcha');
Route::group(['middleware' => 'admin'], function() {
	Route::get('dashboard', 'DashboardController@index')->name('admin.dashboard'); 
	Route::get('show-details', 'DashboardController@showStudentDetails')->name('admin.student.show.details');
	Route::get('registration-show-details', 'DashboardController@showStudentRegistrationDetails')->name('admin.student.Registration.details');
	Route::get('token', 'DashboardController@passportTokenCreate')->name('admin.token');
	Route::get('profile', 'DashboardController@proFile')->name('admin.profile');
	Route::get('profile-show', 'DashboardController@proFileShow')->name('admin.profile.show');
	Route::get('profile-show/{profile_pic}', 'DashboardController@proFilePhotoShow')->name('admin.profile.photo.show'); 
	Route::post('profile-update', 'DashboardController@profileUpdate')->name('admin.profile.update');
	Route::post('password-change', 'DashboardController@passwordChange')->name('admin.password.change');
	Route::get('profile-photo', 'DashboardController@profilePhoto')->name('admin.profile.photo');
	Route::post('upload-photo', 'DashboardController@profilePhotoUpload')->name('admin.profile.photo.upload');
	Route::get('photo-refrash', 'DashboardController@profilePhotoRefrash')->name('admin.profile.photo.refrash');
	//---------------account-----------------------------------------	
	Route::prefix('account')->group(function () {
	    Route::get('user-list', 'AccountController@userList')->name('admin.account.user.list');
	    Route::get('user-list-table', 'AccountController@userListTable')->name('admin.account.user.list.table');
	    Route::get('add-user/{id?}', 'AccountController@addUser')->name('admin.account.add.user');
	    Route::post('user-store/{id?}', 'AccountController@userStore')->name('admin.account.user.store');
		
		
	});
	Route::prefix('master')->group(function () {
	    Route::get('village-list', 'MasterController@villageList')->name('admin.master.village.list');
	    Route::get('add-village/{id?}', 'MasterController@addVillage')->name('admin.master.add.village');
	    Route::get('village-list-table', 'MasterController@villageListTable')->name('admin.master.village.list.table');
	    Route::post('village-store/{id?}', 'MasterController@villageStore')->name('admin.master.village.store');
		
	 Route::get('items-list', 'MasterController@itemsList')->name('admin.master.items.list');
	 Route::get('add-items/{id?}', 'MasterController@addItems')->name('admin.master.add.items');
	 Route::post('add-store/{id?}', 'MasterController@storeItems')->name('admin.master.items.store');
	 Route::get('item-image/{id?}', 'MasterController@itemsImage')->name('admin.master.items.image');


	 Route::get('rate-list', 'MasterController@rateList')->name('admin.master.rate.list');
	 Route::get('rate-list-price', 'MasterController@rateListPrice')->name('admin.master.rate.list.price');
	 Route::post('rate-list-store', 'MasterController@rateListPriceStore')->name('admin.master.rate.list.price.store');

	 Route::post('rate-store/{id?}', 'MasterController@storeRate')->name('admin.master.rate.store');
	});
 	Route::prefix('maping')->group(function () {
 	    Route::get('village-farmer', 'MasterController@villageFarmer')->name('admin.village.farmer');
 	    Route::post('village-farmer-store', 'MasterController@villageFarmerStore')->name('admin.village.farmer.store');
 	    Route::get('village-farmer-to-user', 'MasterController@villageFarmerToUser')->name('admin.village.farmer.to.user');

 	    Route::get('village-vendor', 'MasterController@villageVendor')->name('admin.village.vendor');
 	    Route::get('village-vendor-to-user', 'MasterController@villageVendorToUser')->name('admin.village.vendor.to.user');
 	    Route::post('village-vendor-store', 'MasterController@villageVendorStore')->name('admin.village.vendor.store');
 	    Route::get('cluster-village', 'MasterController@villageCluster')->name('admin.cluster.village');
 	    Route::get('cluster-village-to-user', 'MasterController@villageClusterToUser')->name('admin.cluster.village.to.user');
 	    Route::post('cluster-village-store', 'MasterController@villageClusterStore')->name('admin.cluster.village.store');
 	    Route::get('delevery-village', 'MasterController@deliveryVillage')->name('admin.delivery.village');    
 	});
	
            
            
           

            

});
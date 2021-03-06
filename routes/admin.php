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
	    Route::get('village-delete/{id?}', 'MasterController@villagedelete')->name('admin.master.village.delete');
		
	 Route::get('items-list', 'MasterController@itemsList')->name('admin.master.items.list');
	 Route::get('add-items/{id?}', 'MasterController@addItems')->name('admin.master.add.items');
	 Route::post('add-store/{id?}', 'MasterController@storeItems')->name('admin.master.items.store');
	 Route::get('item-image/{id?}', 'MasterController@itemsImage')->name('admin.master.items.image');
	 Route::get('item-delete/{id?}', 'MasterController@itemsDelete')->name('admin.master.items.delete');


	 Route::get('rate-list', 'MasterController@rateList')->name('admin.master.rate.list');
	 Route::get('rate-list-price', 'MasterController@rateListPrice')->name('admin.master.rate.list.price');
	 Route::get('rate-list-price.farmer', 'MasterController@rateListPriceFarmer')->name('admin.master.rate.list.price.farmer');
	 Route::post('rate-list-farmer-store', 'MasterController@rateListPriceFarmerStore')->name('admin.master.rate.list.price.farmer.store');
	 Route::post('rate-list-store', 'MasterController@rateListPriceStore')->name('admin.master.rate.list.price.store');

	 Route::post('rate-store/{id?}', 'MasterController@storeRate')->name('admin.master.rate.store');

	Route::get('user-bank-details', 'MasterController@userBankDetails')->name('admin.master.user.bank.details'); 
	Route::get('show-bank-details', 'MasterController@showBankDetails')->name('admin.master.show.bank.details'); 
	Route::post('store-bank-details', 'MasterController@storeBankDetails')->name('admin.master.store.bank.details'); 
	});
 	Route::prefix('maping')->group(function () {
 	    Route::get('village-farmer', 'MasterController@villageFarmer')->name('admin.village.farmer');
 	    Route::post('village-farmer-store', 'MasterController@villageFarmerStore')->name('admin.village.farmer.store');
 	    Route::get('village-farmer-to-user', 'MasterController@villageFarmerToUser')->name('admin.village.farmer.to.user');
 	    Route::get('village-farmer-report/{id?}/{report_type}', 'MasterController@villageFarmerReport')->name('admin.village.farmer.report');

 	    Route::get('village-vendor', 'MasterController@villageVendor')->name('admin.village.vendor');
 	    Route::get('village-vendor-to-user', 'MasterController@villageVendorToUser')->name('admin.village.vendor.to.user');
 	    Route::post('village-vendor-store', 'MasterController@villageVendorStore')->name('admin.village.vendor.store');
 	    Route::get('village-vendor-report/{id?}', 'MasterController@villageVendorReport')->name('admin.village.vendor.report');

 	    Route::get('cluster-village', 'MasterController@villageCluster')->name('admin.cluster.village');
 	    Route::get('cluster-village-to-user', 'MasterController@villageClusterToUser')->name('admin.cluster.village.to.user');
 	    Route::post('cluster-village-store', 'MasterController@villageClusterStore')->name('admin.cluster.village.store');
 	    Route::get('village-cluster-report/{id?}', 'MasterController@villageClusterReport')->name('admin.village.cluster.report');

 	   Route::get('delevery-village', 'MasterController@deliveryVillage')->name('admin.delivery.village');
 	   Route::get('delevery-village-to-user', 'MasterController@villageDeleveryToUser')->name('admin.delevery.village.to.user');
 	   Route::post('delevery-village-store', 'MasterController@villageDeleveryStore')->name('admin.delevery.village.store');
 	   Route::get('village-cluster-delevery-report/{id?}/{vill_clus_shg}', 'MasterController@villageClusterDeleveryReport')->name('admin.village.cluster.delevery.report');    
 	});
 	
 	   Route::prefix('order')->group(function () {
 	   	Route::get('/', 'OrderController@index')->name('admin.order.index');
 	   	Route::get('user-order-list/{user_type_id}', 'OrderController@userOrderList')->name('admin.order.user.order.list');
 	   	Route::get('user-order-list-view/{user_id}/{for_date}', 'OrderController@userOrderListView')->name('admin.order.user.order.list.view'); 
 	   	Route::post('user-order-list-export', 'OrderController@userOrderListExport')->name('admin.order.user.order.list.export'); 

 	   	Route::get('order-list/{user_type}', 'OrderController@orderList')->name('delivery.order.list');
 	   	Route::get('user-order-list-delevery/{user_type}', 'OrderController@userTypeOrderList')->name('delevery.order.user.order.list');
 	   	Route::get('delevery-user-order-list-view/{user_id}/{for_date}', 'OrderController@userTypeOrderListView')->name('delevery.order.user.order.view');
 	   	Route::post('delevery-user-order-list-store/{for_date}', 'OrderController@userTypeOrderListStore')->name('delevery.order.user.order.store');

 		});
 	   Route::prefix('passbook')->group(function () {
 	   
 	   	Route::get('/', 'PassbookController@list')->name('admin.vender.passbook');
 	   	Route::post('passbok-table', 'PassbookController@passbookTable')->name('admin.vender.passbook.table');
 	   	 

 		});
 	   Route::prefix('finance')->group(function () {
 	   	Route::get('/', 'FinanceController@index')->name('admin.delivery.finance');
 	   	Route::get('user-list/{id?}', 'FinanceController@userList')->name('admin.delivery.finance.userList');
 	   	Route::get('user-list-payment/{id?}/{user_type_id}', 'FinanceController@userListPayment')->name('admin.delivery.finance.userList.payment');
 	   	Route::post('user-list-payment-store/{id}/{user_type_id}', 'FinanceController@userListPaymentStore')->name('admin.delivery.finance.userList.payment.store');
 	   	 

 		});


	
            
            
           

            

});
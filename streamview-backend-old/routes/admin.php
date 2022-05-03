<?php

Route::group(['middleware' => 'web'], function() {

	Route::get('/clear-cache', 'ApplicationController@clear_cache')->name('clear-cache');

	/***********************  UI Routes *********************/

	/*********************** TEST ROUTES *********************/
	
	Route::any('/interview_tasks' , 'SampleController@interview_tasks');

	Route::get('/sample' , 'SampleController@sample');

	Route::post('/test' , 'SampleController@get_image')->name('sample');
	
	Route::get('/export' , 'SampleController@sample_export');

	Route::get('/compress' , 'SampleController@compress_image_upload')->name('compress.image');

	Route::get('/compress/i' , 'SampleController@compress_image_check');

	Route::post('/compress/image' , 'SampleController@getImageThumbnail');

	Route::get('/sendpush' , 'SampleController@send_push_notification');

	/*********************** TEST ROUTES *********************/

	Route::get('/generate/index' , 'ApplicationController@generate_index');

	Route::get('generate_player_data' , 'ApplicationController@generate_player_data');

	Route::get('admin_videos_auto_clear_cron' , 'ApplicationController@admin_videos_auto_clear_cron');

	Route::get('demo_credential_cron' , 'ApplicationController@demo_credential_cron');
	    
	    
	// Used For Version Upgrade - V6.0 Referral Option

	Route::get('generate_referral_code', 'ApplicationController@generate_referral_code')->name('generate_referral_code');

	Route::get('generate_pages_unique', 'ApplicationController@generate_pages_unique')->name('generate_pages_unique');


	// Singout from all devices which is expired account

	Route::get('signout/all/devices', 'ApplicationController@signout_all_devices');

	Route::get('/email/verification' , 'ApplicationController@email_verify')->name('email.verify');

	Route::get('/check/token', 'ApplicationController@check_token_expiry')->name('check_token_expiry');

	// Installation

	Route::get('/configuration', 'InstallationController@install')->name('installTheme');

	Route::get('/system/check', 'InstallationController@system_check_process')->name('system-check');

	Route::post('/configuration', 'InstallationController@theme_check_process')->name('install.theme');

	Route::post('/install/settings', 'InstallationController@settings_process')->name('install.settings');

	Route::get('/embed', 'UserController@embed_video')->name('embed_video');


	// CRON

	Route::get('/publish/video', 'ApplicationController@cron_publish_video')->name('publish');

	Route::get('/notification/payment', 'ApplicationController@send_notification_user_payment')->name('notification.user.payment');

	Route::get('/payment/expiry', 'ApplicationController@user_payment_expiry')->name('user.payment.expiry');

	Route::get('/payment/failure' , 'ApplicationController@payment_failure')->name('payment.failure');

	Route::get('/automatic/renewal', 'ApplicationController@automatic_renewal_stripe')->name('automatic.renewal');

	Route::get('check/download/status', 'ApplicationController@checkDownloadVideoStatus')->name('checkDownloadVideoStatus');

	// Generral configuration routes 

	Route::post('project/configurations' , 'ApplicationController@configuration_site');


	// Static Pages

	Route::get('/privacy', 'UserApiController@privacy')->name('user.privacy');

	Route::get('/terms_condition', 'UserApiController@terms')->name('user.terms');

	Route::get('/static/terms', 'UserApiController@terms')->name('static.terms');

	Route::get('/privacy_policy', 'ApplicationController@privacy')->name('user.privacy_policy');

	Route::get('/terms', 'ApplicationController@terms')->name('user.terms-condition');

	Route::get('/about', 'ApplicationController@about')->name('user.about');

	// Video upload 

	Route::post('select/sub_category' , 'ApplicationController@select_sub_category')->name('select.sub_category');

	Route::post('select/genre' , 'ApplicationController@select_genre')->name('select.genre');

	Route::get('/admin-control', 'ApplicationController@admin_control')->name('admin_control');

	Route::post('save_admin_control', 'ApplicationController@save_admin_control')->name('save_admin_control');

	Route::get('/admin/check_role', 'AdminController@check_role');


	Route::get('/', 'AdminController@dashboard')->name('dashboard');


	Route::group(['prefix' => 'admin'  , 'as' => 'admin.'], function() {

	    Route::get('/', 'AdminController@dashboard')->name('dashboard');

	    Route::get('login', 'Auth\AdminAuthController@showLoginForm')->name('login');

	    Route::post('login', 'Auth\AdminAuthController@login')->name('login.post');

	    Route::get('logout', 'Auth\AdminAuthController@logout')->name('logout');

	    // Registration Routes...

	    Route::get('register', 'Auth\AdminAuthController@showRegistrationForm');

	    Route::post('register', 'Auth\AdminAuthController@register');

	    // Password Reset Routes...
	    Route::get('password/reset/{token?}', 'Auth\AdminPasswordController@showResetForm');

	    Route::post('password/email', 'Auth\AdminPasswordController@sendResetLinkEmail');

	    Route::post('password/reset', 'Auth\AdminPasswordController@reset');

	    //  Admin User Methods starts

	    Route::get('/users', 'AdminController@users_index')->name('users.index');

	    Route::get('users/create', 'AdminController@users_create')->name('users.create');

	    Route::get('users/edit', 'AdminController@users_edit')->name('users.edit');

	    Route::post('users/create', 'AdminController@users_save')->name('users.save');

	    Route::get('/users/view', 'AdminController@users_view')->name('users.view');

	    Route::get('users/delete', 'AdminController@users_delete')->name('users.delete');

	    Route::get('users/status/change', 'AdminController@users_status_change')->name('users.status.change');
	    
	    Route::get('/users/verify', 'AdminController@users_verify_status')->name('users.verify');

	    Route::get('/users/upgrade', 'AdminController@users_upgrade')->name('users.upgrade');

	    Route::any('users/upgrade-disable', 'AdminController@users_upgrade_disable')->name('users.upgrade.disable');

	    Route::get('/users/subprofiles', 'AdminController@users_sub_profiles')->name('users.subprofiles');

	    Route::get('/users/clear-login', 'AdminController@users_clear_login')->name('users.clear-login');

	    Route::get('/uses/subscriptions', 'AdminController@users_subscriptions')->name('subscriptions.plans');

	    Route::get('/users/wallet/{id}', 'AdminController@users_wallet')->name('users.wallet');

	    //  Admin Users History - admin

	    Route::get('/users/history', 'AdminController@users_history')->name('users.history');

	    Route::get('users/history/remove', 'AdminController@users_history_remove')->name('users.history.remove');
	    
	    //  Admin Users Wishlist - admin

	    Route::get('/users/wishlist', 'AdminController@users_wishlist')->name('users.wishlist');

	    Route::get('/users/wishlist/remove', 'AdminController@users_wishlist_remove')->name('users.wishlist.remove');

	    Route::post('/users/subscriptions/disable', 'AdminController@users_auto_subscription_disable')->name('subscriptions.cancel');

	    Route::get('/users/subscriptions/enable', 'AdminController@users_auto_subscription_enable')->name('subscriptions.enable');

	    Route::post('/users/bulk_action', 'AdminController@users_bulk_action')->name('users.bulk_action');
	    

	    //  Admin User Methods Ends

	    //  Admin moderators Methods begins

	    Route::get('/moderators', 'AdminController@moderators_index')->name('moderators.index');

	    Route::get('/moderators/create', 'AdminController@moderators_create')->name('moderators.create');

	    Route::get('/moderators/edit', 'AdminController@moderators_edit')->name('moderators.edit');

	    Route::post('/moderators/create', 'AdminController@moderators_save')->name('moderators.save');

	    Route::get('/moderators/delete', 'AdminController@moderators_delete')->name('moderators.delete');

	    Route::get('/moderators/view', 'AdminController@moderators_view')->name('moderators.view');

	    Route::get('/moderators/videos','AdminController@moderators_videos')->name('moderators.videos.index');

	    Route::get('moderators/status/change', 'AdminController@moderators_status_change')->name('moderators.status.change');


	    Route::get('/moderator/videos/{id}','AdminController@moderator_videos')->name('moderator.videos.list');

	    Route::post('/moderator/bulk_action', 'AdminController@moderators_bulk_action')->name('moderators.bulk_action');


	    Route::get('moderators/redeems', 'AdminController@moderators_redeem_requests')->name('moderators.redeems');

	    Route::any('/moderators/redeems/cancel', 'AdminController@moderators_redeems_request_cancel')->name('moderators.redeems.cancel');

	    Route::any('/moderators/payout/invoice', 'AdminController@moderators_redeems_payout_invoice')->name('moderators.payout.invoice');

	    Route::post('moderators/payout/direct', 'AdminController@moderators_redeems_payout_direct')->name('moderators.payout.direct');

	    Route::any('/moderators/payout/response', 'AdminController@moderators_redeems_payout_response')->name('moderators.payout.response');

	    // Redeem Pay from Paypal

	    Route::get('moderator/redeem-pay', 'RedeemPaymentController@redeem_pay')->name('moderator.redeem_pay');

	    Route::get('moderator/redeem-pay-status', 'RedeemPaymentController@redeem_pay_status')->name('moderator.redeem_pay_status');
	    
	    // Admin moderators Methods ends


	    // Admin Categories Methods begins

	    Route::get('/categories', 'AdminController@categories_index')->name('categories.index');

	    Route::get('/categories/create', 'AdminController@categories_create')->name('categories.create');

	    Route::get('/categories/edit', 'AdminController@categories_edit')->name('categories.edit');

	    Route::post('/categories/create', 'AdminController@categories_save')->name('categories.save');

	    Route::get('/categories/delete', 'AdminController@categories_delete')->name('categories.delete');

	    Route::get('/categories/view', 'AdminController@categories_view')->name('categories.view');

	    Route::get('categories/status/change', 'AdminController@categories_status_change')->name('categories.status.change');

	    // USER HOME PAGE DISPLAY
	    
	    Route::get('categories/home/status', 'AdminController@categories_home_status')->name('categories.home.status');

	    // Admin Categories Methods ends

	    // Admin Sub Categories Methods begins

	    Route::get('/sub_categories/{category_id?}', 'AdminController@sub_categories_index')->name('sub_categories.index');

	    Route::get('/sub_categories/create/{category_id?}', 'AdminController@sub_categories_create')->name('sub_categories.create');

	    Route::get('/sub_categories/edit/{sub_category_id?}', 'AdminController@sub_categories_edit')->name('sub_categories.edit');

	    Route::post('/sub_categories/create/{sub_category_id?}', 'AdminController@sub_categories_save')->name('sub_categories.save');

	    Route::get('/sub_categories/delete/{sub_category_id?}', 'AdminController@sub_categories_delete')->name('sub_categories.delete');

	    Route::get('/sub_categories/view/{category_id?}&{sub_category_id?}', 'AdminController@sub_categories_view')->name('sub_categories.view');

	    Route::get('sub_categories/status/change/{sub_category_id?}', 'AdminController@sub_categories_status_change')->name('sub_categories.status.change');

	    // Admin Sub Categories Methods ends

	    // Admin Genres Methods begins

	    Route::get('/genres/{sub_category_id?}', 'AdminController@genres_index')->name('genres.index');

	    Route::get('/genres/create/{sub_category_id?}', 'AdminController@genres_create')->name('genres.create');

	    Route::get('/genres/edit/{genre_id?}', 'AdminController@genres_edit')->name('genres.edit');

	    Route::post('/genres/create', 'AdminController@genres_save')->name('genres.save');

	    Route::get('/genres/delete/{genre_id?}', 'AdminController@genres_delete')->name('genres.delete');

	    Route::get('/genres/view/{sub_category_id?}&{genre_id?}', 'AdminController@genres_view')->name('genres.view');

	    Route::get('genres/status/change', 'AdminController@genres_status_change')->name('genres.status.change');

	    Route::post('genres/position/change', 'AdminController@genre_position_change')->name('genres.position.change');

	    // Admin Genres Methods ends
	    
	    // Admin Cast & crews Methods begin   

	    Route::get('/cast-crews/index', 'AdminController@cast_crews_index')->name('cast_crews.index');

	    Route::get('/cast-crews/create', 'AdminController@cast_crews_create')->name('cast_crews.create');

	    Route::get('/cast-crews/edit', 'AdminController@cast_crews_edit')->name('cast_crews.edit');

	    Route::post('/cast-crews/save', 'AdminController@cast_crews_save')->name('cast_crews.save');
	    
	    Route::get('/cast-crews/view', 'AdminController@cast_crews_view')->name('cast_crews.view');

	    Route::get('/cast-crews/delete', 'AdminController@cast_crews_delete')->name('cast_crews.delete');

	    Route::get('/cast_crews/status/change', 'AdminController@cast_crews_status_change')->name('cast_crews.status.change');

	    // Admin Cast & crews Methods ends


	    // Videos Methods begins

	    Route::get('/videos', 'AdminController@admin_videos_index')->name('videos');
	    
	    Route::get('/videos/create', 'AdminController@admin_videos_create')->name('videos.create');

	    Route::get('/videos/edit/', 'AdminController@admin_videos_edit')->name('videos.edit');

	    Route::post('/videos/save', 'AdminController@admin_videos_save')->name('videos.save');

	    Route::get('/videos/view', 'AdminController@admin_videos_view')->name('view.video');

	    Route::get('/gif/generation', 'AdminController@gif_generator')->name('gif_generator');

	    Route::get('/videos/delete', 'AdminController@admin_videos_delete')->name('delete.video');

	    Route::get('/videos/approve', 'AdminController@admin_videos_status_approve')->name('videos.approve');

	    Route::get('/video/decline/', 'AdminController@admin_videos_status_decline')->name('videos.decline');

	    Route::get('/video/publish-video', 'AdminController@admin_videos_publish')->name('video.publish-video');

	    Route::post('/video/change/position', 'AdminController@admin_videos_change_position')->name('save.video.position');

	    Route::post('/videos/ppv/add/{id}', 'AdminController@admin_videos_ppv_add')->name('save.video-payment');

	    Route::get('/videos/ppv/remove/', 'AdminController@admin_videos_ppv_remove')->name('remove_pay_per_view');

	    Route::get('/videos/downloadable', 'AdminController@admin_videos_index')->name('videos.downloadable');  

	    Route::get('users/videos/downloaded', 'AdminController@admin_videos_index')->name('users.videos.downloaded');

	    Route::get('originals_list', 'AdminController@admin_videos_index')->name('admin_videos.originals.list');


	    // Video compression status

	    Route::get('/videos/compression/complete','AdminController@admin_videos_compression_complete')->name('compress.status');

	    // Videos original section

	    Route::get('videos/originals/status', 'AdminController@admin_videos_original_status')->name('admin_videos.originals.status');


	    // Banner videos

	    Route::post('videos/banner/set', 'AdminController@admin_videos_banner_add')->name('banner.set');

	    Route::get('videos/banner/remove', 'AdminController@admin_videos_banner_remove')->name('banner.remove');


	    // Slider Videos (Not usinh)

	    Route::get('/videos/slider', 'AdminController@admin_videos_slider_status')->name('slider.video');

	    // Banner Videos ( NOT USING)

	    Route::get('/banner/videos', 'AdminController@banner_videos')->name('banner.videos');

	    // Route::get('/add/banner/video', 'AdminController@add_banner_video')->name('add.banner.video');

	    // Route::get('/change/banner/video/{id}', 'AdminController@change_banner_video')->name('change.video');

	    
	    Route::get('/spam-videos', 'AdminController@admin_videos_spams')->name('spam-videos');

	    Route::get('/spam-videos/user-reports/', 'AdminController@admin_videos_spams_user_reports')->name('spam-videos.user-reports');

		Route::get('video_analytics', 'AdminController@admin_videos_analytics')->name('videos.analytics');

		Route::get('video_audios', 'AdminController@admin_videos_audios')->name('videos.audios');

		Route::post('video_audios_save', 'AdminController@admin_videos_audios_save')->name('videos.audios.save');
		
	    // Admin videos section end


	    // New Coupons Methods begins

	    Route::get('/coupons/create','AdminController@coupons_create')->name('coupons.create');

	    Route::get('/coupons/edit','AdminController@coupons_edit')->name('coupons.edit');

	    Route::post('/coupons/save','AdminController@coupons_save')->name('coupons.save');

	    Route::get('/coupons/index','AdminController@coupons_index')->name('coupons.index');

	    Route::get('/coupons/view','AdminController@coupons_view')->name('coupons.view');

	    Route::get('/coupons/delete','AdminController@coupons_delete')->name('coupons.delete');

	    Route::get('/coupons/status','AdminController@coupons_status_change')->name('coupons.status');

	    // New Coupons Methods ends

	    // Custom Push

	    Route::get('/custom/push', 'AdminController@custom_push')->name('push');

	    Route::post('/custom/push', 'AdminController@custom_push_save')->name('send.push');

	    // Admin email Methods start

	    Route::get('/email/form','AdminController@mailcamp_create')->name('mailcamp.create');

		Route::get('/qrcode','AdminController@qrcode_create')->name('qrcode.create');
		
		Route::get('/openscanner','Openscanner@index')->name('openscanner');

		Route::post('/payment_done','Paymentverify@payment');
		
		// // for generate Qrcode
 		Route::get('/generate-qrcode','QrCodeController@index')->name('generate-qrcode');
		
		Route::get('/qrcode','QrCodeController@qrcode')->name('qrcode');



	    Route::post('/email/form/action','AdminController@email_send_process')->name('email.success');

	    // Admin email Methods ends

		// admin qrcode view //

		Route::get('/qr-code-g', function () {
			\QrCode::size(500)
					  ->format('png')
					  ->generate('25 USD', public_path('images/qrcode.png'));
			  
			return view('qrCode');
			  
		  });

	    // Admin templates Methods begins

	    Route::get('/templates', 'AdminController@templates_index')->name('templates.index');

	    Route::get('templates/create/', 'AdminController@templates_create')->name('templates.create');

	    Route::get('templates/edit/', 'AdminController@templates_edit')->name('templates.edit');

	    Route::post('templates/save/', 'AdminController@templates_save')->name('templates.save');

	    Route::get('templates/view/', 'AdminController@templates_view')->name('templates.view');

	    // Admin templates Methods ends

	    Route::get('help' , 'AdminController@help')->name('help');


	    // Exports tables

	    Route::get('/users/export/', 'AdminExportController@users_export')->name('users.export');

	    Route::get('/moderators/export/', 'AdminExportController@moderators_export')->name('moderators.export');

	    Route::get('/videos/export/', 'AdminExportController@videos_export')->name('videos.export');

	    Route::get('/subscription/payment/export/', 'AdminExportController@subscription_export')->name('subscription.export');

	    Route::get('/payperview/payment/export/', 'AdminExportController@payperview_export')->name('payperview.export');

	    // Exports tables methods ends

	    Route::get('/videos/download/status', 'AdminController@admin_videos_download_status')->name('admin_videos.download_status');
	   
	    Route::get('/users/referrals/index', 'AdminController@users_referrals_index')->name('users.referrals.index');

	    Route::get('user_payments/view' , 'AdminController@user_payments_view')->name('user_payments.view');

	    Route::get('ppv_payments/view' , 'AdminController@ppv_payments_view')->name('ppv_payments.view');
	    
	    Route::get('server_status_view' , 'AdminController@server_status_view')->name('server_status_view');


	});

	Route::group(['middleware' => ['AdminMiddleware' , 'admin'] , 'prefix' => 'admin'  , 'as' => 'admin.'], function() {
	
	// Route::group(['as' => 'admin.', 'prefix' => 'admin'], function() {

	    // Admins CRUD Operations

	    Route::get('admins/create', 'AdminController@admins_create')->name('admins.create');

	    Route::get('admins/edit', 'AdminController@admins_edit')->name('admins.edit');

	    Route::get('admins/view', 'AdminController@admins_view')->name('admins.view');

	    Route::get('admins/status', 'AdminController@admins_status')->name('admins.status');

	    Route::get('admins/index', 'AdminController@admins_index')->name('admins.list');

	    Route::get('admins/delete', 'AdminController@admins_delete')->name('admins.delete');

	    Route::post('admins/save', 'AdminController@admins_save')->name('admins.save');

	    // Languages

	    Route::get('/languages/index', 'LanguageController@languages_index')->name('languages.index'); 

	    Route::get('/languages/download/', 'LanguageController@languages_download')->name('languages.download'); 

	    Route::get('/languages/create', 'LanguageController@languages_create')->name('languages.create');
	    
	    Route::get('/languages/edit', 'LanguageController@languages_edit')->name('languages.edit');

	    Route::get('/languages/status', 'LanguageController@languages_status_change')->name('languages.status');   

	    Route::post('/languages/save', 'LanguageController@languages_save')->name('languages.save');

	    Route::get('/languages/delete', 'LanguageController@languages_delete')->name('languages.delete');

	    Route::get('/languages/set_default', 'LanguageController@languages_set_default')->name('languages.set_default');

	    /** | * | * | * | * | * | * | REVENUES SECTION START | * | * | * | * | * | * | */

	    Route::get('revenue/dashboard', 'AdminController@revenue_dashboard')->name('revenue.dashboard');

	    // New User Payment details
	    
	    Route::get('user/payments' , 'AdminController@user_payments')->name('user.payments');

	    Route::get('ajax/subscription/payments', 'AdminController@ajax_subscription_payments')->name('ajax.user-payments');

	    // Video payments

	    Route::get('user/video-payments' , 'AdminController@video_payments')->name('user.video-payments');

	    Route::get('ajax/video/payments','AdminController@ajax_video_payments')->name('ajax.video-payments');


	    /** | * | * | * | * | * | * | REVENUES SECTION END | * | * | * | * | * | * | */


	    /** * * * * * * * * * * * * * Subscriptions section start * * * * * * * * * * * * * */

	    // New subscriptions Methods begins

	    Route::get('/subscriptions', 'AdminController@subscriptions_index')->name('subscriptions.index');

	    Route::get('/subscription/save', 'AdminController@users_subscriptions_save')->name('users.subscriptions.save');

	    Route::get('/subscriptions/create', 'AdminController@subscriptions_create')->name('subscriptions.create');

	    Route::get('/subscriptions/edit', 'AdminController@subscriptions_edit')->name('subscriptions.edit');

	    Route::post('/subscriptions/create', 'AdminController@subscriptions_save')->name('subscriptions.save');

	    Route::get('/subscriptions/view', 'AdminController@subscriptions_view')->name('subscriptions.view');

	    Route::get('/subscriptions/delete', 'AdminController@subscriptions_delete')->name('subscriptions.delete');

	    Route::get('/subscriptions/status', 'AdminController@subscriptions_status_change')->name('subscriptions.status.change');

	    Route::get('/subscriptions/popular/status', 'AdminController@subscriptions_popular_status')->name('subscriptions.popular.status');

	    Route::get('/subscriptions/users', 'AdminController@subscriptions_users')->name('subscriptions.users');

	    // New Subscriptions Methods ends

	    /** * * * * * * * * * * * * * Subscriptions section end * * * * * * * * * * * * * */


	    // Admin account Methods begins
	    
	    Route::get('/profile', 'AdminController@profile')->name('profile');

	    Route::post('/profile/save', 'AdminController@profile_save')->name('save.profile');

		Route::post('/change/password', 'AdminController@change_password')->name('change.password');
		
		Route::get('/reset_password','Auth\AdminAuthController@showLinkRequestForm')->name('reset_password.request');

		Route::post('forgot_password_update', 'Auth\AdminAuthController@forgot_password_update')->name('forgot_password.update');

        Route::post('reset_password_update', 'Auth\AdminAuthController@reset_password_update')->name('reset_password.update');

        Route::get('/reset/password', 'Auth\AdminAuthController@reset_password')->name('reset_password');

	    // Admin account Methods ends

	    // Admin Settings Methods begins

	    Route::get('settings' , 'AdminController@settings')->name('settings');
	    
	    Route::post('settings' , 'AdminController@settings_save')->name('settings.save');

	    Route::post('common-settings_save' , 'AdminController@common_settings_save')->name('common-settings.save');

	    Route::post('video-settings_save' , 'AdminController@video_settings_save')->name('video-settings.save');

	    // Home page setting url

	    Route::get('homepage/settings','AdminController@home_page_settings')->name('homepage.settings');

	    Route::get('/settings_generate_json', 'AdminController@settings_generate_json')->name('settings_generate_json'); 

	    // Admin Settings Methods ends


	    // Admin Pages Methods begin

	    Route::get('/pages', 'AdminController@pages_index')->name('pages.index');

	    Route::get('/pages/create', 'AdminController@pages_create')->name('pages.create');

	    Route::get('/pages/edit', 'AdminController@pages_edit')->name('pages.edit');

	    Route::post('/pages/create', 'AdminController@pages_save')->name('pages.save');

	    Route::get('/pages/view', 'AdminController@pages_view')->name('pages.view');

	    Route::get('/pages/delete', 'AdminController@pages_delete')->name('pages.delete');
	    
		// New Pages Methods ends

		// Admin Faqs Methods begin

        Route::get('/faqs', 'AdminController@faqs_index')->name('faqs.index');

        Route::get('/faqs/create', 'AdminController@faqs_create')->name('faqs.create');

        Route::get('/faqs/edit', 'AdminController@faqs_edit')->name('faqs.edit');

        Route::post('/faqs/create', 'AdminController@faqs_save')->name('faqs.save');

        Route::get('/faqs/view', 'AdminController@faqs_view')->name('faqs.view');

        Route::get('/faqs/delete', 'AdminController@faqs_delete')->name('faqs.delete');
        
        // New Faqs Methods ends
		
	    // Sub Admins CRUD Operations

	    Route::get('sub_admins/index', 'AdminController@sub_admins_index')->name('sub_admins.index');

	    Route::get('sub_admins/create', 'AdminController@sub_admins_create')->name('sub_admins.create');

	    Route::get('sub_admins/edit', 'AdminController@sub_admins_edit')->name('sub_admins.edit');

	    Route::get('sub_admins/view', 'AdminController@sub_admins_view')->name('sub_admins.view');

	    Route::get('sub_admins/status', 'AdminController@sub_admins_status')->name('sub_admins.status');

	    Route::get('sub_admins/delete', 'AdminController@sub_admins_delete')->name('sub_admins.delete');

	    Route::post('sub_admins/save', 'AdminController@sub_admins_save')->name('sub_admins.save');

	    Route::post('sub_admins/bulk_action', 'AdminController@sub_admins_bulk_action')->name('sub_admins.bulk_action');



		// Store CRUD Operations

	    Route::get('store/index', 'AdminController@store_index')->name('store.index');

	    Route::get('store/create', 'AdminController@store_create')->name('store.create');

	    Route::get('store/edit', 'AdminController@store_edit')->name('store.edit');

	    Route::get('store/view', 'AdminController@store_view')->name('store.view');

	    Route::get('store/status', 'AdminController@store_status')->name('store.status');

	    Route::get('store/delete', 'AdminController@store_delete')->name('store.delete');

	    Route::post('store/save', 'AdminController@store_save')->name('store.save');

	    Route::post('store/bulk_action', 'AdminController@store_bulk_action')->name('store.bulk_action');
		// store route end

	    //ios control settings

	    // Get ios control page
	    Route::get('/ios-control','AdminController@ios_control')->name('ios_control');

	    //Save the ios control status
	    Route::post('/ios-control/save','AdminController@ios_control_save')->name('ios_control.save');

	    Route::get('ajax/users_index', 'AdminController@ajax_users_index')->name('ajax.users_index');

	    Route::any('videos/set-position', 'AdminController@admin_videos_set_position')->name('admin_videos_set_position');

	    Route::any('videos/set-position-all', 'AdminController@admin_videos_change_position_all')->name('admin_videos_change_position_all');

	});

	Route::group(['middleware' => ['SubAdminMiddleware', 'admin'], 'prefix' => 'subadmin', 'as' => 'subadmin.'], function () {

	    Route::get('/', 'SubAdminController@dashboard')->name('dashboard');

	    Route::get('subadmin/profile', 'SubAdminController@profile')->name('profile');

	});

	// Store Routes
	Route::group(['middleware' => ['StoreMiddleware', 'admin'], 'prefix' => 'store', 'as' => 'store.'], function () {

	    Route::get('/', 'StoreController@dashboard')->name('dashboard');

	    Route::get('store/profile', 'StoreController@profile')->name('profile');

		// for openscanner Qrcode
		Route::get('/openscanner','Openscanner@index')->name('openscanner');

		// // for generate Qrcode
 		Route::get('/generate-qrcode','QrCodeController@index')->name('generate-qrcode');

		Route::get('/storeUsers','StoreController@storeUsers');

	});

	Route::get('/user/searchall' , 'ApplicationController@search_video')->name('search');

	Route::any('/user/search' , 'ApplicationController@search_all')->name('search-all');

	// Social Login

	Route::post('/social', array('as' => 'SocialLogin' , 'uses' => 'SocialAuthController@redirect'));

	Route::get('/callback/{provider}', 'SocialAuthController@callback');

	Route::get('/user_session_language/{lang}', 'ApplicationController@set_session_language')->name('user_session_language');


	Route::group(['prefix' => 'moderator' , 'as' => 'moderator.'], function(){


	    Route::get('login', 'Auth\ModeratorAuthController@showLoginForm')->name('login');

	    Route::post('login', 'Auth\ModeratorAuthController@login')->name('login.post');

	    Route::get('logout', 'Auth\ModeratorAuthController@logout')->name('logout');

	    // Registration Routes...
	    Route::get('register', 'Auth\ModeratorAuthController@showRegistrationForm');

	    Route::post('register', 'Auth\ModeratorAuthController@register');

	    // Password Reset Routes...
	    Route::get('password/reset/{token?}', 'Auth\ModeratorPasswordController@showResetForm');

	    Route::post('password/email', 'Auth\ModeratorPasswordController@sendResetLinkEmail');

	    Route::post('password/reset', 'Auth\ModeratorPasswordController@reset');

	    Route::get('/', 'ModeratorController@dashboard')->name('dashboard');

	    // Account

	    Route::get('/profile', 'ModeratorController@profile')->name('profile');

	    Route::post('/profile/save', 'ModeratorController@profile_save')->name('save.profile');

	    Route::post('/change/password', 'ModeratorController@change_password')->name('change.password');

	    // Videos Management

	    Route::get('/videos', 'ModeratorController@admin_videos_index')->name('videos');

	    Route::get('/videos/create', 'ModeratorController@admin_videos_create')->name('videos.create');

	    Route::get('/videos/edit/{id}', 'ModeratorController@admin_videos_edit')->name('videos.edit');

	    Route::post('/videos/save', 'ModeratorController@admin_videos_save')->name('videos.save');

	    Route::get('/videos/view', 'ModeratorController@admin_videos_view')->name('videos.view');

	    // PPV 

	    Route::post('/videos/add_ppv', 'ModeratorController@admin_videos_ppv_add')->name('videos.add_ppv');

	    Route::get('/videos/remove_ppv/', 'ModeratorController@admin_videos_ppv_remove')->name('videos.remove_ppv');

	    // Revenues sections

	    Route::get('revenues', 'ModeratorController@revenues')->name('revenues');

	    Route::get('revenues/ppv_payments' , 'ModeratorController@revenues_ppv_payments')->name('revenues.ppv_payments');

	    // Redeems

	    Route::get('redeems/', 'ModeratorController@redeems')->name('redeems');

	    Route::get('redeems/send_request', 'ModeratorController@redeems_request_send')->name('redeems.send_request');

	    Route::get('redeems/cancel', 'ModeratorController@redeems_request_cancel')->name('redeems.cancel_request');

	});


	/**
	 * 
	 */

	Route::group(['prefix' => 'admin'  , 'as' => 'admin.'], function() {

	    // wallet_vouchers CRUD operations

	    Route::get('/wallet/payments', 'CustomWalletAdminController@custom_wallet_payments')->name('wallet.payments');

	    Route::get('/wallet_vouchers/index', 'CustomWalletAdminController@custom_wallet_vouchers_index')->name('wallet_vouchers.index');

	    Route::get('/wallet_vouchers/create', 'CustomWalletAdminController@custom_wallet_vouchers_create')->name('wallet_vouchers.create');

	    Route::get('/wallet_vouchers/edit/{id}', 'CustomWalletAdminController@custom_wallet_vouchers_edit')->name('wallet_vouchers.edit');

	    Route::post('/wallet_vouchers/save', 'CustomWalletAdminController@custom_wallet_vouchers_save')->name('wallet_vouchers.save');

	    Route::post('/wallet_vouchers/generate', 'CustomWalletAdminController@custom_wallet_vouchers_generate')->name('wallet_vouchers.generate');

	    Route::get('/wallet_vouchers/view/{id}', 'CustomWalletAdminController@custom_wallet_vouchers_view')->name('wallet_vouchers.view');

	    Route::get('/wallet_vouchers/delete/{id}', 'CustomWalletAdminController@custom_wallet_vouchers_delete')->name('wallet_vouchers.delete');

	    Route::get('/wallet_vouchers/status/{id}', 'CustomWalletAdminController@custom_wallet_vouchers_status')->name('wallet_vouchers.status');

	});

	Route::group(['middleware' => 'cors'], function(){

	    // Route::get('add_money_via_paypal/{user_id}/{amount}','PaypalController@add_money_via_paypal')->name('add_money_via_paypal');

	    Route::get('admin-videos-upload','AdminVideoController@admin_videos_create')->name('admin_videos_create');

	    Route::post('admin-videos-upload', 'AdminVideoController@videos_save')->name('videos_save');
	});
});
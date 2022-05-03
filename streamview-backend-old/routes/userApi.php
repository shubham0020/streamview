<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CodpaymentController;

use App\Http\Controllers\UsersubscriptionController;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'cors' , 'as' => 'userapi.'], function(){

    Route::any('/get_settings_json','ApplicationController@get_settings_json');
    
    Route::any('/get_home_settings_json','ApplicationController@get_home_settings_json');

    Route::post('/register','UserApiController@register');
    
    Route::post('/login','UserApiController@login');

    Route::get('/userDetails','UserApiController@user_details');

    Route::post('/updateProfile', 'UserApiController@update_profile');

    Route::post('/forgotpassword', 'UserApiController@forgot_password');

    Route::post('/changePassword', 'UserApiController@change_password');

    Route::get('/tokenRenew', 'UserApiController@token_renew');

    Route::post('/deleteAccount', 'UserApiController@delete_account');

    Route::post('/settings', 'UserApiController@settings');


    // Categories And SubCategories

    Route::post('/categories' , 'UserApiController@get_categories');

    Route::post('/subCategories' , 'UserApiController@get_sub_categories');


    // Videos and home

    Route::post('/home' , 'UserApiController@home');
    
    Route::post('/common' , 'UserApiController@common');

    Route::post('/categoryVideos' , 'UserApiController@get_category_videos');

    Route::post('/subCategoryVideos' , 'UserApiController@get_sub_category_videos');

    Route::post('/singleVideo' , 'UserApiController@single_video');

    
    //  Route::post('/apiSearchVideo' , 'UserApiController@api_search_video')->name('api-search-video');

    Route::post('/searchVideo' , 'UserApiController@search_video')->name('search-video');

    Route::post('/test_search_video' , 'UserApiController@test_search_video');


    // Rating and Reviews

    Route::post('/userRating', 'UserApiController@user_rating'); // @TODO - Not used for future use

    // Wish List

    Route::post('/addWishlist', 'UserApiController@wishlist_add');

    Route::post('/getWishlist', 'UserApiController@wishlist_index');

    Route::post('/deleteWishlist', 'UserApiController@wishlist_delete');

    // History

    Route::post('/addHistory', 'UserApiController@history_add');

    Route::post('getHistory', 'UserApiController@history_index');

    Route::post('/deleteHistory', 'UserApiController@history_delete');

    Route::get('/clearHistory', 'UserApiController@clear_history');

    Route::post('/details', 'UserApiController@details');

    Route::post('/active-categories', 'UserApiController@getCategories');

    Route::post('/browse', 'UserApiController@browse');

    Route::post('/active-profiles', 'UserApiController@activeProfiles');

    Route::post('/add-profile', 'UserApiController@addProfile');

    Route::post('/view-sub-profile','UserApiController@view_sub_profile');

    Route::post('/edit-sub-profile','UserApiController@edit_sub_profile');

    Route::post('/delete-sub-profile', 'UserApiController@delete_sub_profile');

    Route::post('/active_plan', 'UserApiController@active_plan');

    Route::post('/subscription_index', 'UserApiController@subscription_index');

    Route::post('/zero_plan', 'UserApiController@zero_plan');

    Route::get('/site_settings' , 'UserApiController@site_settings');

    Route::post('/allPages', 'UserApiController@allPages');

    Route::get('/getPage/{id}', 'UserApiController@getPage');

    Route::get('check_social', 'UserApiController@check_social');

    Route::post('/get-subscription', 'UserApiController@last_subscription');

    Route::post('/genre-video', 'UserApiController@genre_video');

    Route::post('/genre-list', 'UserApiController@genre_list');

    Route::get('/searchall' , 'UserApiController@searchAll');

    Route::post('/notifications', 'UserApiController@notifications');

    Route::post('/red-notifications', 'UserApiController@red_notifications');

    Route::post('subscribed_plans', 'UserApiController@subscribed_plans');


    Route::post('stripe_payment_video', 'UserApiController@stripe_payment_video');

    Route::post('card_details', 'UserApiController@card_details');

    Route::post('payment_card_add', 'UserApiController@payment_card_add');

    Route::post('default_card', 'UserApiController@default_card');

    Route::post('delete_card', 'UserApiController@delete_card');

    Route::post('subscription_plans', 'UserApiController@subscription_plans');

    Route::post('subscribedPlans', 'UserApiController@subscribedPlans');

    Route::post('/stripe_payment', 'UserApiController@stripe_payment');
    
    Route::post('pay_now', 'UserApiController@pay_now');

    Route::post('/like_video', 'UserApiController@likeVideo');

    Route::post('/dis_like_video', 'UserApiController@disLikeVideo');

    Route::post('/add_spam', 'UserApiController@add_spam');

    Route::get('/spam-reasons', 'UserApiController@reasons');

    Route::post('remove_spam', 'UserApiController@remove_spam');

    Route::post('spam_videos', 'UserApiController@spam_videos');

    Route::post('stripe_ppv', 'UserApiController@stripe_ppv');

    Route::post('ppv_end', 'UserApiController@ppv_end');

    Route::post('paypal_ppv', 'UserApiController@paypal_ppv');

    Route::post('keyBasedDetails', 'UserApiController@keyBasedDetails');

    Route::post('plan_detail', 'UserApiController@plan_detail');

    Route::post('logout', 'UserApiController@logout');

    Route::post('check_token_valid', 'UserApiController@check_token_valid');

    Route::post('ppv_list', 'UserApiController@ppv_list');


    // Continue watching Video

    Route::post('continue/videos', 'UserApiController@continue_watching_videos');

    Route::any('save/watching/video', 'UserApiController@save_continue_watching_video');

    Route::post('/oncomplete/video', 'UserApiController@on_complete_video');

    // Enable / Disable Notifications

    Route::post('/email/notification', 'UserApiController@email_notification');

    Route::post('/cod/payment', 'UserApiController@codpayment');

    Route::post('coupon/apply/vidoes','UserApiController@coupon_apply_videos');

    // Genres

    Route::post('genres/videos', 'UserApiController@genres_videos');

    Route::post('/apply/coupon/subscription', 'UserApiController@apply_coupon_subscription');

    Route::post('/apply/coupon/ppv', 'UserApiController@apply_coupon_ppv');

    Route::post('/cancel/subscription', 'UserApiController@autorenewal_cancel');

    Route::post('/autorenewal/enable', 'UserApiController@autorenewal_enable');

    Route::post('/pay_ppv', 'UserApiController@pay_ppv');

    // Cast Crews

    Route::post('cast_crews/videos', 'UserApiController@cast_crews_videos');

    // Kids videos
    Route::post('/kids/videos', 'UserApiController@kids_videos');

    // Downloads

    Route::post('/video/download', 'UserApiController@video_dowload_status');

    Route::post('downloaded/videos', 'UserApiController@downloaded_videos');

    // Notification count

    Route::post('notification/count', 'UserApiController@notifications_count');


    // NEW CONTROLLER API's 

    Route::post('test' , 'V4UserApiController@test');

    // HOME RELEATED API START

    Route::post('home_first_section' , 'V4UserApiController@home_first_section');

    Route::post('home_second_section' , 'V4UserApiController@home_second_section');

    Route::post('home_category_section' , 'V4UserApiController@home_category_section');

    Route::post('see_all', 'V4UserApiController@see_all_section');

    // HOME RELEATED API END


    // SECTIONS API START

    Route::post('new-releases' , 'V4UserApiController@section_new_releases')->name('section_new_releases');

    Route::post('trending' , 'V4UserApiController@section_trending')->name('section_trending');

    Route::post('continue_watching_videos' , 'V4UserApiController@section_continue_watching_videos')->name('section_continue_watching_videos');

    Route::post('suggestions' , 'V4UserApiController@section_suggestions')->name('section_suggestions');

    Route::post('originals' , 'V4UserApiController@section_originals')->name('section_originals');

    Route::post('sub_category_videos' , 'V4UserApiController@sub_category_videos')->name('sub_category_videos');
    
    Route::post('genre_videos' , 'V4UserApiController@genre_videos')->name('genre_videos');

    // SECTIONS API END

    // SINGLE VIDEO API START

    Route::post('videos/view' , 'V4UserApiController@admin_videos_view')->name('admin_videos_view');

    Route::post('videos/view/second' , 'V4UserApiController@admin_videos_view_second')->name('admin_videos_view_second');

    // SINGLE VIDEO API END

    Route::post('notification/settings', 'V4UserApiController@notification_settings'); // 22

    Route::any('continue_watching_videos/save', 'V4UserApiController@continue_watching_videos_save'); // 22

    Route::post('sub_profiles/delete', 'V4UserApiController@sub_profiles_delete'); // 22

    // WISHLIST

    Route::post('/wishlists', 'V4UserApiController@wishlist_index')->name('section_wishlists');

    Route::post('/wishlists/list', 'V4UserApiController@wishlist_index');

    Route::post('/wishlists/operations', 'V4UserApiController@wishlist_operations');


    // Spam Videos

    // Route::post('spam_videos', 'V4UserApiController@spam_videos'); // 22

    Route::post('spam_videos/list', 'V4UserApiController@spam_videos'); // 22

    Route::post('spam_videos/add', 'V4UserApiController@spam_videos_add'); // 22

    Route::post('spam_videos/remove', 'V4UserApiController@spam_videos_remove'); // 22


    // =================== branch v4.0-ios ================

    Route::post('/v4/register','V4UserApiController@register');

    Route::post('/v4/login','V4UserApiController@login');

    Route::post('/profile','V4UserApiController@profile');

    Route::post('/update_profile', 'V4UserApiController@profile_update'); // 2


    Route::post('/videos/like', 'V4UserApiController@videos_like');

    Route::post('/videos/dis_like', 'V4UserApiController@videos_dislike');


    // Route::post('/videos/history', 'V4UserApiController@history_index');

    Route::post('/history/list', 'V4UserApiController@history_index');

    Route::post('/videos/history/delete', 'V4UserApiController@history_delete');


    Route::get('pages/list' , 'ApplicationController@static_pages_api');

    Route::post('v4/categories/list' , 'V4UserApiController@categories_list');

    Route::post('v4/cast_crews/videos', 'V4UserApiController@cast_crews_videos');

    Route::post('v4/subscriptions_payment', 'V4UserApiController@subscriptions_payment');

    Route::post('v4/ppv_payment', 'V4UserApiController@ppv_payment');

    // Referral Code
    Route::post('referral_code' , 'V4UserApiController@referral_code')->name('referral_code');

    Route::post('user_referrals_list' , 'V4UserApiController@user_referrals_list')->name('user_referrals_list');

    Route::post('invoice_referral_amount' , 'V4UserApiController@invoice_referral_amount')->name('invoice_referral_amount');

    Route::post('v4/subscriptions_payment_apple_pay', 'V4UserApiController@subscriptions_payment_apple_pay');

    Route::post('v4/ppv_payment_apple_pay', 'V4UserApiController@ppv_payment_apple_pay');

    Route::get('faqs/list' , 'ApplicationController@faqs_list');

    Route::post('reset_password', 'V4UserApiController@reset_password');
    
});


Route::group(['middleware' => 'cors'], function(){

    // Wallet details

    Route::post('custom_wallet_index', 'WalletApiController@custom_wallet_index');
    
    Route::post('voucher_code_check', 'WalletApiController@voucher_code_check');

    // Add money to wallets

    Route::post('wallet_add_money_via_paypal', 'WalletApiController@custom_wallet_add_money_via_paypal');

    Route::post('wallet_add_money_via_stripe', 'WalletApiController@custom_wallet_add_money_via_stripe');

    Route::post('wallet_add_money_via_voucher', 'WalletApiController@custom_wallet_add_money_via_voucher');

    // Payments via wallet

    Route::post('ppv_pay_via_wallet', 'WalletApiController@ppv_pay_via_wallet');

    Route::post('subscription_pay_via_wallet', 'WalletApiController@subscription_pay_via_wallet');

    Route::post('video_player_info', 'V4UserApiController@video_player_info');

    Route::post('video_playlist', 'V4UserApiController@video_playlist');

});


Route::group(['middleware' => 'cors'], function(){

    // Wallet details

    Route::post('custom_wallet', 'WalletApiController@custom_wallet');

    // Payments via cod
	Route::get('codpayment',[CodpaymentController:: class,'saveData']);

    Route::get('subscription',[UsersubscriptionController:: class,'saveData']);

    Route::get('/email/qrcode', 'UserApiController@email_qrcode');
	
    // pay per view cod payment
    
    Route::get('payperview',[UsersubscriptionController:: class,'payperView']);

    Route::get('storeUsers',[UsersubscriptionController:: class,'storeUsers']);

	// Payments via wallet

    Route::post('ppv_pay_via_wallet', 'WalletApiController@ppv_pay_via_wallet');

    Route::post('subscription_pay_via_wallet', 'WalletApiController@subscription_pay_via_wallet');

    // Search video

    Route::post('search_videos', 'V4UserApiController@search_videos');
    
    Route::post('sub_profiles', 'V4UserApiController@sub_profiles');

    // View all Notifications

    Route::any('notifications/view-all', 'V4UserApiController@notifications');

    Route::get('/referrals_signup/{referral_code}', 'ApplicationController@referrals_signup')->name('referrals_signup');

    Route::any('referral_code_validate' , 'V4UserApiController@referral_code_validate')->name('referral_code_validate');

    // Route::get('add_money_via_paypal_status','PaypalController@add_money_via_paypal_status')->name('add_money_via_paypal_status');

});


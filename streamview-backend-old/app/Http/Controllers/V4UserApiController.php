<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\Helper;

use App\Helpers\VideoHelper;

use App\Jobs\NormalPushNotification;

use App\Repositories\PaymentRepository as PaymentRepo;

use App\Repositories\VideoRepository as VideoRepo;

use Log, Hash, File, DB, Auth, Setting, Validator, Exception;

use App\Admin, App\AdminVideo, App\AdminVideoImage;

use App\Card, App\CastCrew, App\ContinueWatchingVideo; 

use App\Category, App\SubCategory;

use App\Coupon, App\Flag, App\Genre, App\Language;

use App\LikeDislikeVideo, App\Page, App\OfflineAdminVideo;

use App\MobileRegister, App\Moderator, App\Notification;

use App\PageCounter, App\PayPerView;

use App\Settings, App\SubProfile;

use App\Subscription, App\Wishlist, App\VideoCastCrew;

use App\User, App\UserCoupon, App\UserHistory, App\UserLoggedDevice, App\UserPayment, App\UserRating;

use App\ReferralCode, App\UserReferral;

use App\CustomWallet;

use App\Repositories\CustomWalletRepository as CustomWalletRepo;

use App\Jobs\SendEmailJob;

class V4UserApiController extends Controller {

    public function __construct(Request $request) {

        Log::info(url()->current());

        Log::info("Request Data".print_r($request->all(), true));

        $this->middleware('NewUserApiVal', ['except' => ['register', 'login', 'referral_code_validate','reset_password']]);

        config(['app.locale' => $request->language ?: "en"]);
    }

    /**
	 *
	 * @method home_first_section() 
	 *
	 * @uses used to get the first set of sections based on the page type
	 *
	 * @created Vidhya R
	 *
	 * @updated Vidhya R
	 *
	 * @param
	 *
	 * @return
	 */

    public function home_first_section(Request $request) {

    	try {

            $user_details = User::find($request->id);

            $sub_profile_details = SubProfile::find($request->sub_profile_id);

            $data = [];

            /* - - - - - - - - - - - My List section - - - - - - - - - - - */

            $wishlist_videos = VideoHelper::wishlist_videos($request);

            $wishlist_videos_data['title'] = tr('header_wishlist','',$request->language);

            $wishlist_videos_data['url_type'] = URL_TYPE_WISHLIST;

            $wishlist_videos_data['url_type_id'] = $wishlist_videos_data['url_page_id'] = 0;

            $wishlist_videos_data['see_all_url'] = route('userapi.section_wishlists');

            $wishlist_videos_data['data'] = $wishlist_videos ?: [];

            if($wishlist_videos->count() > 0) {
                array_push($data, $wishlist_videos_data);
            }

            /* - - - - - - - - - - - My List section - - - - - - - - - - - */


            /* - - - - - - - - - - - New Releases section - - - - - - - - - - - */

            $new_releases_videos = VideoHelper::new_releases_videos($request);

            $new_releases_videos_data['title'] = tr('header_new_releases','',$request->language);

            $new_releases_videos_data['url_type'] = URL_TYPE_NEW_RELEASE;

            $new_releases_videos_data['url_type_id'] = $new_releases_videos_data['url_page_id'] = 0;

            $new_releases_videos_data['see_all_url'] = route('userapi.section_new_releases');

            $new_releases_videos_data['data'] = $new_releases_videos ?: [];

            if($new_releases_videos->count() > 0) {
                array_push($data, $new_releases_videos_data);
            }

            /* - - - - - - - - - - - New Releases section - - - - - - - - - - - */


            /* - - - - - - - - - - - Continue Watching section - - - - - - - - - - - */

            $continue_watching_videos = VideoHelper::continue_watching_videos($request);

            $c_w_videos_data['title'] = tr('header_continue_watching' , $sub_profile_details->name,$request->language);

            $c_w_videos_data['url_type'] = URL_TYPE_CONTINUE_WATCHING;

            $c_w_videos_data['url_type_id'] = $c_w_videos_data['url_page_id'] = 0;

            $c_w_videos_data['see_all_url'] = route('userapi.section_continue_watching_videos');

            $c_w_videos_data['data'] = $continue_watching_videos ?: [];

            if($continue_watching_videos->count() > 0) {
                array_push($data, $c_w_videos_data);
            }

            /* - - - - - - - - - - - Continue Watching section - - - - - - - - - - - */

            /* - - - - - - - - - - - Trending Now section - - - - - - - - - - - */

            $trending_videos = VideoHelper::trending_videos($request);

            $trending_videos_data['title'] = tr('header_trending','',$request->language);

            $trending_videos_data['url_type'] = URL_TYPE_TRENDING;

            $trending_videos_data['url_type_id'] = $trending_videos_data['url_page_id'] = 0;

            $trending_videos_data['see_all_url'] = route('userapi.section_trending');

            $trending_videos_data['data'] = $trending_videos ?: [];

            if($trending_videos->count() > 0) {
                array_push($data, $trending_videos_data);
            }

            /* - - - - - - - - - - - Trending Now section - - - - - - - - - - - */

            /* - - - - - - - - - - - Recommented section - - - - - - - - - - - */

            $suggestion_videos = VideoHelper::suggestion_videos($request);

            $suggestion_videos_data['title'] = tr('header_recommended','',$request->language);

            $suggestion_videos_data['url_type'] = URL_TYPE_SUGGESTION;

            $suggestion_videos_data['url_type_id'] = $suggestion_videos_data['url_page_id'] = 0;

            $suggestion_videos_data['see_all_url'] = route('userapi.section_suggestions');

            $suggestion_videos_data['data'] = $suggestion_videos ?: [];

            if($suggestion_videos->count() > 0) {
                array_push($data, $suggestion_videos_data);
            }
            
            /* - - - - - - - - - - - Recommented section - - - - - - - - - - - */

            /* - - - - - - - - - - - Banner section - - - - - - - - - - - */

            $banner_videos = VideoHelper::banner_videos($request);

            $banner_videos_data['title'] = tr('header_banner','',$request->language);

            $banner_videos_data['url_type'] = "";

            $banner_videos_data['url_type_id'] = $banner_videos_data['url_page_id'] = 0;

            $banner_videos_data['see_all_url'] = "";

            $banner_videos_data['data'] = $banner_videos ?: [];

            /* - - - - - - - - - - - Banner section - - - - - - - - - - - */

            /* - - - - - - - - - - - Originals section - - - - - - - - - - - */

            $originals_videos = VideoHelper::original_videos($request);

            $originals_videos_data['title'] = tr('header_originals','',$request->language);

            $originals_videos_data['url_type'] = URL_TYPE_ORIGINAL;

            $originals_videos_data['url_type_id'] = $originals_videos_data['url_page_id'] = 0;

            $originals_videos_data['see_all_url'] = route('userapi.section_originals');

            $originals_videos_data['data'] = $originals_videos ?: [];

            /* - - - - - - - - - - - Originals section - - - - - - - - - - - */

            // Get the page title

            $api_page_title = ""; 

            if($request->category_id) {

                $category_details = Category::find($request->category_id);

                $api_page_title = $category_details->name ?: "Category"; 

            }

			$response_array = ['success' => true , 'page_title' => $api_page_title,'data' => $data ,'banner' => $banner_videos_data , 'originals' => $originals_videos_data];

			return response()->json($response_array , 200);

		} catch(Exception $e) {

			$error_messages = $e->getMessage();

			$error_code = $e->getCode();

			$response_array = ['success' => false , 'error_messages' => $error_messages , 'error_code' => $error_code];

			return response()->json($response_array , 200);

		}
    
    }

    /**
     *
     * @method home_second_section() 
     *
     * @uses used to get the first set of sections based on the page type
     *
     * @created Vidhya R
     *
     * @updated Vidhya R
     *
     * @param
     *
     * @return
     */

    public function home_second_section(Request $request) {

        try {

            $validator = Validator::make($request->all() , [
                'skip' => 'nullable'
            ]);

            if($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);
                
            }

            $skip = $request->skip ?: 0;

            $take = 20;

            $base_query = SubCategory::where('sub_categories.is_approved' , APPROVED)
                            ->orderBy('sub_categories.id', 'desc')
                            ->has('approvedAdminVideos', '>' , 0)
                            ->with('approvedAdminVideos');
                      //      ->skip($skip)->take($take);


            $sub_category_ids = $base_query->pluck('sub_categories.id')->toArray();

            $sub_categories = SubCategory::whereIn('sub_categories.id', $sub_category_ids)->skip($skip)->take($take)->get();

            $data = [];

            foreach ($sub_categories as $key => $sub_category_details) {

                // Get the sub category videos

                $request->request->add(['sub_category_id' => $sub_category_details->id]);

                $sub_category_videos = VideoHelper::sub_category_videos($request);
                
                
                if(count($sub_category_videos)) {

                    $sub_category_videos_data['title'] = $sub_category_details->name;

                    $sub_category_videos_data['url_type'] = URL_TYPE_SUB_CATEGORY;

                    $sub_category_videos_data['url_type_id'] = $sub_category_videos_data['url_page_id'] = $sub_category_details->id;

                    $sub_category_videos_data['see_all_url'] = route('userapi.sub_category_videos');

                    $sub_category_videos_data['data'] = $sub_category_videos ?: [];

                    array_push($data, $sub_category_videos_data);

                }

            }

            $response_array = ['success' => true , 'data' => $data];

            return response()->json($response_array , 200);

        } catch(Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false , 'error_messages' => $error_messages , 'error_code' => $error_code];

            return response()->json($response_array , 200);

        }

    }


    /**
     *
     * @method home_category_section() 
     *
     * @uses used to get the first set of sections based on the page type
     *
     * @created Vidhya R
     *
     * @updated Vidhya R
     *
     * @param
     *
     * @return
     */

    public function home_category_section(Request $request) {

        try {

            $validator = Validator::make($request->all() , [
                'skip' => 'nullable'
            ]);

            if($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);
                
            }

            $skip = $request->skip ?: 0;

            $take = 10;

            $base_query = Category::where('categories.is_approved' , APPROVED)
                            ->orderBy('categories.id', 'desc')
                            ->has('approvedAdminVideos', '>' , 0)
                            ->with('approvedAdminVideos')
                            ->skip($skip)->take($take);

            $categories = $base_query->get();

            $data = [];

            foreach ($categories as $key => $category_details) {

                // Get the sub category videos

                $request->request->add(['category_id' => $category_details->id]);

                $category_videos = VideoHelper::category_videos($request);

                if(count($category_videos)) {

                    $category_videos_data['title'] = $category_details->name;

                    $category_videos_data['url_type'] = URL_TYPE_CATEGORY;

                    $category_videos_data['url_type_id'] = $category_videos_data['url_page_id'] = $category_details->id;

                    $category_videos_data['data'] = $category_videos ?: [];

                    array_push($data, $category_videos_data);

                }

            }

            $response_array = ['success' => true , 'data' => $data];

            return response()->json($response_array , 200);

        } catch(Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false , 'error_messages' => $error_messages , 'error_code' => $error_code];

            return response()->json($response_array , 200);

        }

    }

    /**
     *
     * @method home_second_section() 
     *
     * @uses used to get the first set of sections based on the page type
     *
     * @created Vidhya R
     *
     * @updated Vidhya Rs
     *
     * @param
     *
     * @return
     */

    public function see_all_section(Request $request) {

        try {

            switch ($request->url_type) {

                case URL_TYPE_WISHLIST:
                    $admin_videos = VideoHelper::wishlist_videos($request);
                    break;
                case URL_TYPE_NEW_RELEASE:
                    $admin_videos = VideoHelper::new_releases_videos($request);
                    break;
                case URL_TYPE_CONTINUE_WATCHING:
                    $admin_videos = VideoHelper::continue_watching_videos($request);
                    break;
                case URL_TYPE_TRENDING:
                    $admin_videos = VideoHelper::trending_videos($request);
                    break;
                case URL_TYPE_SUGGESTION:
                    $admin_videos = VideoHelper::suggestion_videos($request);
                    break;
                case URL_TYPE_ORIGINAL:
                    $admin_videos = VideoHelper::original_videos($request);
                    break;
                case URL_TYPE_CATEGORY:

                    $url_page_id = $request->url_type_id ?: $request->url_page_id;

                    $request->request->add(['category_id' => $url_page_id]);

                    $admin_videos = VideoHelper::category_videos($request);
                    break;
                case URL_TYPE_SUB_CATEGORY:
                    $url_page_id = $request->url_type_id ?: $request->url_page_id;

                    $request->request->add(['sub_category_id' => $url_page_id]);

                    $admin_videos = VideoHelper::sub_category_videos($request);
                    break;
                case URL_TYPE_GENRE:
                    $url_page_id = $request->url_type_id ?: $request->url_page_id;

                    $request->request->add(['genre_id' => $url_page_id]);
                    $admin_videos = VideoHelper::genre_videos($request);
                    break;
                case URL_TYPE_CAST_CREW:
                    $url_page_id = $request->url_type_id ?: $request->url_page_id;

                    $request->request->add(['cast_crew_id' => $url_page_id]);
                    $admin_videos = VideoHelper::cast_crews_videos($request);
                    break;
                default:
                    $admin_videos = VideoHelper::suggestion_videos($request);
                    break;
            }

            $response_array = ['success' => true, 'data' => $admin_videos];

            return response()->json($response_array, 200);

        } catch(Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false , 'error_messages' => $error_messages , 'error_code' => $error_code];

            return response()->json($response_array , 200);

        }

    }

	/**
     *
     * @method admin_videos_view()
     *
     * @uses used to get video details based on the selected video id
     *
     * @created Vidhya R
     *
     * @updated Vidhya R
     *
     * @param integer admin_video_id
     *
     * @return JSON Response
     */

    public function admin_videos_view(Request $request) {

        try {

            $admin_video_details = AdminVideo::SingleVideoResponse()->where('admin_videos.id' , $request->admin_video_id)->first();

            $user_details = User::find($request->id);

            if(!$admin_video_details) {

                throw new Exception(Helper::get_error_message(157), 157);
                
            }

            // Check the video is marked as spam

            if (check_flag_video($request->admin_video_id, $request->sub_profile_id)) {

                throw new Exception(Helper::get_error_message(904), 904);

            }

            $data = new \stdClass();

            $data = $admin_video_details;

            $data->user_type = $user_details->user_type;

            $data->share_link = Setting::get('ANGULAR_SITE_URL').'video/'.$request->admin_video_id;

            $data->share_message = tr('video_share_message', $admin_video_details->title);

            // ************** Continue watching section *************** //

            $continue_watching_video_details = VideoHelper::videoPlayDuration($request->admin_video_id, $request->sub_profile_id);

            $data->video_play_duration = $data->seek_time_in_seconds = "";

            if($continue_watching_video_details) {
                
                $data->video_play_duration = $continue_watching_video_details->duration;

                $data->seek_time_in_seconds = $continue_watching_video_details->duration_in_seconds;
            }

            // ************** Continue watching section *************** //

            $data->wishlist_status = VideoHelper::wishlist_status($request->admin_video_id,$request->sub_profile_id);

            $data->history_status = VideoHelper::history_status($request->admin_video_id, $request->sub_profile_id);

            $data->is_liked = VideoHelper::like_status($request->admin_video_id, $request->sub_profile_id,$request->admin_video_id);

            $data->likes = number_format_short(VideoHelper::likes_count($request->admin_video_id));
            
            $data->dislikes = number_format_short(VideoHelper::dislikes_count($request->admin_video_id));

            $data->likes_formatted = $data->likes >  1 ? $data->likes." ".tr('likes'): $data->likes." ".tr('like');
            
            $data->dislikes_formatted = $data->dislikes >  1 ? $data->dislikes." ".tr('dislikes'): $data->dislikes." ".tr('dislike');

            $data->currency = Setting::get('currency') ?: "$";

            $request->request->add(['video_type' => $admin_video_details->video_type, 'video_upload_type' => $admin_video_details->video_upload_type, 'device_type' => $user_details->device_type]);

            // if($request->device_type == DEVICE_WEB && $admin_video_details->hls_main_video) {

                // $data->main_video = $admin_video_details->hls_main_video;

            // } else {

                $data->main_video = VideoHelper::get_streaming_link_video($admin_video_details->video, $request, $is_single_video = YES);
            // }

            $data->trailer_video = VideoHelper::get_streaming_link_video($admin_video_details->trailer_video, $request, $is_single_video = YES);

            $data->is_series = $admin_video_details->genre_id ? YES : NO;


            $data->video_subtitle = $admin_video_details->video_subtitle ? Setting::get('ANGULAR_SITE_URL')."subtitles/".get_video_end($admin_video_details->video_subtitle) : "";

            $data->trailer_subtitle = $admin_video_details->trailer_subtitle ? Setting::get('ANGULAR_SITE_URL')."subtitles/".get_video_end($admin_video_details->trailer_subtitle) : "";
            /* $ $ $ $ $ $ $ $ $ $ PPV STATUS CHECK START $ $ $ $ $ $ $ $ $ $*/

            $ppv_details = VideoRepo::pay_per_views_status_check($user_details->id, $user_details->user_type, $data)->getData();

            $is_pay_per_view = $admin_video_details->is_pay_per_view;

            $data->is_pay_per_view = $ppv_details->success ? NO : YES; // not using. Don't use.

            $watch_video_free = DEFAULT_TRUE;

            $data->should_display_ppv = $ppv_details->success == $watch_video_free ? NO : YES;

            $ppv_page_type_data = VideoHelper::get_ppv_page_type($admin_video_details, $user_details->user_type, $admin_video_details->is_pay_per_view);

            $data->ppv_page_type = $ppv_page_type_data->ppv_page_type;

            $data->ppv_page_type_content = $ppv_page_type_data->ppv_page_type_content;

            $data->is_user_need_subscription = $is_pay_per_view == NO ? ($data->user_type == SUBSCRIBED_USER ? NO : YES) : NO;

            /* $ $ $ $ $ $ $ $ $ $ PPV STATUS CHECK END $ $ $ $ $ $ $ $ $ $*/


            $data->images = AdminVideoImage::where('admin_video_id' , $request->admin_video_id)->orderBy('is_default' , 'desc')
                                    ->pluck('image')->toArray();

            $data->cast_crews = VideoCastCrew::select('cast_crew_id', 'name')
                                    ->where('admin_video_id', $request->admin_video_id)
                                    ->leftjoin('cast_crews', 'cast_crews.id', '=', 'video_cast_crews.cast_crew_id')
                                    ->get()->toArray();

            /* @@@@@@@@@@@@@@@@@@@@@@ DOWNLOAD STATUS START @@@@@@@@@@@@@@@@@@@@@@ */

            $download_button_status = VideoHelper::download_button_status($request->admin_video_id , $request->id, $admin_video_details->download_status, $user_details->user_type, $data->is_pay_per_view);

            $data->download_button_status = $download_button_status;


            $offline_admin_video_details = OfflineAdminVideo::where('admin_video_id' , $request->admin_video_id)
                                                ->where('user_id', $request->user_id)
                                                ->first();

            $download_status_text = "";  $downloading_video_status = 0;

            if($offline_admin_video_details) {

                $downloading_video_status = $offline_admin_video_details->status;

                $download_status_text = VideoHelper::download_status_text($offline_admin_video_details->status);

            }

            $data->downloading_video_status = $downloading_video_status;

            $data->download_status_text = $download_status_text;

            $main_resolutions = $trailer_resolutions = $download_urls = [];

            // Main video and download urls data

            if($admin_video_details->video_resolutions) {

                $request_data = ['video_resolutions' => $admin_video_details->video_resolutions , 'video_resize_path' => $admin_video_details->video_resize_path, 'video' => $admin_video_details->video , 'device_type' => $user_details->device_type,'video_type' => $admin_video_details->video_type ,'video_upload_type' => $admin_video_details->video_upload_type];

                $video_res_request = new \Illuminate\Http\Request();

                Log::info(print_r($request_data,true));

                $video_res_request->setMethod('POST');

                $video_res_request->request->add($request_data);

                $video_resolutions_data = VideoHelper::get_video_resolutions($video_res_request);

                $main_resolutions = $video_resolutions_data[0];

                Log::info('video url'.print_r($video_resolutions_data,true));
                
                $download_urls = $video_resolutions_data[1];

            }

            $data->main_resolutions = $main_resolutions ?: [];

            $data->download_urls = $download_urls ?: [];
                
            $data->download_button_status = $data->download_urls ? $download_button_status : DOWNLOAD_BTN_DONT_SHOW;

            /* @@@@@@@@@@@@@@@@@@@@@@ DOWNLOAD STATUS START @@@@@@@@@@@@@@@@@@@@@@ */

            $data->video = VideoHelper::get_streaming_link_video($admin_video_details->video, $request, $is_single_video = YES);

            $data->player_json = $admin_video_details->player_json;

            $next_position_admin_video_details = VideoHelper::get_auto_play_video($admin_video_details);

            $data->next_admin_video_id = 0; $data->next_video_details = "";

            if($next_position_admin_video_details) {

                $data->next_admin_video_id = $next_position_admin_video_details->id; 

                $data->next_video_details = $next_position_admin_video_details;

            }

            if($data->is_series) {

                $video_position = $admin_video_details->position + 1;

                $playlist_video = AdminVideo::where('position', $video_position)
                    ->where('genre_id', $admin_video_details->genre_id)
                    ->where('is_approved', DEFAULT_TRUE)
                    ->where('status', DEFAULT_TRUE)
                    ->first() ?? [];
                
                $data->playlist_video_id = $playlist_video ? $playlist_video->id : '';

                $data->playlist_title = $playlist_video ? $playlist_video->title : '';

                $video_playlist = AdminVideo::where('genre_id', $admin_video_details->genre_id)
                    ->where('is_approved', DEFAULT_TRUE)
                    ->where('status', DEFAULT_TRUE)
                    ->orderBy('position', 'asc')
                    ->select('id','title','duration','description','default_image','mobile_image')
                    ->get();
                
                foreach ($video_playlist as $key => $playlist_details) {
                    
                    $watching_history = ContinueWatchingVideo::where('admin_video_id', $playlist_details->id)->first();

                    $playlist_details->watch_history_percentage = 0;

                    if($watching_history){

                        $video_duration = time_to_sec($admin_video_details->duration);

                        $watch_history = time_to_sec($watching_history->duration);

                        $percentage = ($watch_history/$video_duration) * 100;
                        
                        $playlist_details->watch_history_percentage = number_format($percentage);

                    }
                    
                    $playlist_details->is_playing = ($playlist_details->id == $admin_video_details->admin_video_id) ? YES : NO;

                }

                $data->video_playlist = $video_playlist;
            
            }
            
            $response_array = ['success' => true , 'data' => $data];

            return response()->json($response_array , 200);

        } catch(Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false , 'error_messages' => $error_messages , 'error_code' => $error_code];

            return response()->json($response_array , 200);

        }

    }

    /**
	 *
	 * @method admin_videos_view_second()
	 *
	 * @uses used to get video details based on the selected video id
	 *
	 * @created Vidhya R
	 *
	 * @updated Vidhya R
	 *
	 * @param integer admin_video_id
	 *
	 * @return JSON Response
	 */

	public function admin_videos_view_second(Request $request) {

		try {

			$admin_video_details = AdminVideo::SingleVideoResponse()->where('admin_videos.id' , $request->admin_video_id)->first();

            $user_details = User::find($request->id);

			if(!$admin_video_details) {

				throw new Exception(Helper::get_error_message(157), 157);
				
			}

            // Check the video is marked as spam

            if (check_flag_video($request->admin_video_id, $request->sub_profile_id)) {

                throw new Exception(Helper::get_error_message(904), 904);

            }

            $data = new \stdClass();

            /* $ $ $ $ $ $ $ $ $ $ PPV STATUS CHECK START $ $ $ $ $ $ $ $ $ $*/

            $ppv_details = VideoRepo::pay_per_views_status_check($user_details->id, $user_details->user_type, $admin_video_details)->getData();

            $is_pay_per_view = $ppv_details->success ? YES : NO;

            /* $ $ $ $ $ $ $ $ $ $ PPV STATUS CHECK END $ $ $ $ $ $ $ $ $ $*/

            $data->is_series = $admin_video_details->genre_id ? YES : NO;


            $offline_admin_video_details = OfflineAdminVideo::where('admin_video_id' , $request->admin_video_id)
                                                ->where('user_id', $request->user_id)
                                                ->first();


            $main_resolutions = $trailer_resolutions = $download_urls = [];

            $trailer_video_type = $admin_video_details->video_type;

            // Trailer video resolutions

            if ($admin_video_details->trailer_video_resolutions) {

                $request_data = ['video_resolutions' => $admin_video_details->trailer_video_resolutions , 'video_resize_path' => $admin_video_details->trailer_resize_path, 'video' => $admin_video_details->trailer_video , 'device_type' => $user_details->device_type,'video_type' => $admin_video_details->video_type ,'video_upload_type' => $admin_video_details->video_upload_type];

                $video_res_request = new \Illuminate\Http\Request();

                $video_res_request->setMethod('POST');

                $video_res_request->request->add($request_data);

                $trailer_video_resolutions_data = VideoHelper::get_video_resolutions($video_res_request);

                $trailer_resolutions = $trailer_video_resolutions_data[0];

            } else {

                $trailer_video_type = $admin_video_details->video_type;

                $trailer_video_resolutions_data['original'] = $admin_video_details->trailer_video;

                $trailer_resolutions = $trailer_video_resolutions_data;
            }

            $trailer_data = $trailer_section_data = [];

            $trailer_data['name'] = $admin_video_details->title;

            $trailer_data['default_image'] = $trailer_data['mobile_image'] = $admin_video_details->default_image;

            $trailer_data['video_type'] = $trailer_video_type ?: VIDEO_TYPE_UPLOAD;

            $trailer_data['resolutions'] = $trailer_resolutions;

            array_push($trailer_section_data, $trailer_data);

            $data->trailer_section = $trailer_section_data;
            
            /* @@@@@@@@@@@@@@@@@@@@@@ DOWNLOAD STATUS START @@@@@@@@@@@@@@@@@@@@@@ */


            /** = = = = = = = GENRE SECTION = = = = = = = = */

            $data->genres = $data->genre_videos = [];

            if($admin_video_details->genre_id) {

                $genres = Genre::where('sub_category_id', $admin_video_details->sub_category_id)->whereHas('adminVideo')->orderBy('created_at' , 'desc')->select('id as genre_id' , 'name as genre_name')->get();

                foreach ($genres as $key => $genre_details) {

                    $genre_details->is_selected = $genre_details->genre_id == $admin_video_details->genre_id ? YES : NO;
                }

                $data->genres = $genres;

                $request->request->add(['genre_id' => $admin_video_details->genre_id]);

                $data->genre_videos = VideoHelper::genre_videos($request);
           
            }

            /** = = = = = = = GENRE SECTION = = = = = = = = */

            // Suggestion videos for if is series = 0

            if($data->is_series == NO) {
                
                $suggestion_videos = VideoHelper::suggestion_videos($request);

                $suggestion_videos_data['title'] = tr('header_recommended','',$request->language);

                $suggestion_videos_data['see_all_url'] = route('userapi.section_suggestions');

                $suggestion_videos_data['data'] = $suggestion_videos ?: [];

                $data->suggestion_videos = $suggestion_videos_data;

            }

			$response_array = ['success' => true , 'data' => $data];

			return response()->json($response_array , 200);

		} catch(Exception $e) {

			$error_messages = $e->getMessage();

			$error_code = $e->getCode();

			$response_array = ['success' => false , 'error_messages' => $error_messages , 'error_code' => $error_code];

			return response()->json($response_array , 200);

		}

	}

    /**
     * @method wishlist_index()
     *
     * @uses To get all the lists based on logged in user id
     *
     * @created Vidhya R
     * 
     * @updated Vidhya R
     *
     * @param object $request - Wishlist id
     *
     * @return respone with array of objects
     */
    public function wishlist_index(Request $request)  {

        try {

            $validator = Validator::make($request->all(), [
                    'skip' => 'required|numeric',
                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);
                
            } else {
            
                $wishlist_videos = VideoHelper::wishlist_videos($request);
                
                $response_array = ['success' => true, 'data' => $wishlist_videos , 'total' => $wishlist_videos->count()];

                return response()->json($response_array, 200);
            }

        } catch (Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return response()->json($response_array);

        }
    
    }

	/**
     * @method wishlist_operations()
     *
     * @uses To add / Remove by using this operation favorite
     *
     * @created Vidhya R
     *
     * @updated Vidhya R
     *
     * @param object $request - song id and user id, token
     *
     * @return response of details
     */
    public function wishlist_operations(Request $request) {

        try {

            DB::beginTransaction();

            $validator = Validator::make(
                $request->all(),
                [
                    'clear_all_status' => 'nullable|numeric|in:'.YES.','.NO,
                    'sub_profile_id' => 'required|exists:sub_profiles,id',
                    'admin_video_id' => $request->clear_all_status == NO ? 'required|integer|exists:admin_videos,id,status,'.VIDEO_PUBLISHED.',is_approved,'.VIDEO_APPROVED : "",
                ],
                [
                	'exists.sub_profile_id' => Helper::get_error_message(168),
                	'required.admin_video_id' => Helper::get_error_message(157)
                ]
            );

            if($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);

            } else {

                if ($request->clear_all_status == YES) {

                    Wishlist::where('sub_profile_id', $request->sub_profile_id)->delete();
                    
                    $response_array = ['success' => true, 'message'=> Helper::get_message(127)];

                } else {

                	if (check_flag_video($request->admin_video_id,$request->sub_profile_id)) {

	                    throw new Exception(Helper::get_error_message(904), 904);

	                }

                    $wishlist_details = Wishlist::where('admin_video_id', $request->admin_video_id)
                                ->where('sub_profile_id', $request->sub_profile_id)
                                ->first();

                    if ($wishlist_details) {

                        if ($wishlist_details->delete()) {

                            $response_array = ['success' => true, 'message'=> Helper::get_message(129)];

                        } else {

                            throw new Exception(Helper::error_message(113), 113);
                            
                        }

                    } else {

                        $wishlist_details = new Wishlist;

                        $wishlist_details->user_id = $request->id;

                        $wishlist_details->sub_profile_id = $request->sub_profile_id;

                        $wishlist_details->admin_video_id = $request->admin_video_id;

                        $wishlist_details->status = APPROVED;

                        $wishlist_details->save();

                        $response_array = ['success' => true, 'message' => Helper::get_message(128),'wishlist_id' => $wishlist_details->id];
                    }

                }
                
            }

            DB::commit();


            $user = User::find($request->id);
            
            if($user->device_token){
                
                $message = $response_array['message'] ?? '';

                $title = Setting::get('site_name');

                dispatch(new \App\Jobs\PushNotification(PUSH_TO_USER , $title,$message,$user,$user->device_token));

            }

            return response()->json($response_array , 200);

        } catch (Exception $e) {

            DB::rollback();

            $response_array = ['success'=>false, 'error'=>$e->getMessage(), 'error_code'=>$e->getCode()];

            return response()->json($response_array);
        }

    }

    /**
     * @method notification_settings()
     *
     * To enable/disable notifications of email / push notification
     *
     * @created Vidhya R
     *
     * @updated Vidhya R
     *
     * @param - 
     *
     * @return response of details
     */
    public function notification_settings(Request $request) {

        try {

            DB::beginTransaction();

            $validator = Validator::make(
                $request->all(),
                array(
                    'status' => 'required|numeric',
                    'type'=>'required|in:'.EMAIL_NOTIFICATION.','.PUSH_NOTIFICATION
                )
            );

            if($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);

            } else {

                
                $user_details = User::find($request->id);
            
                if ($request->type == EMAIL_NOTIFICATION) {

                    $user_details->email_notification_status = $request->status;

                    $message = $request->status ? tr('notification_enable_email') : tr('notification_disable_email');

                }

                if ($request->type == PUSH_NOTIFICATION) {

                    $user_details->push_status = $request->status;

                    $message = $request->status ? tr('notification_enable_push') : tr('notification_disable_push');


                }

                $user_details->save();


                $data = ['id' => $user_details->id , 'token' => $user_details->token];

                $response_array = [
                    'success' => true ,'message' => $message, 
                    'email_notification_status' => (int) $user_details->email_notification_status,  // Don't remove int (used ios)
                    'push_notification_status' => (int) $user_details->push_status,    // Don't remove int (used ios)
                    'data' => $data
                ];
                
            }

            DB::commit();

            return response()->json($response_array , 200);

        } catch (Exception $e) {

            DB::rollback();

            $response_array = ['success'=>false, 'error'=>$e->getMessage(), 'error_code'=>$e->getCode()];

            return response()->json($response_array);
        }

    }

    /**
     * @method section_new_releases()
     *
     * @uses used to get videos based on the new release
     *
     * @created vidhya
     *
     * @updated vidhya
     *
     * @param - 
     *
     * @return response of details
     */
    public function section_new_releases(Request $request) {

        try {

            $validator = Validator::make($request->all(), [
                    'skip' => 'required|numeric',
                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);
                
            } else {
            
                $new_releases_videos = VideoHelper::new_releases_videos($request);
                
                $response_array = ['success' => true, 'data' => $new_releases_videos , 'total' => $new_releases_videos->count()];

                return response()->json($response_array, 200);
            }

        } catch (Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return response()->json($response_array);

        }

    }

    /**
     * @method section_trending()
     *
     * @uses used to get videos based on the new release
     *
     * @created vidhya
     *
     * @updated vidhya
     *
     * @param - 
     *
     * @return response of details
     */
    public function section_trending(Request $request) {

        try {

            $validator = Validator::make($request->all(), [
                    'skip' => 'required|numeric',
                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);
                
            } else {
            
                $trending_videos = VideoHelper::trending_videos($request);
                
                $response_array = ['success' => true, 'data' => $trending_videos , 'total' => $trending_videos->count()];

                return response()->json($response_array, 200);
            }

        } catch (Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return response()->json($response_array);

        }

    }

    /**
     * @method section_continue_watching_videos()
     *
     * @uses used to get videos based on the new release
     *
     * @created vidhya
     *
     * @updated vidhya
     *
     * @param - 
     *
     * @return response of details
     */
    public function section_continue_watching_videos(Request $request) {

        try {

            $validator = Validator::make($request->all(), [
                    'skip' => 'required|numeric',
                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);
                
            } else {
            
                $continue_watching_videos = VideoHelper::continue_watching_videos($request);
                
                $response_array = ['success' => true, 'data' => $continue_watching_videos , 'total' => $continue_watching_videos->count()];

                return response()->json($response_array, 200);
            }

        } catch (Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return response()->json($response_array);

        }

    }

    /**
     * @method section_suggestions()
     *
     * @uses used to get videos based on the new release
     *
     * @created vidhya
     *
     * @updated vidhya
     *
     * @param - 
     *
     * @return response of details
     */
    public function section_suggestions(Request $request) {

        try {

            $validator = Validator::make($request->all(), [
                    'skip' => 'required|numeric',
                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);
                
            } else {
            
                $suggestion_videos = VideoHelper::suggestion_videos($request);
                
                $response_array = ['success' => true, 'data' => $suggestion_videos , 'total' => $suggestion_videos->count()];

                return response()->json($response_array, 200);
            }

        } catch (Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return response()->json($response_array);

        }

    }

    /**
     * @method section_originals()
     *
     * @uses used to get videos based on the new release
     *
     * @created vidhya
     *
     * @updated vidhya
     *
     * @param - 
     *
     * @return response of details
     */
    public function section_originals(Request $request) {

        try {

            $validator = Validator::make($request->all(), [
                    'skip' => 'required|numeric',
                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);
                
            } else {
            
                $suggestion_videos = VideoHelper::suggestion_videos($request);
                
                $response_array = ['success' => true, 'data' => $suggestion_videos , 'total' => $suggestion_videos->count()];

                return response()->json($response_array, 200);
            }

        } catch (Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return response()->json($response_array);

        }

    }

    /**
     * @method category_videos()
     *
     * @uses used to get videos based on the new release
     *
     * @created vidhya
     *
     * @updated vidhya
     *
     * @param - 
     *
     * @return response of details
     */
    public function category_videos(Request $request) {

        try {

            $validator = Validator::make($request->all(), [
                    'skip' => 'required|numeric',
                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);
                
            } else {
            
                $category_videos = VideoHelper::category_videos($request);
                
                $response_array = ['success' => true, 'data' => $category_videos , 'total' => $category_videos->count()];

                return response()->json($response_array, 200);
            }

        } catch (Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return response()->json($response_array);

        }

    }

    /**
     * @method sub_category_videos()
     *
     * @uses used to get videos based on the new release
     *
     * @created vidhya
     *
     * @updated vidhya
     *
     * @param - 
     *
     * @return response of details
     */
    public function sub_category_videos(Request $request) {

        try {

            $validator = Validator::make($request->all(), [
                    'skip' => 'required|numeric',
                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);
                
            } else {
            
                $sub_category_videos = VideoHelper::sub_category_videos($request);
                
                $response_array = ['success' => true, 'data' => $sub_category_videos , 'total' => $sub_category_videos->count()];

                return response()->json($response_array, 200);
            }

        } catch (Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return response()->json($response_array);

        }

    }

    /**
     * @method genre_videos()
     *
     * @uses used to get videos based on the new release
     *
     * @created vidhya
     *
     * @updated vidhya
     *
     * @param - 
     *
     * @return response of details
     */
    public function genre_videos(Request $request) {

        try {

            $validator = Validator::make($request->all(), [
                    'skip' => 'required|numeric',
                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);
                
            } else {
            
                $genre_videos = VideoHelper::genre_videos($request);
                
                $response_array = ['success' => true, 'data' => $genre_videos , 'total' => $genre_videos->count()];

                return response()->json($response_array, 200);
            }

        } catch (Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return response()->json($response_array);

        }

    }

    /**
     * @method save_continue_watching_video
     *
     * @uses To save every few seconds in continue wattching videos
     *
     * @created : 
     *
     * @edited : 
     *
     * @param object $request - Userid, token, sub_profile_id & admin video id, duarion
     *
     * @return response of success / failure
     */
    public function continue_watching_videos_save(Request $request) {

        // If user watching the video, we shouldn't allow user get logout.

        check_token_expiry($request->id);

        try {

            DB::beginTransaction();

            $validator = Validator::make($request->all(),[
                    'admin_video_id' => 'required|exists:admin_videos,id',
                    'duration'=>'required',
                ]);

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages);
                
            }

            $continue_watching_video_details = ContinueWatchingVideo::where('sub_profile_id', $request->sub_profile_id)->where('admin_video_id', $request->admin_video_id)->first();

            if (!$continue_watching_video_details) {

                $continue_watching_video_details = new ContinueWatchingVideo;

            }

            $admin_video_details = AdminVideo::where('is_approved' , 1)->where('status' , 1)->where('id', $request->admin_video_id)->first();

            if(!$admin_video_details) {
                
                throw new Exception(tr('video_not_approved_by_admin'));

            }

            $continue_watching_video_details->user_id = $request->id;

            $continue_watching_video_details->sub_profile_id = $request->sub_profile_id;

            $continue_watching_video_details->admin_video_id = $admin_video_details->id;

            $continue_watching_video_details->status = DEFAULT_TRUE; 

            $continue_watching_video_details->is_genre = $admin_video_details->genre_id > 0 ? DEFAULT_TRUE : DEFAULT_FALSE;

            if ($continue_watching_video_details->is_genre) {

                $genre_details = Genre::where('status', DEFAULT_TRUE)->where('is_approved', DEFAULT_TRUE)->where('id', $admin_video_details->genre_id)->first();

                if (!$genre_details) {

                    throw new Exception(tr('genre_not_found'), 101);
                    
                }

                $continue_watching_video_details->position = $admin_video_details->position;

                $continue_watching_video_details->genre_position = $genre_details->position;

            } else {

                $continue_watching_video_details->position = 0;

                $continue_watching_video_details->genre_position = 0;
            }

            $continue_watching_video_details->duration = gmdate("H:i:s", $request->duration);

            $continue_watching_video_details->duration_in_seconds = $request->duration ?: 0;


            if($continue_watching_video_details->save()) {

                DB::commit();
                 
                $continue_watching_video_details->video_title = $admin_video_details->title;

                $response_array = array('success' => true, 'data' => $continue_watching_video_details);

            } else {
                throw new Exception(tr('continue_watching_video_save_error'), 101);
                
            }

            return response()->json($response_array, 200);

        } catch (Exception $e) {

            DB::rollback();

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return response()->json($response_array);

        }

    }

    /**
     * @method sub_profiles_delete()
     * 
     * @uses Based on logged in user , Delete sub profiles using sub profile id
     *
     * @created : vidhya R
     *
     * @edited : 
     *
     * @param object $request - User Id , sub profile id
     *
     * @return response of boolean
     */
    public function sub_profiles_delete(Request $request) {

        try {


            $validator = Validator::make($request->all(),[
                    'delete_sub_profile_id'=>'required'
                ]);

            if ($validator->fails()) {

                $error = implode(',', $validator->messages()->all());

                throw new Exception($error);
            } 

            DB::beginTransaction();

            $user_details = User::find($request->id);

            $next_sub_profile_id = $request->sub_profile_id;

            $delete_sub_profile = SubProfile::find($request->delete_sub_profile_id);

            if (!$delete_sub_profile) {

                throw new Exception(tr('sub_profile_details_not_found'), 101);
            }

            $delete_sub_profile_check_default_status = $delete_sub_profile->status;

            $delete_sub_profile->delete();

            $next_sub_profile = SubProfile::where('user_id', $request->id)->first();

            if ($delete_sub_profile_check_default_status == DEFAULT_SUB_PROFILE || $request->sub_profile_id == $request->delete_sub_profile_id) {

                if($next_sub_profile) {

                    $next_sub_profile->status = DEFAULT_TRUE;

                    $next_sub_profile->save();

                    $next_sub_profile_id = $next_sub_profile->id;

                } else {

                    throw new Exception(Helper::get_error_message(169), 169);
                }
            }
            
            $user_details->no_of_account -= 1;

            if ($user_details->save()) {

                $response_array = ['success' => true , 'message' => tr('sub_profile_deleted'),'sub_profile_id' => $next_sub_profile_id];

            } else {

                throw new Exception(tr('user_details_not_save'));
            }

            DB::commit();

            return response()->json($response_array, 200);

        } catch(Exception $e) {

            DB::rollback();

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return response()->json($response_array);

        }

    }

    /**
     * @method spam_videos()
     * 
     * @uses index
     *
     * @created Vithya R 
     *
     * @updated Vithya R 
     *
     * @param object $request - sub profile id, video id
     * 
     * @return spam video details
     */
    public function spam_videos(Request $request) {

        try {

            $validator = Validator::make($request->all(), [
                            'sub_profile_id'=>'required|exists:sub_profiles,id',
                            'skip' => 'required|numeric',

                        ], 
                        [
                            'exists' => 'The :attribute doesn\'t exists',
                        ]);
        
            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);
                
            }

            $base_query = Flag::where('flags.user_id', $request->id)
                                ->where('flags.sub_profile_id', $request->sub_profile_id);

            $take = Setting::get('admin_take_count', 12);

            $skip = $request->skip ?: 0;

            $suggestion_video_ids = $base_query->skip($skip)->take($take)->pluck('video_id')->toArray();

            $admin_videos = VideoRepo::video_list_response($suggestion_video_ids);

            $response_array = ['success' => true, 'data' => $admin_videos];

            return response()->json($response_array, 200);

        } catch (Exception $e) {

            DB::rollback();

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return response()->json($response_array);

        }

    }

    /**
     * @method spam_videos_add()
     * 
     * @uses Spam videos based on each single video based on logged in user id, If they flagged th video they wont see in any of the pages except spam videos page
     *
     * @created Vithya R 
     *
     * @updated Vithya R 
     *
     * @param object $request - sub profile id, video id
     * 
     * @return spam video details
     */
    public function spam_videos_add(Request $request) {

        try {

            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                            'admin_video_id' => 'required|exists:admin_videos,id',
                            'sub_profile_id'=>'required|exists:sub_profiles,id',
                            'reason' => 'required',
                        ], 
                        [
                            'exists' => 'The :attribute doesn\'t exists',
                        ]);
        
            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);
                
            }

            $spam_video_details = Flag::where('user_id', $request->id)->where('video_id', $request->admin_video_id)->where('sub_profile_id', $request->sub_profile_id)->first();

            if (!$spam_video_details) {

                $data = $request->all();

                $data['user_id'] = $request->id;

                $data['video_id'] =$request->admin_video_id;

                $data['sub_profile_id'] = $request->sub_profile_id;
                
                $data['status'] = DEFAULT_TRUE;

                if (Flag::create($data)) {

                    $response_array = ['success' => true, 'message' => tr('report_video_success_msg')];

                } else {

                    throw new Exception(tr('admin_published_video_failure'), 101);
                    
                }

            } else {

                $spam_video_details->status =  DEFAULT_TRUE;

                $spam_video_details->save();

                $response_array = ['success' => true, 'message' => tr('report_video_success_msg')];
            
            }

            DB::commit();

            return response()->json($response_array, 200);

        } catch (Exception $e) {

            DB::rollback();

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return response()->json($response_array);

        }

    }

    /**
     * @method spam_videos_remove()
     * 
     * @uses Remove Spam videos based on each single video based on logged in user id, You can see the videos in all the pages
     *
     * @created Vithya R 
     *
     * @updated Vithya R 
     *
     * @param object $request - sub profile id, video id
     * 
     * @return spam video details
     */
    public function spam_videos_remove(Request $request) {

        try {
            
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                            'sub_profile_id'=>'required|exists:sub_profiles,id',
                        ], 
                        [
                            'exists' => 'The :attribute doesn\'t exists',
                        ]);
        
            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);
                
            }

            if($request->clear_all_status == YES) {

                $spam_videos = Flag::where('user_id', $request->id)->where('sub_profile_id', $request->sub_profile_id)->delete();
                
                $response_array = ['success' => true, 'message' => tr('unmark_report_video_success_msg')];

            } else {

                $admin_video_details = AdminVideo::where('id', $request->admin_video_id)->first();
                

                if(!$admin_video_details) {

                    throw new Exception(Helper::get_error_message(157), 157);
                    
                }
            
                $spam_video_details = Flag::where('user_id', $request->id)
                                        ->where('sub_profile_id', $request->sub_profile_id)
                                        ->where('video_id', $request->admin_video_id)
                                        ->first();

                if (!$spam_video_details) {

                    throw new Exception(tr('spam_not_found'), 101);   

                }                 
                
                $spam_video_details->delete();

                $response_array = ['success' => true, 'message' => tr('unmark_report_video_success_msg')];


            }

            DB::commit(); 

            return response()->json($response_array, 200);


        } catch (Exception $e) {

            DB::rollback();

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return response()->json($response_array);
        }
    }

    /**
     * @method register()
     * 
     * @uses Register a new user 
     *
     * @created Anjana H
     * 
     * @edited: Anjana H
     *
     * @param object $request - New User Details
     * 
     * @return Json Response with user details
     *
     */
    public function register(Request $request) {
        
        try {

            DB::beginTransaction();

            $basicValidator = Validator::make(
                $request->all(),
                array(
                    'device_type' => 'required|in:'.DEVICE_ANDROID.','.DEVICE_IOS.','.DEVICE_WEB,
                    'device_token' => 'required',
                    'login_by' => 'required|in:manual,facebook,google,apple',
                )
            );

            if($basicValidator->fails()) {

                $error_messages = implode(',', $basicValidator->messages()->all());

                throw new Exception($error_messages, 101);

            } else {

                $allowedSocialLogin = ['facebook','google', 'apple'];

                $new_user_send_email = YES;

                if (in_array($request->login_by,$allowedSocialLogin)) {

                    // validate social registration fields

                    $socialValidator = Validator::make(
                                $request->all(),
                                array(
                                    'social_unique_id' => 'required',
                                    'name' => 'required|min:2|max:100',
                                    'email' => 'required|email|max:255',
                                    // 'mobile' => 'digits_between:4,16',
                                    'picture' => "",
                                )
                            );

                    if ($socialValidator->fails()) {

                        $error_messages = implode(',', $socialValidator->messages()->all());
                        throw new Exception($error_messages, 101);
                    }

                    $user = User::where('email' , $request->email)->first();

                    if ($user) {

                        $new_user_send_email = NO;
                    }

                } else {

                    // Validate manual registration fields

                    $manualValidator = Validator::make(
                        $request->all(),
                        array(
                            'name' => 'required|min:2|max:100',
                            'email' => 'required|email|max:255',
                            'password' => 'required|min:6',
                            // 'mobile' => 'nullable|digits_between:4,16',
                            'picture' => 'mimes:jpeg,jpg,bmp,png',
                        ),
                        // [
                        //     'mobile.digits_between' => 'The :attribute number must be between 4 and 16 digits'
                        // ]
                    );

                    if($manualValidator->fails()) {

                        $error_messages = implode(',', $manualValidator->messages()->all());
                       
                        throw new Exception($error_messages, 101);                        
                    } 

                    // validate email existence

                    $emailValidator = Validator::make(
                        $request->all(),
                        array(
                            'email' => 'unique:users,email',
                        )
                    );

                    if($emailValidator->fails()) {

                        $error_messages = implode(',', $emailValidator->messages()->all());

                        throw new Exception($error_messages, 101);
                    }

                    $user = "";
                }

                // Creating the user

                if($new_user_send_email) {

                    $user = new User;

                    register_mobile($request->device_type);

                } else {

                    if ($user->is_activated == USER_DECLINED) {

                        throw new Exception(Helper::get_error_message(905),905);
                    
                    }

                    $sub_profile = SubProfile::where('user_id', $user->id)->first();

                    if (!$sub_profile) {

                        $new_user_send_email = YES;

                    }

                }


                $user->name = $request->name;

                $user->email = $request->email;

                $user->mobile = $request->mobile ?? ($user->mobile ?? '');

                $user->password = Hash::make($request->password);

                $user->gender = $request->has('gender') ? $request->gender : "male";

                $user->token = Helper::generate_token();

                $user->token_expiry = Helper::generate_token_expiry();

                $check_device_exist = User::where('device_token', $request->device_token)->first();

                if($check_device_exist){

                    $check_device_exist->device_token = "";

                    $check_device_exist->save();
                }

                $user->device_token = $request->has('device_token') ? $request->device_token : "";

                $user->device_type =$request->device_type;

                $user->login_by = $request->login_by;

                $user->social_unique_id = $request->social_unique_id ? : '';

                if($new_user_send_email){

                    $user->picture = asset('placeholder.png');

                }

                // Upload Picture

                $user->is_verified = USER_EMAIL_VERIFIED;

                $user->is_activated = $user->no_of_account = $user->logged_in_account = $user->status = 1;

                $user->timezone = $request->timezone ?: 'America/New_York';

                if($request->login_by == MANUAL) {

                    if($request->hasFile('picture')) {

                        $user->picture = Helper::storage_upload_file($request->file('picture'), PROFILE_PATH_USER);

                    }

                } else {

                    if($new_user_send_email && $request->has('picture')) {

                        $user->picture = $request->picture ?:asset('placeholder.png');

                    }

                }

                if(Setting::get('email_verify_control')) {

                    $user->status = DEFAULT_FALSE;

                    if ($request->login_by == 'manual') {

                        $user->is_verified = USER_EMAIL_NOT_VERIFIED;

                    }

                } 

                if ($user->save()) {

                    if($request->referral_code) {

                        Helper::referral_register($request->referral_code, $user);
                    }
                    
                    // Send welcome email to the new user:
                    
                    if($new_user_send_email == YES) {

                        // Check the default subscription and save the user type 

                        $user->user_type = user_type_check();

                        $user->user_type_change_by = $user->user_type ? "" : "USER CHECK";

                        if ($user->login_by == MANUAL) {

                            // $user->password = $request->password;

                            $email_data['page'] = "emails.welcome";

                            $email_data['user_id'] = $user->id;

                            $email_data['email'] = $user->email;

                            $email_data['verification_code'] = $user->verification_code;

                            $email_data['subject'] = tr('user_welcome_title').' '.Setting::get('site_name');

                            $email_data['data'] = $user;

                            $email_data['content'] = Helper::get_email_content(USER_WELCOME,$email_data);

                            $email_data['subject'] = tr('welcome_title', Setting::get('site_name'));

                            if(Setting::get('email_notification') == YES) {

                                dispatch(new SendEmailJob($email_data));

                            } else {
                                Log::info("Email notification off for user");
                            }

                        }

                        $sub_profile = new SubProfile;

                        $sub_profile->user_id = $user->id;

                        $sub_profile->name = $user->name;

                        $sub_profile->picture = $user->picture;

                        $sub_profile->status = DEFAULT_TRUE;

                        if ($sub_profile->save()) {

                            // Response with registered user details:

                            if (!Setting::get('email_verify_control')) {

                                $logged_device = new UserLoggedDevice();

                                $logged_device->user_id = $user->id;

                                $logged_device->token_expiry = Helper::generate_token_expiry();

                                $logged_device->status = DEFAULT_TRUE;

                                $logged_device->save();

                            }
                            

                        } else {

                            throw new Exception(tr('sub_profile_not_save'),101);
                            
                        }
                    }

                    $moderator = Moderator::where('email', $user->email)->first();

                    // If the user already registered as moderator, automatically the status will update.

                    if($moderator && $user) {

                        $user->is_moderator = DEFAULT_TRUE;

                        $user->moderator_id = $moderator->id;

                        $user->save();

                        $moderator->is_activated = DEFAULT_TRUE;

                        $moderator->is_user = DEFAULT_TRUE;

                        $moderator->save();

                    }

                    if ($user->is_verified) {

                        counter('home');

                        $user_details = User::where('id' , $user->id)->CommonResponse()->first();

                        $data = $user_details->toArray();

                        $data['id'] = $user_details->id;

                        $data['user_id'] = $user_details->id;

                        $data['card_last_four_number'] = "";

                        $data['sub_profile_id'] = $sub_profile->id;

                        $data['sub_profile_name'] = $sub_profile->name ?? $user_details->name;

                        $data['sub_profile_picture'] = $sub_profile->picture ?? $user_details->picture;

                        $data['payment_subscription'] = $data['appstore_update_status'] = (int) Setting::get('ios_payment_subscription_status');

                        $email_verify_control = Setting::get('email_verify_control');

                        $data['verification_control'] = $email_verify_control;

                        $data['ios_jw_player_paid_version'] = Setting::get('ios_jw_player_paid_version');

                        $data['jw_player_key_ios'] = Setting::get('jw_player_key_ios');

                        $message = $email_verify_control && !$user_details->is_verified ? tr('register_verify_success') : tr('register_success');
                        
                        $response_array = ['success' => true, 'message'=> $message ,'data' => $data];                       

                    } else {

                        $response_array = ['success' => false, 'error_messages' => Helper::get_error_message(3001), 'error_code' => 3001];

                    }

                }

            }

            DB::commit();

            $response = response()->json($response_array, 200);

            return $response;

        } catch(Exception $e) {

            DB::rollback();

            $response_array = ['success'=>false, 'error_messages'=>$e->getMessage(), 'error_code'=>$e->getCode()];

            return response()->json($response_array);
        }
    
    }

        /**
     * @method login()
     *
     * @uses Registered user can login using their email & Password
     * 
     * @created Vithya R
     * 
     * @updated vithya R
     *
     * @param object $request - User Email & Password
     *
     * @return Json response with user details
     */
    public function login(Request $request) {

        try {

            DB::beginTransaction();
            
            $basicValidator = Validator::make($request->all(), 
                array(

                    'device_token' => 'required',
                    'device_type' => 'required|in:'.DEVICE_ANDROID.','.DEVICE_IOS.','.DEVICE_WEB,
                    'login_by' => 'required|in:manual,facebook,google,apple',
                )
            );
           
            if($basicValidator->fails()){
                
                $error_messages = implode(',',$basicValidator->messages()->all());

                throw new Exception($error_messages, 101);
            
            } else {

                /*validate manual login fields*/

                $manualValidator = Validator::make($request->all(),
                    array(
                        'email' => 'required|email',
                        'password' => 'required',

                    )
                );

                if ($manualValidator->fails()) {

                    $error_messages = implode(',',$manualValidator->messages()->all());

                    throw new Exception($error_messages, 101);
                
                }

                /*validate manual login fields*/

                $emailValidator = Validator::make($request->all(),
                    array(
                        'email' => 'exists:users,email',
                    )
                );

                if ($emailValidator->fails()) {

                    $error_messages = implode(',',$emailValidator->messages()->all());

                    throw new Exception($error_messages, 101);
                
                }

                $user = User::where('email', '=', $request->email)->first();
                
                if(!$user->is_activated) {

                    throw new Exception(Helper::get_error_message(905));

                }

                if (!$user->is_verified) {

                    if (Setting::get('email_verify_control')) {

                        Helper::check_email_verification("" , $user->id, $error);

                        throw new Exception(Helper::get_error_message(3001), 3001);

                    } else {

                        $user->is_verified = USER_EMAIL_VERIFIED;

                    }

                }

                if(Hash::check($request->password, $user->password)){


                } else {

                    throw new Exception(Helper::get_error_message(105), 105);
                    
                }

                $sub_profile = SubProfile::where('user_id', $user->id)->first();

                if ($sub_profile) {

                    $sub_profile_id = $sub_profile->id;

                } else {

                    $sub_profile = new SubProfile;

                    $sub_profile->user_id = $user->id;

                    $sub_profile->name = $user->name;

                    $sub_profile->status = DEFAULT_TRUE;

                    $sub_profile->picture = $user->picture;

                    if ($sub_profile->save()) {

                        $sub_profile_id = $sub_profile->id;

                        $user->no_of_account += 1;

                        $user->save();

                    } else {

                        throw new Exception(tr('sub_profile_not_save'));
                        
                    }
                }

                if ($user->email != DEMO_USER) {

                    if ($user->no_of_account >= $user->logged_in_account) {

                        $model = UserLoggedDevice::where("user_id",$user->id)->get();

                        foreach ($model as $key => $value) {

                            if ($value->token_expiry > time()) {


                            } else {

                               if ($value->delete()) {

                                    $user->logged_in_account -= 1;

                                    $user->save();

                                }

                            }

                        }
                    }

                } else {

                    $user->logged_in_account = 0;

                    $user->save();

                }

                 
                $user->token_expiry = Helper::generate_token_expiry();

                // Save device details

                $user->device_token = $request->device_token;

                $user->device_type = $request->device_type;

                $user->login_by = $request->login_by;

                $user->timezone = $request->timezone ?: $user->timezone;

                if ($user->save()) {

                    counter('home');

                    $payment_mode_status = $user->payment_mode ? $user->payment_mode : 0;
 
                    $logged_device = new UserLoggedDevice();

                    $logged_device->user_id = $user->id;

                    $logged_device->token_expiry = Helper::generate_token_expiry();

                    $logged_device->status = DEFAULT_TRUE;

                    $logged_device->save();

                    $user->logged_in_account += 1;

                    $user->save();

                    $user_details = User::where('id' , $user->id)->CommonResponse()->first();

                    $data = $user_details->toArray();

                    $data['id'] = $user_details->id;

                    $data['user_id'] = $user_details->id;
                    
                    $data['card_last_four_number'] = "";

                    $data['sub_profile_id'] = $sub_profile_id;

                    $data['sub_profile_name'] = $sub_profile->name ?? $user_details->name;

                    $data['sub_profile_picture'] = $sub_profile->picture ?? $user_details->picture;

                    $data['payment_subscription'] = $data['appstore_update_status'] = (int) Setting::get('ios_payment_subscription_status');

                    $email_verify_control = Setting::get('email_verify_control');

                    $data['verification_control'] = $email_verify_control;

                    $data['ios_jw_player_paid_version'] = Setting::get('ios_jw_player_paid_version');

                    $data['jw_player_key_ios'] = Setting::get('jw_player_key_ios');

                    $message = tr('login_success');
                    
                    $response_array = ['success' => true, 'message'=> $message ,'data' => $data];

                } else {

                    throw new Exception(tr('no_of_logged_in_device'));
                    
                }
                   
               
            }
           
            DB::commit();

            return response()->json($response_array, 200);

        } catch(Exception $e) {

            DB::rollback();

            $response_array = ['success'=>false, 'error_messages'=>$e->getMessage(), 'error_code'=>$e->getCode()];

            return response()->json($response_array);

        }
    
    }


    /**
     * @method user_details()
     * 
     * @uses get the user details 
     *
     * @created Anjana H
     * 
     * @updated Anjana H
     *
     * @param 
     * 
     * @return JSON Response
     *
     */
    public function profile(Request $request) {
        
        try {
            
            $user_details = User::where('id' , $request->id)->CommonResponse()->first();

            if (!$user_details) { 

                throw new Exception(Helper::get_error_message(3000), 3000);
            }

            // Sub profile details

            $sub_profile_details = SubProfile::where('user_id', $request->id)->where('status', DEFAULT_SUB_PROFILE)->first();

            $sub_profile_id =  $sub_profile_details ? $sub_profile_details->id : 0 ;

            $card_details = Card::find($user_details->card_id);

            $card_last_four_number = $card_details ? $card_details->last_four : "";

            $get_subscription_title_query = UserPayment::where('user_id' , $request->id)
                    ->leftJoin('subscriptions', 'subscriptions.id', '=', 'subscription_id')
                    ->select('subscriptions.title as subscription_name')
                    ->orderBy('user_payments.created_at', 'desc');

            $model = $get_subscription_title_query->first();


            $data = $user_details->toArray();

            $data['card_last_four_number'] = $card_last_four_number;

            $data['sub_profile_id'] = $sub_profile_id;

            $data['subscription_title'] = (!empty($model) && $model != null) ? $model->subscription_name : "";
            
            $response_array = ['success' => true, 'data' => $data];

            return response()->json($response_array, 200);

        } catch(Exception $e) {


            $response_array = ['success' => false, 'error_messages '=> $e->getMessage(), 'error_code' => $e->getCode()];

            return response()->json($response_array);
        }
    }


    /**
     * @method profile_update()
     *
     * @uses To update the user details
     *
     * @created Anjana H
     * 
     * @updated Vidhya R
     *
     * @param objecct $request
     *
     * @return JSON Response
     */
    public function profile_update(Request $request) {

        try {

            DB::beginTransaction();
           
            $validator = Validator::make(
                $request->all(),
                array(
                    'name' => 'required|min:2|max:100',
                    'email' => 'nullable|email|unique:users,email,'.$request->id.'|max:255',
                    'mobile' => 'nullable|digits_between:4,16',
                    'picture' => 'nullable|mimes:jpeg,bmp,png',
                    'device_token' => '',
                ));

            if ($validator->fails()) {

                $error = implode(',',$validator->messages()->all());

                throw new Exception($error, 101);                
            } 

            $user_details = User::find($request->id);

            if (!$user_details) { 

                throw new Exception(Helper::get_error_message(3000), 3000);
            }
            
            $user_details->name = $request->name ?: $user_details->name;
            
            if($request->has('email')) {

                $user_details->email = $request->email;
            }

            $user_details->mobile = $request->mobile ?: $user_details->mobile;

            $user_details->gender = $request->gender ?: $user_details->gender;

            $user_details->address = $request->address ?: $user_details->address;

            $user_details->description = $request->description ? $request->description : $user_details->address;

            // Upload picture

            if ($request->hasFile('picture') != "") {

            
                Helper::storage_delete_file($user_details->picture, COMMON_IMAGE_PATH); // Delete the old pic

                $user_details->picture = Helper::storage_upload_file($request->file('picture'), COMMON_IMAGE_PATH);
           
           
            }

            if ($user_details->save()) {

                // Sub profile details

                $sub_profile_details = SubProfile::where('user_id', $request->id)->where('status', DEFAULT_SUB_PROFILE)->first();

                $sub_profile_id =  $sub_profile_details ? $sub_profile_details->id : 0 ;

                // Card details

                $card_details = Card::find($user_details->card_id);

                $card_last_four_number = $card_details ? $card_details->last_four : "";

                $data = User::CommonResponse()->find($user_details->id);

                $data = $data->toArray();

                $data['card_last_four_number'] = $card_last_four_number;

                $data['sub_profile_id'] = $sub_profile_id;

                $response_array = ['success' => true ,  'message' => Helper::get_message(130), 'data' => $data];

            } else {

                throw new Exception(Helper::get_error_message(170), 170);
            }

            DB::commit();

            return response()->json($response_array, 200);

        } catch (Exception $e) {

            DB::rollback();

            $response_array = ['success' => false, 'error_messages' => $e->getMessage(), 'error_code' => $e->getCode()];

            return response()->json($response_array);
        }
    
    }

    /**
     * @method history_index()
     *  
     * @uses To get all the history details based on logged in user id
     *
     * @created Anjana H
     * 
     * @updated Vithya R
     *
     * @param object $request - User Profile details
     *
     * @return Response with list of details
     */     
    public function history_index(Request $request) {

        try {

            $validator = Validator::make($request->all(),['skip' => 'required|numeric']);

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages);                
            } 

            $sub_profile_id = $request->sub_profile_id;

            $histories = VideoHelper::history_videos($request);

            // foreach ($histories as $key => $history_details) {

            //     $history_details->is_spam = check_flag_video($history_details->admin_video_id, $sub_profile_id)

            // }

            $response_array = ['success' => true, 'data' => $histories , 'total' => $histories->count()];

            return response()->json($response_array, 200);

        } catch (Exception $e) {

            $response_array = ['success' => false, 'error_messages' => $e->getMessage(), 'error_code' => $e->getCode()];

            return response()->json($response_array);
        }   
    
    }

        /**
     * @method history_delete()
     *
     * @uses To delete history based on login id
     *
     * @created Vithya R
     * 
     * @updated vithya R
     *
     * @param Object $request - History Id
     *
     * @return Json object based on history
     */
    public function history_delete(Request $request) {

        try {

            DB::beginTransaction();
            
            $validator = Validator::make($request->all(),
                [
                    'admin_video_id' => $request->clear_all_status ? 'integer|exists:admin_videos,id' : 'required|integer|exists:admin_videos,id',
                    'sub_profile_id' => 'required|integer|exists:sub_profiles,id',
                ],[
                    'exists' => 'The :attribute doesn\'t exists please add to history',
                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);                
            }

        
            if($request->clear_all_status == YES) {

                $history = UserHistory::where('user_id', $request->sub_profile_id)->delete();

            } else {

                $history = UserHistory::where('admin_video_id' ,  $request->admin_video_id)
                                ->where('user_id', $request->sub_profile_id)
                                ->delete();
            }

            $response_array = ['success' => true, 'message' => tr('delete_history_success')];

            DB::commit();

            return response()->json($response_array, 200);

        } catch(Exception $e) {

            DB::rollback();

            $response_array = ['success' => false, 'error_messages' => $e->getMessage(), 'error_code' => $e->getCode()];

            return response()->json($response_array, 200);

        }
    
    }

    /**
     * @method videos_like()
     * 
     * @uses Like videos in each single video based on logged in user id
     *
     * @created Anjana H
     *
     * @updated Anjana H 
     *
     * @param object $request - video id & sub profile id
     * 
     * @return resposne of success/failure message with count of like and dislike
     */
    public function videos_like(Request $request) {

        try {

            $validator = Validator::make($request->all() , [
                'admin_video_id' => 'required|exists:admin_videos,id,status,'.VIDEO_PUBLISHED.',is_approved,'.VIDEO_APPROVED,
                'sub_profile_id'=>'required|exists:sub_profiles,id',
                ], array(
                    'exists' => 'The :attribute doesn\'t exists',
                ));

            if ($validator->fails()) {

                $error = implode(',', $validator->messages()->all());

                throw new Exception($error, 101);          
            }

            $like_dislike_video_details = LikeDislikeVideo::where('admin_video_id', $request->admin_video_id)
                            ->where('user_id',$request->id)
                            ->where('sub_profile_id',$request->sub_profile_id)
                            ->first();

            $like_count = LikeDislikeVideo::where('admin_video_id', $request->admin_video_id)
                            ->where('like_status', DEFAULT_TRUE)
                            ->count();

            $dislike_count = LikeDislikeVideo::where('admin_video_id', $request->admin_video_id)
                            ->where('dislike_status', DEFAULT_TRUE)
                            ->count();

            if (!$like_dislike_video_details) {

                $like_dislike_video_details = new LikeDislikeVideo;

                $like_dislike_video_details->admin_video_id = $request->admin_video_id;

                $like_dislike_video_details->user_id = $request->id;

                $like_dislike_video_details->sub_profile_id = $request->sub_profile_id;

                $like_dislike_video_details->like_status = DEFAULT_TRUE;

                $like_dislike_video_details->dislike_status = DEFAULT_FALSE;

                if( $like_dislike_video_details->save() ) {

                    $data = new \stdClass;

                    $data->like_count = $like_count+1;

                    $data->dislike_count = $dislike_count;

                    $data->delete = DEFAULT_FALSE;
                        
                    $response_array = ['success' => true, 'data' => $data,'message'=>tr('like_video')];

                } else {

                    throw new Exception(tr('something_error'), 101);
                }


            } else {

                if( $like_dislike_video_details->dislike_status ) {

                    $like_dislike_video_details->like_status = DEFAULT_TRUE;

                    $like_dislike_video_details->dislike_status = DEFAULT_FALSE;

                    if( $like_dislike_video_details->save() ) {

                        $data = new \stdClass;

                        $data->like_count = $like_count+1;

                        $data->dislike_count = $dislike_count-1;
                            
                        $response_array = ['success' => true, 'data' => $data,'message'=>tr('like_video')];


                    } else {

                        throw new Exception(tr('something_error'), 101);
                    }

                } else {

                    if( $like_dislike_video_details->delete()) {

                        $data = new \stdClass;

                        $data->like_count = $like_count-1;

                        $data->dislike_count = $dislike_count;

                        $data->delete = DEFAULT_TRUE;
                            
                        $response_array = ['success' => true, 'data' => $data,'message'=>tr('dislike_video')];
                   
                    } else {

                        throw new Exception(tr('something_error'), 101);
                    }
                }
            }

            DB::commit();

            return response()->json($response_array, 200);  

        } catch (Exception $e) {
            
            DB::rollback();

            $message = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $message, 'error_code' => $error_code];

            return response()->json($response_array);
        }

    }

    /**
     * @method videos_dislike()
     * 
     * @uses DisLike videos in each single video based on logged in user id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param object $request - video id & sub profile id
     * 
     * @return resposne of success/failure message with count of like and dislike
     */
    public function videos_dislike(Request $request) {

        try {

            $validator = Validator::make($request->all() , [
                'admin_video_id' => 'required|exists:admin_videos,id,status,'.VIDEO_PUBLISHED.',is_approved,'.VIDEO_APPROVED,
                'sub_profile_id'=>'required|exists:sub_profiles,id',
                ], array(
                    'exists' => 'The :attribute doesn\'t exists',
                ));

            if ($validator->fails()) {

                $error = implode(',', $validator->messages()->all());
                
                throw new Exception($error, 101);
            }

            $like_dislike_video_details = LikeDislikeVideo::where('admin_video_id', $request->admin_video_id)
                    ->where('user_id',$request->id)
                    ->where('sub_profile_id',$request->sub_profile_id)
                    ->first();
           
            $like_count = LikeDislikeVideo::where('admin_video_id', $request->admin_video_id)
                ->where('like_status', DEFAULT_TRUE)
                ->count();

            $dislike_count = LikeDislikeVideo::where('admin_video_id', $request->admin_video_id)
                ->where('dislike_status', DEFAULT_TRUE)
                ->count();

            if (!$like_dislike_video_details) {

                $like_dislike_video_details = new LikeDislikeVideo;

                $like_dislike_video_details->admin_video_id = $request->admin_video_id;

                $like_dislike_video_details->user_id = $request->id;

                $like_dislike_video_details->sub_profile_id = $request->sub_profile_id;

                $like_dislike_video_details->like_status = DEFAULT_FALSE;

                $like_dislike_video_details->dislike_status = DEFAULT_TRUE;
                
                if( $like_dislike_video_details->save() ) {

                    $data = new \stdClass;

                    $data->like_count = $like_count;

                    $data->dislike_count = $dislike_count+1;

                    $data->delete = DEFAULT_FALSE;
                        
                    $response_array = ['success' => true, 'data' => $data];
                        
                } else {

                    throw new Exception(tr('something_error'), 101);
                }

            } else {

                if($like_dislike_video_details->like_status) {

                    $like_dislike_video_details->like_status = DEFAULT_FALSE;

                    $like_dislike_video_details->dislike_status = DEFAULT_TRUE;

                    if( $like_dislike_video_details->save() ) {
                        
                        $data = new \stdClass;

                        $data->like_count = $like_count-1;

                        $data->dislike_count = $dislike_count+1;
                            
                        $response_array = ['success' => true, 'data' => $data];


                    } else {

                        throw new Exception(tr('something_error'), 101);
                    }

                } else {

                    if( $like_dislike_video_details->delete() ) {

                        $data = new \stdClass;

                        $data->like_count = $like_count;

                        $data->dislike_count = $dislike_count-1;

                        $data->delete = DEFAULT_TRUE;
                            
                        $response_array = ['success' => true, 'data' => $data];                          

                    } else {

                        throw new Exception(tr('something_error'), 101);
                    }
                }
            }

            DB::commit();

            return response()->json($response_array, 200); 
            
        } catch (Exception $e) {
            
            DB::rollback();

            $message = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $message, 'error_code' => $error_code];

            return response()->json($response_array);
        }

    }

    /**
     * @method categories_list()
     * 
     * @uses Get categories and split into chunks (6)
     *
     * @created Vidhya R
     *
     * @updated 
     *
     * @param object $request - As of now no attribute
     *
     * @return array of array category
     */
    
    public function categories_list(Request $request) {

        $skip = $request->skip ?: 0;

        $take = $request->take ?: (Setting::get('admin_take_count') ?: 12);
        
        $categories = Category::where('categories.is_approved' , 1)
                    ->select('categories.id as category_id' , 'categories.name' , 'categories.picture' ,
                        'categories.is_series' ,'categories.status' , 'categories.is_approved')
                    ->leftJoin('admin_videos' , 'categories.id' , '=' , 'admin_videos.category_id')
                    ->where('admin_videos.status' , 1)
                    ->where('admin_videos.is_approved' , 1)
                    ->groupBy('admin_videos.category_id')
                    ->havingRaw("COUNT(admin_videos.id) > 0")
                    ->orderBy('name' , 'ASC')
                    ->skip($skip)
                    ->take($take)
                    ->get();

        $response_array = ['success' => true, 'data' => $categories];

        return response()->json($response_array, 200);
   
    }

    /**
     * @method cast_crews_videos()
     *
     * @uses To load videos based on cast & crews
     *
     * @created Vithya R
     *
     * @updated
     *
     * @param object $request - user & crews details
     *
     * @return response of json details
     */
   public function cast_crews_videos(Request $request) {

        try {

            $validator = Validator::make($request->all(), [
                    'skip' => 'required|numeric',
                    'cast_crew_id'=>'required|exists:cast_crews,id'
                ],
                [

                    'cast_crew_id.exists'=>tr('cast_crew_not_found')

                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);
                
            }
            
            $cast_crews_videos = VideoHelper::cast_crews_videos($request);
            
            $response_array = ['success' => true, 'data' => $cast_crews_videos , 'total' =>$cast_crews_videos->count()];

            return response()->json($response_array, 200);

        } catch (Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return response()->json($response_array);

        }

   }
    
    /**
     * @method subscriptions_payment()
     *
     * @uses subscription payment based on the payment mode
     *
     * @created Vithya R
     * 
     * @updated vithya R
     *
     * @param Object $request - History Id
     *
     * @return Json object based on history
     */
    public function subscriptions_payment(Request $request) {

        try {

            DB::beginTransaction();
            
            $validator = Validator::make($request->all(),
                [
                    'subscription_id' => 'required|integer|exists:subscriptions,id,status,'.APPROVED,
                    'coupon_code'=>'nullable|exists:coupons,coupon_code',
                    'payment_mode' => 'required|in:'.PAYPAL.','.CARD,
                    'payment_id' => 'required_if:payment_mode,'.PAYPAL
                ],
                [
                    'coupon_code.exists' => tr('coupon_code_not_exists'),
                    'subscription_id.exists' => tr('subscription_not_exists'),
                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);                
            }

            $subscription_details = Subscription::find($request->subscription_id);

            $user_details = User::find($request->id);

            if(!$subscription_details) {

                throw new Exception(Helper::get_error_message(154), 154);
            }

            // Initial detault values

            $total = $subscription_details->amount; 

            $coupon_amount = 0.00;
           
            $coupon_reason = ""; 

            $is_coupon_applied = COUPON_NOT_APPLIED;

            // Check the coupon code

            if($request->coupon_code) {
                
                $coupon_code_response = PaymentRepo::check_coupon_code($request, $user_details, $subscription_details->amount);

                $coupon_amount = $coupon_code_response['coupon_amount'];

                $coupon_reason = $coupon_code_response['coupon_reason'];

                $is_coupon_applied = $coupon_code_response['is_coupon_applied'];

                $total = $coupon_code_response['total'];

            }

            // Update the coupon details and total to the request

            $request->coupon_amount = $coupon_amount ?: 0.00;

            $request->coupon_reason = $coupon_reason ?: "";

            $request->is_coupon_applied = $is_coupon_applied;

            $wallet_details = CustomWallet::where('user_id', $request->id)->first();

            if($wallet_details) {

                if($wallet_details->remaining > 0 && $total > 0) {

                    $response_data = CustomWalletRepo::wallet_credits($wallet_details,$total);

                    $request->wallet_amount = $response_data->wallet_amount ?? 0.00;

                    $request->is_wallet_credits_applied = $response_data->is_wallet_applied ?? WALLET_CREDITS_NOT_APPLIED;

                    $total = $response_data->save_total ?: 0.00;
                }
            }

            $request->total = $total ?: 0.00;

            // If total greater than zero, do the stripe payment

            if($request->total > 0 && $request->payment_mode == CARD) {

                // Check the card details

                $check_card_exists = User::where('users.id' , $request->id)->leftJoin('cards' , 'users.id','=','cards.user_id')->where('cards.id' , $user_details->card_id)->where('cards.is_default' , DEFAULT_TRUE);

                if($check_card_exists->count() == 0) {
                        
                    throw new Exception(Helper::get_error_message(901), 901);

                }

                $user_card_details = $check_card_exists->first();

                $stripe_secret_key = Setting::get('stripe_secret_key');


                if($stripe_secret_key) {

                    \Stripe\Stripe::setApiKey($stripe_secret_key);

                } else {

                    throw new Exception(Helper::get_error_message(902), 902);

                }

                try {

                    $customer_id = $user_card_details->customer_id;

                    $total = number_format((float)$request->total, 2, '.', '');

                    $payment_data = [
                        "amount" => $total * 100,
                        "currency" => Setting::get('currency_code', 'USD'),
                        "customer" => $customer_id,
                    ];

                    $stripe_subscription_payment =  \Stripe\Charge::create($payment_data);

                    $request->payment_id = $stripe_subscription_payment->id;

                    $request->total = $stripe_subscription_payment->amount/100;

                    $paid_status = $stripe_subscription_payment->paid;

                    if($paid_status) {

                        // No need

                    }

                // }  catch(\Stripe\Error\RateLimit | \Stripe\Error\Card | \Stripe\Error\InvalidRequest | \Stripe\Error\Authentication | \Stripe\Error\ApiConnection | \Stripe\Error\Base | Exception $e) {

                } catch(Exception $e) {

                    $error_message = $e->getMessage(); $error_code = $e->getCode();

                    $response_array = ['success'=>false, 'error_messages'=> $error_message , 'error_code' => $error_code];

                    // Update the failure to payments table @todo

                    return response()->json($response_array);
                } 

            }

            $response_array = PaymentRepo::subscriptions_payment_save($request, $subscription_details, $user_details);

            $previous_payment_amount = UserPayment::where('user_id' , $request->id)->where('status', PAID_STATUS)->sum('subscription_amount');

            if($previous_payment_amount >= Setting::get('referral_earnings_amount')) {

                $referrer_user = \App\UserReferral::where('user_id', $request->id)->first();
                
                if($referrer_user) {

                    $referrer_referral_code= \App\ReferralCode::where('user_id', $referrer_user->parent_user_id)->first();

                    $referrer_wallet_details = \App\CustomWallet::where('user_id', $referrer_user->parent_user_id)->first();

                    if($referrer_wallet_details && $referrer_wallet_details->onhold > 0){

                        $referrer_history = \App\ReferralHistory::where('user_id',$request->id)
                            ->where('parent_user_id', $referrer_user->parent_user_id)
                            ->where('referral_code_id', $referrer_user->referral_code_id)
                            ->first();

                        if($referrer_history) {

                            $referral_earnings = $referrer_history->referral_amount;

                            $referrer_wallet_details->onhold -= $referral_earnings;

                            $referrer_wallet_details->total += $referral_earnings;

                            $referrer_wallet_details->remaining += $referral_earnings;
                            
                            $referrer_wallet_details->save();

                            $referrer_referral_code->referral_earnings += $referral_earnings;

                            $referrer_referral_code->save();

                            $referrer_history->delete();
                        }
                        
                    }
                } 
            }
            
            DB::commit();

            return response()->json($response_array, 200);

        } catch(Exception $e) {

            DB::rollback();

            $response_array = ['success' => false, 'error_messages' => $e->getMessage(), 'error_code' => $e->getCode()];

            return response()->json($response_array, 200);

        }
    
    }

    /**
     * @method ppv_payment()
     *
     * @uses PPV payment based on the payment mode
     *
     * @created Vithya R
     * 
     * @updated vithya R
     *
     * @param Object $request - History Id
     *
     * @return Json object based on history
     */
    public function ppv_payment(Request $request) {

        try {

            DB::beginTransaction();
            
            $validator = Validator::make($request->all(),
                [
                    'admin_video_id' => 'required|integer|exists:admin_videos,id',
                    'coupon_code'=>'nullable|exists:coupons,coupon_code',
                    'payment_mode' => 'required|in:'.PAYPAL.','.CARD,
                    'payment_id' => 'required_if:payment_mode,'.PAYPAL
                ],
                [
                    'coupon_code.exists' => tr('coupon_code_not_exists'),
                    'admin_video_id.exists' => Helper::get_error_message(157),
                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);                
            }

            $admin_video_details = AdminVideo::where('admin_videos.id', $request->admin_video_id)
                                        ->where('status', VIDEO_PUBLISHED)
                                        ->where('is_approved', VIDEO_APPROVED)
                                        ->first();

            if(!$admin_video_details) {

                throw new Exception(Helper::get_error_message(157), 157);
                
            }

            if($admin_video_details->is_pay_per_view == PPV_DISABLED) {

                throw new Exception(Helper::get_error_message(171), 171);
                
            }

            $user_details = User::find($request->id);

            if(!$user_details) {

                throw new Exception(Helper::get_error_message(154), 154);
            }

            // Initial detault values

            $total = $admin_video_details->amount; 

            $coupon_amount = 0.00; $coupon_reason = ""; $is_coupon_applied = COUPON_NOT_APPLIED;

            // Check the coupon code

            if($request->coupon_code) {
                
                $coupon_code_response = PaymentRepo::check_coupon_code($request, $user_details, $admin_video_details->amount);

                $coupon_amount = $coupon_code_response['coupon_amount'];

                $coupon_reason = $coupon_code_response['coupon_reason'];

                $is_coupon_applied = $coupon_code_response['is_coupon_applied'];

                $total = $coupon_code_response['total'];

            }

            // Update the coupon details and total to the request

            $request->coupon_amount = $coupon_amount ?: 0.00;

            $request->coupon_reason = $coupon_reason ?: "";

            $request->is_coupon_applied = $is_coupon_applied;

            $wallet_details = CustomWallet::where('user_id', $request->id)->first();

            if($wallet_details) {

                if($wallet_details->remaining > 0 && $total > 0) {

                    $response_data = CustomWalletRepo::wallet_credits($wallet_details,$total);

                    $request->wallet_amount = $response_data->wallet_amount ?? 0.00;

                    $request->is_wallet_credits_applied = $response_data->is_wallet_applied ?? WALLET_CREDITS_NOT_APPLIED;

                    $total = $response_data->save_total ?: 0.00;
                }
            }

            $request->total = $total ?: 0.00;
            
            // If total greater than zero, do the stripe payment

            if($request->total > 0 && $request->payment_mode == CARD) {

                // Check the card details

                $check_card_exists = User::where('users.id' , $request->id)->leftJoin('cards' , 'users.id','=','cards.user_id')->where('cards.id' , $user_details->card_id)->where('cards.is_default' , DEFAULT_TRUE);

                if($check_card_exists->count() == 0) {
                        
                    throw new Exception(Helper::get_error_message(901), 901);

                }

                $user_card_details = $check_card_exists->first();

                $stripe_secret_key = Setting::get('stripe_secret_key');


                if($stripe_secret_key) {

                    \Stripe\Stripe::setApiKey($stripe_secret_key);

                } else {

                    throw new Exception(Helper::get_error_message(902), 902);

                }

                try {

                    $customer_id = $user_card_details->customer_id;

                    $total = number_format((float)$request->total, 2, '.', '');

                    $payment_data = [
                        "amount" => $total * 100,
                        "currency" => Setting::get('currency_code', 'USD'),
                        "customer" => $customer_id,
                    ];

                    $stripe_payment =  \Stripe\Charge::create($payment_data);

                    $request->payment_id = $stripe_payment->id;

                    $request->total = $stripe_payment->amount/100;

                    $paid_status = $stripe_payment->paid;

                    if($paid_status) {

                        // No need

                    }

                }  
                // catch(\Stripe\Error\RateLimit | \Stripe\Error\Card | \Stripe\Error\InvalidRequest | \Stripe\Error\Authentication | \Stripe\Error\ApiConnection | \Stripe\Error\Base | Exception $e) {

                // } 
                catch(Exception $e) {

                    $error_message = $e->getMessage(); $error_code = $e->getCode();

                    $response_array = ['success'=>false, 'error_messages'=> $error_message , 'error_code' => $error_code];

                    // Update the failure to payments table @todo

                    return response()->json($response_array);
                } 

            }

            $response_array = PaymentRepo::ppv_payment_save($request, $admin_video_details, $user_details);
            
            DB::commit();

            return response()->json($response_array, 200);

        } catch(Exception $e) {

            DB::rollback();

            $response_array = ['success' => false, 'error_messages' => $e->getMessage(), 'error_code' => $e->getCode()];

            return response()->json($response_array, 200);

        }
    
    }

    /**
     * @method search_video()
     *
     * @uses To search videos based on title
     *
     * @created vidhya R
     *
     * @updated 
     *
     * @param object $request - Title of the video (For Web Usage)
     *
     * @return response of the array 
     */
    public function search_videos(Request $request) {

        try {

            $admin_videos = VideoHelper::search_videos($request);
            
            $response_array = ['success' => true, 'data' => $admin_videos , 'total' => $admin_videos->count()];

            return response()->json($response_array, 200);

        } catch(Exception $e) {

            return $this->sendError($e->getMessage(), $e->getCode());

        }

    }

    /**
     * @method sub_profiles()
     *
     * @uses To search videos based on title
     *
     * @created vidhya R
     *
     * @updated 
     *
     * @param object $request - Title of the video (For Web Usage)
     *
     * @return response of the array 
     */
    public function sub_profiles(Request $request) {

        try {

            $sub_profiles = SubProfile::CommonResponse()->where('user_id', $request->id)->get();

            $is_new_sub_profile_allowed = NO;

            if($sub_profiles) {

                $user_payment_details = UserPayment::where('user_id', $request->id)->orderBy('created_at', 'desc')->first();

                // Get allowed no of accounts based on the user subscription

                $total_allowed_accounts = $user_payment_details ? ($user_payment_details->subscription ? $user_payment_details->subscription->no_of_account : 1) : 1;

                if ($total_allowed_accounts > $sub_profiles->count()) {

                    $is_new_sub_profile_allowed = YES;

                }

            }

            $data = [];

            $data['sub_profiles'] = $sub_profiles;

            $data['is_new_sub_profile_allowed'] = $is_new_sub_profile_allowed;

            return $this->sendResponse($message = "", $code = "", $data);

        } catch(Exception $e) {

            return $this->sendError($e->getMessage(), $e->getCode());

        }

    }

    /**
     * @method notifications()
     * 
     * @uses Display New uploaded videos notification 
     *
     * @created Vithya
     *
     * @updated
     *
     * @param object $request - user id
     * 
     * @return response of searched videos
     */
    public function notifications(Request $request) {

        $count = Notification::where('status', 0)->where('user_id', $request->id)->count();

        $take_count = $request->take ?: Setting::get('admin_take_count');

        $admin_video_ids = Notification::where('notifications.user_id', $request->id)
                ->leftJoin('admin_videos', 'admin_videos.id', '=', 'notifications.admin_video_id')
                ->leftJoin('categories', 'categories.id', '=', 'admin_videos.category_id')
                ->leftJoin('sub_categories', 'categories.id', '=', 'sub_categories.category_id')
                ->where('admin_videos.status', 1)
                ->where('admin_videos.is_approved', 1)
                ->where('admin_videos.is_approved', 1)
                ->where('categories.is_approved', 1)
                ->where('sub_categories.is_approved', 1)
                ->skip($request->skip)
                ->take($take_count)
                ->orderBy('notifications.updated_at', 'desc')
                ->pluck('admin_videos.id')->toArray();

        $admin_videos = VideoRepo::video_list_response($admin_video_ids);

        // if($request->device_type != DEVICE_WEB) {

            Notification::where('status', 0)->where('user_id', $request->id)->update(['status'=>DEFAULT_TRUE]);

        // }

        $data['total_count'] = $count;
        
        $data['notifications'] = $admin_videos;

        return $this->sendResponse($message = "", $code = "", $data);

        $response_array = ['success' => true, 'count' => $count, 'data' => $admin_videos];

        return response()->json($response_array);

    }

    /**
     * @method referral_code()
     * 
     * @uses Save and Display User Referral Codes
     *
     * @created Bhawya
     *
     * @updated Bhawya
     *
     * @param object $request - user id
     * 
     * @return response of Referral Codes
     */
    public function referral_code(Request $request) {

        try {

            DB::beginTransaction();

            $user_details =  User::find($request->id);

            if(!$user_details) {

                throw new Exception(Helper::get_error_message(133),133);

            }

            $referral_code_details = ReferralCode::CommonResponse()->where('referral_codes.user_id', $user_details->id)->first();

            if(!$referral_code_details) {

                $referral_code_details = Helper::user_referral_code($user_details->id);

            }

            // share message start
            $share_message = tr('referral_code_share_message', Setting::get('site_name', 'STREAMVIEW'));

            $share_message = str_replace('<%referral_code%>', $referral_code_details->referral_code, $share_message);

            $share_message = str_replace("<%referral_earnings%>", formatted_amount(Setting::get('referral_earnings', 10)),$share_message);

            $referrals_signup_url = Setting::get('ANGULAR_SITE_URL')."register?referral=".$referral_code_details->referral_code;

            $referral_code_details->share_message = $share_message." ".$referrals_signup_url;

            $referral_code_details->referrals_signup_url = $referrals_signup_url;

            $referral_code_details->currency = Setting::get('currency') ?: "$";

            $referral_code_details->referral_earnings_formatted = formatted_amount($referral_code_details->referral_earnings);
            
            $referral_code_details->referee_earnings_formatted = formatted_amount($referral_code_details->referee_earnings);

            $referral_code_details->referrals_signup_note = "Everyone you refer gets ".formatted_amount(Setting::get('referrer_earnings')).". Once they've spent ".formatted_amount(Setting::get('referral_earnings_amount'))." with us, you'll get ".formatted_amount(Setting::get('referral_earnings')).'.';

            DB::commit();

            return $this->sendResponse($message = "", $code = "", $referral_code_details);

        } catch(Exception $e) {

            DB::rollback();

            return $this->sendError($e->getMessage(), $e->getCode());

        }
    }

    /**
     * @method user_referrals_list()
     * 
     * @uses List User Referrals
     *
     * @created Bhawya
     *
     * @updated Bhawya
     *
     * @param object $request - user id
     * 
     * @return response of user Referrals
     */
    public function user_referrals_list(Request $request) {

        try {

            $user_details =  User::find($request->id);

            if(!$user_details) {

                throw new Exception(Helper::get_error_message(133),133);

            }

            $user_referrals = UserReferral::where('parent_user_id', $user_details->id)->CommonResponse()->orderBy('created_at', 'desc')->get();
            
            return $this->sendResponse($message = "", $code = "", $user_referrals);

        } catch(Exception $e) {

            return $this->sendError($e->getMessage(), $e->getCode());

        }
    }

    /**
     * @method validate_referral_code()
     * 
     * @uses To Validate Referral Code
     *
     * @created Bhawya
     *
     * @updated Bhawya
     *
     * @param object $referral_code
     * 
     * @return response success/error
     */
    public function referral_code_validate(Request $request) {

        try {

            $validator = Validator::make($request->all(), [
                'referral_code' => 'required',
            ]);

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);
                
            }

            $referral_code =  ReferralCode::where('referral_code', $request->referral_code)->where('status', APPROVED)->first();

            if(!$referral_code) {

                throw new Exception(Helper::get_error_message(172), 172);

            }

            $user_details = User::where('id', $referral_code->user_id)->where('is_activated', USER_APPROVED)->first();

            if(!$user_details) {

                throw new Exception(Helper::get_error_message(172), 172);
            }

            return $this->sendResponse($message = Helper::get_message(131), $code = 131, $request->referral_code);

        } catch(Exception $e) {

            return $this->sendError($e->getMessage(), $e->getCode());

        }
    }

    /**
     * @method invoice_referral_amount()
     * 
     * @uses To send balance amount after referral code
     *
     * @created Bhawya
     *
     * @updated Bhawya
     *
     * @param object $amount
     * 
     * @return response referral amount details
     */
    public function invoice_referral_amount(Request $request) {

        try {

            $validator = Validator::make($request->all(), [
                'amount' => 'required',
            ]);

            if($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);
                
            }

            $wallet_details = CustomWallet::where('user_id', $request->id)->first();

            $data = new \stdClass();

            if($wallet_details) {

                if($wallet_details->remaining > 0 && $request->amount > 0) {

                    $response_data = CustomWalletRepo::wallet_credits($wallet_details,$request->amount);
                }
            }

            $data->is_wallet_credits_applied = $response_data->is_wallet_applied ?? WALLET_CREDITS_NOT_APPLIED;

            $data->referral_amount = $response_data->wallet_amount ?? 0.00;

            $data->referral_amount_formatted = formatted_amount($response_data->wallet_amount ?? 0.00);

            $data->pay_amount = $response_data->save_total ?? $request->amount;

            $data->pay_amount_formatted = formatted_amount($data->pay_amount ?? 0.00);

            $response_array = ['success' => true , 'data' => $data];

            return response()->json($response_array , 200);

        } catch(Exception $e) {

            return $this->sendError($e->getMessage(), $e->getCode());

        }
    }

    /**
     * @method subscriptions_payment_apple_pay()
     *
     * @uses subscription payment for Apple Pay Payment
     *
     * @created Bhawya
     * 
     * @updated Bhawya
     *
     * @param Object $request -
     *
     * @return Json object based on history
     */
    public function subscriptions_payment_apple_pay(Request $request) {

        try {

            DB::beginTransaction();
            
            $validator = Validator::make($request->all(),
                [
                    'subscription_id' => 'required|integer|exists:subscriptions,id,status,'.APPROVED,
                    'coupon_code'=>'nullable|exists:coupons,coupon_code',
                    'payment_mode' => 'required|in:'.APPLE_PAY,
                    'token_id' => 'required'
                ],
                [
                    'coupon_code.exists' => tr('coupon_code_not_exists'),
                    'subscription_id.exists' => tr('subscription_not_exists'),
                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);                
            }

            $subscription_details = Subscription::find($request->subscription_id);

            $user_details = User::find($request->id);

            if(!$subscription_details) {

                throw new Exception(Helper::get_error_message(154), 154);
            }

            // Initial detault values

            $total = $subscription_details->amount; 

            $coupon_amount = 0.00;
           
            $coupon_reason = ""; 

            $is_coupon_applied = COUPON_NOT_APPLIED;

            // Check the coupon code

            if($request->coupon_code) {
                
                $coupon_code_response = PaymentRepo::check_coupon_code($request, $user_details, $subscription_details->amount);

                $coupon_amount = $coupon_code_response['coupon_amount'];

                $coupon_reason = $coupon_code_response['coupon_reason'];

                $is_coupon_applied = $coupon_code_response['is_coupon_applied'];

                $total = $coupon_code_response['total'];

            }

            // Update the coupon details and total to the request

            $request->coupon_amount = $coupon_amount ?: 0.00;

            $request->coupon_reason = $coupon_reason ?: "";

            $request->is_coupon_applied = $is_coupon_applied;

            $wallet_details = CustomWallet::where('user_id', $request->id)->first();

            if($wallet_details) {

                if($wallet_details->remaining > 0 && $total > 0) {

                    $response_data = CustomWalletRepo::wallet_credits($wallet_details,$total);

                    $request->wallet_amount = $response_data->wallet_amount ?? 0.00;

                    $request->is_wallet_credits_applied = $response_data->is_wallet_applied ?? WALLET_CREDITS_NOT_APPLIED;

                    $total = $response_data->save_total ?: 0.00;
                }
            }
            
            $request->total = $total ?: 0.00;

            // If total greater than zero, do the stripe payment

            if($request->total > 0 && $request->payment_mode == APPLE_PAY) {

                $stripe_secret_key = Setting::get('stripe_secret_key');

                if($stripe_secret_key) {

                    \Stripe\Stripe::setApiKey($stripe_secret_key);

                } else {

                    throw new Exception(Helper::get_error_message(902), 902);

                }

                try {

                    $total = number_format((float)$request->total, 2, '.', '');

                    $payment_data = [
                        "amount" => $total * 100,
                        "currency" => Setting::get('currency_code', 'USD'),
                        "source" => $request->token_id,
                    ];

                    $stripe_subscription_payment =  \Stripe\Charge::create($payment_data);

                    $request->payment_id = $stripe_subscription_payment->id;

                    $request->total = $stripe_subscription_payment->amount/100;

                    $paid_status = $stripe_subscription_payment->paid;

                    if($paid_status) {

                        // No need

                    }

                // }  catch(\Stripe\Error\RateLimit | \Stripe\Error\Card | \Stripe\Error\InvalidRequest | \Stripe\Error\Authentication | \Stripe\Error\ApiConnection | \Stripe\Error\Base | Exception $e) {

                } catch(Exception $e) {

                    $error_message = $e->getMessage(); $error_code = $e->getCode();

                    $response_array = ['success'=>false, 'error_messages'=> $error_message , 'error_code' => $error_code];

                    // Update the failure to payments table @todo

                    return response()->json($response_array);
                } 

            }

            $response_array = PaymentRepo::subscriptions_payment_save($request, $subscription_details, $user_details);

            DB::commit();

            return response()->json($response_array, 200);

        } catch(Exception $e) {

            DB::rollback();

            $response_array = ['success' => false, 'error_messages' => $e->getMessage(), 'error_code' => $e->getCode()];

            return response()->json($response_array, 200);

        }
    
    }

    /**
     * @method ppv_payment_apple_pay()
     *
     * @uses PPV payment based on the payment mode
     *
     * @created Bhawya
     * 
     * @updated Bhawya
     *
     * @param Object $request - History Id
     *
     * @return Json object based on history
     */
    public function ppv_payment_apple_pay(Request $request) {

        try {

            DB::beginTransaction();
            
            $validator = Validator::make($request->all(),
                [
                    'admin_video_id' => 'required|integer|exists:admin_videos,id',
                    'coupon_code'=>'nullable|exists:coupons,coupon_code',
                    'payment_mode' => 'required|in:'.APPLE_PAY,
                    'token_id' => 'required'
                ],
                [
                    'coupon_code.exists' => tr('coupon_code_not_exists'),
                    'admin_video_id.exists' => Helper::get_error_message(157),
                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);                
            }

            $admin_video_details = AdminVideo::where('admin_videos.id', $request->admin_video_id)
                                        ->where('status', VIDEO_PUBLISHED)
                                        ->where('is_approved', VIDEO_APPROVED)
                                        ->first();

            if(!$admin_video_details) {

                throw new Exception(Helper::get_error_message(157), 157);
                
            }

            if($admin_video_details->is_pay_per_view == PPV_DISABLED) {

                throw new Exception(Helper::get_error_message(171), 171);
                
            }

            $user_details = User::find($request->id);

            if(!$user_details) {

                throw new Exception(Helper::get_error_message(154), 154);
            }

            // Initial detault values

            $total = $admin_video_details->amount; 

            $coupon_amount = 0.00; $coupon_reason = ""; $is_coupon_applied = COUPON_NOT_APPLIED;

            // Check the coupon code

            if($request->coupon_code) {
                
                $coupon_code_response = PaymentRepo::check_coupon_code($request, $user_details, $admin_video_details->amount);

                $coupon_amount = $coupon_code_response['coupon_amount'];

                $coupon_reason = $coupon_code_response['coupon_reason'];

                $is_coupon_applied = $coupon_code_response['is_coupon_applied'];

                $total = $coupon_code_response['total'];

            }

            // Update the coupon details and total to the request

            $request->coupon_amount = $coupon_amount ?: 0.00;

            $request->coupon_reason = $coupon_reason ?: "";

            $request->is_coupon_applied = $is_coupon_applied;


            $wallet_details = CustomWallet::where('user_id', $request->id)->first();

            if($wallet_details) {

                if($wallet_details->remaining > 0 && $total > 0) {

                    $response_data = CustomWalletRepo::wallet_credits($wallet_details,$total);

                    $request->wallet_amount = $response_data->wallet_amount ?? 0.00;

                    $request->is_wallet_credits_applied = $response_data->is_wallet_applied ?? WALLET_CREDITS_NOT_APPLIED;

                    $total = $response_data->save_total ?: 0.00;
                }
            }

            $request->total = $total ?: 0.00;

            // If total greater than zero, do the stripe payment

            if($request->total > 0 && $request->payment_mode == APPLE_PAY) {

                $stripe_secret_key = Setting::get('stripe_secret_key');


                if($stripe_secret_key) {

                    \Stripe\Stripe::setApiKey($stripe_secret_key);

                } else {

                    throw new Exception(Helper::get_error_message(902), 902);

                }

                try {

                    $total = number_format((float)$request->total, 2, '.', '');

                    $payment_data = [
                        "amount" => $total * 100,
                        "currency" => Setting::get('currency_code', 'USD'),
                        "source" => $request->token_id,
                    ];

                    $stripe_payment = \Stripe\Charge::create($payment_data);

                    $request->payment_id = $stripe_payment->id;

                    $request->total = $stripe_payment->amount/100;

                    $paid_status = $stripe_payment->paid;

                    if($paid_status) {

                        // No need

                    }

                }  
                // catch(\Stripe\Error\RateLimit | \Stripe\Error\Card | \Stripe\Error\InvalidRequest | \Stripe\Error\Authentication | \Stripe\Error\ApiConnection | \Stripe\Error\Base | Exception $e) {

                // } 
                catch(Exception $e) {

                    $error_message = $e->getMessage(); $error_code = $e->getCode();

                    $response_array = ['success'=>false, 'error_messages'=> $error_message , 'error_code' => $error_code];

                    // Update the failure to payments table @todo

                    return response()->json($response_array);
                } 

            }

            $response_array = PaymentRepo::ppv_payment_save($request, $admin_video_details, $user_details);

            DB::commit();

            return response()->json($response_array, 200);

        } catch(Exception $e) {

            DB::rollback();

            $response_array = ['success' => false, 'error_messages' => $e->getMessage(), 'error_code' => $e->getCode()];

            return response()->json($response_array, 200);

        }
    
    }

    /**
     *
     * @method video_player_info()
     *
     * @uses used to get video details based on the selected video id
     *
     * @created Vidhya R
     *
     * @updated Vidhya R
     *
     * @param integer admin_video_id
     *
     * @return JSON Response
     */

    public function video_player_info(Request $request) {

        try {

            $admin_video = AdminVideo::SingleVideoResponse()->where('admin_videos.id' , $request->admin_video_id)->first();

            $user_details = User::find($request->id);

            if(!$admin_video) {

                throw new Exception(Helper::get_error_message(157), 157);
                
            }

            // Check the video is marked as spam

            if (check_flag_video($request->admin_video_id, $request->sub_profile_id)) {

                throw new Exception(Helper::get_error_message(904), 904);

            }

            $data = new \stdClass();

            $data->player_resolutions = [];

            $data->player_resolutions_count = 0;

            $data->player_json = $admin_video->player_json;
            
            if($data->player_json) {
                
                $player_json_data = file_get_contents($data->player_json);
                

                if($player_json_data !== false) {
                    // deal with error...


                    $player_resolutions = json_decode($player_json_data, true);

                    if ($player_resolutions === null) {
                        // deal with error...
                    } else {

                        $p_datas = [];

                        foreach ($player_resolutions['main_video_resolutions'] as $key => $value) {

                            if($value['title'] != "" && $value['video']) {

                                $p_data = [];

                                $admin_video_id = 25;

                                $hls_path = url('/uploads/hls/'.$admin_video_id.'/'.$admin_video_id.hls_video_name($value['resolution']));

                                $p_data = ['label' => hls_video_title($value['title']), 'file' => $value['video'], 'hls_path' => $hls_path];

                                array_push($p_datas, (object) $p_data);


                            }

                        }

                        // $data->player_resolutions = (object) dummy_video_data() ?? [];

                        $data->player_resolutions = (object) $p_datas ?? [];

                        $data->player_resolutions_count = count((array)$data->player_resolutions);


                    }
                }
            }

            $data->subtitles = \App\AdminVideoAudio::where('subtitle', '!=', '')->where('video_id', $request->admin_video_id)->get();

            $data->audio_tracks = \App\AdminVideoAudio::where('audio', '!=', '')->where('video_id', $request->admin_video_id)->get();
            
            $response_array = ['success' => true , 'data' => $data];

            return response()->json($response_array , 200);

        } catch(Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false , 'error_messages' => $error_messages , 'error_code' => $error_code];

            return response()->json($response_array , 200);

        }
    }

    /**
     *
     * @method video_playlist()
     *
     * @uses used to get video details based on the selected video id
     *
     * @created Vidhya R
     *
     * @updated Vidhya R
     *
     * @param integer admin_video_id
     *
     * @return JSON Response
     */

    public function video_playlist(Request $request) {

        try {

            $admin_video = AdminVideo::SingleVideoResponse()->where('admin_videos.id' , $request->admin_video_id)->first();

            $user_details = User::find($request->id);

            if(!$admin_video) {

                throw new Exception(Helper::get_error_message(157), 157);
                
            }

            // Check the video is marked as spam

            if (check_flag_video($request->admin_video_id, $request->sub_profile_id)) {

                throw new Exception(Helper::get_error_message(904), 904);

            }

            $data = new \stdClass();

            $next_position_admin_video_details = VideoHelper::get_auto_play_video($admin_video);

            $data->next_admin_video_id = 0; $data->next_video_details = "";

            if($next_position_admin_video_details) {

                $data->next_admin_video_id = $next_position_admin_video_details->id; 

                $data->next_video_details = $next_position_admin_video_details;

            }

            $data->is_series = $admin_video->genre_id ? YES : NO;

            if($data->is_series) {

                $video_position = $admin_video->position + 1;

                $playlist_video = AdminVideo::where('position', $video_position)
                    ->where('genre_id', $admin_video->genre_id)
                    ->where('is_approved', DEFAULT_TRUE)
                    ->where('status', DEFAULT_TRUE)
                    ->first() ?? [];
                
                $data->playlist_video_id = $playlist_video ? $playlist_video->id : '';

                $data->playlist_title = $playlist_video ? $playlist_video->title : '';

                $video_playlist = AdminVideo::where('genre_id', $admin_video->genre_id)
                    ->where('is_approved', DEFAULT_TRUE)
                    ->where('status', DEFAULT_TRUE)
                    ->orderBy('position', 'asc')
                    ->select('id','title','duration','description','default_image','mobile_image')
                    ->get();
                
                foreach ($video_playlist as $key => $playlist_details) {
                    
                    $watching_history = ContinueWatchingVideo::where('admin_video_id', $playlist_details->id)->first();

                    $playlist_details->watch_history_percentage = 0;

                    if($watching_history){

                        $video_duration = time_to_sec($admin_video->duration);

                        $watch_history = time_to_sec($watching_history->duration);

                        $percentage = ($watch_history/$video_duration) * 100;
                        
                        $playlist_details->watch_history_percentage = number_format($percentage);

                    }
                    
                    $playlist_details->is_playing = ($playlist_details->id == $admin_video->admin_video_id) ? YES : NO;

                }

                $data->video_playlist = $video_playlist;
            
            }
            
            $response_array = ['success' => true , 'data' => $data];

            return response()->json($response_array , 200);

        } catch(Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false , 'error_messages' => $error_messages , 'error_code' => $error_code];

            return response()->json($response_array , 200);

        }
    }

     /**
     * @method reset_password()
     *
     * @uses To reset the password
     *
     * @created Ganesh
     *
     * @updated Ganesh
     *
     * @param object $request - Email id
     *
     * @return send mail to the valid user
     */
    
    public function reset_password(Request $request) {

        try {

            $validator = Validator::make($request->all(),
                [
                    'password' => 'required|confirmed|min:6',
                    'reset_token'=>'required|string',
                    'password_confirmation' => 'required',
                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);                
            }

            DB::beginTransaction();

            $password_reset = \App\PasswordReset::where('token', $request->reset_token)->first();

            if(!$password_reset){

                throw new Exception('Invalid Token', 163);
            }
            
            $user = User::where('email', $password_reset->email)->first();

            $user->password = \Hash::make($request->password);

            $user->save();

            \App\PasswordReset::where('email', $user->email) ->delete();

            DB::commit();

            $data = $user;

            return $this->sendResponse('Password Changed Successfully', $success_code = 153, $data);

        } catch(Exception $e) {

             DB::rollback();

            return $this->sendError($e->getMessage(), $e->getCode());
        }


   }
}

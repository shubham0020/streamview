<?php 

namespace App\Helpers;

use Image, Hash, Mail, File, Log, Storage, Setting, DB;

use Exception, Auth, AWS;

use App\Admin, App\AdminVideo, App\AdminVideoImage;

use App\User, App\UserHistory, App\UserRating, App\UserPayment;

use App\Category, App\SubCategory, App\SubCategoryImage;

use App\Wishlist, App\LikeDislikeVideo, App\Requests, App\ContinueWatchingVideo;

use App\EmailTemplate;

use App\OfflineAdminVideo, App\Settings, App\Page;

use App\ReferralCode, App\UserReferral;

use App\Repositories\CustomWalletRepository as CustomWalletRepo;

use Aws\S3\S3Client;

use Mailgun\Mailgun;

use App\Jobs\OriginalVideoCompression;

use App\Helpers\ConvertSubtitle;

use \Done\Subtitles\Subtitles;

class Helper

{
    public static function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public static function web_url()
    {
        return url('/');
    }

    public static function generate_email_code($value = "")
    {
        return uniqid($value);
    }

    public static function generate_email_expiry()
    {
        return time() + 24*3600*30;  // 30 days
    }

    // Check whether email verification code and expiry

    public static function check_email_verification($verification_code , $user_id , &$error) {

        if(!$user_id) {

            $error = tr('user_id_empty');

            return FALSE;

        } else {

            $user_details = User::find($user_id);
        }

        // Check the data exists

        if($user_details) {

            // Check whether verification code is empty or not

            if($verification_code) {

                // Log::info("Verification Code".$verification_code);

                // Log::info("Verification Code".$user_details->verification_code);

                if ($verification_code ===  $user_details->verification_code ) {

                    // Token is valid

                    $error = NULL;

                    // Log::info("Verification CODE MATCHED");

                    return true;

                } else {

                    $error = tr('verification_code_mismatched');

                    // Log::info(print_r($error,true));

                    return FALSE;
                }

            }
                
            // Check whether verification code expiry 

            if ($user_details->verification_code_expiry > time()) {

                // Token is valid

                $error = NULL;

                Log::info(tr('token_expiry'));

                return true;

            } else if($user_details->verification_code_expiry < time() || (!$user_details->verification_code || !$user_details->verification_code_expiry) ) {

                $user_details->verification_code = Helper::generate_email_code();
                
                $user_details->verification_code_expiry = Helper::generate_email_expiry();
                
                $user_details->save();

                // If code expired means send mail to that user

                $subject = tr('verification_code_title');
                $email_data = $user_details;
                $page = "emails.welcome";
                $email = $user_details->email;
                $result = Helper::send_email($page,$subject,$email,$email_data);

                $error = tr('verification_code_expired');

                Log::info(print_r($error,true));

                return FALSE;
            }
       
        }

    }

    // Note: $error is passed by reference
    public static function is_token_valid($entity, $id, $token, &$error)
    {
        if (
            ( $entity== 'USER' && ($row = User::where('id', '=', $id)->where('token', '=', $token)->first()))
        ) {
            if ($row->token_expiry > time()) {
                // Token is valid
                $error = NULL;
                return $row;
            } else {
                $error = array('success' => false, 'error_messages' => Helper::get_error_message(103), 'error_code' => 103);
                return FALSE;
            }
        }
        $error = array('success' => false, 'error_messages' => Helper::get_error_message(104), 'error_code' => 104);
        return FALSE;
    }

    // Convert all NULL values to empty strings
    public static function null_safe($arr)
    {
        $newArr = array();
        foreach ($arr as $key => $value) {
            $newArr[$key] = ($value == NULL) ? "" : $value;
        }
        return $newArr;
    }

    public static function generate_token()
    {
        return Helper::clean(Hash::make(rand() . time() . rand()));
    }

    public static function generate_token_expiry()
    {
        $token_expiry = Setting::get('token_expiry_hour') ? Setting::get('token_expiry_hour') : 1;
        
        return time() + $token_expiry*3600;  // 1 Hour
    }

    public static function send_email($page,$subject,$email,$email_data) {

        // Check the email configuration 
        if(Setting::get('email_notification') == OFF) {
            
            return Helper::get_error_message(123);
        }

        // check the email configured

        if( config('mail.username') &&  config('mail.password')) {

            try {

                $site_url = url('/');

                $isValid = 1;

                Log::info("Mail - STRAT");

                if(envfile('MAIL_MAILER') == 'mailgun' && Setting::get('MAILGUN_PUBLIC_KEY') && Setting::get('is_mailgun_check_email') == 1) {

                    Log::info("isValid - STRAT");

                    # Instantiate the client.

                    $email_address = new Mailgun(Setting::get('MAILGUN_PUBLIC_KEY'));

                    $validateAddress = $email;
                    
                    # Issue the call to the client.
                    $result = $email_address->get("address/validate", array('address' => $validateAddress));

                    # is_valid is 0 or 1

                    $isValid = $result->http_response_body->is_valid;
                    
                    Log::info("isValid FINAL STATUS - ".$isValid);

                }

                if($isValid) {

                    $content = "";

                    $template = [];

                    if(isset($email_data['template_type'])) {
                        
                        $template = EmailTemplate::where('template_type', $email_data['template_type'])->first();

                    }

                    if ($template) {

                        $content = $template->description;

                        $subject = $template->subject ?  str_replace('<%site_name%>', Setting::get('site_name'),$template->subject) : '';

                        $subject = $subject ?  str_replace('&lt;%site_name%&gt;', Setting::get('site_name'),$subject) : '';


                        $content = isset($email_data['email']) ? str_replace('<%email%>',$email_data['email'], $content) : $content;

                        $content = isset($email_data['email']) ? str_replace('&lt;%email%&gt;',$email_data['email'], $content) : $content;

                        $content = isset($email_data['password']) ? str_replace('<%password%>',$email_data['password'],$content) : $content;

                        $content = isset($email_data['password']) ? str_replace('&lt;%password%&gt;',$email_data['password'],$content) : $content;

                        $content = str_replace('<%site_name%>', Setting::get('site_name'),$content);

                        $content = str_replace('&lt;%site_name%&gt;',Setting::get('site_name'),$content);

                        if ($template->template_type == NEW_VIDEO || $template->template_type == EDIT_VIDEO) {

                            $content = str_replace('<%category_name%>', $email_data['category_name'],$content);

                            $content = str_replace('&lt;%category_name%&gt;',$email_data['category_name'],$content);

                            $content = str_replace('<%video_name%>', $email_data['video_name'],$content);

                            $content = str_replace('&lt;%video_name%&gt;',$email_data['video_name'],$content);

                            $subject = $subject ?  str_replace('<%video_name%>', $email_data['video_name'],$subject) : '';

                            $subject = $subject ?  str_replace('&lt;%video_name%&gt;', $email_data['video_name'],$subject) : '';

                        }

                    }

                    Log::info(print_r($email_data , true));

                    $email_data['content'] = $content;

                    if (Mail::queue($page, array('email_data' => $email_data,'site_url' => $site_url), 
                            function ($message) use ($email, $subject) {

                                $message->to($email)->subject($subject);
                            }
                    )) {

                        return Helper::get_message(106);

                    } else {

                        throw new Exception(Helper::get_error_message(123));
                        
                    }

                } else {

                    return Helper::get_message(106);

                }

            } catch(\Exception $e) {

                Log::info($e->getMessage());
                
                return $e->getMessage();

            }

        } else {

            return Helper::get_error_message(123);


        }
    }

    public static function get_error_message($code) {

        switch($code) {

            case 101:
                $string = tr('invalid_input');
                break;
            case 102:
                $string = tr('email_address_already_use');
                break;
            case 103:
                $string = tr('token_expiry');
                break;
            case 104:
                $string = tr('invalid_token');
                break;
            case 105:
                $string = tr('username_password_donot_match');
                break;
            case 106:
                $string = tr('all_fields_required');
                break;
            case 107:
                $string = tr('current_password_incorrect');
                break;
            case 108:
                $string = tr('password_not_correct');
                break;
            case 109:
                $string = tr('application_encountered_unknown');
                break;
            case 111:
                $string = tr('email_not_activated');
                break;
            case 115:
                $string = tr('invalid_refresh_token');
                break;
            case 123:
                $string = tr('something_went_wrong_error');
                break;
            case 124:
                $string = tr('email_not_registered');
                break;
            case 125:
                $string = tr('not_valid_social_register');
                break;
            case 130:
                $string = tr('no_result_found');
                break;
            case 131:
                $string = tr('old_password_wrong_password_doesnot_match');
                break;
            case 132:
                $string = tr('provider_id_not_found');
                break;
            case 133:
                $string = tr('user_id_not_found');
                break;
            case 141:
                $string = tr('something_went_wrong_paying_amount');
                break;
            case 144:
                $string = tr('please_verify_your_account');
                break;
            case 145:
                $string = tr('video_already_added_history');
                break;
            case 146:
                $string = tr('something_wrong_please_try_again');
                break;

            case 147:
                $string = tr('redeem_disabled_by_admin');
                break;
            case 148:
                $string = tr('minimum_redeem_not_have');
                break;
            case 149:
                $string = tr('redeem_wallet_empty');
                break;
            case 150:
                $string = tr('redeem_request_status_mismatch');
                break;
            case 151:
                $string = tr('redeem_not_found');
                break;
            case 152:
                $string = tr('coupon_not_found');
                break;
            case 153:
                $string = tr('coupon_inactive_status');
                break;
            case 154:
                $string = tr('subscription_not_found');
                break;
            case 155:
                $string = tr('subscription_inactive_status');
                break;
            case 156:
                $string = tr('subscription_amount_should_be_grater');
                break;
            case 157:
                $string = tr('video_not_found');
                break;
            case 158:
                $string = tr('video_amount_should_be_grater');
                break;
            case 159:
                $string = tr('expired_coupon_code');
                break;
            case 162:
                $string = tr('failed_to_upload');
                break;
            case 163:
                $string = tr('user_payment_details_not_found');
                break;
            case 164:
                $string = tr('subscription_autorenewal_already_cancelled');
                break;
            case 165:
                $string = tr('subscription_autorenewal_already_enabled');
                break;
            case 166 :
                $string = tr('publish_time_should_not_lesser');
                break;
            case 167 :
                $string = tr('video_not_saving');
                break;
            case 168 :
                $string = tr('sub_profile_details_not_found');
                break;
            case 169 :
                $string = tr('sub_profile_delete_not_allowed_for_default_profile');
                break;
            case 170 :
                $string = tr('user_profile_save_failed');
                break;
            case 171 :
                $string = tr('admin_video_no_ppv');
                break;

            case 172 :
                $string = tr('invalid_referral_code');
                break;

            case 901:
                $string = tr('default_card_not_available');
                break;
            case 902:
                $string = tr('something_went_wrong_error_payment');
                break;
            case 903:
                $string = tr('payment_not_completed_pay_again');
                break;
            case 904:
                $string = tr('flagged_video');
                break;
            case 905:
                $string = tr('user_login_decline');
                break;
            case 906:
                $string = tr('video_data_not_found');
                break;

            case 3000: 
                $string = tr('user_record_deleted_contact_admin');
                break;
            case 3001:
                $string = tr('verification_code_title');
                break;
            case 3002:
                $string = tr('sub_profile_is_invalid');
                break;
            // Wallet voucher codes
            case 10001:
                $string = tr('user_wallet_amount_add_failed');
                break;
            case 10002:
                $string = tr('voucher_code_is_invalid');
                break;
            case 10003:
                $string = tr('voucher_code_expired');
                break;
            case 10004:
                $string = tr('voucher_code_already_used');
                break;
            case 10005:
                $string = tr('wallet_no_balance');
                break;

            
            default:
                $string = tr('unknown_error_occured');
        }
        return $string;
    }

    public static function get_message($code)
    {
        switch($code) {
            case 101:
                $string = tr('success');
                break;
            case 102:
                $string = tr('password_change_success');
                break;
            case 103:
                $string = tr('successfully_logged_in');
                break;
            case 104:
                $string = tr('successfully_logged_out');
                break;
            case 105:
                $string = tr('successfully_sign_up');
                break;
            case 106:
                $string = tr('mail_sent_successfully');
                break;
            case 107:
                $string = tr('payment_successful_done');
                break;
            case 108:
                $string = tr('favourite_provider_delete');
                break;
            case 109:
                $string = tr('payment_mode_changed');
                break;
            case 110:
                $string = tr('payment_mode_changed');
                break;
            case 111:
                $string = tr('service_accepted');
                break;
            case 112:
                $string = tr('provider_started');
                break;
            case 113:
                $string = tr('arrived_service_location');
                break;
            case 114:
                $string = tr('service_started');
                break;
            case 115:
                $string = tr('service_completed');
                break;
            case 116:
                $string = tr('user_rating_done');
                break;
            case 117:
                $string = tr('request_cancelled_successfully');
                break;
            case 118:
                $string = tr('wishlist_added');
                break;
            case 119:
                $string = tr('payment_confirmed_successfully');
                break;
            case 120:
                $string = tr('history_added');
                break;
            case 121:
                $string = tr('history_deleted_successfully');
                break;
            case 122:
                $string = tr('autorenewal_enable_success');
                break;
            case 123:
                $string = tr('ppv_not_set');
                break;
            case 124:
                $string = tr('watch_video_success');
                break;
            case 125:
                $string = tr('pay_and_watch_video');
                break;
            case 126:
                $string = tr('pay_and_watch_video');
                break;
            case 127:
                $string = tr('wishlist_clear_success');
                break;
            case 128:
                $string = tr('wishlist_add_success');
                break;
            case 129:
                $string = tr('wishlist_delete_success');
                break;
            case 130:
                $string = tr('user_profile_update_success');
                break;

            case 131:
                $string = tr('valid_referral_code');
                break;
            case 132:
                $string = tr('you_liked_this_video');
                break;
            case 133:
                $string = tr('you_disliked_this_video');
                break;

            // wallet messages start 

            case 10001:
                $string = tr('user_wallet_amount_added');
                break;
            default:
                $string = "";
        
        }
        
        return $string;
    }

    public static function get_push_message($code) {

        switch ($code) {
            case 601:
                $string = tr('no_provider_available');
                break;
            case 602:
                $string = tr('no_provider_available_take_service');
                break;
            case 603:
                $string = tr('request_complted_successfully');
                break;
            case 604:
                $string = tr('new_request');
                break;
            default:
                $string = "";
        }

        return $string;

    }

    public static function generate_password()
    {
        $new_password = time();
        $new_password .= rand();
        $new_password = sha1($new_password);
        $new_password = substr($new_password,0,8);
        return $new_password;
    }

    public static function upload_video_image($image,$video_id,$position) {

        $check_video_image = AdminVideoImage::where('admin_video_id' , $video_id)->where('position',$position)->first();

        if($check_video_image) {

            $video_image = $check_video_image;

            Helper::delete_picture($video_image->image, "/uploads/images/");

        } else {
            $video_image = new AdminVideoImage;
        }

        $video_image->admin_video_id = $video_id;

        $video_image->image = Helper::normal_upload_picture($image, '', "video_".$video_id."_00".$position);

        if($position == 1) {
            $video_image->is_default = DEFAULT_TRUE;
        } else {
            $video_image->is_default = DEFAULT_FALSE;
        }

        $video_image->position = $position;

        $video_image->save();

        Log::info('VIDEO IMAGE SAVED : '.$video_image->id);

    }

    public static function upload_picture($picture)
    {
        Helper::delete_picture($picture, "/uploads/");

        $s3_url = "";

        $file_name = Helper::file_name();

        $ext = $picture->getClientOriginalExtension();
        $local_url = $file_name . "." . $ext;

        if(config('filesystems')['disks']['s3']['key'] && config('filesystems')['disks']['s3']['secret']) {

            Storage::disk('s3')->put($local_url, file_get_contents($picture) ,'public');

            $s3_url = Storage::url($local_url);
        } else {
            $ext = $picture->getClientOriginalExtension();

            $picture->move(public_path() . "/uploads", $file_name . "." . $ext);

            $local_url = $file_name . "." . $ext;

            $s3_url = Helper::web_url().'/uploads/'.$local_url;
        }

        return $s3_url;
    }


    public static function normal_upload_picture($picture, $path = null, $file_name = "") {

        $s3_url = "";

        $file_name = $file_name ? $file_name : Helper::file_name();

        $ext = $picture->getClientOriginalExtension();

        $local_url = $file_name . ".".$ext;

        $path = $path ? $path : '/uploads/images/';

        $inputFile = base_path('public'.$path.$local_url);

        // Convert bytes into MB

        list($width, $height) = getimagesize($picture);

        $final_folder_path = public_path($path);

        if(!File::isDirectory($final_folder_path)){

            File::makeDirectory($final_folder_path, 0777, true, true);

        }

        $inputFile = base_path('public'.$path.$local_url);

        $bytes = $picture->getSize() ? convertMegaBytes($picture->getSize()) : 0;

        if (intval($bytes) > intval(Setting::get('image_compress_size'))) {

            Log::info('inside FFmpeg');

            // Compress the video and save in original folder

            $img = Image::canvas($width ? $width : 960, $height ? $height : 720);

            $image = Image::make($picture->getPathname())->resize($width, $height, function ($c) {
                    $c->aspectRatio();
                    $c->upsize();
            });

            // insert resized image centered into background

            $img->insert($image, 'center');

            $img->encode($ext , 75);

            $img->save($inputFile);

            // $FFmpeg = new \FFmpeg;

            // $FFmpeg
            //     ->input($picture->getPathname())
            //     ->output($inputFile)
            //     ->ready();
        
        } else {

            $picture->move(public_path() . $path, $local_url);

        }

        $s3_url = Helper::web_url().$path.$local_url;

        Log::info("s3_url".$s3_url);

        return $s3_url;
    }

    public static function subtitle_upload($subtitle) {
        
        $s3_url = "";

        $file_name = Helper::file_name();

        $ext = $subtitle->getClientOriginalExtension();

        $local_url = $file_name . "." . $ext;

        $vtt_local_url = $file_name . ".vtt";

        $path = SUBTITLE_PATH;

        $final_folder_path = public_path($path);

        if(!File::isDirectory($final_folder_path)){

            File::makeDirectory($final_folder_path, 0777, true, true);

        }

        $subtitle->move(public_path() . $path, $local_url);

        $s3_url = Helper::web_url().$path.$local_url;

        $vtt_s3_url = Helper::web_url().$path.$vtt_local_url;

        Subtitles::convert(public_path().$path.$local_url, public_path().$path.$vtt_local_url);

        return $s3_url;
    }

    public static function subtitle_upload_vtt($subtitle, $vtt_filename) {

        $s3_url = "";

        if($subtitle) {

            // Log::info("subtitle".$subtitle);

            // Log::info("vtt_filename".$vtt_filename);

            // $vtt_subtitle = new ConvertSubtitle($subtitle);

            // $vtt_subtitle->convert();

            // $vtt_subtitle->save(public_path(SUBTITLE_PATH.$vtt_filename));

            // $s3_url = Helper::web_url().SUBTITLE_PATH.$vtt_filename;

        }

        return $s3_url;
    }

    public static function video_upload($picture, $compress_type,$path = null)
    {
        
        $s3_url = "";

        $file_name = Helper::file_name();

        $ext = $picture->getClientOriginalExtension();

        $local_url = $file_name . ".mp4" ;

        $path = $path ? $path : '/uploads/videos/original/';

        // Convert bytes into MB
        $bytes = convertMegaBytes($picture->getSize());

        $inputFile = public_path().$path.$local_url;

        if ($bytes > Setting::get('video_compress_size') && $compress_type == COMPRESS_ENABLED) {

            // dispatch(new OriginalVideoCompression($picture->getPathname(), $inputFile));

            Log::info("Compress Video : ".'Success');

            // Compress the video and save in original folder
            $FFmpeg = new \FFmpeg;

            $FFmpeg
                ->input($picture->getPathname())
                ->vcodec('h264')
                ->constantRateFactor('28')
                // ->forceFormat( 'mp4' )
                ->output($inputFile)
                ->ready();

        } else {
            Log::info("Original Video");

             // Compress the video and save in original folder
            if($ext == "mp4") {

            	$picture->move(public_path() . $path, $local_url);

            } else {

            	$FFmpeg = new \FFmpeg;

                $FFmpeg
                    ->input($picture->getPathname())
                    ->vcodec('h264')
                    ->output($inputFile)
                    ->ready();
            }
            
            //$picture->move(public_path() . $path, $local_url);
        }

        $s3_url = Helper::web_url().$path.$local_url;

        Log::info("Compress Video completed");

        return ['db_url'=>$s3_url, 'baseUrl'=> $inputFile, 'local_url'=>$local_url, 'file_name'=>$file_name];
    }

    public static function delete_picture($picture, $path) {
        
        if (file_exists(public_path() . $path . basename($picture))) {
            
            File::delete( public_path() . $path . basename($picture));
            
        }   
        
        return true;
    }

    public static function s3_delete_picture($picture) {
        Log::info($picture);

        Storage::Delete(basename($picture));
        return true;
    }

    public static function file_name($prefix = "") {

        $prefix = $prefix ? $prefix : Setting::get('prefix_file_name');

        $current_time = date("Y-m-d-H-i-s");

        $random_name = sha1(rand());

        $file_name = $prefix."-".$current_time."-".$random_name;

        return $file_name;
    }

    public static function recently_added($web = NULL , $skip = 0, $id = null) {

        $videos_query = AdminVideo::whereNotIn('admin_videos.is_banner',[1])
                        ->orderby('admin_videos.created_at' , 'desc');
        if ($id) {

            // Check any flagged videos are present

            $flagVideos = getFlagVideos($id);

            if($flagVideos) {

                $videos_query->whereNotIn('admin_videos.id',$flagVideos);

            }

        }

        // Check any flagged videos are present
        
        $continue_watching_videos = continueWatchingVideos($id);
        
        if($continue_watching_videos) {

            $videos_query->whereNotIn('admin_videos.id', $continue_watching_videos);

        }

        $videos = $videos_query->skip($skip)->take(Setting::get('admin_take_count'))
                    ->get();
        

        return $videos;
    }

    public static function recently_video($count, $sub_profile_id = null) {

        $videos_query = AdminVideo::where('admin_videos.is_approved' , 1)
                        ->leftJoin('categories' , 'admin_videos.category_id' , '=' , 'categories.id')
                        ->leftJoin('sub_categories' , 'admin_videos.sub_category_id' , '=' , 'sub_categories.id')
                        ->leftJoin('genres' , 'admin_videos.genre_id' , '=' , 'genres.id')
                        ->where('admin_videos.status' , 1)
                        ->where('categories.is_approved', CATEGORY_APPROVED)
                        ->where('sub_categories.is_approved', SUB_CATEGORY_APPROVED)
                        ->videoResponse()
                        ->whereNotIn('admin_videos.is_banner',[1])
                        ->orderby('admin_videos.created_at' , 'desc');
        if ($sub_profile_id) {
            // Check any flagged videos are present
            $flagVideos = getFlagVideos($sub_profile_id);

            if($flagVideos) {
                $videos_query->whereNotIn('admin_videos.id',$flagVideos);
            }

            // Check any flagged videos are present
            $continue_watching_videos = continueWatchingVideos($sub_profile_id);
            
            if($continue_watching_videos) {

                $videos_query->whereNotIn('admin_videos.id', $continue_watching_videos);

            }
        }

        if ($count > 0) {

            $video = $videos_query->skip(0)->take($count)->get();

        } else {

            $video = $videos_query->first();

        }
        return $video;
    }

    public static function wishlist($user_id, $skip = 0, $take = 12, $sub_profile_id = 0) {

        $videos_query = Wishlist::select('admin_video_id')->where('user_id' , $user_id)->where('sub_profile_id', $sub_profile_id)->orderby('updated_at', 'desc');

        // Check any flagged videos are present
        $flagVideos = getFlagVideos($user_id);
        
        if($flagVideos) {

            $videos_query->whereNotIn('admin_video_id', $flagVideos);

        }

        // Check any video present in continue watching

        $continue_watching_videos = continueWatchingVideos($user_id);
        
        if($continue_watching_videos) {

            $videos_query->whereNotIn('admin_video_id', $continue_watching_videos);

        }

        $videos = $videos_query->skip($skip)->take($take)->get();

        return $videos;

    }

    public static function watch_list($user_id, $skip = 0) {

        $videos_query = UserHistory::select('admin_video_id')->where('user_id' , $user_id)->orderby('updated_at', 'desc');
                        
        // Check any flagged videos are present
        $flagVideos = getFlagVideos($user_id);

        if($flagVideos) {

            $videos_query->whereNotIn('admin_video_id', $flagVideos);

        }

        // Check whether video present in continue watching video or not

        $continue_watching_videos = continueWatchingVideos($user_id);
        
        if($continue_watching_videos) {

            $videos_query->whereNotIn('admin_video_id', $continue_watching_videos);

        }

        $videos = $videos_query->skip($skip)->take(Setting::get('admin_take_count', 12))->get();


        return $videos;

    }

    public static function banner_videos($user_id) {

        $videos_query = AdminVideo::where('admin_videos.is_approved' , 1)
                        ->where('admin_videos.status' , 1)
                        ->where('admin_videos.is_banner' , 1)
                        ->select(
                            'admin_videos.id as admin_video_id' ,
                            'admin_videos.title','admin_videos.ratings',
                            'admin_videos.banner_image as default_image'
                            )
                        ->orderBy('created_at' , 'desc');

         // Check any flagged videos are present
        $flagVideos = getFlagVideos($user_id);

        if($flagVideos) {

            $videos_query->whereNotIn('admin_videos.id', $flagVideos);
            
        }


        $videos = $videos_query->get();
     

        return $videos;
    }

    public static function suggestion_videos($web = NULL , $skip = 0, $id = null,$user_id = null) {

        $videos_query = UserHistory::where('user_id' , $user_id)
                        ->orderByRaw('RAND()');

        if ($user_id) {

            // Check any flagged videos are present
            $flagVideos = getFlagVideos($user_id);

            if($flagVideos) {

                $videos_query->whereNotIn('admin_video_id',$flagVideos);

            }

        }

        if ($id) {

            $videos_query->where('admin_video_id', '!=', $id);

        }

        // Check any flagged videos are present
        $continue_watching_videos = continueWatchingVideos($user_id);
        
        if($continue_watching_videos) {

            $videos_query->whereNotIn('admin_video_id', $continue_watching_videos);

        }

        $videos = $videos_query->skip($skip)->take(Setting::get('admin_take_count' ,12))
                    ->get();


        return $videos;

    }

    public static function trending($web = NULL , $skip = 0, $id = null) {

        $videos_query = AdminVideo::where('watch_count' , '>' , 0)
                        ->orderby('watch_count' , 'desc');
        if ($id) {

            // Check any flagged videos are present
            $flagVideos = getFlagVideos($id);

            if($flagVideos) {

                $videos_query->whereNotIn('admin_videos.id', $flagVideos);

            }


        }

         // Check any flagged videos are present
        $continue_watching_videos = continueWatchingVideos($id);
        
        if($continue_watching_videos) {

            $videos_query->whereNotIn('admin_videos.id', $continue_watching_videos);

        }

       
        $videos = $videos_query->skip($skip)->take(Setting::get('admin_take_count'))->get();
        
        return $videos;

    }

    public static function kids_videos($web = NULL , $skip = 0, $id = null) {

        $videos_query = AdminVideo::where('is_kids_video', YES)
                        ->orderby('updated_at' , 'desc');
        if ($id) {

            // Check any flagged videos are present
            $flagVideos = getFlagVideos($id);

            if($flagVideos) {

                $videos_query->whereNotIn('admin_videos.id', $flagVideos);

            }


        }

         // Check any flagged videos are present
        $continue_watching_videos = continueWatchingVideos($id);
        
        if($continue_watching_videos) {

            $videos_query->whereNotIn('admin_videos.id', $continue_watching_videos);

        }
       
        $videos = $videos_query->skip($skip)->take(Setting::get('admin_take_count'))->get();
        
        return $videos;

    }

    public static function category_videos($category_id, $web = NULL , $skip = 0) {

        $videos_query = AdminVideo::where('admin_videos.is_approved' , 1)
                    ->where('admin_videos.status' , 1)
                    ->leftJoin('categories' , 'admin_videos.category_id' , '=' , 'categories.id')
                    ->leftJoin('sub_categories' , 'admin_videos.sub_category_id' , '=' , 'sub_categories.id')
                    ->leftJoin('genres' , 'admin_videos.genre_id' , '=' , 'genres.id')
                    ->where('admin_videos.category_id' , $category_id)
                    ->videoResponse()
                    ->orderby('admin_videos.sub_category_id' , 'asc');
        if (Auth::check()) {
            // Check any flagged videos are present
            $flagVideos = getFlagVideos(Auth::user()->id);

            if($flagVideos) {
                $videos_query->whereNotIn('admin_videos.id', $flagVideos);
            }
        }

        if($web) {
            $videos = $videos_query->paginate(16);
        } else {
            $videos = $videos_query->skip($skip)->take(Setting::get('admin_take_count' ,12))->get();
        }

        return $videos;
    }

    public static function sub_category_videos($sub_category_id , $web = NULL , $skip = 0,$user_id = null) {

        $videos_query = AdminVideo::where('admin_videos.is_approved' , 1)
                    ->where('admin_videos.status' , 1)
                    ->leftJoin('categories' , 'admin_videos.category_id' , '=' , 'categories.id')
                    ->leftJoin('sub_categories' , 'admin_videos.sub_category_id' , '=' , 'sub_categories.id')
                    ->leftJoin('genres' , 'admin_videos.genre_id' , '=' , 'genres.id')
                    ->where('admin_videos.sub_category_id' , $sub_category_id)
                    ->where('categories.is_approved', CATEGORY_APPROVED)
                    ->where('sub_categories.is_approved', SUB_CATEGORY_APPROVED)
                    ->videoResponse()
                    ->orderby('admin_videos.sub_category_id' , 'asc');
        if ($user_id) {
            // Check any flagged videos are present
            $flagVideos = getFlagVideos($user_id);

            if($flagVideos) {
                $videos_query->whereNotIn('admin_videos.id', $flagVideos);
            }
        }
        
        if($web) {
            $videos = $videos_query->paginate(16);
        } else {
            $videos = $videos_query->skip($skip)->take(Setting::get('admin_take_count' ,12))->get();
        }

        return $videos;
    }

    public static function genre_videos($id , $web = NULL , $skip = 0) {

        $videos_query = AdminVideo::where('admin_videos.is_approved' , 1)
                    ->where('admin_videos.status' , 1)
                    ->leftJoin('categories' , 'admin_videos.category_id' , '=' , 'categories.id')
                    ->leftJoin('sub_categories' , 'admin_videos.sub_category_id' , '=' , 'sub_categories.id')
                    ->leftJoin('genres' , 'admin_videos.genre_id' , '=' , 'genres.id')
                    ->where('admin_videos.genre_id' , $id)
                    ->videoResponse()
                    ->orderby('admin_videos.sub_category_id' , 'asc');

        if($web) {
            $videos = $videos_query->paginate(16);
        } else {
            $videos = $videos_query->skip($skip)->take(Setting::get('admin_take_count' ,12))->get();
        }

        return $videos;
    }

    public static function get_video_details($video_id) {

        $videos = AdminVideo::where('admin_videos.id' , $video_id)
                ->leftJoin('categories' , 'admin_videos.category_id' , '=' , 'categories.id')
                ->leftJoin('sub_categories' , 'admin_videos.sub_category_id' , '=' , 'sub_categories.id')
                ->leftJoin('genres' , 'admin_videos.genre_id' , '=' , 'genres.id')
                ->videoResponse()
                ->orderBy('admin_videos.created_at' , 'desc')
                ->first();

        if(!$videos) {
            $videos = array();
        }

        return $videos;
    }

    public static function video_ratings($video_id) {

        $ratings = UserRating::where('admin_video_id' , $video_id)
                        ->leftJoin('users' , 'user_ratings.user_id' , '=' , 'users.id')
                        ->select('users.id as user_id' , 'users.name as username',
                                'users.picture as user_picture' ,

                                'user_ratings.rating' , 'user_ratings.comment',
                                'user_ratings.created_at')
                        ->get();
        if(!$ratings) {
            $ratings = array();
        }

        return $ratings;
    }

    public static function wishlist_status($video_id,$user_id) {
        if($wishlist = Wishlist::where('admin_video_id' , $video_id)->where('user_id' , $user_id)->first()) {
            if($wishlist->status)
                return $wishlist->id;
            else
                return 0 ;
        } else {
            return 0;
        }
    }

    public static function download_status($video_id,$user_id) {
        if($offline_video_status = OfflineAdminVideo::where('admin_video_id' , $video_id)->where('user_id' , $user_id)->first()) {
           return $offline_video_status;
        } else {
            return 0;
        }
    }


    public static function history_status($user_id,$video_id) {
        if(UserHistory::where('admin_video_id' , $video_id)->where('user_id' , $user_id)->count()) {
            return 1;
        } else {
            return 0;
        }
    }

    public static function like_status($user_id,$video_id) {

        $model = LikeDislikeVideo::where('admin_video_id' , $video_id)  
                
                ->where('sub_profile_id' , $user_id)->first();

        if ($model) {

            if($model->like_status == DEFAULT_TRUE) {

                return 1;

            } else if($model->dislike_status == DEFAULT_TRUE){

                return -1;

            } else {

                return 0;

            }

        } else {

            return 0;
        }
    }

    public static function likes_count($video_id) {

        $model = LikeDislikeVideo::where('admin_video_id' , $video_id)->where('like_status' , YES)->count();

        return $model ? $model : 0;

    }

    public static function dislikes_count($video_id) {

        $model = LikeDislikeVideo::where('admin_video_id' , $video_id)->where('dislike_status' , YES)->count();

        return $model ? $model : 0;

    }

    public static function search_video($key,$web = NULL,$skip = 0,$id = null) {

        $videos_query = AdminVideo::where('admin_videos.is_approved' ,'=', 1)
                    ->leftJoin('categories' , 'admin_videos.category_id' , '=' , 'categories.id')
                    ->leftJoin('sub_categories' , 'admin_videos.sub_category_id' , '=' , 'sub_categories.id')
                    ->leftJoin('genres' , 'admin_videos.genre_id' , '=' , 'genres.id')
                    ->where('title','like', '%'.$key.'%')
                    ->where('admin_videos.status' , 1)
                    ->whereNotIn('admin_videos.is_banner',[1])
                    ->where('categories.is_approved',1)
                    ->where('sub_categories.is_approved',1)
                    ->videoResponse()
                    ->orderBy('admin_videos.created_at' , 'desc');
        if ($id) {
            // Check any flagged videos are present
            $flagVideos = getFlagVideos($id);

            if($flagVideos) {
                $videos_query->whereNotIn('admin_videos.id',$flagVideos);
            }
        }

        if($web) {
            $videos = $videos_query->paginate(16);
        } else {
            $videos = $videos_query->skip($skip)->take(Setting::get('admin_take_count' ,12))->get();
        }

        return $videos;
    }

    public static function get_user_comments($user_id,$web = NULL) {

        $videos_query = UserRating::where('user_id' , $user_id)
                        ->leftJoin('admin_videos' ,'user_ratings.admin_video_id' , '=' , 'admin_videos.id')
                        ->where('admin_videos.is_approved' , 1)
                        ->where('admin_videos.status' , 1)
                        ->select('admin_videos.id as admin_video_id' ,
                            'admin_videos.title','admin_videos.description' ,
                            'default_image','admin_videos.watch_count',
                            'admin_videos.duration',
                            DB::raw('DATE_FORMAT(admin_videos.publish_time , "%e %b %y") as publish_time'))
                        ->orderby('user_ratings.created_at' , 'desc')
                        ->groupBy('admin_videos.id');

        if($web) {
            $videos = $videos_query->paginate(16);
        } else {
            $videos = $videos_query->skip($skip)->take(Setting::get('admin_take_count' ,12))->get();
        }

        return $videos;

    }

    public static function get_video_comments($video_id,$skip = 0 ,$web = NULL) {

        $videos_query = UserRating::where('admin_video_id' , $video_id)
                        ->leftJoin('admin_videos' ,'user_ratings.admin_video_id' , '=' , 'admin_videos.id')
                        ->leftJoin('users' ,'user_ratings.user_id' , '=' , 'users.id')
                        ->where('admin_videos.is_approved' , 1)
                        ->where('admin_videos.status' , 1)
                        ->select('admin_videos.id as admin_video_id' ,
                            'user_ratings.user_id as rating_user_id' ,
                            'user_ratings.rating as rating',
                            'user_ratings.comment', 'user_ratings.created_at',
                            'users.name as username' , 'users.picture')
                        ->orderby('user_ratings.created_at' , 'desc');
        if($web) {
            $videos = $videos_query->get();
        } else {
            $videos = $videos_query->skip($skip)->take(Setting::get('admin_take_count' , 12));
        }

        return $videos;

    }

    public static function check_wishlist_status($user_id,$video_id) {

        $status = Wishlist::where('user_id' , $user_id)
                                    ->where('admin_video_id' , $video_id)
                                    ->where('status' , 1)
                                    ->first();
        return $status;
    }

    public static function send_notification($id,$title,$message) {

        Log::info("Send Push Started");

        // Check the user type whether "USER" or "PROVIDER"
        if($id == "all") {
            
            $users = User::where('push_status' , 1)->get();
        } else {
            $users = User::find($id);
        }

        $push_data = array();

        $push_message = array('success' => true,'message' => $message,'data' => array());

        $push_notification = 1; // Check the push notifictaion is enabled

        if ($push_notification == 1) {

            Log::info('Admin enabled the push ');

            if($users){

                Log::info('Check users variable');

                foreach ($users as $key => $user) {

                    Log::info('Individual User');

                    if ($user->device_type == 'ios') {

                        // Log::info("iOS push Started");

                        // // require_once app_path().'/ios/apns.php';

                        // $msg = array("alert" => $message,
                        //     "status" => "success",
                        //     "title" => $title,
                        //     "message" => $push_message,
                        //     "badge" => 1,
                        //     "sound" => "default",
                        //     "status" => "",
                        //     "rid" => "",
                        //     );

                        // if (!isset($user->device_token) || empty($user->device_token)) {
                        //     $deviceTokens = array();
                        // } else {
                        //     $deviceTokens = $user->device_token;
                        // }

                        // $apns = new \Apns();
                        // $apns->send_notification($deviceTokens, $msg);

                        // Log::info("iOS push end");

                    } else {

                        Log::info("Andriod push Started");

                        require_once app_path().'/gcm/GCM_1.php';
                        require_once app_path().'/gcm/const.php';

                        if (!isset($user->device_token) || empty($user->device_token)) {
                            $registatoin_ids = "0";
                        } else {
                            $registatoin_ids = trim($user->device_token);
                        }
                        if (!isset($push_message) || empty($push_message)) {
                            $msg = "Message not set";
                        } else {
                            $msg = $push_message;
                        }
                        if (!isset($title) || empty($title)) {
                            $title1 = "Message not set";
                        } else {
                            $title1 = trim($title);
                        }

                        $message = array(TEAM => $title1, MESSAGE => $msg);

                        $gcm = new \GCM();
                        $registatoin_ids = array($registatoin_ids);
                        $gcm->send_notification($registatoin_ids, $message);

                        Log::info("Andriod push end");

                    }

                }

            }

        } else {
            Log::info('Push notifictaion is not enabled. Please contact admin');
        }

        Log::info("*************************************");

    }

    public static function upload_language_file($folder,$picture,$filename) {

        $ext = $picture->getClientOriginalExtension();
        
        $picture->move(base_path() . "/resources/lang/".$folder ."/", $filename);

    }

    public static function delete_language_files($folder, $boolean, $filename) {
        if ($boolean) {
            $path = base_path() . "/resources/lang/" .$folder;
            \File::cleanDirectory($path);
            \Storage::deleteDirectory( $path );
            rmdir( $path );
        } else {
            \File::delete( base_path() . "/resources/lang/" . $folder ."/".$filename);
        }
        return true;
    }


    /**
     * Used to generate index.php
     *
     * 
     */

    public static function generate_index_file($folder) {

        $filename = public_path()."/".$folder."/index.php"; 

        if(!file_exists($filename)) {

            $index_file = fopen($filename,'w');

            $sitename = Setting::get("site_name");

            fwrite($index_file, '<?php echo "You Are trying to access wrong path!!!!--|E"; ?>');       

            fclose($index_file);
        }
    
    }

    /**
     * Function name: RTMP Secure video url 
     *
     * @description: used to convert the video to rtmp secure link
     *
     * @created: vidhya R
     * 
     * @edited: 
     *
     * @param string $video_name
     *
     * @param string $video_link
     *
     * @return RTMP SECURE LINK or Normal video link
     */

    public static function convert_rtmp_to_secure($video_name  = "", $video_link = "") {

        if(Setting::get('RTMP_SECURE_VIDEO_URL') != "") {

            // HLS_STREAMING_URL
        
            // validity of the link in seconds (if rtmp and www are on two different machines, it is better to give a higher value, because there may be a time difference.

            $e = date('U')+20; 

            $secret_word = "cgshlockkey"; 

            $user_remote_address = $_SERVER['REMOTE_ADDR'] ?? "127.0.0.1"; 

            $md5 = base64_encode(md5($secret_word . $user_remote_address . $e , true)); 

            $md5 = strtr($md5, '+/', '-_'); 

            $md5 = str_replace('=', '', $md5); 

            $rtmp = $video_name."?token=".$md5."&e=".$e; 
            
            $secure_url = Setting::get('RTMP_SECURE_VIDEO_URL').$rtmp;

            return $secure_url; 
        
        } elseif (Setting::get('streaming_url')) {

            $rtmp_video_url = Setting::get('streaming_url').$video_name;

            return $rtmp_video_url;

        } else {

            return $video_link;

        }
        
    }

    /**
     * Function name: RTMP Secure video url 
     *
     * @description: used to convert the video to rtmp secure link
     *
     * @created: vidhya R
     * 
     * @edited: 
     *
     * @param string $video_name
     *
     * @param string $video_link
     *
     * @return RTMP SECURE LINK or Normal video link
     */

    public static function convert_hls_to_secure($video_name  = "", $video_link = "") {

        if(Setting::get('HLS_SECURE_VIDEO_URL') != "") {


            // HLS_STREAMING_URL
        
            // validity of the link in seconds (if rtmp and www are on two different machines, it is better to give a higher value, because there may be a time difference.

            $expires = date('U')+20000;

            // secure_link_md5 "$secure_link_expires$uri$remote_addr cgshlockkey";

            $secret_word = "cgshlockkey"; 

            $user_remote_address = $_SERVER['REMOTE_ADDR'] ?? "127.0.0.1"; 

            Log::info("user_remote_address".$user_remote_address);

            $md5 = md5("$expires/$video_name$user_remote_address $secret_word", true);

            $md5 = base64_encode($md5); 

            $md5 = strtr($md5, '+/', '-_'); 

            $md5 = str_replace('=', '', $md5); 

            $hls = $video_name."?md5=".$md5."&expires=".$expires; 
            
            $secure_url = Setting::get('HLS_SECURE_VIDEO_URL').$hls;

            return $secure_url; 
        
        } elseif (Setting::get('HLS_STREAMING_URL')) {

            $hls_video_url = Setting::get('HLS_STREAMING_URL').$video_name;

            return $hls_video_url;

        } else {

            return $video_link;

        }
        
    }

    /**
     * Function Name : continue_watching_videos
     * 
     * Brief : Displayed partially seen videos by the users based on their profile
     *
     * @param object $request - USer id, token & sub profile id
     *
     * @return response of array 
     */

    public static function continue_watching_videos($sub_profile_id, $device_type, $skip) {

        $query = ContinueWatchingVideo::where('continue_watching_videos.sub_profile_id', $sub_profile_id)->orderby('continue_watching_videos.updated_at', 'desc');
                   
        // Check any flagged videos are present

        $flagVideos = getFlagVideos($sub_profile_id);

        if($flagVideos) {

            $query->whereNotIn('admin_video_id', $flagVideos);

        }

        $model = $query->skip($skip)->take(Setting::get('admin_take_count', 12))->get();

        return $model;

    }


    /* Function name: RTMP Secure video url 
     *
     * @description: used to convert the video to rtmp secure link
     *
     * @created: vidhya R
     * 
     * @edited: 
     *
     * @param string $video_name
     *
     * @param string $video_link
     *
     * @return RTMP SECURE LINK or Normal video link
     */

    public static function convert_smil_to_secure($smil_file  = "", $smil_link = "") {

        if(Setting::get('VIDEO_SMIL_URL') != "") {
        
            // validity of the link in seconds (if rtmp and www are on two different machines, it is better to give a higher value, because there may be a time difference.

            $expires = date('U')+20;

            // secure_link_md5 "$secure_link_expires$uri$remote_addr cgshlockkey";

            $secret_word = "cgshlockkey"; 

            $user_remote_address = $_SERVER['REMOTE_ADDR'] ?? "127.0.0.1"; 

            Log::info("user_remote_address".$user_remote_address);

            $md5 = md5("$expires/$smil_file$user_remote_address $secret_word", true);

            $md5 = base64_encode($md5); 

            $md5 = strtr($md5, '+/', '-_'); 

            $md5 = str_replace('=', '', $md5); 

            $smil = $smil_file."?md5=".$md5."&expires=".$expires; 
            
            $secure_url = Setting::get('VIDEO_SMIL_URL').'/'.$smil;

            return $secure_url; 
        
        } else {

            return $smil_link;

        }
        
    }

    /**
     * Function: upload_file_to_s3
     *
     * @uses used to upload files to S3 Bucket
     *
     * @created Vidhya R
     *
     * @updated Vidhya R
     *
     * @param file $picture
     *
     * @return uploaded file URL
     */

    public static function upload_file_to_s3($picture) {

        $s3_url = "";

        $file_name = Helper::file_name();

        $extension = $picture->getClientOriginalExtension();

        $local_url = $file_name . "." . $extension;

        // Check S3 bucket configuration

        if(config('filesystems')['disks']['s3']['key'] && config('filesystems')['disks']['s3']['secret']) {

            $bucket = config('filesystems')['disks']['s3']['bucket'];

            $keyname = $local_url;

            $filename = $picture;

            Log::info($bucket);

            Log::info($keyname);

            Log::info(envfile('S3_REGION'));

            $s3 = new S3Client([
                'version' => 'latest',
                'region'  => envfile('S3_REGION'),
                'credentials' => array(
                    'key' => envfile('S3_KEY'),
                    'secret'  => envfile('S3_SECRET'),
                  )

            ]);

            $result = $s3->createMultipartUpload([
                'Bucket'       => $bucket,
                'Key'          => $keyname,
                'StorageClass' => 'REDUCED_REDUNDANCY',
                'ACL'          => 'public-read',
                'Metadata'     => [
                    'param1' => 'value 1',
                    'param2' => 'value 2',
                    'param3' => 'value 3'
                ]
            ]);

            $uploadId = $result['UploadId'];

            // Upload the file in parts.

            $parts = [];
           
            try {
                
                $file = fopen($filename, 'r');
                
                $partNumber = 1;
                
                while (!feof($file)) {
                    $result = $s3->uploadPart([
                        'Bucket'     => $bucket,
                        'Key'        => $keyname,
                        'UploadId'   => $uploadId,
                        'PartNumber' => $partNumber,
                        'Body'       => fread($file, 5 * 1024 * 1024),
                    ]);
                    
                    // $parts = [];

                    $parts['Parts'][$partNumber] = [
                        'PartNumber' => $partNumber,
                        'ETag' => $result['ETag'],
                    ];
                    
                    $partNumber++;

                    Log::info("Uploading part {$partNumber} of {$filename}." . PHP_EOL);

                }

                fclose($file);

            } catch (S3Exception $e) {

                $result = $s3->abortMultipartUpload([
                    'Bucket'   => $bucket,
                    'Key'      => $keyname,
                    'UploadId' => $uploadId
                ]);

                Log::info("Upload of {$filename} failed." . PHP_EOL);

            }

            // Complete the multipart upload.

            $result = $s3->completeMultipartUpload([
                'Bucket'   => $bucket,
                'Key'      => $keyname,
                'UploadId' => $uploadId,
               // 'MultipartUpload'    => $parts,
                'MultipartUpload' => Array('Parts' => $parts ? $parts['Parts'] : []),
            ]);

            $url = $s3_url= $result['Location'];

            Log::info("Uploaded {$filename} to {$url}." . PHP_EOL);

        } else {

            $ext = $picture->getClientOriginalExtension();

            $picture->move(public_path() . "/uploads/", $file_name . "." . $ext);

            $local_url = $file_name . "." . $ext;

            $s3_url = Helper::web_url().'/uploads/'.$local_url;
       
        }

        return $s3_url;
    
    }

    /**
     * @method settings_generate_json()
     *
     * @uses used to update settings.json file with updated details.
     *
     * @created vidhya
     * 
     * @updated vidhya
     *
     * @param -
     *
     * @return boolean
     */
    
    public static function settings_generate_json() {

        $basic_keys = ['site_name', 'site_logo', 'site_icon', 'currency', 'currency_code', 'google_analytics', 'header_scripts', 'body_scripts', 'facebook_link', 'linkedin_link', 'twitter_link', 'google_plus_link', 'pinterest_link', 'instagram_link', 'demo_user_email', 'demo_user_password', 'chat_socket_url', 'google_api_key', 'appstore', 'playstore', 'common_bg_image', 'meta_title', 'meta_description', 'meta_author', 'meta_keywords','stripe_publishable_key'];

        $settings = Settings::get();
        
        $settings_data = [];

        foreach ($settings as $key => $setting_details) {

            $settings_data[$setting_details->key] = $setting_details->value;
        }

        $settings_data['PAYPAL_ID'] = envfile('PAYPAL_ID');

        $settings_data['PAYPAL_SECRET'] = envfile('PAYPAL_SECRET');
        
        $settings_data['PAYPAL_MODE'] = envfile('PAYPAL_MODE');

        $footer_pages1 = Page::select('id as page_id', 'unique_id', 'type as page_type', 'heading')->where('section_type', STATIC_PAGE_SECTION_1)->get();

        $footer_pages2 = Page::select('id as page_id', 'unique_id', 'type as page_type', 'heading')->where('section_type', STATIC_PAGE_SECTION_2)->get();

        $settings_data['footer_pages1'] = $footer_pages1;

        $settings_data['footer_pages2'] = $footer_pages2;


        // Social logins

        $social_login_keys = ['FB_CLIENT_ID', 'FB_CLIENT_SECRET', 'FB_CALL_BACK' , 'TWITTER_CLIENT_ID', 'TWITTER_CLIENT_SECRET', 'TWITTER_CALL_BACK', 'GOOGLE_CLIENT_ID', 'GOOGLE_CLIENT_SECRET', 'GOOGLE_CALL_BACK'];

        $social_logins = Settings::whereIn('key', $social_login_keys)->get();

        $social_login_data = [];

        foreach ($social_logins as $key => $social_login_details) {

            $social_login_data[$social_login_details->key] = $social_login_details->value;
        }

        $settings_data['social_logins'] = $social_login_data;

        $data['data'] = $settings_data;

        $data = json_encode($data);

        $file_name = public_path('/default-json/settings.json');

        File::put($file_name, $data);
   
    }

    /**
     * @method home_settings_generate_json()
     *
     * @uses used to update settings.json file with updated details.
     *
     * @created vidhya
     * 
     * @updated vidhya
     *
     * @param -
     *
     * @return boolean
     */
    
    public static function home_settings_generate_json() {

        $basic_keys = ['home_page_bg_image', 'home_banner_title','home_banner_heading', 'home_banner_description','home_section_1_title','home_section_1_description','home_section_1_video','home_section_2_title','home_section_2_description','home_section_2_image','home_section_2_mob_image','home_section_2_image_title','home_section_3_title','home_section_3_description','home_section_3_video','home_section_3_cover_image'];

        $settings = Settings::whereIn('key', $basic_keys)->get();

        $settings_data = [];

        foreach ($settings as $key => $setting_details) {

            $settings_data[$setting_details->key] = $setting_details->value;
        }

        $data['data'] = $settings_data;

        $data = json_encode($data);

        $file_name = public_path('/default-json/home-settings.json');

        File::put($file_name, $data);
    }

    /**
     * @method referral_register()
     *
     * @uses Used to Register Referral users
     *
     * @created Bhawya
     * 
     * @updated Bhawya
     *
     * @param Referral code
     *
     * @return boolean
     */
    public static function referral_register($code, $user_details) {

        $referral_code = ReferralCode::where('referral_code', $code)->first();

        if($referral_code) {

            $user = User::where('status', APPROVED)->where('users.id', $referral_code->user_id)->first(); 

            if(!$user) {

                \Log::info("ReferralCode Invalid");

                $referral_codes = ReferralCode::where('user_id', $user_details->id)->first();

                if(!$referral_codes) {

                    $referral_codes = Helper::user_referral_code($user_details->id);

                }

                return false;
            }

            Log::info('Inside Referral Code');

            $user_referrals =  UserReferral::where('user_id', $user_details->id)->where('referral_code', $code)->first() ?? new UserReferral;

            $user_referrals->user_id = $user_details->id;

            $user_referrals->parent_user_id = $referral_code->user_id;

            $user_referrals->referral_code_id = $referral_code->id;

            $user_referrals->referral_code = $referral_code->referral_code;

            $user_referrals->device_type = $user_details->device_type;

            $referral_earnings = Setting::get('referral_earnings') ?: 0;

            $referrer_earnings = Setting::get('referrer_earnings') ?: 0;

            if($user_referrals->save()) {

                $referral_code->total_referrals = $referral_code->total_referrals + 1;

                // $referral_code->referral_earnings += $referral_earnings;
                
                $referral_code->save();

            }

            // Wallet Amount add for Referral earnings
            // current user code, if someone joined referral_earnings referral_code->user_id - referral_earnings


            // someother user joined using referral code -  referee_earnings user_details->id - referee_earnings

            if($referral_earnings > 0) {

                CustomWalletRepo::custom_wallet_update($referral_code->user_id,$referral_earnings,CW_PAYMENT_TYPE_REFERRAL);

                $message = tr('referral_earnings_wallet_message').$user_details->name;

                $history_data = [
                    'id'=> $referral_code->user_id,
                    'payment_id'=>uniqid(),
                    'custom_field_id' => $referral_code->user_id,
                    'history_type' => CW_HISTORY_TYPE_WALLET, 
                    'transaction_type' => CW_ADD, 
                    'message' => $message,
                    'wallet_amount'=>$referral_earnings,
                    'payment_mode'=>CW_HISTORY_TYPE_WALLET,
                ];
                
                CustomWalletRepo::custom_wallet_history_save((object)$history_data);

                $referral_data = [
                    'id'=> $user_details->id,
                    'parent_user_id' => $referral_code->user_id,
                    'referral_code_id' => $referral_code->id,
                    'referral_code' => $referral_code->referral_code,
                    'referral_amount' => $referral_earnings,
                ];

                CustomWalletRepo::referral_history_save((object)$referral_data);

            }

            if($referrer_earnings > 0) {

                $referral_codes = ReferralCode::where('user_id', $user_details->id)->first();

                if(!$referral_codes) {

                    $referral_codes = Helper::user_referral_code($user_details->id);

                }

                $referral_codes->referee_earnings += $referrer_earnings;

                $referral_codes->save();

                CustomWalletRepo::custom_wallet_update($user_details->id,$referrer_earnings);

                $message = tr('referrer_earnings_wallet_message').$user_details->name;

                $history_data = [
                    'id'=> $user_details->id,
                    'payment_id'=>uniqid(),
                    'custom_field_id' => $user_details->id,
                    'history_type' => CW_HISTORY_TYPE_WALLET, 
                    'transaction_type' => CW_ADD, 
                    'message' => $message,
                    'wallet_amount'=>$referrer_earnings,
                    'payment_mode'=>CW_HISTORY_TYPE_WALLET
                ];

                CustomWalletRepo::custom_wallet_history_save((object)$history_data);
            
            }
            
        }

    }

    /**
     * @method user_referral_code()
     *
     * @uses Used to Generate user Referral codes
     *
     * @created Bhawya
     * 
     * @updated Bhawya
     *
     * @param Referral code
     *
     * @return boolean
     */
    public static function user_referral_code($user_id) {

        $referral_codes = new ReferralCode;

        $referral_codes->user_id = $user_id;

        $referral_codes->referral_code = strtoupper(uniqid());

        $referral_codes->total_referrals = $referral_codes->referral_earnings = $referral_codes->referee_earnings = 0;

        $referral_codes->save();

        return $referral_codes;

    }

    public static function get_email_content($template_type,$email_data) {
        $content = "";

        $template = EmailTemplate::where('template_type', $template_type)->first()  ?? [];

        if ($template) {

            $content = $template->description;

            $subject = $template->subject ?  str_replace('<%site_name%>', Setting::get('site_name'),$template->subject) : '';

            $subject = $subject ?  str_replace('&lt;%site_name%&gt;', Setting::get('site_name'),$subject) : '';


            $content = isset($email_data['email']) ? str_replace('<%email%>',$email_data['email'], $content) : $content;

            $content = isset($email_data['email']) ? str_replace('&lt;%email%&gt;',$email_data['email'], $content) : $content;

            $content = isset($email_data['password']) ? str_replace('<%password%>',$email_data['password'],$content) : $content;

            $content = isset($email_data['password']) ? str_replace('&lt;%password%&gt;',$email_data['password'],$content) : $content;

            $content = str_replace('<%site_name%>', Setting::get('site_name'),$content);

            $content = str_replace('&lt;%site_name%&gt;',Setting::get('site_name'),$content);

            if ($template->template_type == NEW_VIDEO || $template->template_type == EDIT_VIDEO) {

                $content = str_replace('<%category_name%>', $email_data['category_name'],$content);

                $content = str_replace('&lt;%category_name%&gt;',$email_data['category_name'],$content);

                $content = str_replace('<%video_name%>', $email_data['video_name'],$content);

                $content = str_replace('&lt;%video_name%&gt;',$email_data['video_name'],$content);

                $subject = $subject ?  str_replace('<%video_name%>', $email_data['video_name'],$subject) : '';

                $subject = $subject ?  str_replace('&lt;%video_name%&gt;', $email_data['video_name'],$subject) : '';

            }

        }

        // Log::info(print_r($email_data , true));

        return $content;

    }


    /**
     * @method upload_file
     */
    
    public static function storage_upload_file($input_file, $folder_path = COMMON_IMAGE_PATH) {
       
        $name = Helper::file_name();

        $ext = $input_file->getClientOriginalExtension();

        $file_name = $name.".".$ext;

        $public_folder_path = "public/".$folder_path;

        Storage::disk('local')->putFileAs($public_folder_path, $input_file, $file_name);

        $storage_file_path = $folder_path.$file_name;

        $url = asset(Storage::url($storage_file_path));
    
        return $url;

    }

    /**
     * @method
     * 
     */
    public static function storage_delete_file($url, $folder_path = PROFILE_PATH_USER) {

        $file_name = basename($url);

        $storage_file_path = $folder_path.$file_name;
        
        Storage::disk('public')->delete($storage_file_path);

    }

    public static function audio_upload($audio) {
        
        $s3_url = "";

        $file_name = Helper::file_name();

        $ext = $audio->getClientOriginalExtension();

        $local_url = $file_name . "." . $ext;

        $path = AUDIO_PATH;

        $final_folder_path = public_path($path);

        if(!File::isDirectory($final_folder_path)){

            File::makeDirectory($final_folder_path, 0777, true, true);

        }

        $audio->move(public_path() . $path, $local_url);

        $s3_url = Helper::web_url().$path.$local_url;

        return $s3_url;
    }

}


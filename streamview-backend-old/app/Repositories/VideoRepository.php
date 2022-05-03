<?php

/**************************************************
* Repository Name: VideoRepository
*
* Purpose: This repository used to do all functions related videos.
*
* @author - Vithya R
*
* Date Created: 22 June 2017
**************************************************/

namespace App\Repositories;

use Illuminate\Http\Request;

use App\Helpers\Helper;

use App\Jobs\StreamviewCompressVideo;

use App\Jobs\PushNotification;

use App\Jobs\SendVideoMail;

use App\Repositories\PushNotificationRepository as PushRepo;


use Validator;

use Hash;

use Log;

use Setting;

use DB;

use Exception;

use Auth;

use File;


use App\PayPerView;

use App\AdminVideo;

use App\Notification;

use App\Category, App\Genre;

use App\VideoCastCrew;

use App\EmailTemplate;

use Monolog\Handler\StreamHandler;

use Monolog\Logger;

use Streaming\FFMpeg;

class VideoRepository {

	/**
 	 * @method pay_per_views_status_check
 	 *
 	 * To check the status of the pay per view in each video
 	 *
 	 * @created - Vithya R
 	 * 
 	 * @updated - - 
 	 *
 	 * @param object $request - Video related details, user related details
 	 *
 	 * @return response of success/failure response of datas
 	 */
 	public static function pay_per_views_status_check($user_id, $user_type, $video_data) {

 		// Check video details present or not

 		if ($video_data) {

 			// Check the video having ppv or not

 			if ($video_data->is_pay_per_view) {

 				$is_ppv_applied_for_user = DEFAULT_FALSE; // To check further steps , the user is applicable or not

 				// Check Type of User, 1 - Normal User, 2 - Paid User, 3 - Both users

 				switch ($video_data->type_of_user) {

 					case NORMAL_USER:
 						
 						if (!$user_type) {

 							$is_ppv_applied_for_user = DEFAULT_TRUE;
 						}

 						break;

 					case PAID_USER:
 						
 						if ($user_type) {

 							$is_ppv_applied_for_user = DEFAULT_TRUE;
 						}
 						
 						break;
 					
 					default:

 						// By default it will taks as Both Users

 						$is_ppv_applied_for_user = DEFAULT_TRUE;

 						break;
 				}

 				if ($is_ppv_applied_for_user) {

 					// Check the user already paid or not

 					$ppv_model = PayPerView::where('status', DEFAULT_TRUE)
 						->where('user_id', $user_id)
 						->where('video_id', $video_data->admin_video_id)
 						->orderBy('id','desc')
 						->first();

 					$watch_video_free = DEFAULT_FALSE;

 					if ($ppv_model) {

 						// Check the type of payment , based on that user will watch the video 

 						switch ($video_data->type_of_subscription) {

		 					case ONE_TIME_PAYMENT:
		 						
		 						$watch_video_free = DEFAULT_TRUE;
		 						
		 						break;

		 					case RECURRING_PAYMENT:

		 						// If the video is recurring payment, then check the user already watched the paid video or not 
		 						
		 						if (!$ppv_model->is_watched) {

		 							$watch_video_free = DEFAULT_TRUE;
		 						}
		 						
		 						break;
		 					
		 					default:

		 						// By default it will taks as true

		 						$watch_video_free = DEFAULT_TRUE;

		 						break;
		 				}

		 				if ($watch_video_free) {

		 					$response_array = ['success'=>true, 'message'=>Helper::get_message(124), 'code'=>124];

		 				} else {

		 					$response_array = ['success'=>false, 'message'=>Helper::get_message(125), 'code'=>125];

		 				}

 					} else {

 						// 125 - User pay and watch the video

 						$response_array = ['success'=>false, 'message'=>Helper::get_message(125), 'code'=>125];
 					}

 				} else {

 					$response_array = ['success'=>true, 'message'=>Helper::get_message(124), 'code'=>124];

 				}

 			} else {

 				// 124 - User can watch the video
 				
 				$response_array = ['success'=>true, 'message'=>Helper::get_message(123), 'code'=>124];

 			}

 		} else {

 			$response_array = ['success'=>false, 'error_messages'=>Helper::get_error_message(906), 
 				'error_code'=>906];

 		}

 		return response()->json($response_array);
 	
 	}

 	/**
 	 * @method admin_videos_save
 	 *
 	 * @uses To save the video (Common function for both create and edit)
 	 *
 	 * @created: Vithya R
 	 * 
 	 * @updated: Vidhya R
 	 *
 	 * @param object $request - Video related details
 	 *
 	 * @return response of success/failure response of datas
 	 */
 	public static function admin_videos_save(Request $request) {

 		try {
            
 			DB::beginTransaction();

 			Log::info(print_r($request->all(),true));

	 		// Basic validations of video save form

	 		$validator = Validator::make($request->all(),
	 			[
	 				'admin_video_id'=>$request->admin_video_id ? 'exists:admin_videos,id' : '',
	 				'title'=>'required|max:255|min:4',	
	 				'publish_type'=>'required|in:'.PUBLISH_NOW.','.PUBLISH_LATER,
	 				'publish_time'=>$request->publish_type == PUBLISH_LATER ? 'required' : '',
	 				'age'=>'required|min:2|max:3',
	 				'ratings'=>'required|numeric|min:1|max:5',
	 				'description'=>'required',
	 				'details'=>'required',
	 				'category_id'=>'required|exists:categories,id,is_approved,'.DEFAULT_TRUE,
	 				'sub_category_id'=>'required|exists:sub_categories,id,is_approved,'.DEFAULT_TRUE,
	 				'genre_id'=>'exists:genres,id,is_approved,'.DEFAULT_TRUE,
	 				'default_image'=> $request->admin_video_id ? 'nullable|mimes:png,jpeg,jpg' : 'required|mimes:png,jpeg,jpg',
	 				'video_type'=>'required|in:'.VIDEO_TYPE_UPLOAD.','.VIDEO_TYPE_YOUTUBE.','.VIDEO_TYPE_OTHER.','.VIDEO_TYPE_VIMEO,
	 				'compress_video'=>'required|in:'.COMPRESS_ENABLED.','.COMPRESS_DISABLED,
	 				'video_upload_type'=> ($request->video_type == VIDEO_TYPE_UPLOAD) ? 'required|in:'.VIDEO_UPLOAD_TYPE_s3.','.VIDEO_UPLOAD_TYPE_DIRECT : '',
	 				'video'=> ($request->video_type == VIDEO_TYPE_UPLOAD) ? ($request->admin_video_id ? 'nullable|mimes:mp4,mov,avi,qt,mkv' : 'required|mimes:mp4,mov,avi,qt,mkv') : 'url',
	 				'trailer_video' => $request->hasFile('trailer_video') ? ($request->video_type == VIDEO_TYPE_UPLOAD ?  'mimes:mp4,mov,avi,qt,mkv' : 'url') : ($request->video_type == VIDEO_TYPE_UPLOAD ? 'nullable|mimes:mp4,mov,avi,qt,mkv' : 'url'), // If trailer subtitle uploading by admin without trailer video it will throw an error
	 				'duration'=>'required',
	 				'trailer_duration'=>'required',
	 				'is_kids_video'=> 'in:'.KIDS_SECTION_YES.','.KIDS_SECTION_NO
	 				// |date_format:hh:mm:ss
	 			],
	 			[
	 				'category_id.exists' => tr('category_not_exists'),
	 				'sub_category_id.exists' => tr('subcategory_not_exists'),
	 				'genre_id.exists' => tr('genre_not_exists'),
	 				'admin_video_id.exists' => tr('video_not_exists'),
	 				'cast_crew_ids.exists' => tr('cast_crew_not_exists'),
	 			]
	 		);

	 		if ($validator->fails()) {

	 			$errors = implode(',', $validator->messages()->all());

	 			throw new Exception($errors, 101);
	 		} 

 			// Check the category having genre or not

 			$load_category = Category::find($request->category_id);

 			$genres = Genre::where('sub_category_id', '=', $request->sub_category_id)
                        ->where('is_approved' , GENRE_APPROVED)->first();

 			if ($load_category) {

 				if ($load_category->is_series && $genres) {

 					// If Genre not present, trailer video should be required

	 				$is_genre_existing = Validator::make($request->all(),[

	 					'genre_id'=> 'required',

	 				],[

	 					'genre_id.exists' => tr('genre_not_exists'),

	 				]);

	 				if ($is_genre_existing->fails()) {

			 			$errors = implode(',', $is_genre_existing->messages()->all());

			 			throw new Exception($errors);

			 		}

 				}

 			}

 			// Check Genre present or not

 			if($request->genre_id <= 0) {

 				// If Genre not present, trailer video should be required

 				$genre_validator = Validator::make($request->all(),[

 					'trailer_video'=> $request->video_type == VIDEO_TYPE_UPLOAD ? ($request->admin_video_id ? 'nullable|mimes:mp4' : 'required|mimes:mp4,mov,avi,qt,mkv') : 'required|url'

 				]);

 			} else {

 				// If Genre present, trailer video Optional

 				$genre_validator = Validator::make($request->all(),[

 					'trailer_video'=> $request->video_type == VIDEO_TYPE_UPLOAD ? ($request->admin_video_id ? 'nullable|mimes:mp4' : 'mimes:mp4,mov,avi,qt,mkv') : 'required|url'

 				]);

 			}

 			if ($genre_validator->fails()) {

	 			$errors = implode(',', $genre_validator->messages()->all());

	 			throw new Exception($errors);

	 		}

	 		$videopath = '/uploads/videos/original/';

	 		// If video id present, load video and check whether the user changed the video type or not
 			if ($request->admin_video_id) {

 				$video_model = AdminVideo::find($request->admin_video_id);

 				$different_type = DEFAULT_FALSE;

 				if ($request->video_type == $video_model->video_type) {

 					$different_type = DEFAULT_FALSE;

 					$video_validator = Validator::make($request->all(),[

	 					'video'=> $request->video_type == VIDEO_TYPE_UPLOAD ? 'nullable|mimes:mp4,mov,avi,qt,mkv' : 'required|url',

	 					'trailer_video'=> $request->video_type == VIDEO_TYPE_UPLOAD ? 'nullable|mimes:mp4,mov,avi,qt,mkv' : 'required|url',

	 				]);

 				} else {

 					$different_type = DEFAULT_TRUE;

 					$video_validator = Validator::make($request->all(),[

	 					'video'=> $request->video_type == VIDEO_TYPE_UPLOAD ? 'required|mimes:mp4,mov,avi,qt,mkv' : 'required|url',

	 					'trailer_video'=> $request->video_type == VIDEO_TYPE_UPLOAD ? 'required|mimes:mp4,mov,avi,qt,mkv' : 'required|url',

	 				]);

 				}

 				if ($video_validator->fails()) {

		 			$errors = implode(',', $video_validator->messages()->all());

		 			throw new Exception($errors);

		 		}

		 		$video_model->edited_by = $request->edited_by ? $request->edited_by : ADMIN;

		 		// If the video type is different, Based on type just delete the videos

		 		if ($different_type && $request->admin_video_id) {

		 			if ($video_model->video_type == VIDEO_TYPE_UPLOAD && $request->video_type != VIDEO_TYPE_UPLOAD) {

		 				if($video_model->video_upload_type == VIDEO_UPLOAD_TYPE_s3) {

			        		Helper::s3_delete_picture($video_model->video);   

			               	Helper::s3_delete_picture($video_model->trailer_video);  

			        	} else {

			        		Helper::delete_picture($video_model->video, $videopath); 

	                		$splitVideos = ($video_model->video_resolutions) 
                                ? explode(',', $video_model->video_resolutions)
                                : [];

	                        foreach ($splitVideos as $key => $value) {

	                        	Helper::delete_picture($video_model->video, $videopath.$value.'/');

	                        }

	                        Helper::delete_picture($video_model->trailer_video, $videopath); 

	                		$splitVideos = ($video_model->trailer_video_resolutions) 
                                ? explode(',', $video_model->trailer_video_resolutions)
                                : [];

	                        foreach ($splitVideos as $key => $value) {

	                        	Helper::delete_picture($video_model->trailer_video, $videopath.$value.'/');

	                        }

			        	}

		 			}

		 		}


 			} else {

 				$video_model = new AdminVideo;

 				$video_model->uploaded_by = $request->uploaded_by ? $request->uploaded_by : ADMIN;

 				$video_model->is_approved = $request->uploaded_by ? VIDEO_DECLINED : VIDEO_APPROVED;

 			}

 			$video_model->title = $request->title;

 			$video_model->skip_intro_seconds = $request->skip_intro_seconds ?? 0;

 			$video_model->skip_intro_start = $request->skip_intro_start ?? 0;

 			if($request->has('skip_intro_end')) {

 				$check_start = $request->skip_intro_start + $request->skip_intro_seconds;

 				$video_model->skip_intro_end = $request->skip_intro_end >= $check_start ? $request->skip_intro_end : $request->skip_intro_start + 5;
 			}
 			
 			$timezone =  $request->timezone;

 			$current_date_time = date('Y-m-d H:i:s');

 			$converted_current_datetime = convertTimeToUSERzone($current_date_time, $timezone);

 			// Check the publish type based on that convert the time to timezone

 			if ($request->publish_type == PUBLISH_LATER) {

 				$publish_time = $request->publish_time;

 				$strtotime_publish_time = strtotime($publish_time);

 				$current_strtotime = strtotime($converted_current_datetime);

 				if ($strtotime_publish_time <= $current_strtotime) {

 					throw new Exception(Helper::get_error_message(166), 166);

 				}

 				$video_model->publish_time = date('Y-m-d H:i:s', $strtotime_publish_time);

 				// Based on publishing time the status will change

 				$video_model->status = VIDEO_NOT_YET_PUBLISHED;

 			} else {

 				$video_model->publish_time = $converted_current_datetime;

 				$video_model->status = VIDEO_PUBLISHED;

 			}

 			$video_model->age = $request->age;

 			$video_model->duration = $request->duration;

 			$video_model->trailer_duration = $request->trailer_duration;

 			$video_model->ratings = $request->ratings;

 			$video_model->description = $request->description;

 			$video_model->reviews = '';

 			$video_model->details = $request->details;

 			$video_model->category_id = $request->category_id;

 			$video_model->sub_category_id = $request->sub_category_id;

 			$video_model->genre_id = $request->genre_id ? $request->genre_id : 0;

 			$video_model->video_type = $request->video_type;

 			$video_model->video_upload_type = $request->video_type == VIDEO_TYPE_UPLOAD ? $request->video_upload_type : '';

 			$video_model->unique_id = seoUrl($video_model->title);

 			$video_model->duration = $request->duration;

 			$video_model->is_kids_video = $request->is_kids_video ? $request->is_kids_video : KIDS_SECTION_NO;

            $main_video_details = $trailer_video_details = "";

            $no_need_compression = DEFAULT_TRUE;

            // If the video type is manual upload then below code will excute

	        if($request->video_type == VIDEO_TYPE_UPLOAD) {

	        	// In Manual Upload, need to check whether its s3 bucket / streaming upload, if it is streaming upload need to show resolution based upload video

	        	if($request->video_upload_type == VIDEO_UPLOAD_TYPE_s3) {

	        		if ($request->hasFile('video')) {

	        			if ($request->admin_video_id) {

	        			 	Helper::s3_delete_picture($video_model->video);   

	        			 }

	        			$video_model->video = Helper::upload_file_to_s3($request->file('video'));

	        		}

                    if ($request->hasFile('trailer_video')) {

                    	if ($request->admin_video_id) {

	                        Helper::s3_delete_picture($video_model->trailer_video);  

	                    }

                        $video_model->trailer_video = Helper::upload_file_to_s3($request->file('trailer_video'));

                    }

	        	} else {

		        	//$video_model->compress_video = $request->compress_video;

		        	$video_model->video_resolutions = $request->video_resolutions ? implode(',', $request->video_resolutions) : ($request->admin_video_id ? $video_model->video_resolutions : "");

		        	$video_model->trailer_video_resolutions = $request->trailer_video_resolutions ? implode(',', $request->trailer_video_resolutions) : ($request->admin_video_id ? $video_model->video_resolutions : "");

		        	// $video_model->is_approved = DEFAULT_FALSE;

		        	$video_model->main_video_compress_status = COMPRESS_NOT_YET_STARTED;

	                $video_model->trailer_compress_status = COMPRESS_NOT_YET_STARTED;

	                $video_model->compress_status = COMPRESS_NOT_YET_STARTED;

	                if (Setting::get('ffmpeg_installed') == FFMPEG_NOT_INSTALLED) {

	                	$request->compress_video = DO_NOT_COMPRESS;
	                }

                	/****** ORIGINAL VIDEO UPLOAD START *****/

	                if ($request->hasFile('video')) {

	                	if ($request->admin_video_id) {

	                		Helper::delete_picture($video_model->video, $videopath); 

	                		$splitVideos = ($video_model->video_resolutions) 
                                ? explode(',', $video_model->video_resolutions)
                                : [];

	                        foreach ($splitVideos as $key => $value) {

	                        	Helper::delete_picture($video_model->video, $videopath.$value.'/');

	                        }

	                	}

		                $main_video_details = Helper::video_upload($request->file('video'), $request->compress_video);

                    	$video_model->video = $main_video_details['db_url'];

                    }

                	if($request->hasFile('trailer_video')) {

                		if ($request->admin_video_id) {

	                		Helper::delete_picture($video_model->trailer_video, $videopath); 

	                		$splitVideos = ($video_model->trailer_video_resolutions) 
                                ? explode(',', $video_model->trailer_video_resolutions)
                                : [];

	                        foreach ($splitVideos as $key => $value) {

	                        	Helper::delete_picture($video_model->trailer_video, $videopath.$value.'/');

	                        }

	                	}

                        $trailer_video_details = Helper::video_upload($request->file('trailer_video'), $request->compress_video);

                        $video_model->trailer_video = $trailer_video_details['db_url'];  

                	}

                	/****** ORIGINAL VIDEO UPLOAD END *****/

                	/****** RESOLUTION CHECK START *****/

                	// If moderator or admin choosed any resolutions - check compression queue is applicable for video

                	if ($request->video_resolutions && $request->trailer_video_resolutions) {

                		Log::info('Both resolutions : ');

                		if ($request->hasFile('video') && $request->hasFile('trailer_video')) {

                    		$no_need_compression = DEFAULT_FALSE;

                    	} else {

                    		$no_need_compression = DEFAULT_TRUE;

                    	}

                	} else if(!empty($request->video_resolutions) && empty($request->trailer_video_resolutions)){

                		Log::info('Video resolutions : ');

                		$video_model->trailer_compress_status = COMPRESS_COMPLETED;

                		if ($request->hasFile('video')) {

                    		$no_need_compression = DEFAULT_FALSE;

                    	} else {

                    		$no_need_compression = DEFAULT_TRUE;
                    	}

                	} else if(empty($request->video_resolutions) && !empty($request->trailer_video_resolutions)){	
                		Log::info('Trailer resolutions : ');

                		$video_model->main_video_compress_status = COMPRESS_COMPLETED;

                		if ($request->hasFile('trailer_video')) {

                    		$no_need_compression = DEFAULT_FALSE;

                    	} else {

                    		$no_need_compression = DEFAULT_TRUE;
                    	}

                	} else {

                		Log::info('Empty Value');

                		$no_need_compression = DEFAULT_TRUE;
                			
                	}

                	/****** RESOLUTION CHECK END *****/

	            }

	        } else if($request->video_type == VIDEO_TYPE_YOUTUBE) {

                $video_model->video = get_youtube_embed_link($request->video);

                $video_model->trailer_video = get_youtube_embed_link($request->trailer_video);

            } else {
                
                $video_model->video = $request->video;

                $video_model->trailer_video = $request->trailer_video;
	           
	        }

	        if($request->hasFile('trailer_subtitle')) {

                if ($video_model->id) {

                    if ($video_model->trailer_subtitle) {

                        Helper::delete_picture($video_model->trailer_subtitle, SUBTITLE_PATH);  

                    }  
                }
		        
		        $vtt_filename = $video_model->id."-trailer.vtt";

                $video_model->trailer_subtitle =  Helper::subtitle_upload($request->file('trailer_subtitle'), $vtt_filename);


                $trailer_subtitle_vtt = Setting::get('ANGULAR_SITE_URL').'assets/subtitles/'.get_subtitle_vtt($video_model->video_subtitle);

                $video_model->trailer_subtitle_vtt = $trailer_subtitle_vtt;
            }

            if($request->hasFile('video_subtitle')) {

                if($video_model->id && $video_model->video_subtitle) {

                    Helper::delete_picture($video_model->video_subtitle, SUBTITLE_PATH);  

                }

                $video_model->video_subtitle =  Helper::subtitle_upload($request->file('video_subtitle'));

        		$video_subtitle_vtt = Setting::get('ANGULAR_SITE_URL').'assets/subtitles/'.get_subtitle_vtt($video_model->video_subtitle);

                $video_model->video_subtitle_vtt = $video_subtitle_vtt;

            }

            // Intialize the position is zero

            $position = 0;

            // Check the video has genre type or not

            if ($video_model->genre_id) {

                // If genre, in order to give the position of the admin videos

                $position = 1; // By default intialize 1

                /*
                 * Check is there any videos present in same genre, 
                 * if it is assign the position with increment of 1 otherwise intialize as zero
                 */

                if($check_position = AdminVideo::where('genre_id' , $video_model->genre_id)
                        ->orderBy('position' , 'desc')->first()) {

                	// check the edit or upload video 

                	if($request->admin_video_id) {

                		if($video_model->genre_id == $request->genre_id) {

                			// VIDHYA R - On edit no need to update the position of the video. if they wants to change the video position means USE CHANGE POSITION option in admin panel

                			$position = $video_model->position;

                		} else {

                			// When admin changing the genre - need to update the latest genre position for selected video 

                			$position = $check_position->position + 1;
                		}

                	} else {
                    	
                    	$position = $check_position->position + 1;

                	}
                } 

            }

            $video_model->position = $position;

            Log::info("no_need_compression ".$no_need_compression);

            // Incase of queue and ffmpeg not configured properly, compress will not work so by default we will approve the videos

            if (envfile('QUEUE_CONNECTION') != 'redis' || Setting::get('ffmpeg_installed') == FFMPEG_NOT_INSTALLED || $no_need_compression) {

                \Log::info("Queue Driver : ".envfile('QUEUE_CONNECTION'));

                // On update check the video & trailer video having resolutions

                if($request->admin_video_id && $no_need_compression) {

                	$video_model->video_resolutions = $video_model->video_resolutions ? $video_model->video_resolutions : "";

                	$video_model->video_resize_path = $video_model->video_resize_path ? $video_model->video_resize_path : "";

                } else {

	        		$video_model->video_resolutions = '';

	        		$video_model->video_resize_path = '';

                }

                if($request->admin_video_id && $no_need_compression) {

                	$video_model->trailer_video_resolutions = $video_model->trailer_video_resolutions ? $video_model->trailer_video_resolutions : "";

                	$video_model->trailer_resize_path = $video_model->trailer_resize_path ? $video_model->trailer_resize_path : "";

                } else {

	        		$video_model->video_resolutions = '';

	        		$video_model->trailer_resize_path = '';

                }

	        	// check the moderator uploaded video or admin uploaded video

	        	// if(is_numeric($video_model->uploaded_by) && $request->admin_video_id && $video_model->status ==) {

	        	// 	if ($request->admin_video_id) {

	        			// BY VIDHYA - NO NEED TO UPDATE THE STATUS OF THE VIDEO (FOR FOLLOWING ISSUE)

	        			// - Admin declined the video and moderator(or admin )edited the video. Automatically its getting approved

	        			// $video_model->is_approved = DEFAULT_TRUE;
	        			
	        		// } else {

						// $video_model->is_approved = DEFAULT_FALSE;

					// }

	        	// } else {

	        		// $video_model->is_approved = DEFAULT_TRUE;

	        	// }

	        	$video_model->main_video_compress_status = COMPRESSION_NOT_HAPPEN;

                $video_model->trailer_compress_status = COMPRESSION_NOT_HAPPEN;

                $video_model->compress_status = COMPRESSION_NOT_HAPPEN;
            }

            if ($video_model->save()) {
				
            	if($request->hasFile('default_image')) {

	 				if ($request->admin_video_id) {

	                	Helper::delete_picture($video_model->default_image, COMMON_IMAGE_PATH);

	                	Helper::delete_picture($video_model->default_image, "/uploads/images/1080x768/");

	                }
					
	                $video_model->default_image = Helper::normal_upload_picture($request->file('default_image'), '', "video_".$video_model->id."_001");
					
					// $video_model->mobile_image = $video_model->default_image;
					
	                
	                // If ffmpeg installed then resize the image

                	if (Setting::get('ffmpeg_installed') == FFMPEG_INSTALLED) {

                		$path = public_path().'/uploads/images/1080x768';

                		$default_image_input_path = public_path().'/uploads/images/'.get_video_end($video_model->default_image);

                		$default_image_output_path = public_path().'/uploads/images/1080x768/'.get_video_end($video_model->default_image);

                		if (!File::isDirectory($path)) {

							File::makeDirectory($path, $mode = 0777, true, true);

						}

		                $FFmpeg = new \FFmpeg;

			            $FFmpeg
			                ->input($default_image_input_path)
			                //->imageScale("1080:768")
			                ->output($default_image_output_path)
			                ->ready();

			            Log::info(print_r($FFmpeg->command,true));

		            }

	                $video_model->save();
	            
	            }

	            if($request->hasFile('mobile_image')) {

	                $request->admin_video_id ? Helper::delete_picture($video_model->mobile_image, COMMON_IMAGE_PATH) : "";

	                $mobile_image_filename = "video_mobile_".$video_model->id."_001";

	 				// To upload mobile image of the video

	                $video_model->mobile_image = Helper::normal_upload_picture($request->file('mobile_image'), '', $mobile_image_filename);
            
	            }
				
	            // Save cast & crews based on tagging into this video

            	$cast_crew_ids = $request->cast_crew_ids ?? [];

            	$removed_crews = $crews_id = [];

            	if ($request->admin_video_id) {

            		// Load Cast & crews which is tagged into this video

            		$load_cast_crews = VideoCastCrew::select('cast_crew_id')->where('admin_video_id', $request->admin_video_id)->get();

            		if(count($load_cast_crews) > 0 ) {

            			// Check if any removed index present or not, if removed from the list.delete the row from db

            			foreach ($load_cast_crews as $key => $value) {
            				
            				if(in_array($value->cast_crew_id, $cast_crew_ids)) {

            					$crews_id[] = $value->cast_crew_id;

            				} else {

            					$removed_crews[] = $value->cast_crew_id;

            				}

            			}

            			// If the admin removed any one of the crews, those cast will be deleting here
            			if(count($removed_crews) > 0) {

            				VideoCastCrew::whereIn('cast_crew_id', $removed_crews)->where('admin_video_id', $video_model->id)->delete();

            			}

            		}

            	} 

            	// Check is there any cast deleted by admin

            	// if (count($crews_id) > 0) {

            		// If the casts exists, check the cast existing or not. if not add the cast details.

            		foreach ($cast_crew_ids as $key => $value) {

            			if (!in_array($value, $crews_id)) {

		            		$video_cast_crew = new VideoCastCrew;

		            		$video_cast_crew->admin_video_id = $video_model->id;

		            		$video_cast_crew->cast_crew_id = $value;

		            		$video_cast_crew->save();

	            		}

	            	}

	            // }

	            // Queue Dispatch code

	            // Check whether the video resolutions present or not if is need to run queue

	            if ($video_model->trailer_video_resolutions && $request->hasFile('trailer_video')) {

                    if ($trailer_video_details) {

                        $inputFile = $trailer_video_details['baseUrl'];

                        $local_url = $trailer_video_details['local_url'];

                        $file_name = $trailer_video_details['file_name'];

                        if (file_exists($inputFile)) {

                        	$video_status = $video_model->status; // If any failure in compression, the status will revert back to old status ( edit video)

                        	$video_model->is_approved = DEFAULT_FALSE;

                    		$video_model->save();

                            dispatch(new StreamviewCompressVideo($inputFile, $local_url, TRAILER_VIDEO, $video_model->id,$file_name,$request->send_notification, $video_status , $request->admin_video_id));
                        }
                        
                    }
                    
                } else {

	                $video_model->trailer_compress_status = COMPRESSION_NOT_HAPPEN;

                }
                
	            if($video_model->video_resolutions && $request->hasFile('video')) {

                    if($main_video_details) {

                    	Log::info("Inside video resolutions main video");

                        $inputFile = $main_video_details['baseUrl'];

                        $local_url = $main_video_details['local_url'];

                        $file_name = $main_video_details['file_name'];

                        Log::info('Inside video File'.file_exists($inputFile));

                        if(file_exists($inputFile)) {

                        	$video_status = $video_model->status; // If any failure in compression, the status will revert back to old status ( edit video)

                        	$video_model->is_approved = DEFAULT_FALSE;

                    		$video_model->save();

                        	Log::info('Compress Inside'.$inputFile);

                            dispatch(new StreamviewCompressVideo($inputFile, $local_url, MAIN_VIDEO, $video_model->id, $file_name, $request->send_notification , $video_status , $request->admin_video_id));
                       
                        }

                    }

                } else {

                	if($request->hasFile('video') || $request->hasFile('trailer_video')) {

                    	dispatch(new \App\Jobs\StreamviewWaterMarkDrmVideo($video_model->id));
                   	}

                	$video_model->main_video_compress_status = COMPRESSION_NOT_HAPPEN;

                }

                if($video_model->trailer_compress_status == COMPRESSION_NOT_HAPPEN && $video_model->main_video_compress_status == COMPRESSION_NOT_HAPPEN) {
	                
	                $video_model->compress_status = COMPRESSION_NOT_HAPPEN;

                }

		        $video_model->video_gif_image = $video_model->default_image ?? "";

                $video_model->save();
               
		        // Send Email and push notification to users

		        if($video_model->is_approved && $video_model->status) {

            		Log::info("Send Notification ".$request->send_notification);

                    if ($request->send_notification) {

                        Log::info("Mail queue started : ".'Success');

                        dispatch(new SendVideoMail($video_model->id, $request->admin_video_id ? EDIT_VIDEO : NEW_VIDEO));

                        Log::info("Mail queue completed : ".'Success');

                        Notification::save_notification($video_model->id);

                        // Send Notifications to mobile push notification

				        $id = 'all';

				        // Load Template content of upload/edit video

				        $template = EmailTemplate::where('template_type', $request->admin_video_id ? EDIT_VIDEO : NEW_VIDEO)->first();

				        $subject = $content = "";

				        if ($template) {

				        	$category = Category::find($video_model->category_id);

				        	$content = str_replace('<%category_name%>', $category->name, $template->content);

	                        $content = str_replace('&lt;%category_name%&gt;', $category->name, $content);

	                        $content = str_replace('<%video_name%>', $video_model->title, $content);

	                        $content = str_replace('&lt;%video_name%&gt;', $video_model->title, $content);

	                        $content = strip_tags($content);

	                        $subject = $template->subject ?  str_replace('<%video_name%>', $video_model->title,$template->subject) : '';

	                        $subject = $subject ?  str_replace('&lt;%video_name%&gt;', $video_model->title, $subject) : '';

	                        $subject = strip_tags($subject);

				        }

				        // Sending Notifications to mobile

	            		$data = [];

		                $data['admin_video_id'] = $video_model->id;

		                $title = Setting::get('site_name');

		                $message = $video_model->title ? $video_model->title : "";

                        dispatch(new PushNotification(PUSH_TO_ALL , $title , $message, $data));

		                // PushRepo::send_push_notification(PUSH_TO_ALL , $title , $message, $data);

                    }

			    }

			    // Check the mobile_image is not empty

			    if(!$video_model->mobile_image) {

			    	$video_model->mobile_image = $video_model->default_image;

			    	$video_model->save();
			    }

	        } else {

	        	throw new Exception(Helper::get_error_message(167), 167);
	        }

 			DB::commit();

 			$response_array = ['success'=>true, 'message'=>tr('video_upload_success'),'data'=>$video_model];

 			return response()->json($response_array);

 		} catch(Exception $e) {

 			DB::rollback();

 			$response_array = ['success'=>false, 'error_messages'=>$e->getMessage(), 'error_code'=>$e->getCode()];

 			return response()->json($response_array);

 		}

 	}

 	/**
 	 * @method image_resolution_covertor
 	 *
 	 * @uses used to change the image resolutions
 	 *
 	 * @created: Vidhya R
 	 * 
 	 * @updated: Vidhya R
 	 *
 	 * @param object $request - Video related details
 	 *
 	 * @return response of success/failure response of datas
 	 */

 	public static function image_resolution_covertor($picture , $width = null, $height = null , $type = "fit") {

 	}

 	/**
	 *
	 * @method 
	 *
	 * @uses used to get the common list details for video
	 *
	 * @created Vidhya R
	 *
	 * @updated Vidhya R
	 *
	 * @param 
	 *
	 * @return
	 */

 	public static function video_list_response($admin_video_ids, $orderby = 'admin_videos.id', $other_select_columns = "", $orderby_type = 'desc') {

 		$base_query = AdminVideo::whereIn('admin_videos.id' , $admin_video_ids)
 							->orderBy($orderby , $orderby_type);

 		if($other_select_columns != "") {

 			$base_query = $base_query->BaseResponse($other_select_columns);

 		} else {

 			$base_query = $base_query->BaseResponse();
 		}
 		
 		$admin_videos = $base_query->get();

 		return $admin_videos;

 	}

 	public static function add_drm_to_video($admin_video_details) {

 		try {

			$config = [
			    'timeout'          => 0, // The timeout for the underlying process
			    'ffmpeg.threads'   => 12,   // The number of threads that FFmpeg should use
			];

			$log = new Logger('FFmpeg_Streaming');

			$log->pushHandler(new StreamHandler(base_path('storage/logs/ffmpeg-streaming.log'))); // path to log file
			    
			$ffmpeg = FFMpeg::create($config, $log);

 			$video_file = public_path(VIDEO_PATH.get_video_end($admin_video_details->video)); 

			$video = $ffmpeg->open($video_file);

			$encryption_key = $admin_video_details->id;

			// Add DRM for video

			//A path you want to save a random key to your local machine
			$save_to = public_path('abcd_keys/'.$encryption_key);

			//A URL (or a path) to access the key on your website

        	// $url = public_path('abcd_keys/'.$encryption_key);

        	$url = route('get_encrypt_key', ['key' => $encryption_key]);

        	Log::info("url".$url);

            $file_name = $admin_video_details->id.".m3u8";

 			$hls_video_path = public_path(HLS_VIDEO_PATH.'/'.$admin_video_details->id.'/'.$file_name);

			$video->hls()
			    ->encryption($save_to, $url)
			    // ->setSegDuration(15)
			    ->x264()
			    ->autoGenerateRepresentations()
			    ->save($hls_video_path);

			// $admin_video_details->hls_main_video = url('/'.HLS_VIDEO_PATH.$admin_video_details->id.'/'.$file_name);

			$admin_video_details->hls_main_video = Setting::get('ANGULAR_SITE_URL').'assets/hls/'.$admin_video_details->id.'/'.$file_name;

			$admin_video_details->save();
                
        } catch(Exception $e) {

        	Log::info("add_drm_to_video".print_r($e->getMessage(), true));

        }

 	}
 	
 	// public static function add_watermark_to_video($admin_video) {

 	// 	try {
 			
 	// 		if(Setting::get('is_watermark') == YES) {

	 // 			$ffmpeg = \FFMpeg\FFMpeg::create();

	 // 			$watermark_image =  public_path(SETTINGS_PATH.get_video_end(Setting::get('watermark_logo')));

	 // 			$video_file = public_path(VIDEO_PATH.get_video_end($admin_video)); 

	 // 			$new_video_path = public_path(VIDEO_PATH."water-".get_video_end($admin_video)); 

		// 		$video = $ffmpeg->open($video_file);

		// 		$video
		// 		    ->filters()
		// 		    ->watermark($watermark_image)->synchronize();

		// 		// $video->save(new \FFMpeg\Format\Video\X264('libmp3lame', 'libx264'), $new_video_path);
  //    		} else {
    			
  //   			$centre = "/usr/bin/ffmpeg -y -i ".$video." -i ".$watermark_path." -filter_complex ". '"[1][0]scale2ref=h=ow/mdar:w=iw/8[#A video][image];[#A video]format=argb,colorchannelmixer=aa=0.5[#B video transparent];[image][#B video transparent]overlay=(main_w-w)/2:(main_h-h)/2"'." ".$new_video_path;
  //     			shell_exec($centre);

		// 		rename($new_video_path , $video_file);
		// 	}

		// 	// Water mark added 
			
  //       } catch(Exception $e) {

  //       	Log::info("add_watermark_to_video errors".$e->getMessage());

  //       }


 	// }

 	public static function add_watermark_to_video($admin_video) {

 		try {
 			if(Setting::get('is_watermark_logo_enabled') == YES) {

	 			$watermark_image =  public_path(SETTINGS_PATH.get_video_end(Setting::get('watermark_logo')));

	 			$video = public_path(VIDEO_PATH.get_video_end($admin_video)); 
	 			$new_video_path = public_path(VIDEO_PATH."water-".get_video_end($admin_video)); 

				$watermark_path =  public_path("storage/".SETTINGS_PATH.get_video_end(Setting::get('watermark_logo')));


        		if(Setting::get('watermark_position') == WATERMARK_TOP_LEFT){
        			
        			$top_left = "/usr/bin/ffmpeg -y -i ".$video." -i ".$watermark_path." -filter_complex ". '"[1][0]scale2ref=h=ow/mdar:w=iw/8[#A video][image];[#A video]format=argb,colorchannelmixer=aa=0.5[#B video transparent];[image][#B video transparent]overlay=(main_w-overlay_w)/(main_w-overlay_w):y=(main_h-overlay_h)/(main_h-overlay_h)"'." ".$new_video_path;

		            shell_exec($top_left);

        		} else if(Setting::get('watermark_position') == WATERMARK_TOP_RIGHT){

          			$top_right = "/usr/bin/ffmpeg -y -i ".$video." -i ".$watermark_path." -filter_complex ". '"[1][0]scale2ref=h=ow/mdar:w=iw/8[#A video][image];[#A video]format=argb,colorchannelmixer=aa=0.5[#B video transparent];[image][#B video transparent]overlay=(main_w-overlay_w):y=(main_h-overlay_h)/(main_h-overlay_h)"'." ".$new_video_path;
         			shell_exec($top_right);

	         	}else if(Setting::get('watermark_position') == WATERMARK_BOTTOM_RIGHT){
         				
         			$bottom_right = "/usr/bin/ffmpeg -y -i ".$video." -i ".$watermark_path." -filter_complex ". '"[1][0]scale2ref=h=ow/mdar:w=iw/8[#A video][image];[#A video]format=argb,colorchannelmixer=aa=0.5[#B video transparent];[image][#B video transparent]overlay=(main_w-w)-(main_w*0.1):(main_h-h)-(main_h*0.1)"'." ".$new_video_path;
         			shell_exec($bottom_right);

        		} else if(Setting::get('watermark_position') == WATERMARK_BOTTOM_LEFT){
        			
        			$bottom_left = "/usr/bin/ffmpeg -y -i ".$video." -i ".$watermark_path." -filter_complex ". '"[1][0]scale2ref=h=ow/mdar:w=iw/8[#A video][image];[#A video]format=argb,colorchannelmixer=aa=0.5[#B video transparent];[image][#B video transparent]overlay=(main_w-w)-(main_w*0.9):(main_h-h)-(main_h*0.1)"'." ".$new_video_path;
          			shell_exec($bottom_left);

         		} else {
        			
        			$centre = "/usr/bin/ffmpeg -y -i ".$video." -i ".$watermark_path." -filter_complex ". '"[1][0]scale2ref=h=ow/mdar:w=iw/8[#A video][image];[#A video]format=argb,colorchannelmixer=aa=0.5[#B video transparent];[image][#B video transparent]overlay=(main_w-w)/2:(main_h-h)/2"'." ".$new_video_path;
          			shell_exec($centre);

         		}
 
				rename($new_video_path , $video);
			}

			// Water mark added 
			
        } catch(Exception $e) {

        	Log::info("add_watermark_to_video errors".$e->getMessage());

        }


 	}

 	public static function promo_video($video) {

 		try {	

 			if(Setting::get('is_promo_video_enabled') == YES) {


	 			$video_file_name = get_video_end($video);

	 			$video_path = public_path(VIDEO_PATH.$video_file_name);
	 			
	 			$trailer_file_name = get_video_end(Setting::get('promo_video'));

	 			$trailer_path = public_path(SETTINGS_PATH.$trailer_file_name);
	 			
	 			$video_file_name_new = 'video-'.get_video_end($video);

	 			$video_path_new = public_path(VIDEO_PATH.$video_file_name_new);

	            Log::info("video_path_new".$video_path_new);

	            Log::info("trailer_path".$trailer_path);

	 			$command = "/usr/bin/ffmpeg -y -i ".$trailer_path." -i ".$video_path."  -filter_complex '[0:v]scale=1024:576:force_original_aspect_ratio=1[v0]; [1:v]scale=1024:576:force_original_aspect_ratio=1[v1]; [v0][0:a][v1][1:a]concat=n=2:v=1:a=1[v][a]' -map '[v]' -map '[a]' ".$video_path_new;

	            Log::info("command ".$command);
	            
	            shell_exec($command);

	            rename($video_path_new , $video_path);
	        }
            
        } catch(Exception $e) {

        	Log::info("promo_video".print_r($e->getMessage(), true));

        }

 	}
}
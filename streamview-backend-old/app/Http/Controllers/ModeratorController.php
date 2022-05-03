<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Jobs\StreamviewCompressVideo;

use App\Repositories\VideoRepository as VideoRepo;

use App\Helpers\Helper,App\Helpers\VideoHelper;

use Log, Auth, Validator, Hash, Mail, DB, Exception, Redirect, Setting;

use App\Moderator;

use App\AdminVideo, App\AdminVideoImage;

use App\CastCrew, App\Category, App\SubCategory, App\SubCategoryImage, App\Genre, App\VideoCastCrew;

use App\PayPerView;

use App\Settings;

use App\Redeem, App\RedeemRequest;

class ModeratorController extends Controller
{
    protected $ModeratorAPI;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ModeratorApiController $api) {

        $this->ModeratorAPI = $api;

        $this->middleware('moderator');
    }

	/**
	 *
	 * @method dahsboard()
	 *
	 * @uses show analytics for moderator
	 *
	 * @created vidhya R
	 *
	 * @updated vidhya R
	 *
	 * @param
	 *
	 * @return view page
	 */

    public function dashboard(Request $request) {

        $moderator_details = Moderator::find(\Auth::guard('moderator')->user()->id);

        $moderator_details->token = Helper::generate_token();

        $moderator_details->token_expiry = Helper::generate_token_expiry();

        $moderator_details->save();
        
        $today_videos = AdminVideo::where('uploaded_by', $moderator_details->id)->count();

        $total_revenue = $moderator_details->moderatorRedeem ? $moderator_details->moderatorRedeem->total_moderator_amount : "0.00";

        $watch_count_revenue = redeem_amount($moderator_details->id);

        $ppv_revenue = total_moderator_video_revenue($moderator_details->id);

        return view('moderator.dashboard.dashboard')
                    ->with('page', 'dashboard')
                    ->with('sub_page','')
                    ->with('today_videos' , $today_videos)
                    ->with('total_revenue', $total_revenue)
                    ->with('watch_count_revenue', $watch_count_revenue)
                    ->with('ppv_revenue', $ppv_revenue);

    }

    /**
	 *
	 * @method profile()
	 *
	 * @uses moderator profile page
	 *
	 * @created vidhya R
	 *
	 * @updated vidhya R
	 *
	 * @param
	 *
	 * @return view page
	 */

    public function profile() {

        $moderator_details = Auth::guard('moderator')->user();
       

        return view('moderator.account.profile')
                    ->with('page', 'profile')
                    ->with('sub_page','')
                    ->with('moderator_details', $moderator_details);

    }

    /**
     *
     * @method profile()
     *
     * @uses Save any changes to the provider profile
     *
     * @created vidhya R
     *
     * @updated vidhya R
     *
     * @param
     *
     * @return view page
     */

    public function profile_save(Request $request) {

        try {
            
            DB::beginTransaction();

            $validator = Validator::make( $request->all(),
                [
                    'name' => 'required|min:2|max:100',
                    'email' => $request->id ? 'email|max:255|unique:moderators,email,'.$request->id : 'required|email|max:255|unique:moderators,email,NULL',
                    'mobile' => 'digits_between:4,16',
                    'address' => 'max:300',
                    'id' => 'required|exists:moderators,id',
                    'picture' => 'mimes:jpeg,jpg,png'
                ]);

            if($validator->fails()) {

                $error = implode(',', $validator->messages()->all());

                throw new Exception($error, 101);
    
            }

            $moderator_details = Moderator::find($request->id);
            
            $moderator_details->name = $request->name ?: $moderator_details->name;

            $moderator_details->email = $request->email ?: $moderator_details->email;

            $moderator_details->mobile = $request->mobile ?: $moderator_details->mobile;

            $moderator_details->gender = $request->gender ?: $moderator_details->gender;

            $moderator_details->address = $request->address ?: $moderator_details->address;

            $moderator_details->paypal_email = $request->paypal_email ?: $moderator_details->paypal_email;
            
            if($request->hasFile('picture')) {

                Helper::delete_picture($moderator_details->picture , MODERATOR_FILE_PATH);
                
                $moderator_details->picture = Helper::normal_upload_picture($request->file('picture'),MODERATOR_FILE_PATH);
            }
                
            $moderator_details->remember_token = Helper::generate_token();

            $moderator_details->is_activated = 1;

            if($moderator_details->save()) {

                DB::commit();

                return back()->with('flash_success', tr('moderator_not_profile'));

            } else {

                return back()->with('flash_error', tr('moderator_profile_save_error'));
            }

        } catch(Exception $e) {

            DB::rollback();

            return back()->withInput()->with('flash_error', $e->getMessage());

        }
    
    }

    /**
     *
     * @method change_password()
     *
     * @uses moderator update the password
     *
     * @created vidhya R
     *
     * @updated vidhya R
     *
     * @param
     *
     * @return view page
     */

    public function change_password(Request $request) {

        try {

            DB::beginTransaction();
        
            $validator = Validator::make($request->all(), [              
                'password' => 'required|min:6|confirmed',
                'old_password' => 'required',
                'id' => 'required|exists:moderators,id'
            ]);

            if($validator->fails()) {

                $error = implode(',', $validator->messages()->all());

                throw new Exception($error, 101);
    
            }

            $moderator_details = Moderator::find(Auth::guard('moderator')->user()->id);

            if(Hash::check($request->old_password,$moderator_details->password)) {

                $moderator_details->password = Hash::make($request->password);

                $moderator_details->save();

                DB::commit();

                \Auth::guard('moderator')->logout();


                return redirect()->route('moderator.login')->with('flash_success', tr('moderator_password_change_success'));
                
            } else {

                throw new Exception(tr('moderator_password_mismatch'), 101);
                

            }
  
        } catch(Exception $e) {

            DB::rollback();

            return back()->withInput()->with('flash_error', $e->getMessage());

        }
       
    }

    /**
     * @method admin_videos_index()
     *
     * @uses list of videos by loggedin moderator
     *
     * @created Vithya R
     *
     * @updated Vithya R
     *
     * @param
     *
     * @return view page
     */

    public function admin_videos_index(Request $request) {
       
        $base_query = AdminVideo::leftJoin('categories' , 'admin_videos.category_id' , '=' , 'categories.id')
                    ->leftJoin('sub_categories' , 'admin_videos.sub_category_id' , '=' , 'sub_categories.id')
                    ->leftJoin('genres' , 'admin_videos.genre_id' , '=' , 'genres.id')
                   ->select('admin_videos.id as video_id' ,'admin_videos.title' , 
                             'admin_videos.description' , 'admin_videos.ratings' , 
                             'admin_videos.reviews' , 'admin_videos.created_at as video_date' ,
                             'admin_videos.default_image',
                             'admin_videos.amount',
                             'admin_videos.user_amount',
                             'admin_videos.type_of_user',
                             'admin_videos.type_of_subscription',
                             'admin_videos.category_id as category_id',
                             'admin_videos.sub_category_id',
                             'admin_videos.genre_id',
                             'admin_videos.compress_status',
                             'admin_videos.trailer_compress_status',
                             'admin_videos.redeem_amount',
                             'admin_videos.watch_count',
                             'admin_videos.unique_id',
                             'admin_videos.status','admin_videos.uploaded_by',
                             'admin_videos.edited_by','admin_videos.is_approved',
                             'admin_videos.video_subtitle',
                             'admin_videos.trailer_subtitle',
                             'categories.name as category_name' , 'sub_categories.name as sub_category_name' ,
                             'genres.name as genre_name')
                    ->orderBy('admin_videos.created_at' , 'desc')
                    ->where('uploaded_by', Auth::guard('moderator')->user()->id);
        
        if($request->search_key) {
            
            $base_query->where(function ($query) use ($request) {
                $query->where('admin_videos.title','LIKE','%'.$request->search_key);
                $query->orWhere('categories.name','LIKE','%'.$request->search_key);
                $query->orWhere('sub_categories.name','LIKE','%'.$request->search_key);
            });
        }

        if($request->status!=''){

            $base_query->where('admin_videos.is_approved',$request->status);

        }


        $admin_videos = $base_query->get();

        return view('moderator.videos.index')
                    ->with('page', 'videos')
                    ->with('sub_page','videos-view')
                    ->with('admin_videos' , $admin_videos);
   
    }

    /**
     * @method admin_videos_create()
     *
     * @uses video upload view page
     *
     * @created Vithya R
     *
     * @updated Vithya R
     *
     * @param
     *
     * @return view page
     */
    public function admin_videos_create(Request $request) {

        $categories = Category::where('categories.is_approved' , APPROVED)
                    ->leftJoin('sub_categories' , 'categories.id' , '=' , 'sub_categories.category_id')
                    ->select('categories.id as id' , 'categories.name' , 'categories.picture' ,
                        'categories.is_series' ,'categories.status' , 'categories.is_approved','sub_categories.id as sub_category_id')
                    ->groupBy('sub_categories.category_id')
                    ->where("sub_categories.is_approved", SUB_CATEGORY_APPROVED)
                    // ->havingRaw("COUNT(sub_categories.id) > 0")
                    ->orderBy('categories.name' , 'asc')
                    ->get();

        $categories_data = [];

        foreach ($categories as $key => $categorie_details) {

            if($categorie_details->is_series) {

                $sub_category = SubCategory::where('category_id',$categorie_details->id)->whereHas('genres')->first();
                   
                $sub_category_id = $sub_category->id ?? $categorie_details->sub_category_id;

                if($gener = Genre::where('category_id',$categorie_details->id)
                    ->where('sub_category_id',$sub_category_id)->first()) {
                    $categories_data[] = $categorie_details;
                }

            } else {

                $categories_data[] = $categorie_details;
            }
        }

        $model = new AdminVideo;

        $model->trailer_video_resolutions = [];

        $model->video_resolutions = [];

        $video_cast_crews = [];

        $videoimages = [];

        $cast_crews = CastCrew::select('id', 'name')->get();

        return view('moderator.videos.upload')->with('page', 'videos')
            ->with('categories', $categories_data)
            ->with('sub_page', 'videos-create')
            ->with('model', $model)
            ->with('videoimages', $videoimages)
            ->with('cast_crews', $cast_crews)
            ->with('video_cast_crews',$video_cast_crews);
    }

    /**
     * Function Name : admin_videos_edit()
     *
     * To display a upload video form
     *
     * @created_by - Shobana Chandrasekar
     *
     * @updated_by - - 
     *
     * @param object $request - - 
     *
     * @return response of html page with details
     */

    /**
     * @method admin_videos_edit()
     *
     * @uses video edit view page
     *
     * @created Vithya R
     *
     * @updated Vithya R
     *
     * @param
     *
     * @return view page
     */
    public function admin_videos_edit(Request $request) {

        try {

            $admin_video_details = AdminVideo::where('admin_videos.id' , $request->id)->first();

            if (!$admin_video_details) {

                throw new Exception(tr('moderator_video_found'), 101);

            }

            $categories = Category::where('categories.is_approved' , DEFAULT_TRUE)
                                ->select('categories.id as id' , 'categories.name' , 'categories.picture' ,
                                    'categories.is_series' ,'categories.status' , 'categories.is_approved')
                                ->leftJoin('sub_categories' , 'categories.id' , '=' , 'sub_categories.category_id')
                                ->groupBy('sub_categories.category_id')
                                ->havingRaw("COUNT(sub_categories.id) > 0")
                                ->orderBy('categories.name' , 'asc')
                                ->get();

            $sub_categories = get_sub_categories($admin_video_details->category_id);

            $admin_video_details->publish_time = $admin_video_details->publish_time ? date('d-m-Y H:i:s', strtotime($admin_video_details->publish_time)) : $admin_video_details->publish_time;

            $videoimages = get_video_image($admin_video_details->id);

            $admin_video_details->video_resolutions = $admin_video_details->video_resolutions ? explode(',', $admin_video_details->video_resolutions) : [];

            $admin_video_details->trailer_video_resolutions = $admin_video_details->trailer_video_resolutions ? explode(',', $admin_video_details->trailer_video_resolutions) : [];



            $video_cast_crews = VideoCastCrew::select('cast_crew_id')
                    ->where('admin_video_id', $request->id)
                    ->get()->pluck('cast_crew_id')->toArray();
         
            $cast_crews = CastCrew::select('id', 'name')->get();

            return view('moderator.videos.upload')
                        ->with('page', 'videos')
                        ->with('sub_page', 'videos-create')
                        ->with('cast_crews',$cast_crews)
                        ->with('video_cast_crews', $video_cast_crews)
                        ->with('categories', $categories)
                        ->with('sub_categories', $sub_categories)
                        ->with('model', $admin_video_details)
                        ->with('videoimages', $videoimages);

        } catch(Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            return back()->with('flash_error', $error_messages);
        
        }
    
    }

    /**
     * @method admin_videos_save()
     *
     * @uses save/update the video details
     *
     * @created Vithya R
     *
     * @updated Vithya R
     *
     * @param
     *
     * @return view page
     */
    public function admin_videos_save(Request $request) {

        try {
            // Call video save method of common function video repo

            $response = VideoRepo::admin_videos_save($request)->getData();

            return ['response' => $response ];

        } catch(Exception $e) {

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            $response_array = ['success' => false, 'error_messages' => $error_messages, 'error_code' => $error_code];

            return ['response' => $response_array ];
        }
    
    }

    /**
     * @method admin_videos_view()
     *
     * @uses save/update the video PPV details
     *
     * @created Vithya R
     *
     * @updated Vithya R
     *
     * @param
     *
     * @return view page
     */

    public function admin_videos_view(Request $request) {

        $validator = Validator::make($request->all() , [
                'id' => 'required|exists:admin_videos,id'
            ]);

        if($validator->fails()) {
            $error_messages = implode(',', $validator->messages()->all());
            return back()->with('flash_error', $error_messages);
        }

        $videos = AdminVideo::CommonVideoResponse()
                ->orderBy('admin_videos.created_at' , 'desc')
                ->first();

        $video_pixels = $trailer_pixels = $trailerstreamUrl = $videoStreamUrl = '';

        $request->request->add(['video_type' => $videos->video_type, 'video_upload_type' => $videos->video_upload_type,'device_type' => DEVICE_WEB]);
        

        if ($videos->video_type == VIDEO_TYPE_UPLOAD && $videos->video_upload_type == VIDEO_UPLOAD_TYPE_DIRECT) {

            $video_pixels = $videos->video_resolutions ? 'original,'.$videos->video_resolutions : 'original';
            $trailer_pixels = $videos->trailer_video_resolutions ? 'original,'.$videos->trailer_video_resolutions : 'original';

        }
       
        $videoStreamUrl = VideoHelper::get_streaming_link_video($videos->video, $request, $is_single_video = YES);
            
        $trailerstreamUrl = VideoHelper::get_streaming_link_video($videos->trailer_video, $request, $is_single_video = YES);

        $admin_video_images = AdminVideoImage::where('admin_video_id' , $request->id)
                                ->orderBy('is_default' , 'desc')
                                ->get();

        // Load Video Cast & crews

        $video_cast_crews = VideoCastCrew::select('cast_crew_id', 'name')
                    ->where('admin_video_id', $request->id)
                    ->leftjoin('cast_crews', 'cast_crews.id', '=', 'video_cast_crews.cast_crew_id')
                    ->get()->pluck('name')->toArray();



        return view('moderator.videos.view')->with('video' , $videos)
                    ->with('video_images' , $admin_video_images)
                    ->withPage('videos')
                    ->with('sub_page','videos-view')
                    ->with('video_pixels', $video_pixels)
                    ->with('trailer_pixels', $trailer_pixels)
                    ->with('videoStreamUrl', $videoStreamUrl)
                    ->with('trailerstreamUrl', $trailerstreamUrl)
                    ->with('video_cast_crews',$video_cast_crews);
    
    }  

     /**
     * @method admin_videos_ppv_add()
     *
     * @uses save/update the video PPV details
     *
     * @created Vithya R
     *
     * @updated Vithya R
     *
     * @param
     *
     * @return view page
     */  
    public function admin_videos_ppv_add(Request $request) {

        try {

            DB::beginTransaction();

            $admin_video_details = AdminVideo::find($request->admin_video_id);

            if(!$admin_video_details) {

                throw new Exception(tr('moderator_video_found'), 101);
                
            }

            if($request->amount <= 0) {

                throw new Exception(tr('add_ppv_amount'), 101);
                
            }

            $admin_video_details->type_of_subscription = $request->type_of_subscription ?: $admin_video_details->type_of_subscription;
            $admin_video_details->type_of_user = $request->type_of_user ?: $admin_video_details->type_of_user;

            $admin_video_details->amount = $request->amount ?: $admin_video_details->amount;

            $admin_video_details->is_pay_per_view = PPV_ENABLED;

            if($admin_video_details->save()) {

                DB::commit();

                return back()->with('flash_success', tr('payment_added'));

            } else {

                throw new Exception(tr('moderator_video_ppv_add_failed'), 101);
                
            }                

        } catch(Exception $e) {

            DB::rollback();

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            return back()->with('flash_error', $error_messages);
        }
    
    }
  
    /**
     * @method admin_videos_ppv_remove()
     *
     * @uses remove the video PPV option
     *
     * @created Vithya R
     *
     * @updated Vithya R
     *
     * @param
     *
     * @return view page
     */
    public function admin_videos_ppv_remove(Request $request) {

        try {

            DB::beginTransaction();

            $admin_video_details = AdminVideo::find($request->admin_video_id);

            if(!$admin_video_details) {

                throw new Exception(tr('moderator_video_found'), 101);
                
            }

            $admin_video_details->type_of_subscription = $admin_video_details->type_of_user = $admin_video_details->amount = 0;

            $admin_video_details->is_pay_per_view = PPV_DISABLED;

            if($admin_video_details->save()) {

                DB::commit();

                return back()->with('flash_success', tr('removed_pay_per_view'));

            } else {

                throw new Exception(tr('moderator_video_ppv_add_failed'), 101);
                
            }

        } catch(Exception $e) {

            DB::rollback();

            $error_messages = $e->getMessage();

            $error_code = $e->getCode();

            return back()->with('flash_error', $error_messages);
        }
    
    }

    /**
     * @method revenues()
     *
     * @uses list the redeem details
     *
     * @created Vithya R
     *
     * @updated Vithya R
     *
     * @param
     *
     * @return view page
     */
    public function revenues(Request $request) {

        try {

            $moderator_details = Auth::guard('moderator')->user();

            if(!$moderator_details) {

                throw new Exception(tr('moderator_video_found'));

            }

            $redeem_details = Redeem::where('moderator_id', $moderator_details->id)->first();

            if(!$redeem_details) {

                $redeem_details = New Redeem;

                $redeem_details->moderator_id = $moderator_details->id;

                $redeem_details->total = 0;

                $redeem_details->save();
            }
                
            $payments = AdminVideo::where('admin_videos.uploaded_by', $moderator_details->id)->get();


            $total_revenue = $moderator_details->moderatorRedeem ? $moderator_details->moderatorRedeem->total_moderator_amount : "0.00";

            $watch_count_revenue = redeem_amount($moderator_details->id);

            $ppv_revenue = total_moderator_video_revenue($moderator_details->id);
           
            return view('moderator.payments.revenues')
                        ->with('page', 'revenues')
                        ->with('sub_page','revenues-dashboard')
                        ->with('redeem_details' , $redeem_details)
                        ->with('payments' , $payments)
                        ->with('total_revenue' , $total_revenue)
                        ->with('watch_count_revenue' , $watch_count_revenue)
                        ->with('ppv_revenue' , $ppv_revenue);

        } catch(Exception $e) {

            $error_messages = $e->getMessage();

            return back()->with('flash_error', $error_messages);
        }
    }

    /**
     * @method redeems()
     *
     * @uses list the redeem details
     *
     * @created Vithya R
     *
     * @updated Vithya R
     *
     * @param
     *
     * @return view page
     */

    public function redeems(Request $request) {

        try {

            $moderator_details = Auth::guard('moderator')->user();

            if(!$moderator_details) {

                throw new Exception(tr('moderator_video_found'));

            }

            $redeem_details = Redeem::where('moderator_id', $moderator_details->id)->first();

            if(!$redeem_details) {

                $redeem_details = New Redeem;

                $redeem_details->moderator_id = $moderator_details->id;

                $redeem_details->total = 0;

                $redeem_details->save();
            }

            $redeem_requests = RedeemRequest::where('moderator_id', $moderator_details->id)->paginate(10);

            return view('moderator.payments.redeems')
                        ->with('page', 'revenues')
                        ->with('sub_page', 'revenues-redeems')
                        ->with('redeem_details', $redeem_details)
                        ->with('redeem_requests', $redeem_requests);

        } catch(Exception $e) {

            $error_messages = $e->getMessage();

            return back()->with('flash_error', $error_messages);
        }

    }

    /**
     * @method revenues_ppv_payments()
     *
     * @uses list the redeem details
     *
     * @created Vithya R
     *
     * @updated Vithya R
     *
     * @param
     *
     * @return view page
     */

    public function revenues_ppv_payments(Request $request) {

        $moderator_id = Auth::guard('moderator')->user()->id;

        $base_query = PayPerView::orderBy('created_at' , 'desc')
                        ->select('pay_per_views.*')
                        ->leftJoin('users' , 'users.id' , '=' , 'pay_per_views.user_id')
                        ->leftJoin('admin_videos', 'admin_videos.id', '=', 'video_id')
                        ->where('admin_videos.uploaded_by', $moderator_id);

        if($request->search_key) {
            
            $base_query->where(function ($query) use ($request) {
                $query->where('users.name','LIKE','%'.$request->search_key.'%');
                $query->orWhere('admin_videos.title','LIKE','%'.$request->search_key.'%');
                $query->orWhere('pay_per_views.payment_mode','LIKE','%'.$request->search_key.'%');
            });
        }


        if($request->status!=''){

            $base_query->where('pay_per_views.status',$request->status);
        }
                  
        
        $ppv_payments = $base_query->paginate(10);

        $total_moderator_video_revenue = total_moderator_video_revenue($moderator_id);
        
        return view('moderator.payments.ppv_payments')
                        ->with('page','revenues')
                        ->with('sub_page','revenues-ppv_payments')
                        ->with('ppv_payments' , $ppv_payments)
                        ->with('total_moderator_video_revenue' , $total_moderator_video_revenue); 
    }

     /**
     * @method redeems_request_send()
     *
     * @uses list the redeem details
     *
     * @created Vithya R
     *
     * @updated Vithya R
     *
     * @param
     *
     * @return view page
     */

    public function redeems_request_send(Request $request) {

        try {

            $request->request->add([ 
                'id' => \Auth::guard('moderator')->user()->id,
                'token' => \Auth::guard('moderator')->user()->token,
                'device_token' => \Auth::guard('moderator')->user()->device_token
            ]);

            DB::beginTransaction();

            $response = $this->ModeratorAPI->send_redeem_request($request)->getData();

            if($response->success) {

                DB::commit();

                return back()->with('flash_success', tr('send_redeem_request_success'));

            } else {

                throw new Exception($response->error_messages);
                
            }

            throw new Exception(Helper::get_error_message(146));

        } catch(Exception $e) {

            DB::rollback();

            $error_messages = $e->getMessage();

            return back()->with('flash_error', $error_messages);
        }

    }

    /**
     * @method redeem_request_cancel()
     *
     * @uses list the redeem details
     *
     * @created Vithya R
     *
     * @updated Vithya R
     *
     * @param
     *
     * @return view page
     */
    public function redeems_request_cancel(Request $request) {

        try {

            $request->request->add([ 
                'id' => \Auth::guard('moderator')->user()->id,
                'token' => \Auth::guard('moderator')->user()->token,
                'device_token' => \Auth::guard('moderator')->user()->device_token,
                'redeem_request_id' => $request->redeem_request_id,
            ]);

            DB::beginTransaction();

            $response = $this->ModeratorAPI->redeem_request_cancel($request)->getData();

            if($response->success) {

                DB::commit();

                return back()->with('flash_success', tr('send_redeem_request_success'));

            } else {

                throw new Exception($response->error_messages);
            }

            throw new Exception(Helper::get_error_message(146));

        } catch(Exception $e) {

            DB::rollback();

            $error_messages = $e->getMessage();

            return back()->with('flash_error', $error_messages);
        }

    }
}

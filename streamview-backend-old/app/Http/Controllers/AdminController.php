<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Repositories\AdminRepository as AdminRepo;

use App\Repositories\VideoRepository as VideoRepo;

use App\Repositories\PushNotificationRepository as PushRepo;

use App\Helpers\Helper, App\Helpers\VideoHelper, App\Helpers\EnvEditorHelper, App\Jobs\StreamviewCompressVideo;

// use App\Jobs\NormalPushNotification;

use App\Jobs\SendVideoMail, App\Jobs\SendMailCamp;

use Validator, Hash, Mail, DB, DateTime;

use Auth, Exception, Redirect, Setting, Log;

use App\Admin, App\SubAdmin, App\Store, App\AdminVideo, App\AdminVideoImage;

use App\User, App\UserPayment, App\UserHistory, App\UserRating, App\UserCoupon, App\UserLoggedDevice, App\ReferralCode;

use App\Wishlist, App\SubProfile, App\Moderator;

use App\Redeem, App\RedeemRequest;

use App\Category, App\SubCategory, App\SubCategoryImage;

use App\CastCrew, App\Subscription, App\Coupon, App\Genre;

use App\VideoCastCrew, App\OfflineAdminVideo, App\PayPerView;

use App\Language, App\Notification, App\EmailTemplate, App\Settings, App\Page, App\Flag , App\Currency;

use App\CustomWallet, App\CustomWalletHistory, App\CustomWalletPayment;

use App\UserReferral, App\Referral, App\AdminVideoAudio;

use App\Notifications\PushNotification as PushNotify;

use App\Jobs\SendEmailJob;

DB::enableQueryLog();

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ModeratorApiController $api)
    {
        $this->ModeratorAPI = $api;

        $this->middleware('auth:admin');
    }

    public function check_role(Request $request) {
        
        if(Auth::guard('admin')->check()) {
            
            $admin_details = Auth::guard('admin')->user();

            if($admin_details->role == ADMIN) {

                return redirect()->route('admin.dashboard');
            }

            if($admin_details->role == SUBADMIN) {

                return redirect()->route('subadmin.dashboard');
            }

            if($admin_details->role == STORE) {

                return redirect()->route('store.dashboard');
            }

        } else {

            return redirect()->route('admin.login');
        }

    }

    /**
     * @method dashboard()
     * 
     * @uses used to display analytics of the website
     *
     * @created Anjana H
     *
     * @updated vithya R
     *
     * @param - 
     *
     * @return view page
     */

    public function dashboard() {

        $admin = Admin::find(Auth::guard('admin')->user()->id);

        $admin->token = Helper::generate_token();

        $admin->token_expiry = Helper::generate_token_expiry();

        $admin->save();
        
        $user_count = User::count();

        $provider_count = Moderator::count();

        $video_count = AdminVideo::count();
        
        $recent_videos = Helper::recently_added();

        $get_registers = get_register_count();

        $recent_users = get_recent_users();

        $total_revenue = total_revenue();

        $view = last_days(10);

        return view('admin.dashboard.dashboard')
                    ->withPage('dashboard')
                    ->with('sub_page','')
                    ->with('user_count' , $user_count)
                    ->with('video_count' , $video_count)
                    ->with('provider_count' , $provider_count)
                    ->with('get_registers' , $get_registers)
                    ->with('view' , $view)
                    ->with('total_revenue' , $total_revenue)
                    ->with('recent_users' , $recent_users)
                    ->with('recent_videos' , $recent_videos);
                
    }


    /**
     * @method users_index()
     *
     * @uses To list out users object details
     *
     * @created Anjana H 
     *
     * @updated Anjana H
     *
     * @param
     *
     * @return View page
     */
    public function users_index(Request $request) {
       
        $total_users = User::orderBy('id','desc')->count();

        $total_approved = User::orderBy('id','desc')->where('is_activated', USER_APPROVED)->count();

        $total_declined = User::orderBy('id','desc')->where('is_activated', USER_DECLINED)->count();        
                
        $base_query = User::orderBy('id','desc');

        $sub_page = 'users-view';
       
        $title = tr('view_users');

        if($request->search_key) {

            $base_query->where(function ($query) use ($request) {
                $query->where('name', "like", "%" . $request->search_key . "%");
                $query->orWhere('email', "like", "%" . $request->search_key . "%");
                $query->orWhere('mobile', "like", "%" . $request->search_key . "%");
            });
        }


        if($request->status!=''){

           $base_query->where('is_activated',$request->status);

        }


        if($request->sort == 'declined') {

            $base_query = $base_query->where('is_activated', USER_DECLINED);

            $sub_page = 'users-view-declined';

            $title = tr('declined_users');
        }

        $users = $base_query->paginate(10);

        $users->total_approved = $total_approved;
        
        $users->total_declined = $total_declined;

        $users->total_users = $total_users;

        return view('admin.users.index')
        		->withPage('users')
                ->with('users' , $users)
                ->with('sub_page', $sub_page)
                ->with('search_key', $request->search_key)
                ->with('sort', $request->sort)
                ->with('title', $title)
                ->with('subscription_details' , []);
    }

    /**
     * @method users_create()
     *
     * @uses To create a user object details
     *
     * @created Anjana H 
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return View page
     */
    public function users_create() {

        $user_details = new User;

        return view('admin.users.create')
                    ->with('page' , 'users')
                    ->with('sub_page','users-create')
                    ->with('user_details',$user_details);
    }

    /**
     * @method users_edit()
     *
     * @uses To display and update user object details based on user id
     *
     * @created  Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $user_id
     *
     * @return View page
     */
    public function users_edit(Request $request) {

        try {
          
            $user_details = User::find($request->user_id);

            if(!$user_details) {

                throw new Exception( tr('admin_user_not_found'), 101);
            } 

            return view('admin.users.edit')
                    ->with('page' , 'users')
                    ->with('sub_page','users-view')
                    ->with('user_details',$user_details);      

        } catch( Exception $e) {

            return redirect()->route('admin.users.index')->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method users_save()
     *
     * @uses To save the user object details of new/existing based on details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $user_id , (request) user details
     *
     * @return success/error message
     */
    public function users_save(Request $request) {

        try {
            
            DB::beginTransaction();
           
            $validator = Validator::make( $request->all(), [
                        // 'name' => 'required|regex:/^[a-z\d\-.\s]+$/i|min:2|max:100',
                        'name' => 'required|min:2|max:100',
                        'email' => $request->user_id ? 'email:rfc,dns|required|email|max:255|unique:users,email,'.$request->user_id : 'required|email|max:255|unique:users,email|email:rfc,dns',
                        'mobile' => 'required|digits_between:4,16',
                        'password' => $request->user_id ? '' : 'required|min:6|confirmed',
                ]
            );

            if($validator->fails()) {

                $error = implode(',', $validator->messages()->all());
                
                throw new Exception($error, 101);            
            } 

            $new_user = NO;

            if($request->user_id != '') {

                $user_details = User::find($request->user_id);

                $message = tr('admin_user_update_success');  

                if($request->hasFile('picture')) {

                    Helper::delete_picture($user_details->picture, "/uploads/images/users/"); 
                } 

            } else {

                $new_user = YES;

                //Add New User
                $user_details = new User;
                
                $new_password = $request->password;

                $user_details->password = Hash::make($new_password);

                $message = tr('admin_user_create_success');

                $user_details->login_by = LOGIN_BY_MANUAL;
                
                $user_details->device_type = DEVICE_WEB ;

                $user_details->picture = asset('placeholder.png');
            }  

            if($request->hasFile('picture')) {
                
                if($request->user_id) {

                    Helper::storage_delete_file($user_details->picture, PROFILE_PATH_USER); 
                    // Delete the old pic
                }

                $user_details->picture = Helper::storage_upload_file($request->file('picture'), PROFILE_PATH_USER);
           
            }          

            $user_details->timezone = $request->has('timezone') ? $request->timezone : '';

            $user_details->name = $request->has('name') ? $request->name : '';

            $user_details->email = $request->has('email') ? $request->email: '';

            $user_details->mobile = $request->has('mobile') ? $request->mobile : '';
            
            $user_details->token = Helper::generate_token();

            $user_details->token_expiry = Helper::generate_token_expiry();

            $user_details->is_activated = $user_details->status = USER_APPROVED; 
            
            $user_details->no_of_account = DEFAULT_SUB_ACCOUNTS;

            if($request->user_id == '') {

                $email_data['subject'] = tr('user_welcome_title').' '.Setting::get('site_name');

                $email_data['page'] = "emails.admin_user_welcome";

                $email_data['data'] = $user_details;

                $email_data['email'] = $user_details->email;

                $email_data['password'] = $new_password;

                $email_data['content'] = Helper::get_email_content(ADMIN_USER_WELCOME,$email_data);

                $this->dispatch(new SendEmailJob($email_data));

                // Check the default subscription and save the user type for new user 
                user_type_check($user_details->id);

            }

            $user_details->is_verified = USER_EMAIL_VERIFIED;      

            if( $user_details->save() ) {

                DB::commit();

            } else {

                throw new Exception(tr('admin_user_save_error'), 101);
            }

            if( $new_user == YES ) {

                $sub_profile = new SubProfile;

                $sub_profile->user_id = $user_details->id;

                $sub_profile->name = $user_details->name;

                $sub_profile->picture = $user_details->picture;

                $sub_profile->status = DEFAULT_TRUE;

                $user_details->is_verified = USER_EMAIL_VERIFIED;

                $user_details->save();

                if( $sub_profile->save() ) {

                    DB::commit();

                } else {

                    throw new Exception(tr('admin_user_sub_profile_save_error'), 101);
                }

            } else {

                $sub_profile = SubProfile::where('user_id', $request->user_id)->first();

                if (!$sub_profile) {

                    $sub_profile = new SubProfile;

                    $sub_profile->user_id = $user_details->id;

                    $sub_profile->name = $user_details->name;

                    $sub_profile->picture = $user_details->picture;

                    $sub_profile->status = DEFAULT_TRUE;

                    if( $sub_profile->save() ) {

                        DB::commit();

                    } else {

                        throw new Exception(tr('admin_user_sub_profile_save_error'), 101);
                    }

                }

            }

            if($user_details) {

                $moderator = Moderator::where('email', $user_details->email)->first();

                // If the user already registered as moderator, atuomatically the status will update.
                if($moderator && $user_details) {

                    $user_details->is_moderator = DEFAULT_TRUE;

                    $user_details->moderator_id = $moderator->id;
                    
                    if( $user_details->save() ) {

                        DB::commit();

                    } else {

                        throw new Exception(tr('admin_user_save_error'), 101);
                    }

                    $moderator->is_activated = DEFAULT_TRUE;

                    $moderator->is_user = DEFAULT_TRUE;
                    
                    if( $moderator->save() ) {

                        DB::commit();

                    } else {

                        throw new Exception(tr('admin_user_to_moderator_save_error'), 101);
                    }
                }

                register_mobile('web');

                if (Setting::get('track_user_mail')) {

                    user_track("StreamHash - New User Created");
                }

                return redirect()->route('admin.users.view' ,['user_id' => $user_details->id] )->with('flash_success', $message);
            } 
            
            throw new Exception(tr('admin_user_save_error'), 101);                     
            
        } catch (Exception $e) {

            DB::rollback();

            return redirect()->back()->withInput()->with('flash_error',$e->getMessage());
            
        }

    }

    /**
     * @method users_view()
     *
     * @uses To display user details based on user id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $user_id 
     *
     * @return view page
     */
    public function users_view(Request $request) {

        try {
               
            $user_details = User::find($request->user_id) ;
            
            if(!$user_details) {

                throw new Exception(tr('admin_user_not_found'), 101);
            }

            $referral_codes = ReferralCode::CommonResponse()->where('referral_codes.user_id', $user_details->id)->first();
            
            if(!$referral_codes) {

                $referral_codes = Helper::user_referral_code($user_details->id);

            }

            return view('admin.users.view')
                    ->with('page','users')
                    ->with('sub_page','users-view')
                    ->with('user_details' , $user_details)
                    ->with('referral_code', $referral_codes);
        
        } catch( Exception $e) {
            
            return redirect()->route('admin.users.index')->with('flash_error',$e->getMessage());
        }

    }    

    /**
     * @method users_delete()
     * 
     * @uses To delete the user object based on user id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return success/failure message
     */
    public function users_delete(Request $request) {

        try {
            
            DB::beginTransaction();

            $user_details = User::where('id',$request->user_id)->first();
            
            if(!$user_details) { 

                throw new Exception(tr('admin_user_not_found'), 101);
            }
            if ($user_details->device_type) {

                // Load Mobile Registers
                subtract_count($user_details->device_type);
            }

            if( $user_details->picture )
                // Delete the old pic
                Helper::delete_picture($user_details->picture, "/uploads/images/users/"); 

                // After reduce the count from mobile register model delete the user
            if( $user_details->is_moderator ) {    
                
                $moderator = Moderator::where('email',$user_details->email)->first();
                
                if($moderator){

                    $moderator->is_user = NO;

                    $moderator->save(); 
                }
            }

            if ($user_details->delete()) {

                DB::commit();
                
                return redirect()->back()->with('flash_success',tr('admin_user_delete_success'));  
            } 

            throw new Exception(tr('admin_user_delete_error'), 101);
            
        } catch (Exception $e) {
            
            DB::rollback();
            
            return redirect()->back()->withInput()->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method users_status_change()
     *
     * @uses To update user status to approve/decline based on user id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $user_id
     *
     * @return success/error message
     */
    public function users_status_change(Request $request) {

        try {

            DB::beginTransaction();
       
            $user_details = User::find($request->user_id);

            if(!$user_details) {
                
                throw new Exception(tr('admin_user_not_found'), 101);
            } 
            
            $user_details->status = $user_details->status == USER_ACTIVATED ? USER_DEACTIVATED : USER_ACTIVATED;

            $user_details->is_activated = $user_details->is_activated ? USER_DECLINED : USER_APPROVED;

            $message = $user_details->is_activated == USER_APPROVED ? tr('admin_user_activate_success') : tr('admin_user_deactivate_success');

            if($user_details->save()) {

                DB::commit();

                return back()->with('flash_success',$message);
            } 

            throw new Exception(tr('admin_user_is_activated_save_error'), 101);
            
        } catch( Exception $e) {

            DB::rollback();
            
            return redirect()->route('admin.users.index')->with('flash_error',$e->getMessage());
        }

    }


    /**
     * @method users_verify_status()
     * 
     * @uses To verify for the user Email 
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $user_id
     *
     * @return success/error message
     */
    public function users_verify_status(Request $request) {

        try {   

            DB::beginTransaction();
       
            $user_details = User::find($request->user_id);

            if(!$user_details) {
                
                throw new Exception(tr('admin_user_not_found'), 101);
            } 
            
            $user_details->is_verified = $user_details->is_verified == USER_EMAIL_VERIFIED ? USER_EMAIL_NOT_VERIFIED : USER_EMAIL_VERIFIED;

            $message = $user_details->is_verified == USER_EMAIL_VERIFIED ? tr('admin_user_verify_success') : tr('admin_user_unverify_success');

            if( $user_details->save() ) {

                DB::commit();

                return back()->with('flash_success',$message);
            } 
            
            throw new Exception(tr('admin_user_is_activated_save_error'), 101);
            
        } catch (Exception $e) {
            
            DB::rollback();
            
            return redirect()->route('admin.users.index')->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method users_sub_profiles()
     *
     * @uses list the sub profiles based on the selected user
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     * 
     * @return list of sub profiles page
     */

    public function users_sub_profiles(Request $request) {

        try {
            
            $user_details = User::find($request->user_id);

            if(!$user_details) {

                throw new Exception(tr('admin_user_not_found'), 101);                
            }

            $sub_profiles = SubProfile::where('user_id', $request->user_id)
                                        ->orderBy('created_at','desc')
                                        ->paginate(10);

            return view('admin.users.sub_profiles')
                        ->withPage('users')
                        ->with('sub_page','users-view')
                        ->with('user_details' , $user_details)
                        ->with('sub_profiles' , $sub_profiles);

        } catch (Exception $e) {
             
            

            return redirect()->route('admin.users.index')->with('flash_error',$e->getMessage());
        }        

    }


    /**
     * @method users_upgrade()
     *
     * @uses To upgrade a user as moderator based on user id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $user_id
     *
     * @return success/error message
     */
    public function users_upgrade(Request $request) {

        try {

            DB::beginTransaction();
            
            $user_details = User::find($request->user_id);
            
            if(!$user_details) {

                throw new Exception(tr('admin_user_not_found'), 101);
            } 
            
            $moderator_details = Moderator::where('email' , $user_details->email)->first();

            if(!$moderator_details) {

                $moderator_user = new Moderator;

                $moderator_user->name = $user_details->name;

                $moderator_user->email = $user_details->email;

                if($user_details->login_by == LOGIN_BY_MANUAL ) {

                    $moderator_user->password = $user_details->password;  

                    $new_password = tr('user_login_password');

                } else {

                    $new_password = time();
                    $new_password .= rand();
                    $new_password = sha1($new_password);
                    $new_password = substr($new_password, 0, 8);
                    $moderator_user->password = Hash::make($new_password);
                }

                $moderator_user->picture = $user_details->picture;
                $moderator_user->mobile = $user_details->mobile;
                $moderator_user->address = $user_details->address;
                
                if( $moderator_user->save() ) {

                    DB::commit();

                } else {

                    throw new Exception(tr('admin_user_to_moderator_save_error'), 101);
                }

                $email_data['subject'] = tr('user_welcome_title').' '.Setting::get('site_name');

                $email_data['page'] = "emails.moderator_welcome";

                $email_data['data'] = $moderator_user;

                $email_data['email'] = $moderator_user->email;

                $email_data['password'] = $new_password;

                $email_data['content'] = Helper::get_email_content(MODERATOR_WELCOME,$email_data);

                $this->dispatch(new SendEmailJob($email_data));

                $moderator_details = $moderator_user;
            } 

            if($moderator_details) {

                $user_details->is_moderator = YES;
                $user_details->moderator_id = $moderator_details->id;
                $user_details->save();

                if( $user_details->save() ) {

                    DB::commit();

                } else {

                    throw new Exception(tr('admin_user_to_moderator_save_error'), 101);
                }

                $moderator_details->is_activated = USER_ACTIVATED ;

                $moderator_details->is_user = YES;
                
                if( $moderator_details->save() ) {

                    DB::commit();

                    return back()->with('flash_success',tr('admin_user_upgrade'));
                } 

                throw new Exception(tr('admin_user_to_moderator_save_error'), 101);

            }

            throw new Exception(tr('admin_user_to_moderator_save_error'), 101);

        } catch (Exception $e) {
            
            DB::rollback();
            
            return back()->with('flash_error',$e->getMessage());
        }
    }


    /**
     * @method users_upgrade_disable()
     *
     * @uses To disable a user as moderator based on user id, moderator id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $user_id,$moderator_id
     *
     * @return success/error message
     */
    public function users_upgrade_disable(Request $request) {

        try {

            DB::beginTransaction();

            $moderator_details = Moderator::find($request->moderator_id);
            
            if(!$moderator_details) {

                throw new Exception(tr('admin_moderator_not_found'), 101);
            }

            $user_details = User::find($request->user_id);
            
            if(!$user_details) {

                throw new Exception(tr('admin_user_not_found'), 101);
            }

            $user_details->is_moderator = NO;
            
            if( $user_details->save() ) {

                DB::commit();

            } else {

                throw new Exception(tr('admin_user_upgrade_disable_error'), 101);
            }

            $moderator_details->is_activated = MODERATOR_DEACTIVATED;

            if( $moderator_details->save() ) {

                DB::commit();

                return back()->with('flash_success',tr('admin_user_upgrade_disable_success'));
            } 

            throw new Exception(tr('admin_user_upgrade_disable_error'), 101);
           
        } catch (Exception $e) {
            
            DB::rollback();
            
            return back()->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method users_history()
     *
     * @uses To display a sub user history based on sub profile id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $sub_profile_id
     *
     * @return view page
     */
    public function users_history(Request $request) {

        try {
            
            $sub_profile_details = SubProfile::find($request->sub_profile_id);

            if(!$sub_profile_details) {

                throw new Exception(tr('admin_sub_user_profile_not_found') , 101);
            }

            $user_histories = UserHistory::where('user_histories.sub_profile_id' , $request->sub_profile_id)
                            ->leftJoin('users' , 'user_histories.user_id' , '=' , 'users.id')
                            ->leftJoin('admin_videos' , 'user_histories.admin_video_id' , '=' , 'admin_videos.id')
                            ->select(
                                'users.name as username' , 
                                'users.id as user_id' , 
                                'user_histories.admin_video_id',
                                'user_histories.id as user_history_id',
                                'admin_videos.title',
                                'user_histories.created_at as date'
                                )
                            ->paginate(10);
                            
            return view('admin.users.history')
                        ->withPage('users')
                        ->with('sub_page','users')
                        ->with('user_histories' , $user_histories)
                        ->with('sub_profile_details', $sub_profile_details);
            
        } catch (Exception $e) {

            return back()->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method users_history_remove()
     *
     * @uses To delete the sub user history based on sub user history id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $user_history_id
     *
     * @return success/failure message
     */
    public function users_history_remove(Request $request) {

        try {

            DB::beginTransaction();

            $user_history = UserHistory::find($request->user_history_id);
            
            if(!$user_history) {
                
                throw new Exception(tr('admin_user_history_not_found'), 101);
            }

            if( $user_history->delete() ) {

                DB::commit();

                return back()->with('flash_success',tr('admin_user_history_delete_success'));
            } 

            throw new Exception(tr('admin_user_history_delete_error') , 101);      
           
        } catch (Exception $e) {

            DB::rollback();
            
            

            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method users_wishlist()
     *
     * @uses To view the sub user wishlist based on sub_profile_id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $sub_profile_id
     *
     * @return view page
     */
    public function users_wishlist(Request $request) {

        try {

            $user_sub_profile_details = SubProfile::find($request->sub_profile_id);
                
            if(!$user_sub_profile_details) {
                
                throw new Exception(tr('admin_user_sub_profile_not_found') , 101);
            }

            $user_wishlists= Wishlist::where('wishlists.sub_profile_id' , $request->sub_profile_id)
                            ->leftJoin('users' , 'wishlists.user_id' , '=' , 'users.id')
                            ->leftJoin('admin_videos' , 'wishlists.admin_video_id' , '=' , 'admin_videos.id')
                            ->select(
                                'users.name as username' , 
                                'users.id as user_id' , 
                                'wishlists.admin_video_id',
                                'wishlists.id as wishlist_id',
                                'admin_videos.title',
                                'wishlists.created_at as date'
                                )
                            ->paginate(10);

            return view('admin.users.wishlist')
                    ->withPage('users')
                    ->with('sub_page','users')
                    ->with('user_wishlists' , $user_wishlists)
                    ->with('user_sub_profile_details', $user_sub_profile_details);

        } catch (Exception $e) {

            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method users_wishlist_remove()
     *
     * @uses To view the sub user wishlist based on sub_profile_id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $sub_profile_id
     *
     * @return view page
     */
    public function users_wishlist_remove(Request $request) {

        try {

            DB::beginTransaction();

            $user_wishlist_details = Wishlist::find($request->user_wishlist_id);
            
            if(!$user_wishlist_details) {
                
                throw new Exception(tr('admin_user_wishlist_not_found') , 101);
            }

            if( $user_wishlist_details->delete() ) {

                DB::commit();
                
                return back()->with('flash_success',tr('admin_user_wishlist_delete_success'));
            } 

            throw new Exception(tr('admin_user_wishlist_delete_error') , 101);      
          
        } catch (Exception $e) {

            DB::rollback();
            
            

            return back()->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method users_clear_login
     *
     * @uses To clear all the logins from all devices
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param object $request - User details
     *
     * @return response of success/failure message
     */
    public function users_clear_login(Request $request) {

        try {
            
            DB::beginTransaction();

            $user_details = User::find($request->user_id);

            if(!$user_details) {

                throw new Exception(tr('admin_user_not_found'), 101);
            }

            // Delete all the records which is stored before
            $user_logged_device = UserLoggedDevice::where('user_id', $request->user_id);

            if($user_logged_device->count() > 0) {

                $user_logged_device->delete();

                $user_details->logged_in_account = 0;

                $user_details->save();

                return back()->with('flash_success', tr('admin_user_clear'));

            } 

            throw new Exception(tr('admin_user_no_device_to_clear') , 101);
                       
        } catch (Exception $e) {
            
            DB::rollback();
            return back()->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method moderators_index()
     * 
     * @uses used to list the moderators
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return view page
     */
    public function moderators_index(Request $request) {
      
        $sub_page = 'moderators-view';

        $total_moderator =  Moderator::orderBy('created_at','desc')->count();
       
        $total_approved =  Moderator::orderBy('created_at','desc')->Where('is_activated', APPROVED)->count();
        
        $total_declined =  Moderator::orderBy('created_at','desc')->Where('is_activated', DECLINED)->count();

        $base_query = Moderator::orderBy('created_at','desc');
        
        $sub_page = 'moderators-view';
        
        $title = tr('view_moderators');

        if($request->search_key) {

            $base_query->where(function ($query) use ($request) {
                $query->where('name', "like", "%" . $request->search_key . "%");
                $query->orWhere('email', "like", "%" . $request->search_key . "%");
                $query->orWhere('mobile', "like", "%" . $request->search_key . "%");
            });
        }


        if($request->status!=''){

            $base_query->where('is_activated',$request->status);
        }

        if($request->filled('sort')) {

            $sub_page = 'moderators-view-declined';
            
            $title = tr('declined_moderators');

            $base_query = $base_query->Where('is_activated', DECLINED);
        }        

        $moderators = $base_query->paginate(10);

        $moderators->total_approved = $total_approved;

        $moderators->total_declined = $total_declined;

        $moderators->total_moderator = $total_moderator;



        return view('admin.moderators.index')
                    ->with('search_key', $request->search_key)
                    ->withPage('moderators')
                    ->with('sub_page', $sub_page)
                    ->with('sort', $request->sort)
                    ->with('status', $request->status)
                    ->with('title', $title )
                    ->with('moderators', $moderators);
    }

    /**
     * @method moderator_create()
     *
     * @uses To create a moderator object details
     *
     * @created Anjana H 
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return View page
     */

    public function moderators_create() {

        $moderator_details = new Moderator;

        return view('admin.moderators.create')
                ->with('page' ,'moderators')
                ->with('sub_page' ,'moderators-create')
                ->with('moderator_details',$moderator_details);
    }

    /**
     * @method moderators_edit()
     *
     * @uses To display and update moderator object details based on the moderator id
     *
     * @created  Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $moderator_id
     *
     * @return View page
     */
    public function moderators_edit(Request $request) {

        try {
          
            $moderator_details = Moderator::find($request->moderator_id);

            if(!$moderator_details) {

                throw new Exception( tr('admin_moderator_not_found'), 101);
            } 

            return view('admin.moderators.edit')
                        ->with('page' , 'moderators')
                        ->with('sub_page','moderators-view')
                        ->with('moderator_details',$moderator_details);
            

        } catch( Exception $e) {
            
            

            return redirect()->route('admin.moderators.index')->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method moderators_save()
     *
     * @uses To save the moderator object details of new/existing based on details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $moderator_id , (request) user details
     *
     * @return success/error message
     */
    public function moderators_save(Request $request) {

        try {
            
            DB::beginTransaction();

            $validator = Validator::make( $request->all(), array(
                    // 'name' => 'required|regex:/^[a-z\d\-.\s]+$/i|min:2|max:100',
                    'name' => 'required|min:2|max:100',
                    'email' => $request->moderator_id ? 'email:rfc,dns|required|email|max:255|unique:moderators,email,'.$request->moderator_id : 'email:rfc,dns|required|email|max:255|unique:moderators,email',
                    'mobile' => 'required|digits_between:6,13',
                    'password' => $request->moderator_id ? '' : 'required|min:6|confirmed',
                    'address'=>'required|max:255'
                )
            );

            if($validator->fails()) {

                $error = implode(',', $validator->messages()->all());
                
                throw new Exception($error, 101);            
            } 

            $changed_email = DEFAULT_FALSE;

            $email = "";

            if( $request->moderator_id != '' ) {

                $moderator_details = Moderator::find($request->moderator_id);

                $message = tr('admin_moderator_update_success');

                if ($moderator_details->email != $request->email) {

                    $changed_email = DEFAULT_TRUE;

                    $email = $moderator_details->email;
                }

                if($request->hasFile('picture')) {

                    Helper::storage_delete_file($moderator_details->picture, MODERATOR_FILE_PATH); 
                } 

            } else {

                $message = tr('admin_moderator_create_success');

                //Add New moderator
                $moderator_details = new Moderator;

                $new_password = $request->password;

                $moderator_details->password = Hash::make($new_password);

                $moderator_details->is_activated = MODERATOR_ACTIVATED;

                $moderator_details->picture = asset('placeholder.png');

            }

            if($request->hasFile('picture')) {
                
                $moderator_details->picture = Helper::storage_upload_file($request->file('picture'), MODERATOR_FILE_PATH);
            }    

            $moderator_details->timezone = $request->has('timezone') ? $request->timezone : '';

            $moderator_details->name = $request->has('name') ? $request->name : '';

            $moderator_details->email = $request->has('email') ? $request->email: '';

            $moderator_details->mobile = $request->has('mobile') ? $request->mobile : '';

            $moderator_details->address = $request->has('address') ? $request->address : '';
            
            $moderator_details->token = Helper::generate_token();

            $moderator_details->token_expiry = Helper::generate_token_expiry();

            if($request->moderator_id == '') {

                $email_data['subject'] = tr('user_welcome_title').' '.Setting::get('site_name');

                $email_data['page'] = "emails.moderator_welcome";

                $email_data['data'] = $moderator_details;

                $email_data['email'] = $moderator_details->email;

                $email_data['password'] = $new_password;

                $email_data['content'] = Helper::get_email_content(MODERATOR_WELCOME,$email_data);

                $this->dispatch(new SendEmailJob($email_data));

            }

            if( $moderator_details->save() ) {

                DB::commit();

            } else {

                throw new Exception(tr('admin_moderator_save_error'), 101);
            }

            $user = User::where('email', $moderator_details->email)->first();

            // if the moderator already exists in user table, the status will change automatically
            if($moderator_details && $user) {

                $user->is_moderator = DEFAULT_TRUE;
                $user->moderator_id = $moderator_details->id;

                if( $user->save() ) {

                    DB::commit();

                } else {

                    throw new Exception(tr('admin_moderator_save_error'), 101);
                }

                $moderator_details->is_activated = MODERATOR_ACTIVATED;

                $moderator_details->is_user = DEFAULT_TRUE;

                if( $moderator_details->save() ) {

                    DB::commit();

                } else {

                    throw new Exception(tr('admin_moderator_save_error'), 101);
                }
            }

            if ($changed_email) {

                if ($email) {

                    $email_data['page'] = "emails.moderator_update_profile";

                    $email_data['data'] = $moderator_details;

                    $email_data['email'] = $moderator_details->email;

                    $email_data['content'] = Helper::get_email_content(MODERATOR_UPDATE_MAIL,$email_data);

                    $this->dispatch(new SendEmailJob($email_data));
                }
            }

            if (Setting::get('track_user_mail')) {

                user_track("StreamHash - Moderator Created");
            }

            return redirect()->route('admin.moderators.view',['moderator_id' => $moderator_details->id] )->withInput()->with('flash_success', $message);
        
            
        } catch (Exception $e) {
            
            DB::rollback();
            return redirect()->back()->with('flash_error',$e->getMessage());
        }  
        
    }

    /**
     * @method moderators_view()
     *
     * @uses To display moderator details based on moderator id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $moderator_id 
     *
     * @return view page
     */
    public function moderators_view(Request $request) {

        try {
               
            $moderator_details = Moderator::find($request->moderator_id) ;
            
            if(!$moderator_details) {

                throw new Exception(tr('admin_moderator_not_found'), 101);
            }

            return view('admin.moderators.view')
                        ->with('page','moderators')
                        ->with('sub_page','moderators-view')
                        ->with('moderator_details' , $moderator_details);
           
        } catch( Exception $e) {
            
            

            return redirect()->route('admin.moderators.index')->with('flash_error',$e->getMessage());
        }

    }
    
    /**
     * @method moderators_delete()
     * 
     * @uses To delete the moderator object based on moderator id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return success/failure message
     */
    public function moderators_delete(Request $request) {

        try {

            DB::beginTransaction();

            $moderator_details = Moderator::find($request->moderator_id);

            if(!$moderator_details) {

                throw new Exception(tr('admin_moderator_not_found'), 101);
            }

            if( $moderator_details->picture ) {

                Helper::delete_picture($moderator_details->picture , '/uploads/images/moderators');
            }

            if( $moderator_details->is_user ) {

                $user_details = User::where('email',$moderator_details->email)->first();

                if( $user_details ) {

                    $user_details->is_moderator = NO;

                    if( $user_details->save() ) {
                        
                        DB::commit();

                    } else {

                        throw new Exception(tr('admin_moderator_delete_error'), 101);
                    } 
                }
            }            

            if( $moderator_details->id ) {

                $admin_video_details = AdminVideo::where('uploaded_by',$moderator_details->id)->first();

                if($admin_video_details) {
                    
                    if ($admin_video_details->delete()) {
                        
                        DB::commit();

                    } else {

                        throw new Exception(tr('admin_moderator_delete_error'), 101);
                    }  
                }         
            }

            if ($moderator_details->delete()) {
                        
                DB::commit();

                return redirect()->route('admin.moderators.index')->with('flash_success',tr('admin_moderator_delete_success'));
            } 
            
            throw new Exception(tr('admin_moderator_delete_error'), 101);

        } catch (Exception $e) {
            
            DB::rollback();
            
            return back()->with('flash_error',$e->getMessage());
        }
    }


    /**
     * @method umoderator_status_change()
     *
     * @uses To update moderator status to approve/decline based on moderator id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $moderator_id
     *
     * @return success/error message
     */
    public function moderators_status_change(Request $request) {

        try {

            DB::beginTransaction();
       
            $moderator_details = Moderator::find($request->moderator_id);

            if(!$moderator_details) {
                
                throw new Exception(tr('admin_moderator_not_found'), 101);
            }

            $moderator_details->is_activated = $moderator_details->is_activated == MODERATOR_ACTIVATED ? MODERATOR_DEACTIVATED : MODERATOR_ACTIVATED ;
                        
            $message = $moderator_details->is_activated == MODERATOR_ACTIVATED ? tr('admin_moderator_activate_success') : tr('admin_moderator_deactivate_success');

            if( $moderator_details->save() ) {

                DB::commit();

                return back()->with('flash_success',$message);
            } 

            throw new Exception(tr('admin_moderator_is_activated_save_error'), 101);
           
        } catch( Exception $e) {

            DB::rollback();
            
            

            return redirect()->route('admin.moderators.index')->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method moderators_redeem_requests()
     * 
     * @uses To list Moderator Reedems 
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param request details
     *
     * @return View Page
     */
    public function moderators_redeem_requests(Request $request) {

        try {

            $base_query = RedeemRequest::leftJoin('moderators' , 'moderators.id' , '=' , 'redeem_requests.moderator_id')
                          ->orderBy('redeem_requests.updated_at' , 'desc');

            $moderator_details = [];

            if( $request->moderator_id ) {

                $moderator_details = Moderator::find($request->moderator_id);

                if(!$moderator_details) {

                    throw new Exception(tr('admin_moderator_not_found'), 101);
                }
            
                $base_query = $base_query->where('moderator_id' , $request->moderator_id);
            }

            if($request->search_key) {

                $base_query = $base_query
                        ->where('moderators.name','LIKE','%'.$request->search_key.'%');
            }
    
            if($request->has('status')){
    
                $base_query->where('status',$request->status);
    
            }
    
            
            $redeem_requests = $base_query->select('redeem_requests.*')->paginate(10);
            
            return view('admin.moderators.redeems')
                        ->withPage('redeems')
                        ->with('sub_page' , 'redeems')
                        ->with('redeem_requests' , $redeem_requests)
                        ->with('moderator_details' , $moderator_details);
            
        } catch (Exception $e) {

            return redirect()->route('admin.moderators.index')->with('flash_error',$e->getMessage());
        }
    
    }

    /**
     * @method moderators_redeems_request_cancel()
     *
     * @uses to cancel redeem cancel from admin end.
     *
     * @created 
     *
     * @updated 
     *
     * @param
     *
     * @return view page
     */
    public function moderators_redeems_request_cancel(Request $request) {

        try {

            $request->request->add([ 
                'id' => $request->moderator_id,
                'redeem_request_id' => $request->redeem_request_id,
            ]);

            DB::beginTransaction();

            $response = $this->ModeratorAPI->redeem_request_cancel($request)->getData();

            if($response->success) {

                DB::commit();

                return back()->with('flash_success', tr('redeem_request_cancel_success'));

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
     * @method moderators_redeems_payout_direct()
     * 
     * @uses To payout for the selected redeem request with direct payment
     *
     * @created Anjana H 
     *
     * @updated Anjana H 
     *
     * @param - 
     *
     * @return success/failure message
     */
    public function moderators_redeems_payout_direct(Request $request) {

        try {
            
            DB::beginTransaction();

            $validator = Validator::make($request->all() , [
                'redeem_request_id' => 'required|exists:redeem_requests,id',
                'paid_amount' => 'required', 
                ]);

            if( $validator->fails() ) {

                $error = implode(',', $validator->messages()->all());

                throw new Exception($error, 101);                

            }

            $redeem_request_details = RedeemRequest::find($request->redeem_request_id);

            if(!$redeem_request_details) {

                throw new Exception(tr('admin_reedem_request_not_found'), 101);
            }

            if( $redeem_request_details->status == REDEEM_REQUEST_PAID ) {

                throw new Exception(tr('admin_redeem_request_status_mismatch'), 101);
            } 

            $redeem_request_details->paid_amount = $redeem_request_details->paid_amount + $request->paid_amount;

            $redeem_request_details->status = REDEEM_REQUEST_PAID;

            $redeem_request_details->payment_mode = "direct";

            if( $redeem_request_details->save() ) {
                
                DB::commit();

            } else { 

                throw new Exception(tr('admin_redeem_request_save_error'), 101);
            }
        
            $redeem = Redeem::where('moderator_id', $redeem_request_details->moderator_id)->first();

            $redeem->paid += $request->paid_amount;

            $redeem->remaining = $redeem->total_moderator_amount - $redeem->paid;

            if( $redeem->save() ) {
                
                DB::commit();

            } else { 

                throw new Exception(tr('admin_redeem_request_save_error'), 101);
            }

            if ($redeem_request_details->moderator) {

                $redeem_request_details->moderator->paid_amount += $request->paid_amount;

                $redeem_request_details->moderator->remaining_amount = $redeem->total_moderator_amount - $redeem->paid;

                if( $redeem_request_details->moderator->save() ) {
                
                    DB::commit();

                    return redirect()->route('admin.moderators.redeems')->with('flash_success' , tr('action_success'));
        
                } else { 

                    throw new Exception(tr('admin_redeem_request_save_error'), 101);
                }    
            }

            throw new Exception(tr('admin_redeem_request_save_error'), 101);
        
        } catch (Exception $e) {
             
            DB::rollback();

            

            return redirect()->route('admin.moderators.redeems')->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method moderators_payout_invoice()
     * 
     * @uses To list the categories
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param request details
     *
     * @return View Page
     */
    public function moderators_redeems_payout_invoice(Request $request) {

        try {
        
            $validator = Validator::make($request->all() , [
                'redeem_request_id' => 'required|exists:redeem_requests,id',
                'paid_amount' => 'required', 
                'moderator_id' => 'required'
                ]);

            if($validator->fails()) {

                $error = implode(',',$validator->messages()->all());

                throw new Exception($error, 101);

            } 

            $redeem_request_details = RedeemRequest::find($request->redeem_request_id);

            if($redeem_request_details) {

                if ($redeem_request_details->status == REDEEM_REQUEST_PAID ) {

                    throw new Exception( tr('admin_redeem_request_status_mismatch'), 101);
                } 

                $invoice_data['moderator_details'] = $moderator_details = Moderator::find($request->moderator_id);

                $invoice_data['redeem_request_id'] = $request->redeem_request_id;

                $invoice_data['redeem_request_status'] = $redeem_request_details->status;

                $invoice_data['moderator_id'] = $request->moderator_id;

                $invoice_data['item_name'] = Setting::get('site_name')." - Checkout to"."$moderator_details ? $moderator_details->name : -";

                $invoice_data['payout_amount'] = $request->paid_amount;

                $data = json_decode(json_encode($invoice_data));

                return view('admin.moderators.payout')
                            ->withPage('moderators')
                            ->with('sub_page' , 'moderators')
                            ->with('data' , $data);                
            }

            throw new Exception(tr('admin_reedem_request_not_found'), 101);
           
        } catch (Exception $e) {

            return redirect()->route('admin.moderators.redeems')->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method moderators_videos()
     *
     * @uses Display the moderator videos list
     *
     * @param Moderator id
     *
     * @return Moderator video list details
     */
    public function moderators_videos(Request $request) {

        $videos = AdminVideo::leftJoin('categories' , 'admin_videos.category_id' , '=' , 'categories.id')
                    ->leftJoin('sub_categories' , 'admin_videos.sub_category_id' , '=' , 'sub_categories.id')
                    ->leftJoin('genres' , 'admin_videos.genre_id' , '=' , 'genres.id')
                   ->select('admin_videos.id as video_id' ,'admin_videos.title' , 
                             'admin_videos.description' , 'admin_videos.ratings' , 
                             'admin_videos.reviews' , 'admin_videos.created_at as video_date' ,
                             'admin_videos.default_image',
                             'admin_videos.admin_amount',
                             'admin_videos.amount',
                             'admin_videos.user_amount',
                             'admin_videos.type_of_user',
                             'admin_videos.type_of_subscription',
                             'admin_videos.category_id as category_id',
                             'admin_videos.sub_category_id',
                             'admin_videos.genre_id',
                             'admin_videos.compress_status',
                             'admin_videos.trailer_compress_status',
                             'admin_videos.main_video_compress_status',
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
                    ->where('uploaded_by',$request->moderator_id)
                    ->paginate(10);

        return view('admin.videos.index')
                    ->with('admin_videos' , $videos)
                    ->with('category' , [])
                    ->with('sub_category' , [])
                    ->with('genre' , [])
                    ->withPage('videos')
                    ->with('sub_page','view-videos');
   
    }


    /**
     * @method categories_index()
     * 
     * @uses To list the categories
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param  
     *
     * @return view page
     */
    public function categories_index(Request $request) {

        $base_query = Category::orderBy('categories.created_at', 'desc')
                        ->distinct('categories.id');
                        
        if($request->search_key) {

            $base_query = $base_query
                    ->where('name','LIKE','%'.$request->search_key.'%');
        }

        if($request->status!=''){

            $base_query->where('is_approved',$request->status);

        }

        $categories   = $base_query->paginate(10);

        foreach($categories as $key=>$category){
          
         $category->videos_count = AdminVideo::where('category_id',$category->id)->count();

        }

        return view('admin.categories.index')
                    ->withPage('categories')
                    ->with('sub_page','categories-view')
                    ->with('categories' , $categories);
    }

    /**
     * @method categories_create()
     *
     * @uses To create a category object details
     *
     * @created Anjana H 
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return View page
     */
    public function categories_create() {

        $category_details = new Category;

        return view('admin.categories.create')
                    ->with('page' , 'categories')
                    ->with('sub_page','categories-create')
                    ->with('category_details',$category_details);
    }

    /**
     * @method categories_edit()
     *
     * @uses To display and update category object details based on the category id
     *
     * @created  Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $category_id
     *
     * @return View page
     */
    public function categories_edit(Request $request) {

        try {
          
            $category_details = Category::find($request->category_id);

            if(!$category_details) {

                throw new Exception( tr('admin_category_not_found'), 101);
            } 

            return view('admin.categories.edit')
                    ->with('page' , 'categories')
                    ->with('sub_page','categories-view')
                    ->with('category_details',$category_details);
        
        } catch( Exception $e) {
            
            

            return redirect()->route('admin.categories.index')->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method categories_save()
     *
     * @uses To save the category object details of new/existing based on details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $category_id , (request) category details
     *
     * @return success/error message
     */
    public function categories_save(Request $request) {

        try {

            DB::beginTransaction();

            $validator = Validator::make( $request->all(), array(
                        // 'name' => $request->category_id ? 'required|regex:/^[a-z\d\-. \'\s]+$/i|min:2|max:100|unique:categories,name,'.$request->category_id : 'required|regex:/^[a-z\d\-. \'\s]+$/i|min:2|max:100|unique:categories,name',
                        'name' => $request->category_id ? 'required|min:2|max:100|unique:categories,name,'.$request->category_id : 'required|min:2|max:100|unique:categories,name',
                        'picture' => $request->category_id ? 'mimes:jpeg,jpg,bmp,png' : 'required|mimes:jpeg,jpg,bmp,png',
                    )
            );
           
            if( $validator->fails() ) {

                $error = implode(',', $validator->messages()->all());

                throw new Exception($error, 101);
            } 

            if( $request->category_id != '') {

                $category_details = Category::find($request->category_id);
                
                $message = tr('admin_category_update_success');
                
                if($request->hasFile('picture')) {

                    Helper::delete_picture($category_details->picture, "/uploads/images/categories/");
                }

            } else {

                $message = tr('admin_category_create_success');

                //Add New Category object
                $category_details = new Category;
                $category_details->is_approved = DEFAULT_TRUE;
                $category_details->created_by = ADMIN;

            }

            $category_details->name = $request->has('name') ? $request->name : '';

            $category_details->is_series = $request->has('is_series') == YES ? $request->is_series : NO ;

            $category_details->status = APPROVED;
            
            if($request->hasFile('picture') && $request->file('picture')->isValid()) {
                
                if($request->category_id) {

                    Helper::storage_delete_file($category_details->picture, CATEGORY_FILE_PATH); 
                    // Delete the old pic
                }

                $category_details->picture = Helper::storage_upload_file($request->file('picture'), CATEGORY_FILE_PATH);
            }

            if( $category_details->save() ) {

                DB::commit();
                
                if( Setting::get('track_user_mail') ) {

                    user_track("StreamHash - Category Created");
                }

                return redirect()->route('admin.categories.view' ,['category_id' => $category_details->id])->with('flash_success', $message);
            }                    

            throw new Exception(tr('admin_category_save_error'), 101);
            
        } catch (Exception $e) {

            DB::rollback();


            return back()->with('flash_error',$e->getMessage());
        }
    
    }

    /**
     * @method categories_view()
     * 
     * @uses To display category details based on category id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $category_id
     *
     * @return view page
     */
    public function categories_view(Request $request) {

        try {

            $category_details = Category::find($request->category_id);
            
            if(!$category_details) {

                throw new Exception(tr('admin_category_not_found'), 101);
            } 

            $videos_count = AdminVideo::where('category_id',$request->category_id)->count();

            return view('admin.categories.view')
                    ->with('page' ,'categories')
                    ->with('sub_page' ,'categories-view')
                    ->with('videos_count' ,$videos_count)
                    ->with('category_details' ,$category_details);
           
        } catch (Exception $e) { 

            return redirect()->route('admin.categories.index')->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method categories_status_change()
     *
     * @uses To update category is_approved to approved/declined based on category id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $category_id
     *
     * @return success/error message
     */
    public function categories_status_change(Request $request) {

        try {

            DB::beginTransaction();
       
            $category_details = Category::find($request->category_id);

            if(!$category_details) {
                
                throw new Exception(tr('admin_category_not_found'), 101);
            } 

            $category_details->is_approved = $category_details->is_approved == CATEGORY_APPROVED ? CATEGORY_DECLINED : CATEGORY_APPROVED;

            $message = $category_details->is_approved == CATEGORY_APPROVED ? tr('admin_category_approved_success') : tr('admin_category_declined_success');

            if( $category_details->save() ) {

                DB::commit();

                if ( $category_details->is_approved == CATEGORY_DECLINED ) {

                    foreach($category_details->subCategory as $sub_category) {               
                        $sub_category->is_approved = DECLINED;

                        if( $sub_category->save() ) {

                            DB::commit();

                        } else {

                            throw new Exception(tr('admin_category_is_approve_save_error'), 101);                            
                        }
                    } 

                    foreach($category_details->adminVideo as $video)
                    {                
                        $video->is_approved = DECLINED;
                        
                        if( $video->save() ) {

                            DB::commit();

                        } else {

                            throw new Exception(tr('admin_category_is_approve_save_error'), 101);                            
                        }
                    } 

                    foreach( $category_details->genre as $genre )
                    {                
                        $genre->is_approved = DECLINED;
                        
                        if( $genre->save() ) {

                            DB::commit();

                        } else {

                            throw new Exception(tr('admin_category_is_approve_save_error'), 101);                            
                        }
                    } 
                }

                return back()->with('flash_success',$message);
            } 
            
            throw new Exception(tr('admin_category_is_approve_save_error'), 101);
            
        } catch( Exception $e) {

            DB::rollback();
            
            

            return redirect()->route('admin.categories.index')->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method categories_delete()
     * 
     * @uses To delete the category object based on category id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return success/failure message
     */
    public function categories_delete(Request $request) {

        try {

            DB::beginTransaction();
            
            $category_details = Category::where('id' , $request->category_id)->first();

            if(!$category_details) {  

                throw new Exception(tr('admin_category_not_found'), 101);
            }

            Helper::delete_picture($category_details->picture, "/uploads/images/categories/");
            
            if( $category_details->delete() ) {

                DB::commit();

                return redirect()->route('admin.categories.index')->with('flash_success',tr('admin_category_delete_success'));
            } 
            
            throw new Exception(tr('admin_category_delete_error'), 101);

        } catch (Exception $e) {
            
            DB::rollback();
            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method sub_categories_index()
     *
     * @uses To create a sub_category object details
     *
     * @created Anjana H 
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return View page
     */
    public function sub_categories_index(Request $request) {

        try {

            $category_details = Category::find($request->category_id);

            if(!$category_details) {

                throw new Exception(tr('admin_category_not_found'), 101);
            }


            $base_query = SubCategory::where('category_id' , $request->category_id)
                            ->select(
                                    'sub_categories.id as id',
                                    'sub_categories.name as sub_category_name',
                                    'sub_categories.description',
                                    'sub_categories.is_approved',
                                    'sub_categories.created_by'
                            );
                            

            if($request->search_key) {

                $base_query = $base_query
                        ->where('name','LIKE','%'.$request->search_key.'%');
            }
    
            if($request->status!=''){
    
                $base_query->where('is_approved',$request->status);
    
            }

            $sub_categories = $base_query->orderBy('sub_categories.created_at', 'desc')->paginate(10);

            foreach ($sub_categories as $key => $sub_category_details) {

                $sub_category_details->videos_count = AdminVideo::where('sub_category_id', $sub_category_details->id)->count();
                

            }


            $sub_category_images = SubCategoryImage::where('sub_category_id' , $request->sub_category_id)
                                ->orderBy('position' , 'ASC')->get();

            return view('admin.categories.sub_categories.index')
                        ->with('page' , 'sub_categories')
                        ->with('sub_page','sub_categories-create')
                        ->with('category_details' , $category_details)
                        ->with('sub_category_images' , $sub_category_images)
                        ->with('sub_categories',$sub_categories);

        } catch (Exception $e) {

            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method sub_categories_create()
     *
     * @uses To create a sub_category object details
     *
     * @created Anjana H 
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return View page
     */
    public function sub_categories_create(Request $request) {

        $category_details = Category::find($request->category_id);

        $sub_category_details = new SubCategory;

        $sub_category_images = new SubCategoryImage; 

        return view('admin.categories.sub_categories.create')
                ->with('page' ,'categories')
                ->with('sub_page' ,'add-category')
                ->with('category_details' , $category_details)
                ->with('sub_category_details' , $sub_category_details)
                ->with('sub_category_images' , $sub_category_images);
    }

    /**
     * @method sub_categories_edit()
     *
     * @uses To display and update sub_category object details based on the sub_category id
     *
     * @created  Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $sub_category_id
     *
     * @return View page
     */
    public function sub_categories_edit(Request $request) {

        try {
          
            $sub_category_details = SubCategory::find($request->sub_category_id);

            if(!$sub_category_details) {

                throw new Exception( tr('admin_sub_category_not_found'), 101);
            } 

            $category_details = Category::find($request->category_id);

            $sub_category_images = SubCategoryImage::where('sub_category_id' , $request->sub_category_id)->orderBy('position' , 'ASC')->get();

            return view('admin.categories.sub_categories.create')
                    ->with('page' ,'categories')
                    ->with('sub_page' ,'add-category')
                    ->with('category_details' , $category_details)
                    ->with('sub_category_details' , $sub_category_details)
                    ->with('sub_category_images' , $sub_category_images);
        
        } catch( Exception $e) {
            
            

            return redirect()->route('admin.sub_categories.index')->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method sub_categories_save()
     *
     * @uses To save the sub_category object details of new/existing based on details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $sub_category_id , (request) sub_category details
     *
     * @return success/error message
     */
    public function sub_categories_save(Request $request) {

        try {
            
            DB::beginTransaction();

            $validator = Validator::make( $request->all(), array(
                            'category_id' => $request->category_id ? 'required|integer|exists:categories,id' : 'required|integer|exists:categories,id',
                            'sub_category_id' => $request->sub_category_id ? 'required|integer|exists:sub_categories,id' : '' ,
                            // 'name' => 'required|regex:/^[a-z\d\-. \'\s]+$/i|min:2|max:100',
                            'name' => 'required|min:2|max:100',
                            'picture1' => $request->category_id ? 'mimes:jpeg,jpg,bmp,png' : 'required|mimes:jpeg,jpg,bmp,png' ,
                    )
            );
           
            if($validator->fails()) {

                $error = implode(',', $validator->messages()->all());

                throw new Exception($error, 101);
                
            } 

            if($request->sub_category_id != '') {

                $sub_category = SubCategory::find($request->sub_category_id);

                $message = tr('admin_sub_category_update_success');

                if($request->hasFile('picture1')) {
                    
                    Helper::delete_picture($sub_category->picture1, "/uploads/images/sub_categories/");
                }

            } else {

                $message = tr('admin_sub_category_create_success');

                //Add New SubCategory
                $sub_category = new SubCategory;
                $sub_category->is_approved = DEFAULT_TRUE;
                $sub_category->created_by = ADMIN;
            }

            $sub_category->category_id = $request->has('category_id') ? $request->category_id : '';
            
            if($request->has('name')) {
                $sub_category->name = $request->name;
            }

            if( $request->has('description')) {
                $sub_category->description =  $request->description;   
            }

            if( $sub_category->save()) { // Otherwise it will save empty values

                DB::commit();
                
                if($request->hasFile('picture')) {

                    sub_category_image($request->file('picture') , $sub_category->id, 1, "/uploads/images/sub_categories/");
                }

                if($sub_category) {

                    if (Setting::get('track_user_mail')) {

                        user_track("StreamHash - Sub category Created");
                    }
                    
                    return redirect()->route('admin.sub_categories.view', ['category_id' => $sub_category->category_id ,'sub_category_id' => $sub_category->id] )->with('flash_success', $message);
                } 

            } 
           
            throw new Exception(tr('admin_sub_category_save_error'), 101);
       
        } catch (Exception $e) {

            DB::rollback();


            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method sub_categories_view()
     * 
     * @uses to display Sub Category details based on Sub Category id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return view page
     */
    public function sub_categories_view(Request $request) {

        try {
            
            $sub_category_details = SubCategory::find($request->sub_category_id);

            if(!$sub_category_details) {

                throw new Exception(tr('admin_sub_category_not_found'), 101);
            } 

            $sub_category_details = $sub_category_details->leftjoin('sub_category_images','sub_category_images.sub_category_id','=','sub_categories.id')
            ->where('sub_categories.id','=', $request->sub_category_id)->first();

            return view('admin.categories.sub_categories.view')
                        ->with('page' ,'categories')
                        ->with('sub_page' ,'categories-view')
                        ->with('sub_category_details' ,$sub_category_details);
           
        } catch (Exception $e) {

            

            return redirect()->route('admin.sub_categories.index',['category_id' => $request->category_id] )->with('flash_error',$e->getMessage());

        }

    }

    /**
     * @method sub_categories_status_change()
     *
     * @uses To update sub category is_approved to approved/declined based on sub category id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $sub_category_id
     *
     * @return success/error message
     */
    public function sub_categories_status_change(Request $request) {
        
        try {

            DB::beginTransaction();

            $sub_category_details = SubCategory::find($request->sub_category_id);

            if(!$sub_category_details) {

                throw new Exception(tr('admin_sub_category_not_found'), 101);
            }
            
            $sub_category_details->is_approved = $sub_category_details->is_approved == SUB_CATEGORY_APPROVED ? SUB_CATEGORY_DECLINED : SUB_CATEGORY_APPROVED ;
            
            $message = $sub_category_details->is_approved == SUB_CATEGORY_APPROVED ? tr('admin_sub_category_approved_success') : tr('admin_sub_category_declined_success');
           
            if( $sub_category_details->save() ) { 

                if ( $sub_category_details->is_approved == CATEGORY_DECLINED ) {

                    foreach($sub_category_details->adminVideo as $video) {    

                        $video->is_approved = $request->status;

                        if( $video->save() ) {


                        } else {

                            throw new Exception(tr('admin_sub_category_is_approve_save_error'), 101);
                        }
                    } 

                    foreach($sub_category_details->genres as $genre) {   

                        $genre->is_approved = CATEGORY_DECLINED;
                        
                        if( $genre->save() ) {

                        } else {

                            throw new Exception(tr('admin_sub_category_is_approve_save_error'), 101);
                        }
                    } 

                }

                DB::commit();
            
                return back()->with('flash_success', $message);
            }  

            throw new Exception(tr('admin_sub_category_is_approve_save_error'), 101);
            
        } catch (Exception $e) {
            
            DB::rollback();
            
            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method sub_categories_delete()
     * 
     * @uses To delete the category object based on category id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return success/failure message
     */
    public function sub_categories_delete(Request $request) {

        try {

            DB::beginTransaction();
            
            $sub_category_details = SubCategory::where('id' , $request->sub_category_id)->first();

            if(!$sub_category_details) {

                throw new Exception(tr('admin_sub_category_not_found'), 101);
            }

            $category_id = $sub_category_details->category_id;

            if( $sub_category_details->delete() ) {

                DB::commit();

                return redirect()->route('admin.sub_categories.index', ['category_id' => $category_id ])->with('flash_success',tr('admin_sub_category_delete_success'));
            } 

            throw new Exception(tr('admin_sub_category_delete_error'), 101);

        } catch (Exception $e) {
            
            DB::rollback();
            return back()->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method genres_index()
     * 
     * @uses To list the genres details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return view page
     */
    public function genres_index(Request $request) {

        $sub_category_details = SubCategory::find($request->sub_category_id);
       
        $genres = Genre::where('sub_category_id' , $request->sub_category_id)
                        ->leftjoin('sub_categories', 'sub_categories.id', '=', 'genres.sub_category_id')
                        ->leftjoin('categories', 'categories.id', '=', 'genres.category_id')
                        ->select('genres.id as genre_id',
                                 'categories.name as category_name',
                                 'sub_categories.name as sub_category_name',
                                 'genres.name as genre_name',
                                 'genres.video',
                                 'genres.subtitle',
                                 'genres.image',
                                 'genres.is_approved',
                                 'genres.created_at',
                                 'sub_categories.id as sub_category_id',
                                 'sub_categories.category_id as category_id',
                                    'genres.position as position')
                        ->orderBy('genres.created_at', 'desc')
                        ->paginate(10);

        return view('admin.categories.sub_categories.genres.index')
                    ->withPage('categories')
                    ->with('sub_page','view-categories')
                    ->with('sub_category_details' , $sub_category_details)
                    ->with('genres' , $genres);
    
    }

    /**
     * @method genres_create()
     * 
     * @uses To create a genres object details object based on sub category id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return success/failure message
     */
    public function genres_create(Request $request) {

        try {
            
            $sub_category_details = SubCategory::find($request->sub_category_id);

            if(!$sub_category_details) {
               throw new Exception(tr('admin_sub_category_not_found'), 101);
            }

            $genre_details = new Genre;
        
            return view('admin.categories.sub_categories.genres.create')
                    ->with('page' ,'categories')
                    ->with('sub_page' ,'add-category')
                    ->with('sub_category_details' , $sub_category_details)
                    ->with('genre_details', $genre_details);            

        } catch (Exception $e) {

            

            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method genres_edit()
     *
     * @uses To display and update genres object details based on the genres id
     *
     * @created  Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $sub_category_id, $genres_id
     *
     * @return View page
     */
    public function genres_edit(Request $request) {

        try {
            
            $sub_category_details = SubCategory::find($request->sub_category_id);

            if(!$sub_category_details) {

                throw new Exception(tr('admin_genre_not_found'), 101);
            }

            $genre_details = Genre::find($request->genre_id);
        
            return view('admin.categories.sub_categories.genres.edit')
                        ->with('page' ,'categories')
                        ->with('sub_page' ,'add-category')
                        ->with('sub_category_details' , $sub_category_details)
                        ->with('genre_details', $genre_details);

        } catch (Exception $e) {

            

            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method genres_save()
     *
     * @uses To save the gener object details of new/existing based on details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $gener_id , (request) gener details
     *
     * @return success/error message
     *
     */
    public function genres_save(Request $request) {

       try {
            
            $validator = Validator::make( $request->all(), array(
                    'category_id' => 'required|integer|exists:categories,id',
                    'sub_category_id' => 'required|integer|exists:sub_categories,id',
                    // 'name' => 'required|regex:/^[a-z\d\-.\s]+$/i|min:2|max:100',
                    'name' => 'required|min:2|max:100',
                    'video'=> $request->genre_id ? 'mimes:mkv,mp4,qt' : 'required|mimes:mkv,mp4,qt',
                    'image'=> $request->genre_id ? 'mimes:jpeg,jpg,bmp,png' : 'required|mimes:jpeg,jpg,bmp,png',
                )
            );

            if( $validator->fails() ) {

                $error = implode(',', $validator->messages()->all());

                throw new Exception($error, 101);
            }

            $genre_details = $request->genre_id ? Genre::find($request->genre_id) : new Genre;

            if( $genre_details->id ) {

                $position = $genre_details->position;

            } else {

                // To order the position of the genres
                $position = 1;

                if($check_position = Genre::where('sub_category_id' , $request->sub_category_id)
                                ->orderBy('position' , 'desc')
                                ->first()) {

                    $position = $check_position->position +1;
                } 
            }

            $genre_details->category_id = $request->category_id;
            $genre_details->sub_category_id = $request->sub_category_id;
            $genre_details->name = $request->name;

            $genre_details->position = $position;
            $genre_details->status = DEFAULT_TRUE;
            $genre_details->is_approved = GENRE_APPROVED;
            $genre_details->created_by = ADMIN;

            if($request->hasFile('video')) {

                if ($genre_details->id) {

                    if ($genre_details->video) {

                        Helper::delete_picture($genre_details->video, '/uploads/videos/original/');
                    }  
                }

                $video = Helper::video_upload($request->file('video'), 1);

                $genre_details->video = $video['db_url'];  
            }

            if( $request->hasFile('image') ) {

                if( $genre_details->id ) {

                    if ( $genre_details->image ) {

                        Helper::delete_picture($genre_details->image,'/uploads/images/genres/');  
                    }  
                }

                $genre_details->image =  Helper::normal_upload_picture($request->file('image'), '/uploads/images/genres/');
            }

            if($request->hasFile('subtitle')) {

                if( $genre_details->id ) {

                    if( $genre_details->subtitle ) {

                        Helper::delete_picture($genre_details->subtitle, SUBTITLE_PATH);
                    }  
                }

                $genre_details->subtitle =  Helper::subtitle_upload($request->file('subtitle'));
            }

            if( $genre_details->save() ) {

                DB::commit();

            } else {

                throw new Exception(tr('admin_genre_save_error'),101);
            }

            $message = ($request->genre_id) ? tr('admin_genre_update_success') : tr('admin_genre_create_success');

            $genre_details->unique_id = $genre_details->id;

            if( $genre_details->save() ) {

                DB::commit();

                if (Setting::get('track_user_mail')) {

                    user_track("StreamHash - Genre Created");
                }

                return back()->with('flash_success', $message);
            } 

            throw new Exception(tr('admin_genre_save_error'),101);
           
        } catch (Exception $e) {
            
            DB::rollback();
            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method genres_view()
     *
     * @uses To display the selected genre details
     *
     * @created Anjana H 
     *
     * @updated Anjana H
     *
     * @param -
     *
     * @return view page
     */
    public function genres_view(Request $request) {

        try {

            $genre_details = Genre::where('genres.id' , $request->genre_id)
                        ->leftJoin('categories' , 'genres.category_id' , '=' , 'categories.id')
                        ->leftJoin('sub_categories' , 'genres.sub_category_id' , '=' , 'sub_categories.id')
                        ->select('genres.id as genre_id' ,'genres.name as genre_name' , 
                                 'genres.position' , 'genres.status' , 
                                 'genres.is_approved' , 'genres.created_at as genre_date' ,
                                 'genres.created_by',
                                    'genres.video',
                                'genres.image',
                                 'genres.category_id as category_id',
                                 'genres.sub_category_id',
                                 'categories.name as category_name',
                                 'genres.unique_id',
                                 'genres.subtitle',
                                 'sub_categories.name as sub_category_name')
                        ->orderBy('genres.position' , 'asc')
                        ->first();

            if(!$genre_details) {

                throw new Exception(tr('admin_genre_not_found'), 101);
            }

            return view('admin.categories.sub_categories.genres.view')
                        ->withPage('categories')
                        ->with('sub_page','view-categories')
                        ->with('genre_details' , $genre_details);

        } catch (Exception $e) {

            return redirect()->route('admin.categories.index')->with('flash_error',$e->getMessage());
        }
        
    }

    /**
     * @method genre_position_change()
     *
     * Change position of the genre
     *
     * @param object $request - Genre id & position of the genre
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @return success/failure message
     */
    public function genre_position_change(Request $request) {

        try {

            DB::beginTransaction();

            $genre_details = Genre::find($request->genre_id);

            if(!$genre_details) {

                throw new Exception( tr('admin_genre_not_found'));
            }

            $changing_row_position = $genre_details->position;

            $change_genre = Genre::where('position', $request->position)
                            ->where('sub_category_id', $genre_details->sub_category_id)
                            ->where('is_approved', DEFAULT_TRUE)
                            ->first();

            if( !$change_genre ) {

                throw new Exception( tr('admin_given_position_not_exits'));
            }

            $new_row_position = $change_genre->position;

            $genre_details->position = $new_row_position;

            if( $genre_details->save() ) {

                DB::commit();

            } else {

                throw new Exception(tr('admin_genre_save_error'));
            }

            $change_genre->position = $changing_row_position;

            if( $change_genre->save() ) {

                DB::commit();

                return back()->with('flash_success', tr('admin_genre_position_updated_success'));

            } 
            
            throw new Exception(tr('admin_genre_save_error'));
           
        } catch (Exception $e) {

            DB::rollback();
            
            

            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method genres_status_change()
     *
     * @uses To update genre status to approve/decline based on genre id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $genre_id
     *
     * @return success/error message
     */
    public function genres_status_change(Request $request) {

        try {

            DB::beginTransaction();

            $genre_details = Genre::find($request->genre_id);

            if(!$genre_details) {

                throw new Exception(tr('admin_genre_not_found'));
            }

            $genre_details->is_approved = $genre_details->is_approved == APPROVED ? DECLINED : APPROVED ;

            $position = $genre_details->position;

            $sub_category_id = $genre_details->sub_category_id;

            if( $genre_details->is_approved == DECLINED ) {

                foreach($genre_details->adminVideo as $video) {

                    $video->is_approved = $request->status;

                    $video->save();
                }

                $next_genres = Genre::where('sub_category_id', $sub_category_id)
                                ->where('position', '>', $position)
                                ->orderBy('position', 'asc')
                                ->where('is_approved', DEFAULT_TRUE)
                                ->get();

                if($next_genres->count() > 0 ) {

                    foreach ($next_genres as $key => $value) {
                        
                        $value->position = $value->position - 1;

                        if ($value->save()) {

                            DB::commit();

                        } else {

                            throw new Exception(tr('admin_genre_save_error'));
                        }
                    }
                }

                $genre_details->position = 0;

            } else {

                $get_genre_position = Genre::where('sub_category_id', $sub_category_id)
                                ->orderBy('position', 'desc')
                                ->where('is_approved', DEFAULT_TRUE)
                                ->first();

                if( $get_genre_position ) {

                    $genre_details->position = $get_genre_position->position + 1;
                }
            }

            if ($genre_details->save()) {

                $message = $genre_details->is_approved == APPROVED ? tr('admin_genre_approve_success') : tr('admin_genre_decline_success') ;

                DB::commit();

                return back()->with('flash_success', $message); 
            } 

            throw new Exception(tr('admin_genre_is_approve_save_error'));
            
        } catch (Exception $e) {

            DB::rollback();

            return back()->with('flash_error', $e->getMessage());
        }    
    }

    /**
     * @method genres_delete()
     *
     * @uses to delete the selected genre
     *
     * @created  
     *
     * @updated 
     *
     * @param 
     *
     * @return view page
     */
    public function genres_delete(Request $request) {

        try {

            DB::beginTransaction();
            
            $genre_details = Genre::where('id',$request->genre_id)->first();
            
            if(!$genre_details) {

                throw new Exception(tr('admin_genre_not_found'), 101);
            }

            Helper::delete_picture($genre_details->image,'/uploads/images/'); 

            if ($genre_details->video) {

                Helper::delete_picture($genre_details->video, '/uploads/videos/original/');   
            }

            if ($genre_details->subtitle) {

                Helper::delete_picture($genre_details->subtitle, SUBTITLE_PATH);
            }  

            $position = $genre_details->position;

            $sub_category_id = $genre_details->sub_category_id;

            if( $genre_details->delete()) {

                $next_genres = Genre::where('sub_category_id', $sub_category_id)
                        ->where('position', '>', $position)
                        ->orderBy('position', 'asc')
                        ->where('is_approved', DEFAULT_TRUE)
                        ->get();

                if($next_genres->count() > 0 ) {

                    foreach ($next_genres as $key => $value) {
                        
                        $value->position = $value->position - 1;

                        $value->save();
                    }
                }

                DB::commit();

                return back()->with('flash_success', tr('admin_not_genre_del'));
            } 

            throw new Exception(tr('genre_not_saved'),101);
            
        } catch (Exception $e) {

            DB::rollback();


            return back()->with('flash_error',$e->getMessage());
        }
    
    }
    
    /**
     * @method pages_index()
     * 
     * @uses To list the static_pages
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param
     *
     * @return view page
     */
    public function pages_index() {

        $pages = Page::orderBy('created_at' , 'desc')->paginate(10);

        return view('admin.pages.index')
                    ->with('page','pages')
                    ->with('sub_page','pages-view')
                    ->with('pages',$pages);
    }

    /**
     * @method pages_create()
     *
     * @uses To list out pages object details
     *
     * @created Anjana H 
     *
     * @updated Anjana H
     *
     * @param
     *
     * @return View page
     */
    public function pages_create() {

        $page_details = new Page;

        $section_types = static_page_footers($section_type = 0, $is_list = YES);

        return view('admin.pages.create')
                    ->with('page' , 'pages')
                    ->with('sub_page',"pages-create")
                    ->with('page_details', $page_details)
                    ->with('section_types', $section_types);
    }
      
    /**
     * @method pages_edit()
     *
     * @uses To display and update pages object details based on the pages id
     *
     * @created  Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $static_page_id
     *
     * @return View page
     */
    public function pages_edit(Request $request) {

        try {
          
            $page_details = Page::find($request->page_id);

            if(!$page_details) {

                throw new Exception( tr('admin_page_not_found'), 101);
            } 

            $section_types = static_page_footers($section_type = 0, $is_list = YES);

            return view('admin.pages.edit')
                    ->with('page' , 'pages')
                    ->with('sub_page','pages-view')
                    ->with('page_details',$page_details)
                        ->with('section_types',$section_types);

        } catch( Exception $e) {
            
            

            return redirect()->route('admin.pages.index')->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method pages_save()
     *
     * @uses To save the page object details of new/existing based on details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $page_id , (request) page details
     *
     * @return success/error message
     */
    public function pages_save(Request $request) {

        try {
            
            DB::beginTransaction();

            $validator = Validator::make($request->all() , array(
                'type' => $request->page_id ? '' : 'required',
                'heading' => $request->page_id ? 'required|max:255|unique:pages,heading,'.$request->page_id : 'required|max:255|unique:pages,heading',
                'description' => 'required',
            ));

            if( $validator->fails() ) {

                $error = implode(',',$validator->messages()->all());

                throw new Exception($error, 101);                
            }

            if($request->has('page_id')) {

                $page_details = Page::find($request->page_id);

            } else {
                
                if(Page::count() < Setting::get('no_of_static_pages')) {

                    if( $request->type != 'others' ) {

                        $check_page_type = Page::where('type',$request->type)->first();
                        
                        if($check_page_type){

                            throw new Exception(tr('admin_page_exists').$request->type , 101);
                        }
                    }
                    
                    $page_details = new Page;
                    
                } else {

                    throw new Exception(tr('admin_page_exists').$request->type , 101);
                }                    
            }

            if($page_details) {

                $page_details->type = $request->type ?: $page_details->type;

                $page_details->heading = $request->heading ?: $page_details->heading;

                $page_details->section_type = $request->section_type ?: $page_details->section_type;

                $page_details->description = $request->description ?: $page_details->description;

                $unique_id = $request->type ?: $page_details->type;

                // Dont change the below code. If any issue, get approval from vithya and change

                if(!in_array($unique_id, ['about', 'privacy', 'terms', 'contact', 'help', 'faq'])) {

                    $unique_id = routefreestring($request->heading ?? rand());

                    $unique_id = in_array($unique_id, ['about', 'privacy', 'terms', 'contact', 'help', 'faq']) ? $unique_id : $unique_id;

                }

                $page_details->unique_id = $unique_id ?? rand();

                if($page_details->save() ) {

                    DB::commit();

                    $message = $request->page_id ? tr('admin_page_update_success') : tr('admin_page_create_success');

                    return redirect()->route('admin.pages.view', ['page_id' => $page_details->id])->with('flash_success', $message);

                }

                throw new Exception(tr('admin_page_save_error'), 101);                
            }
            
            throw new Exception(tr('admin_page_save_error'), 101);
                
        } catch (Exception $e) {
            
            DB::rollback();

            return back()->withInput()->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method pages_view()
     * 
     * @uses To display pages details based on pages id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $page_id
     *
     * @return view page
     */
    public function pages_view(Request $request) {

        try {

            $page_details = Page::find($request->page_id);
            
            if(!$page_details) {

                throw new Exception(tr('admin_page_not_found'), 101);
            }

            return view('admin.pages.view')
                    ->with('page' ,'pages')
                    ->with('sub_page' ,'pages-view')
                    ->with('page_details' ,$page_details);

        } catch (Exception $e) {

            


            return redirect()->route('admin.pages.index')->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method pages_delete()
     * 
     * @uses To delete the page object based on page id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return success/failure message
     */
    public function pages_delete(Request $request) {

        try {

            DB::beginTransaction();
            
            $page_details = Page::where('id' , $request->page_id)->first();

            if(!$page_details) {  

                throw new Exception(tr('admin_page_not_found'), 101);
            }

            Helper::delete_picture($page_details->picture, "/uploads/images/pages/");
            
            if( $page_details->delete() ) {

                DB::commit();

                return redirect()->route('admin.pages.index')->with('flash_success',tr('admin_page_delete_success'));
            } 

            throw new Exception(tr('admin_page_delete_error'), 101);               
            
        } catch (Exception $e) {
            
            DB::rollback();

            return back()->with('flash_error',$e->getMessage());
        }
    }

    
    /**
     * @method cast_crews_index()
     *
     * @uses To list out details of cast and crews
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return response of html page with details
     */
    public function cast_crews_index(Request $request) {

        $base_query = CastCrew::orderBy('created_at', 'desc');

        if($request->search_key) {

            $base_query = $base_query
                    ->where('name','LIKE','%'.$request->search_key.'%');
        }

        if($request->status!=''){

            $base_query->where('status',$request->status);

        }

        $cast_crews = $base_query->paginate(10);

        foreach($cast_crews as $key=>$crew){
          
        $crew->videos_count = VideoCastCrew::where('cast_crew_id',$crew->id)->count();
   
        }

        return view('admin.cast_crews.index')
                ->with('page', 'cast-crews')
                ->with('sub_page', 'cast-crews-view')
                ->with('cast_crews', $cast_crews);
    }

    /**
     * @method cast_crews_create()
     *
     * @uses To create a CastCrew object details
     *
     * @created Anjana H 
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return View page
     */
    public function cast_crews_create() {

        $cast_crew_details = new CastCrew;

        return view('admin.cast_crews.create')
                    ->with('page' , 'cast-crews')
                    ->with('sub_page','cast-crews-create')
                    ->with('cast_crew_details',$cast_crew_details);
    }

    /**
     * @method cast_crews_edit()
     *
     * @uses To display and update cast_crew object details based on the cast_crew id
     *
     * @created  Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $cast_crew_id
     *
     * @return View page
     */
    public function cast_crews_edit(Request $request) {

        try {
          
            $cast_crew_details = CastCrew::find( $request->cast_crew_id );

            if(!$cast_crew_details) {

                throw new Exception( tr('admin_cast_crew_not_found'), 101);
            }

            return view('admin.cast_crews.edit')
                        ->with('page' , 'cast-crews')
                        ->with('sub_page','cast-crews-view')
                        ->with('cast_crew_details', $cast_crew_details);
            
        } catch( Exception $e) {
            
            


            return redirect()->route('admin.cast_crews.index')->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method cast_crews_save()
     *
     * @uses To save the details of the cast and crews
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) cast_crew_id, details
     *
     * @return success/failure message
     */
    public function cast_crews_save(Request $request) {

        try {
                
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'cast_crew_id'=>'exists:cast_crews,id',
                'name'=>'required|min:2|max:128',
                'image'=>$request->cast_crew_id ? 'mimes:jpeg,jpg,png' : 'required|mimes:jpeg,png,jpg',
                'description'=>'required'
            ]);

            if( $validator->fails() ) {

                $error = implode(',', $validator->messages()->all());

                throw new Exception($error);
            } 

            $cast_crew_details = $request->cast_crew_id ? CastCrew::where('id', $request->cast_crew_id)->first() : new CastCrew;

            $cast_crew_details->name = $request->name;

            $cast_crew_details->unique_id = $cast_crew_details->name;

            if ($request->hasFile('image')) {

                if ($request->cast_crew_id) {

                    Helper::storage_delete_file($cast_crew_details->image, CAST_CREWS_FILE_PATH);
                }

                $cast_crew_details->image = Helper::storage_upload_file($request->file('image'),CAST_CREWS_FILE_PATH);
            }

            $cast_crew_details->description = $request->description;

            $cast_crew_details->status = DEFAULT_TRUE; // By default it will be 1, future it may vary

            if( $cast_crew_details->save() ) {

                DB::commit();

                $message = $request->cast_crew_id ? tr('admin_cast_crew_update_success') : tr('admin_cast_crew_create_success'); 

                return redirect()->route('admin.cast_crews.view', ['cast_crew_id'=>$cast_crew_details->id] )->with('flash_success',$message );
            } 

            throw new Exception(tr('admin_cast_crew_save_error'));

        } catch (Exception $e) {

            DB::rollback();
            
            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method cast_crews_view()
     *
     * @uses To display cast_crew details based on cast_crew id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $cast_crew_id 
     *
     * @return view page
     */
    public function cast_crews_view(Request $request) {

        try {
               
            $cast_crew_details = CastCrew::find( $request->cast_crew_id );
            
            if(!$cast_crew_details) {

                throw new Exception(tr('admin_cast_crew_not_found'), 101);
            } 

            return view('admin.cast_crews.view')
                        ->with('page','cast-crews')
                        ->with('sub_page','cast-crews-view')
                        ->with('cast_crew_details' , $cast_crew_details);
            
        } catch( Exception $e) {

            return redirect()->route('admin.cast_crews.index')->with('flash_error',$e->getMessage());
        }

    } 

    /**
     * @method cast_crews_delete()
     * 
     * @uses To delete the cast_crew object based on cast_crew id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return success/failure message
     */
    public function cast_crews_delete(Request $request) {

        try {
            
            DB::beginTransaction();

            $cast_crew_details = CastCrew::where('id',$request->cast_crew_id)->first();

            $image = $cast_crew_details->image;

            if( $cast_crew_details->delete() ) {
                
                DB::commit();
                
                if ($image) {

                    Helper::storage_delete_file($image, CAST_CREWS_FILE_PATH);
                }

                return redirect(route('admin.cast_crews.index'))->with('flash_success', tr('cast_crew_delete_success'));
            }

            throw new Exception(tr('admin_cast_crew_delete_error'), 101);
                   
        } catch( Exception $e) {

            DB::rollback();

            

            return redirect()->route('admin.cast_crews.index')->with('flash_error',$e->getMessage());
        }
    }
    
    /**
     * @method cast_crews_status_change()
     *
     * @uses To update cast_crew is_approved to approved/declined based on cast_crew id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $cast_crew_id
     *
     * @return success/error message
     */
    public function cast_crews_status_change(Request $request) {

        try {
            
            DB::beginTransaction();

            $cast_crew_details = CastCrew::where('id', $request->cast_crew_id)->first();

            if(!$cast_crew_details) {

                throw new Exception(tr('cast_crew_not_found'), 101);
            }

            $cast_crew_details->status = $cast_crew_details->status == CAST_APPROVED ? CAST_DECLINED : CAST_APPROVED;

            if( $cast_crew_details->save() ) {

                if ( $cast_crew_details->status == CAST_DECLINED) {

                    if($cast_crew_details->videoCastCrews->count() > 0 ) {


                        foreach($cast_crew_details->videoCastCrews as $value) {

                            $value->delete();  
                            
                        }
                    }
                }

                DB::commit();

                $message = $cast_crew_details->status == CAST_APPROVED ? tr('cast_crew_approve_success') : tr('cast_crew_decline_success'); 

                return redirect()->route('admin.cast_crews.index')->with('flash_success',$message);
            
            } 
                
            throw new Exception(tr('cast_crew_status_error'), 101);
            
        } catch (Exception $e) {
            
            DB::rollback();
            return redirect()->route('admin.cast_crews.index')->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method coupons_index()
     *
     * @uses list out coupon details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param -
     *
     * @return view page
     */
    public function coupons_index(Request $request) {

        $base_query = Coupon::orderBy('updated_at','desc');

        if($request->search_key) {

            $base_query->where(function ($query) use ($request) {
                $query->where('coupon_code','LIKE','%'.$request->search_key.'%');
                $query->orWhere('coupons.title','LIKE','%'.$request->search_key.'%');
            });
        }


        if($request->amount_type!=''){

            $base_query->where('amount_type',$request->amount_type);

        }

        $coupons = $base_query->paginate(10);

        return view('admin.coupons.index')
                    ->with('page','coupons')
                    ->with('sub_page','coupons-view')
                    ->with('coupons',$coupons);    
    }

    /**
     * @method coupons_create()
     *
     * @uses To create a counpon details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param -
     *
     * @return view page
     */
    public function coupons_create() {

        $coupon_details = new Coupon;

        $coupon_details->expiry_date = date('Y-m-d');

        return view('admin.coupons.create')
                ->with('page','coupons')
                ->with('sub_page','coupons-create')
                ->with('coupon_details', $coupon_details);
    }

    /**
     * @method coupons_edit() 
     *
     * @uses Edit the coupon details and get the coupon edit form for 
     *
     * @created Anjana H
     *
     * @updated Anjana
     *
     * @param Coupon id
     *
     * @return Get the html form
     */
    public function coupons_edit(Request $request){

        try {

            $coupon_details = Coupon::find( $request->coupon_id );

            if(!$coupon_details){

                throw new Exception(tr('admin_coupon_not_found'), 101);
            } 

            return view('admin.coupons.edit')
                        ->with('page','coupons')
                        ->with('sub_page','coupons-view')
                        ->with('coupon_details',$coupon_details);
            
        } catch(Exception $e) {

            return redirect()->back()->with('flash_error',$e->getMessage());
        }   

    }

    /**
     * @method coupons_save()
     *
     * @uses To save the coupon object details of new/existing based on details
     *
     * @created Maheswari
     *
     * @updated Anjana H
     *
     * @param request coupon_id, details
     *
     * @return success/error message
     */
    public function coupons_save(Request $request){

        try {
            
            $validator = Validator::make($request->all(),[
                'id'=>'exists:coupons,id',
                'title'=>'required',
                'coupon_code'=>$request->coupon_id ? 'required|max:10|min:1|unique:coupons,coupon_code,'.$request->coupon_id : 'required|unique:coupons,coupon_code|min:1|max:10',
                'amount'=>'required|numeric|min:1|max:5000',
                'amount_type'=>'required',
                'expiry_date'=>'required|date_format:d-m-Y|after:today',
                'no_of_users_limit'=>'required|numeric|min:1|max:1000',
                'per_users_limit'=>'required|numeric|min:1|max:100',
            ]);

            if( $validator->fails() ) {

                $error = implode(',',$validator->messages()->all());

                throw new Exception( $error, 101);                
            }

            if( $request->coupon_id != '' ) {
                        
                    $coupon_detail = Coupon::find($request->coupon_id); 

                    $message=tr('admin_coupon_update_success');

            } else {

                $coupon_detail = new Coupon;

                $coupon_detail->status = APPROVED;

                $message = tr('admin_coupon_create_success');
            }

            // Check the condition amount type equal zero mean percentage
            
            if( $request->amount_type == PERCENTAGE ) {

                // Amount type zero must should be amount less than or equal 100 only
                if($request->amount <= 100){

                    $coupon_detail->amount_type = $request->has('amount_type') ? $request->amount_type :DEFAULT_FALSE;
     
                    $coupon_detail->amount = $request->has('amount') ?  $request->amount : '';

                } else {

                    throw new Exception(tr('admin_coupon_amount_lessthan_100'), 101);
                }

            } else {

                // This else condition is absoulte amount 

                // Amount type one must should be amount less than or equal 5000 only
                if( $request->amount <= 5000 ) {

                    $coupon_detail->amount_type=$request->has('amount_type') ? $request->amount_type : DEFAULT_TRUE;

                    $coupon_detail->amount=$request->has('amount') ?  $request->amount : '';

                } else {

                    throw new Exception(tr('admin_coupon_amount_lessthan_5000'), 101);
                }
            }

            $coupon_detail->title=ucfirst($request->title);

            // Remove the string space and special characters
            $coupon_code_format  = preg_replace("/[^A-Za-z0-9\-]+/", "", $request->coupon_code);

            // Replace the string uppercase format
            $coupon_detail->coupon_code = strtoupper($coupon_code_format);

            // Convert date format year,month,date purpose of database storing
            $coupon_detail->expiry_date = date('Y-m-d',strtotime($request->expiry_date));
          
            $coupon_detail->description = $request->has('description')? $request->description : '' ;
             // Based no users limit need to apply coupons
            $coupon_detail->no_of_users_limit = $request->no_of_users_limit;

            $coupon_detail->per_users_limit = $request->per_users_limit;

            $coupon_detail->description = $request->description ?? '';
            
            if( $coupon_detail ) {

                if( $coupon_detail->save() ) {

                    DB::commit();

                    return redirect()->route('admin.coupons.view',['coupon_id' => $coupon_detail->id])->with('flash_success',$message);
                } 

                throw new Exception(tr('admin_coupon_save_error'), 101);
            } 

            throw new Exception(tr('admin_coupon_not_found'), 101);             
                                  
        } catch(Exception $e) {
            DB::rollback();

            return redirect()->back()->withInput()->with('flash_error',$e->getMessage());
        }
        
    }

    /**
     * @method coupons_delete()
     *
     * @uses Delete the particular coupon detail
     *
     * @created Maheswari
     *
     * @updated Anjana H
     *
     * @param integer $id
     *
     * @return Deleted Success message
     */
    public function coupons_delete(Request $request) {

        try {
            
            DB::beginTransaction();

            $coupon_details = Coupon::find($request->coupon_id);

            if(!$coupon_details) {

                throw new Exception(tr('admin_coupon_not_found'), 101);
            } 

            if($coupon_details->delete()) {

                DB::commit();

                return redirect()->route('admin.coupons.index')->with('flash_success',tr('coupon_delete_success'));
            } 

            throw new Exception(tr('admin_coupon_delete_error'), 101);
           
        } catch( Exception $e) {
            
            DB::rollback();

            return back()->with('flash_error',$e->getMessage());
        }
        
    }

    /**
     * @method coupons_view()
     *
     * @uses To display coupon details based on coupon_id
     *
     * @created Maheswari
     *
     * @updated Anjana H
     *
     * @param Integer (request() $coupon_id
     *
     * @return view page
     */
    public function coupons_view(Request $request) {

        try {

            $coupon_details = Coupon::find($request->coupon_id);

            if(!$coupon_details){

                throw new Exception(tr('admin_coupon_not_found'), 101);
            }

            $used_coupon_count = UserCoupon::where('coupon_code',$coupon_details->coupon_code)->sum('no_of_times_used');

            return view('admin.coupons.view')
                    ->with('page','coupons')
                    ->with('sub_page','coupons-view')
                    ->with('coupon_details',$coupon_details)
                    ->with('used_coupon_count', $used_coupon_count);
        
        } catch(Exception $e) {


            return redirect()->back()->with('flash_error',$e->getMessage());
        }  
    }

    /**
     * @method coupons_status_change()
     * 
     * @uses Coupon status for active and inactive update the status function
     *
     * @created Maheswari
     *
     * @updated Anjana H
     *
     * @param integer $coupon_id
     *
     * @return Success message for active/inactive
     */
    public function coupons_status_change(Request $request) {

        try {
            
            DB::beginTransaction();

            $coupon_details = Coupon::find($request->coupon_id);

            if(!$coupon_details){

                throw new Exception(tr('admin_coupon_not_found'), 101);    
            } 

            $coupon_details->status = $coupon_details->status == APPROVED ? DECLINED : APPROVED;

            if( $coupon_details->save() ) { 

                DB::commit();

                $message = $coupon_details->status == APPROVED ? tr('admin_coupon_approved_success') : tr('admin_coupon_declined_success');

                return back()->with('flash_success',$message);
            } 

            throw new Exception(tr('admin_coupon_status_save_error'), 101);
            
        } catch(Exception $e) {
            
            DB::rollback();


            return redirect()->back()->with('flash_error',$e->getMessage());
        } 
        
    }

    /**
     * @method subscriptions_index()
     * 
     * @uses To list the subscriptions
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param
     *
     * @return view page
     */
    public function subscriptions_index(Request $request) {

        $base_query = Subscription::orderBy('id','desc')->whereNotIn('status', [DELETE_STATUS]);
        

        if($request->search_key) {

            $base_query = $base_query->where('title','LIKE','%'.$request->search_key.'%');
        }

        if($request->status!=''){

            $base_query->where('status',$request->status);
        }

        $subscriptions = $base_query->paginate(10);

        foreach ($subscriptions as $key => $subscription_details) {

            $user_ids = UserPayment::where('subscription_id' , $subscription_details->id)->where('status' , 1)->pluck('user_id')->toArray();

            $subscription_details->subscribers_count = User::whereIn('id' , $user_ids)->count();
            
        }        

        return view('admin.subscriptions.index')
                    ->with('page','subscriptions')
                    ->with('sub_page','subscriptions-view')
                    ->with('subscriptions',$subscriptions);
    }

    /**
     * @method subscriptions_create()
     *
     * @uses To create subscription object 
     *
     * @created Anjana H 
     *
     * @updated Anjana H
     *
     * @param
     *
     * @return View page
     */
    public function subscriptions_create() {

        $subscription_details = new Subscription;

        return view('admin.subscriptions.create')
                    ->with('page','subscriptions')
                    ->with('sub_page','subscriptions-create')
                    ->with('subscription_details', $subscription_details);
    }

    /**
     * @method subscriptions_edit()
     *
     * @uses To display and update subscription object details based on the subscription id
     *
     * @created  Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $subscription_id
     *
     * @return View page
     */
    public function subscriptions_edit(Request $request) {

        try {
          
            $subscription_details = Subscription::find($request->subscription_id);

            if(!$subscription_details){

                throw new Exception( tr('admin_subscription_not_found'), 101);
            }

            return view('admin.subscriptions.edit')
                    ->with('page' , 'subscriptions')
                    ->with('sub_page','subscriptions-view')
                    ->with('subscription_details', $subscription_details);           

        } catch( Exception $e) {
            
            

            return redirect()->route('admin.subscriptions.index')->with('flash_error',$e->getMessage());
        }

    }
    
    /**
     * @method subscriptions_save()
     *
     * @uses To save the subscription object details of new/existing based on details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $subscription_id , (request) subscription details
     *
     * @return success/error message
     */
    public function subscriptions_save(Request $request) {

        try {
            
            DB::beginTransaction();
            
            $validator = Validator::make($request->all(),[
                'title' => $request->subscription_id ? 'required|max:255|unique:subscriptions,title,NULL,id,status,1'.$request->subscription_id : 'required|max:255|unique:subscriptions,title,NULL,id,status,1',
                'plan' => 'required|numeric|min:1|max:12',
                'amount' => 'required|numeric',
                'no_of_account'=>'required|numeric|min:1',
            ]);
            
            if( $validator->fails() ) {

                $error = implode(',', $validator->messages()->all() );

                throw new Exception($error, 101);
            } 

            if( $request->popular_status == TRUE ) {

                Subscription::where('popular_status' , TRUE )->update(['popular_status' => FALSE]);
            }

            if( $request->subscription_id != '' ) {

                $subscription_details = Subscription::find($request->subscription_id);

                $subscription_details->update($request->all());

            } else {

                $subscription_details = Subscription::create($request->all());

                $subscription_details->status = APPROVED ;

                $subscription_details->popular_status = $request->popular_status == APPROVED ? APPROVED  : DECLINED ;

                $subscription_details->unique_id = $subscription_details->title;

                $subscription_details->no_of_account = $request->no_of_account;
            } 

            if( $subscription_details->save() ) { 

                DB::commit();

                $message = $request->subscription_id ? tr('admin_subscription_update_success') : tr('admin_subscription_create_success');
                
                return redirect()->route('admin.subscriptions.view', ['subscription_id' => $subscription_details->id] )->with('flash_success', $message);

            } 
            
            throw new Exception(tr('admin_subscription_save_error'), 101);
            
            
        } catch (Exception $e) {

            DB::rollback();
            
            

            return redirect()->route('admin.subscriptions.index')->with('flash_error',$e->getMessage());
        }    
        
    }

    /**
     * @method subscriptions_view()
     * 
     * @uses To display subscription details based on subscription id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $subscriptions_id
     *
     * @return view page
     */
    public function subscriptions_view(Request $request) {

        try {

            $subscription_details = Subscription::find($request->subscription_id);
            
            if(!$subscription_details){

                throw new Exception(tr('admin_subscription_not_found'), 101);                
            } 

            $earnings = $subscription_details->userSubscription()->where('status' , APPROVED)->sum('amount');

            $total_subscribers = $subscription_details->userSubscription()->where('status' , APPROVED)->count();

            return view('admin.subscriptions.view')
                        ->with('page' ,'subscriptions')
                        ->with('sub_page' ,'subscriptions-view')
                        ->with('subscription_details' , $subscription_details)
                        ->with('total_subscribers', $total_subscribers)
                        ->with('earnings', $earnings);
           

        } catch (Exception $e) {

            

            return redirect()->route('admin.subscriptions.index')->with('flash_error',$e->getMessage());

        }

    }

    /**
     * @method subscriptions_delete()
     * 
     * @uses To delete the subscription object based on subscription id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return success/failure message
     */
    public function subscriptions_delete(Request $request) {

        try {

            DB::beginTransaction();

            $subscription_details = Subscription::find($request->subscription_id);

            $subscription_details->status = DELETE_STATUS;

            if( $subscription_details->save() ) {

                DB::commit();
                
                return redirect()->route('admin.subscriptions.index')->with('flash_success', tr('admin_subscription_delete_success'));

            } 
                
            throw new Exception(tr('admin_subscription_delete_error'), 101);
        
        } catch( Exception $e) {
            
            DB::rollback();
            
            

            return redirect()->route('admin.subscriptions.index')->with('flash_error',$e->getMessage());
        }
    }


    /**
     * @method subscriptions_popular_status()
     * 
     * @uses To update subscription's popular_status to APPROVED/DECLINED based on subscription id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return success/failure message
     */
    public function subscriptions_popular_status(Request $request) {

        try {
            
            DB::beginTransaction();

            if($request->has('subscription_id')) {  
            
                $subscription_details = Subscription::where('id', $request->subscription_id)->first();
                
                if(!$subscription_details){

                    throw new Exception(tr('admin_subscription_not_found'), 101);
                }

                $subscription_details->popular_status  = $subscription_details->popular_status == APPROVED ? DECLINED : APPROVED ;

                $message = $subscription_details->popular_status ? tr('admin_subscription_popular_success') : tr('admin_subscription_remove_popular_success'); 
                
                if( $subscription_details->save() ) { 

                    DB::commit();

                    return back()->with('flash_success' , $message);                
                } 

                throw new Exception(tr('admin_subscription_populor_status_error'), 101);
            } 
            
            throw new Exception( tr('try_again'), 101);
            
        } catch (Exception $e) {

            DB::rollback();
            
            

            return redirect()->route('admin.subscriptions.index')->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method subscriptions_users()
     * 
     * @uses To update subscription's popular_status to APPROVED/DECLINED based on subscription id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return success/failure message
     */
    public function subscriptions_users(Request $request) {

        try {

            if($request->has('subscription_id')) {     

                $user_ids = [];

                $user_payments = UserPayment::where('subscription_id' , $request->subscription_id)->select('user_id')->get();

                foreach ($user_payments as $key => $value) {

                    $user_ids[] = $value->user_id;
                }

                $subscription_details = Subscription::find($request->subscription_id);

                $title = tr('view_users') . " - " . $subscription_details->title ;
                
                $total_users = User::whereIn('id' , $user_ids)->orderBy('id','desc')->count();

                $total_approved = User::whereIn('id' , $user_ids)->orderBy('id','desc')->where('is_activated', USER_APPROVED)->count();

                $total_declined = User::whereIn('id' , $user_ids)->where('is_activated', USER_DECLINED)->count();        
                        
                $base_query = User::whereIn('id' , $user_ids)->orderBy('created_at','desc');

                if($request->search_key) {

                    $base_query = $base_query
                            ->orWhere('name','LIKE','%'.$request->search_key.'%')
                            ->orWhere('email','LIKE','%'.$request->search_key.'%')
                            ->orWhere('mobile','LIKE','%'.$request->search_key.'%');
                }

                if($request->sort == 'declined') {

                    $base_query = $base_query->where('is_activated', USER_DECLINED);

                    $title = tr('declined_users');
                }

                $users = $base_query->paginate(10);

                $users->total_approved = $total_approved;
                
                $users->total_declined = $total_declined;

                $users->total_users = $total_users;

                return view('admin.users.index')
                        ->withPage('subscriptions')
                        ->with('sub_page','subscriptions-view')
                        ->with('users' , $users)
                        ->with('search_key', $request->search_key)
                        ->with('sort', $request->sort)
                        ->with('title', $title)
                        ->with('user_payments' , $user_payments)
                        ->with('subscription_details' , $subscription_details);
            }  

            throw new Exception(tr('admin_subscription_not_found'), 101);
            
        } catch (Exception $e) {

            

            return redirect()->route('admin.subscriptions.index')->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method subscriptions_status_change()
     *
     * @uses To update subscription status to approve/decline based on subscription id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $subscription_id
     *
     * @return success/error message
     */
    public function subscriptions_status_change(Request $request) {

        try {

            DB::beginTransaction();
       
            $subscription_details = Subscription::find($request->subscription_id);

            if(!$subscription_details){
                
                throw new Exception(tr('admin_subscription_not_found'), 101);
            } 
            
            $subscription_details->status = $subscription_details->status == APPROVED ? DECLINED : APPROVED;

            $message = $subscription_details->status == APPROVED ? tr('admin_subscription_approved_success') : tr('admin_subscription_declined_success');

            if( $subscription_details->save() ) {

                DB::commit();

                return back()->with('flash_success',$message);
            } 
            
            throw new Exception(tr('admin_subscription_status_save_error'), 101);
           
        } catch( Exception $e) {

            DB::rollback();
            
            

            return redirect()->route('admin.subscriptions.index')->with('flash_error',$e->getMessage());
        }

    }    

    /**
     * @method users_subscriptions()
     *
     * @uses To display subscriptions based on user id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $user_id
     *
     * @return success/error message
     */
    public function users_subscriptions(Request $request) {

        try {

            $payments = UserPayment::orderBy('created_at' , 'desc')
                        ->where('user_id' , $request->user_id)->get();

            $free_subscription = $payments->where('amount','=',0.00)->pluck('subscription_id') ?? [];

            $user_details = User::find($request->user_id);

            $subscriptions = Subscription::orderBy('created_at','desc')
                            ->whereNotIn('status', [DELETE_STATUS])
                            ->when($free_subscription, function ($q) use ($free_subscription) {
                                if($free_subscription->count() >= 1)
                                {
                                    return $q->whereNotIn('id', $free_subscription);
                                }
                            })->get();

            return view('admin.subscriptions.user_plans')
                        ->withPage('users')   
                        ->with('sub_page','users-view')
                        ->with('subscriptions' , $subscriptions)
                        ->with('user_id', $request->user_id)
                        ->with('user_details', $user_details)
                        ->with('payments', $payments); 
            
        } catch (Exception $e) {

            return redirect()->back()->with('flash_error',$e->getMessage());
        }            
    }

    /**
     * @method users_subscription_save()
     *
     * @uses To save user subscription based on subscription and user id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $subscription_id, $user_id
     *
     * @return success/error message
     */
    public function users_subscriptions_save(Request $request) {

        try {

            DB::beginTransaction();

            $user_payment_details = UserPayment::where('user_id' , $request->user_id)->where('status', DEFAULT_TRUE)->orderBy('id', 'desc')->first();

            $uses_payment = new UserPayment();

            $uses_payment->subscription_id = $request->subscription_id;

            $uses_payment->user_id = $request->user_id;

            $uses_payment->subscription_amount = ($uses_payment->subscription) ? $uses_payment->subscription->amount  : 0;

            $uses_payment->amount = ($uses_payment->subscription) ? $uses_payment->subscription->amount  : 0;

            $uses_payment->payment_id = ($uses_payment->amount > 0) ? uniqid(str_replace(' ', '-', 'PAY')) : 'Free Plan'; 

            if ($user_payment_details) {

                if (strtotime($user_payment_details->expiry_date) >= strtotime(date('Y-m-d H:i:s'))) {

                 $uses_payment->expiry_date = date('Y-m-d H:i:s', strtotime("+{$uses_payment->subscription->plan} months", strtotime($user_payment_details->expiry_date)));

                } else {

                    $uses_payment->expiry_date = date('Y-m-d H:i:s',strtotime("+{$uses_payment->subscription->plan} months"));
                }

            } else {

                $uses_payment->expiry_date = date('Y-m-d H:i:s',strtotime("+{$uses_payment->subscription->plan} months"));
            }

            $uses_payment->status = DEFAULT_TRUE;

            if( $uses_payment->save() )  {

                $uses_payment->user->user_type = DEFAULT_TRUE;

                $uses_payment->user->expiry_date = $uses_payment->expiry_date;

                if( $uses_payment->user->save() ) {

                    DB::commit();

                    return back()->with('flash_success', tr('admin_subscription_applied_success'));                
                }

                throw new Exception(tr('admin_user_subascription_save_error'), 101);
            } 

            throw new Exception(tr('admin_user_subascription_save_error'), 101);
            
        } catch (Exception $e) {
            
            DB::rollback();
            
            return back()->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method users_auto_subscription_enable()
     *
     * To prevent automatic subscriptioon, user have option to cancel subscription
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param (request) - User details & payment details
     *
     * @return success/failure message
     */
    public function users_auto_subscription_enable(Request $request) {
        
        try {

            $user_payment = UserPayment::where('user_id', $request->user_id)->where('status', PAID_STATUS)->orderBy('created_at', 'desc')
                ->where('is_cancelled', AUTORENEWAL_CANCELLED)
                ->first();

            if(!$user_payment){

                throw new Exception(tr('user_payment_details_not_found'), 101);
            }  

            $user_payment->is_cancelled = AUTORENEWAL_ENABLED;

            $user_payment->save();

            return back()->with('flash_success', tr('autorenewal_enable_success'));
        
        } catch (Exception $e) {

            return back()->with('flash_error',$e->getMessage());
        }     

    }  

    /**
     * @method users_auto_subscription_disable()
     *
     * @uses To prevent automatic subscriptioon of user,user has option to cancel subscription
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param $request - User details & payment details
     *
     * @return success/failure message
     */
    public function users_auto_subscription_disable(Request $request) {

        try {
            
            DB::beginTransaction();

            $user_payment = UserPayment::where('user_id', $request->user_id)->where('status', PAID_STATUS)->orderBy('created_at', 'desc')->first();

            if(!$user_payment){

                throw new Exception(tr('admin_user_payment_details_not_found'), 101);
            } 

            $user_payment->is_cancelled = AUTORENEWAL_CANCELLED;

            $user_payment->cancel_reason = $request->cancel_reason;

            if ($user_payment->save()) {
               
                DB::commit();

                return back()->with('flash_success', tr('admin_cancel_subscription_success'));            
            }

            throw new Exception(tr('admin_subscription_save_error'), 101);                            
        } catch (Exception $e) {
            
            DB::rollback();
            return back()->with('flash_error',$e->getMessage());
        }      

    }

    /**
     * @method revenue_dashboard()
     *
     * @uses To display revenue details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return success/error message
     */

    public function revenue_dashboard() {
        
        $total_sub_revenue = UserPayment::sum('amount');

        $total_revenue = $total_sub_revenue ? $total_sub_revenue : 0;

        // Video Payments

        $live_video_amount = PayPerView::sum('amount');

        $video_amount = $live_video_amount ? $live_video_amount : 0;

        $live_user_amount = PayPerView::sum('moderator_amount');

        $user_amount = $live_user_amount ? $live_user_amount : 0;

        $final = PayPerView::where('admin_amount', '=', 0)->where('moderator_amount', '=', 0)->sum('amount');

        $live_admin_amount = PayPerView::sum('admin_amount');

        $admin_amount = $live_admin_amount + $final;
        
        $video_amount = $live_video_amount;


        // $wallet_revenue = CustomWalletPayment::where('wallet_type', CW_WALLET_TYPE_DIRECT)->where('status', YES)->sum('paid_amount'); 

        return view('admin.payments.revenue_dashboard')
                    ->with('page', 'payments')
                    ->with('sub_page', 'revenue_system')
                    ->with('total_revenue',$total_revenue)
                    ->with('video_amount', $video_amount)
                    ->with('user_amount', $user_amount)
                    ->with('admin_amount', $admin_amount ? $admin_amount : 0);
                    // ->with('wallet_revenue', $wallet_revenue)
    }

    /**
     * @method profile()
     * 
     * @uses admin profile details 
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param - 
     *
     * @return view page
     */
    public function profile() {

        $id = Auth::guard('admin')->user()->id;

        $admin_details = Admin::find($id);

        return view('admin.accounts.profile')
                    ->withPage('profile')
                    ->with('sub_page','')
                    ->with('admin_details' , $admin_details);
    }

    /**
     * @method profile_save()
     * 
     * @uses save admin updated profile details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param - 
     *
     * @return view page
     */
    public function profile_save(Request $request) {
        try {
            
            DB::beginTransaction();

            $validator = Validator::make( $request->all(), [
                    'name' => 'regex:/^[a-zA-Z]*$/|max:100',
                    'email' => $request->id ? 'email:rfc,dns|email|max:255|unique:admins,email,'.$request->id : 'email:rfc,dns|required|email|max:255|unique:admins,email,NULL',
                    'mobile' => 'digits_between:4,16',
                    'address' => 'nullable|max:300',
                    'id' => 'required|exists:admins,id',
                    'picture' => 'nullable|mimes:jpeg,jpg,png'
                ]
            );
            
            if( $validator->fails() ) {
             
                $error = implode(',', $validator->messages()->all());

                throw new Exception($error, 101);                
            } 
                
            $admin_details = Admin::find($request->id);
            
            $admin_details->name = $request->has('name') ? $request->name : $admin_details->name;

            $admin_details->email = $request->has('email') ? $request->email : $admin_details->email;

            $admin_details->mobile = $request->has('mobile') ? $request->mobile : $admin_details->mobile;

            $admin_details->gender = $request->has('gender') ? $request->gender : $admin_details->gender;

            $admin_details->address = $request->has('address') ? $request->address : $admin_details->address;

            if($request->hasFile('picture')) {
                
                Helper::storage_delete_file($admin_details->picture, PROFILE_PATH_ADMIN);

                $admin_details->picture = Helper::storage_upload_file($request->picture,PROFILE_PATH_ADMIN);
            }
                
            $admin_details->remember_token = Helper::generate_token();
            
            $admin_details->is_activated = APPROVED;
            
            if( $admin_details->save() ) {

                DB::commit();

                return back()->with('flash_success', tr('admin_profile_update_success'));
            } 

            throw new Exception(tr('admin_profile_save_error'), 101);
                        
        } catch (Exception $e) {
               
            DB::rollback();

            return redirect()->route('admin.profile')->with('flash_error',$e->getMessage());
        }
    
    }

    /**
     * @method change_password()
     * 
     * @uses change the admin password 
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param - 
     *
     * @return redirect with success/ error message
     */
    public function change_password(Request $request) {
        
        try {
            
            DB::beginTransaction();

            $old_password = $request->old_password;
            
            $new_password = $request->password;
            
            $confirm_password = $request->confirm_password;
            
            $validator = Validator::make($request->all(), [              
                    'password' => 'required|confirmed|min:6',
                    'old_password' => 'required',
                    'password_confirmation' => 'required|min:6',
                    'id' => 'required|exists:admins,id'
                ]);

            if( $validator->fails() ) {

                $error = implode(',',$validator->messages()->all());

                throw new Exception($error, 101);
            } 

            $admin_details = Admin::find($request->id);

            if( Hash::check($old_password,$admin_details->password) ) {
                
                $admin_details->password = Hash::make( $new_password );
               
                if( $admin_details->save() ) {

                    DB::commit();

                    Auth::guard('admin')->logout();

                    return redirect()->route('admin.login')->with('flash_success', tr('admin_password_change_success'));

                }                 
                
                throw new Exception(tr('admin_password_save_error'), 101);
                               
            } else {

                throw new Exception(tr('admin_password_mismatch'), 101);
            }

            $response = response()->json($response_array,$response_code);

            return $response;
            
        } catch (Exception $e) {  
            
            DB::rollback();
            
            

            return redirect()->route('admin.profile')->with('flash_error',$e->getMessage());
        }
    
    }

    /**
     * @method settings()
     * 
     * @uses To display settings details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param - 
     *
     * @return success/error message
     */   
    public function settings() {

        $settings = array();

        $result = EnvEditorHelper::getEnvValues();

        $languages = Language::where('status', DEFAULT_TRUE)->get();

        $currencies = Currency::all();

        return view('admin.settings.settings')
                ->withPage('settings')
                ->with('sub_page','site_settings')
                ->with('settings' , $settings)
                ->with('result', $result)
                ->with('languages' , $languages)
                ->with('currencies' , $currencies);
    
    }

    /**
     * @method settings_save()
     * 
     * @uses to update settings details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param
     *
     * @return success/error message
     */
    public function settings_save(Request $request) {

        try {
            
            DB::beginTransaction();

            foreach( $request->toArray() as $key => $value) {
              
                $check_settings = Settings::where('key' ,'=', $key)->count();

                if ($check_settings == 0) {

                    throw new Exception( $key.tr('admin_settings_key_not_found'), 101);
                }

                if($request->hasFile($key)) {

                    Helper::storage_delete_file($key, SETTINGS_PATH); // check this line

                    $mime = $request->file($key)->getMimeType();
                    
                    if($mime == 'video/mp4' || $mime == 'video/mov' || $mime == 'video/x-m4v' || $mime == 'video/avi' || $mime == 'video/mp4') {

                        $video_details = Helper::video_upload($request->file($key), DEFAULT_TRUE,"/uploads/settings/");

                        $file_path = $video_details['db_url'];
                        
                    } else {

                        $file_path = Helper::storage_upload_file($request->file($key), SETTINGS_PATH);
                    } 

                    $result = Settings::where('key' ,'=', $key)->update(['value' => $file_path]); 
               
                } else {

                    if ($key == "site_name") {

                        $site_name = preg_replace("/[^A-Za-z0-9]/", "", $value);

                        \Enveditor::set("SITENAME", $site_name);
                        
                        \Enveditor::set("MAIL_FROM_NAME", $site_name);

                    }

                    if($key == "HLS_STREAMING_URL") {

                        Settings::where('key' ,'=', "HLS_STREAMING_URL")->update(['value' => $value]); 

                        Settings::where('key' ,'=', "RTMP_SECURE_VIDEO_URL")->update(['value' => $value]); 

                        Settings::where('key' ,'=', "HLS_SECURE_VIDEO_URL")->update(['value' => $value]); 

                        Settings::where('key' ,'=', "streaming_url")->update(['value' => $value]);
                    }
                    
                    if($key == "currency_code") {

                        $currency = Currency::where('currency_code', $value)->first();
                        
                        Settings::where('key' ,'=', "currency")->update(['value' => $currency->currency]); 

                    }

                    $result = Settings::where('key' ,'=', $key)->update(['value' => $value]); 

                    if( $result == TRUE ) {
                     
                        DB::commit();
                   
                    } else {

                        throw new Exception(tr('admin_settings_save_error'), 101);
                    }   
                }  
            }

            Helper::settings_generate_json();
            
            Helper::home_settings_generate_json();

            return back()->with('flash_success', tr('admin_settings_key_save_success') );
            
        } catch (Exception $e) {

            DB::rollback();


            return back()->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method common_settings_save()
     * 
     * @uses to update settings details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param
     *
     * @return success/error message
     */
    public function common_settings_save(Request $request) {

        try {
             
            $settings = array();

            $admin_id = \Auth::guard('admin')->user()->id;

            $redeem_paypal_url = $request->PAYPAL_MODE == LIVE ? "https://www.paypal.com/cgi-bin/webscr" : "https://www.sandbox.paypal.com/cgi-bin/webscr";

            $request->request->add(['redeem_paypal_url' => $redeem_paypal_url]);

            \Session::put('flash_success', tr('admin_settings_key_save_success'));  

            foreach($request->all() as $key => $data ) {

                if(\Enveditor::set($key, $data)) { 
                    
                    // do nothing on success update
                    Settings::where('key' ,'=', $key)->update(['value' => $data]);

                } else {


                    $setting_details = Settings::where('key' ,'=', $key)->first() ?: new Settings;

                    $setting_details->key = $key;

                    $setting_details->value = $data;

                    if($setting_details->save()) {
                   
                    } else {


                        throw new Exception(tr('admin_settings_save_error'), 101);
                    }     
                }
            }
           
            Helper::settings_generate_json();
            
            Helper::home_settings_generate_json();

            return redirect()->route('clear-cache')->with('setting', $settings);

            
        } catch (Exception $e) {

            return back()->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method video_settings_save()
     * 
     * @uses to update settings details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param
     *
     * @return success/error message
     */
    public function video_settings_save(Request $request) {

        try {
            
            DB::beginTransaction();

            $settings = Settings::all();

            foreach( $request->all() as $key => $data) {

                \Enveditor::set($key, $data);
            }

            foreach( $request->toArray() as $key => $value) {
              
                if($request->hasFile($key)) {

                    Helper::storage_delete_file($key, SETTINGS_PATH); // check this line

                    $mime = $request->file($key)->getMimeType();
                    
                    if($mime == 'video/mp4' || $mime == 'video/mov' || $mime == 'video/x-m4v' || $mime == 'video/avi' || $mime == 'video/mp4') {

                        $video_details = Helper::video_upload($request->file($key), DEFAULT_TRUE,"/uploads/settings/");

                        $file_path = $video_details['db_url'];
                        
                    } else {

                        $file_path = Helper::storage_upload_file($request->file($key), SETTINGS_PATH);
                    } 

                    $result = Settings::where('key' ,'=', $key)->update(['value' => $file_path]); 
               
                } else {

                    if($key == "HLS_STREAMING_URL") {

                        Settings::where('key' ,'=', "HLS_STREAMING_URL")->update(['value' => $value]); 

                        Settings::where('key' ,'=', "RTMP_SECURE_VIDEO_URL")->update(['value' => $value]); 

                        Settings::where('key' ,'=', "HLS_SECURE_VIDEO_URL")->update(['value' => $value]); 

                        Settings::where('key' ,'=', "streaming_url")->update(['value' => $value]);
                    }
                    
                    $result = Settings::where('key' ,'=', $key)->update(['value' => $value]); 

                    if($result == TRUE){
                     
                        DB::commit();
                   
                    }  
                }  
            }

            Helper::settings_generate_json();
            
            Helper::home_settings_generate_json();

            return back()->with('flash_success', tr('admin_settings_key_save_success'));
            
        } catch (Exception $e) {

            DB::rollback();


            return back()->with('flash_error',$e->getMessage());
        }

    }

    /**
     * Functiont Name: home_page_settings()
     * 
     * @uses to display/update the user home page content settings
     * 
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return view page
     */
    public function home_page_settings() {

        return view('admin.settings.home_page')
                    ->with('page','settings')
                    ->with('sub_page','home_page_settings');

    }

    public function payment_settings() {

        $settings = array();

        return view('admin.payment-settings')
                    ->withPage('payment-settings')
                    ->with('sub_page','')
                    ->with('settings' , $settings); 
    }

    /**
     * Functiont Name: custom_push()
     * 
     * @uses to display/update Custom Push notification
     * 
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return view page
     */
    public function custom_push() {

        $is_push_enabled = envfile('FCM_SERVER_KEY') && envfile('FCM_SENDER_ID') && (Setting::get('is_push_notification') == ON);

        return view('admin.static_pages.push')
                    ->with('page' , "custom-push")
                    ->with('title' , "Custom Push")
                    ->with('is_push_enabled' , $is_push_enabled);

    }

    /**
     * Functiont Name: custom_push_save()
     * 
     * @uses to save Custom Push notification
     * 
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param $request details
     *
     * @return success/failure message
     */
    public function custom_push_save(Request $request) {

        try {
            
            $validator = Validator::make(
                $request->all(),[ 'message' => 'required' ]
            );

            if( $validator->fails() ) {

                $error = $validator->messages()->all();

                throw new Exception($error, 101);                
            } 

            $message = $request->message;

            $title = Setting::get('site_name');

            $message = $message;
            
            $id = 'all';

            $android_register_ids = User::where('is_activated', USER_APPROVED)->where('device_token' , '!=' , "")->where('device_token' , '!=' , "123456")->where('device_type' , DEVICE_ANDROID)->where('push_status' , ON)->pluck('device_token')->toArray();

            if($android_register_ids) {
                
                \Notification::send($android_register_ids, new PushNotify($title , $message, [], $android_register_ids));

            }

            $ios_register_ids = User::where('is_activated', USER_APPROVED)->where('device_type' , DEVICE_IOS)->where('device_token' , '!=' , "123456")->where('push_status' , ON)->pluck('device_token')->toArray();
            
            if($ios_register_ids) {
                
                \Notification::send($android_register_ids, new PushNotify($title , $message, [], $ios_register_ids));

            }

            $total_android = count($android_register_ids);

            $total_ios = count($ios_register_ids);

            if($total_android <= 0 && $total_ios <= 0) {

                throw new Exception(tr('admin_custom_push_no_users'), 101);

            }

            $message = "<h4>".tr('admin_push_notification_success')."</h4>";

            $message .= "<br> <p>Total Android Users: $total_android</p>";

            $message .= "<br> <p>Total iOS Users: $total_ios</p>";

            return back()->with('flash_success', $message);
       
        } catch (Exception $e) {

            return back()->with('flash_error',$e->getMessage());
        }
    }
    
    /**
     * Functiont Name: help()
     * 
     * @uses: to display help details
     * 
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return view page
     */
    public function help() {

        return view('admin.static_pages.help')
                    ->withPage('help')
                    ->with('sub_page' , "");
    }

    /**
     * @method user_payments()
     * 
     * @uses used to list the user_payments
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param
     *
     * @return view page
     */
    public function user_payments(Request $request) {

        $base_query = UserPayment::leftJoin('subscriptions' , 'subscriptions.id' , '=' , 'user_payments.subscription_id')
                        ->leftJoin('users' , 'users.id' , '=' , 'user_payments.user_id')
                        ->select(
                            'user_payments.*'
                        );


        if($request->search_key) {

            $base_query->where(function ($query) use ($request) {
                $query->where('users.name','LIKE','%'.$request->search_key.'%');
                $query->orWhere('subscriptions.title','LIKE','%'.$request->search_key.'%');
                $query->orWhere('user_payments.payment_mode','LIKE','%'.$request->search_key.'%');
                $query->orWhere('user_payments.payment_id','LIKE','%'.$request->search_key.'%');
            });
        }

        

        if($request->status!=''){
          
            $base_query->where('user_payments.status',$request->status);

        }

        $payments = $base_query->orderBy('user_payments.created_at' , 'desc')->paginate(10);
        
        $payment_count = UserPayment::count();

        return view('admin.payments.user_payments')
                    ->with('page','payments')
                    ->with('sub_page','user-payments')
                    ->with('payments' , $payments)
                    ->with('payment_count', $payment_count); 
    }
    
    /**
     * @method video_payments()
     * 
     * @uses To list the Pay Per View
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param
     *
     * @return view page
     */
    public function video_payments(Request $request) {

        $base_query = PayPerView::leftJoin('admin_videos' , 'admin_videos.id' , '=' , 'pay_per_views.video_id')
                    ->leftJoin('users' , 'users.id' , '=' , 'pay_per_views.user_id')
                    ->select(
                        'pay_per_views.*'
                    );
        

        if($request->search_key) {

            $base_query->where(function ($query) use ($request) {
                $query->where('users.name','LIKE','%'.$request->search_key.'%');
                $query->orWhere('admin_videos.title','LIKE','%'.$request->search_key.'%');
                $query->orWhere('pay_per_views.payment_mode','LIKE','%'.$request->search_key.'%');
                $query->orWhere('pay_per_views.payment_id','LIKE','%'.$request->search_key.'%');
            });
        }
        

        if($request->status!=''){
          
            $base_query->where('pay_per_views.status',$request->status);
           
        }

        $payments = $base_query->orderBy('pay_per_views.created_at' , 'desc')->paginate(10);

        $payment_count = PayPerView::count();

        $dd = DB::getQueryLog($base_query);
        //dd($payments);
      
        return view('admin.payments.ppv_payments')
                    ->withPage('payments')
                    ->with('sub_page','video-subscription')
                    ->with('payment_count',$payment_count)
                    ->with('payments' , $payments); 
    }


    /**
     * @method mailcamp_create()
     * 
     * @uses To display mail camp form  
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param
     *
     * @return view page
     */
    public function mailcamp_create() {

        $users = User::select('users.id','users.name','users.email',
                                'users.is_activated','users.is_verified',
                                'users.amount_paid')
                            ->where('is_activated',TRUE)
                            ->where('email_notification', TRUE)
                            ->where('is_verified',TRUE)
                            ->get();

        $moderators = Moderator::select('moderators.id','moderators.name',
                                    'moderators.email','moderators.is_activated')
                            ->where('is_activated',TRUE)
                            ->get();

         return view('admin.mail_camp')
                    ->with('users',$users)
                    ->with('moderators',$moderators)
                    ->with('page','mail_camp');
    }
    
    /**
     * @method email_send_process()
     *
     * @uses To send emails(email camp) to chosen role(USERS,MODERATORS,CUSTOM_USERS)
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param $request details
     *
     * @return success/failure message
     */
    public function email_send_process(Request $request) {  

        try {
            $validator = Validator::make($request->all(),[
                'to'=>'required|in:'.USERS.','.MODERATORS.','.CUSTOM_USERS,
                'users_type'=>'in:'.ALL_USER.','.NORMAL_USERS.','.PAID_USERS.','.SELECT_USERS.','.ALL_MODERATOR.','.SELECT_MODERATOR,
                'subject'=>'required|min:5|max:255',
                'content'=>'required|min:5',
                ],
                [
                    'to.required' => 'Select To Field to Send Email',
                    'content.required' => 'Fill the Content Fiels',
                ]
            );

            if ($validator->fails()) {

                $error = implode(',',$validator->messages()->all());

                throw new Exception($error, 101);                
            }
          
            if ($request->to == USERS) {

                $base_query = User::select('users.id')->where('is_activated', DEFAULT_TRUE)->where('is_verified', DEFAULT_TRUE)->where('email_notification', ON);

                switch ($request->users_type) {

                    case ALL_USER:
                        $email_details = $base_query->pluck('users.id');
                        break;

                    case NORMAL_USERS:

                        $email_details = $base_query->where('user_type',0)->pluck('users.id');

                        break;

                    case PAID_USERS:
                        $email_details = $base_query->where('user_type',1 )->pluck('users.id');
                        break; 

                    case SELECT_USERS:
                        $email_details = $base_query->whereIn('id',$request->select_user)->pluck('users.id');
                        break;

                    default:
                        throw new Exception(tr('admin_user_type_not_found'), 101);
                }

            } else if ($request->to == MODERATORS) {

                switch ($request->users_type) {

                    case ALL_MODERATOR:
                        $email_details = Moderator::where('is_activated', DEFAULT_TRUE)->pluck('id');
                        break;

                    case SELECT_MODERATOR:
                        $email_details = Moderator::whereIn('id',$request->select_moderator)->pluck('id');
                        break;

                    default:
                        throw new Exception(tr('admin_moderator_not_found'), 101);
                }

            } else if ($request->to == CUSTOM_USERS) {

                $custom_user = $request->custom_user;
                
                if ($custom_user != '') {

                    $email_details = explode(',', $custom_user);
                    
                    if (Setting::get('custom_users_count') >= count($email_details)) {

                        foreach ($email_details as $key => $value) {   

                            Log::info('Custom Mail list : '.$value);

                            if (!filter_var($value,FILTER_VALIDATE_EMAIL)) {

                                //This variable is only for email validate messsage purpose only 
                                $validate_email = DEFAULT_FALSE;

                                $invalid_email[] = $value;

                                $message = tr('custom_email_invalid');

                                $error = implode(' , ' , $invalid_email);

                                throw new Exception($error, 101);                                

                            } else {

                                //This variable is only for email validate messsage purpose only  using
                                $validate_email = DEFAULT_TRUE;
                                                                   
                                // Get the custom user name before @ symbol
                                $name =  substr($value, 0, strrpos($value, "@"));

                                $email_data['subject'] = $request->subject;

                                $email_data['page'] = "emails.send_mail";

                                $email_data['name'] = $name;

                                $email_data['email'] = $value;

                                $email_data['content'] = $request->content;

                                $this->dispatch(new SendEmailJob($email_data));

                                return back()->with('flash_success',tr('mail_send_successfully'));

                            }                            
                        }

                    } else{

                        throw new Exception(tr('custom_user_count'), 101);
                    }

                } else {

                    throw new Exception(tr('custom_user_field_required'), 101);
                }
                    
            } else { 

                throw new Exception(tr('admin_user_not_found'), 101);
            }
        
            foreach($email_details->chunk(50) as $key => $user_ids) { 

                $users_moderator_type = $request->to;

                $subject = $request->subject;
                        
                $content = $request->content;

                dispatch(new SendMailCamp($user_ids,$subject,$content,$users_moderator_type));

            }

            return back()->with('flash_success',tr('mail_send_successfully'));

            throw new Exception(tr('details_not_found'), 101);
            
        } catch (Exception $e) {

            

            return back()->with('flash_error',$e->getMessage());
        }
    } 

    /**
     * @method templates_index()
     *
     * @uses To display email templates
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param 
     *
     * @return view page
     */
    public function templates_index(Request $request) {

        $templates = EmailTemplate::orderBy('created_at', 'desc')->get();

        return view('admin.email_templates.index')
                ->with('templates', $templates)
                ->with('page', 'email_templates')
                ->with('sub_page', 'email_templates');

    }

    /**
     * @method templates_edit()
     *
     * @uses To display and update email template based on template_id
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $template_id
     *
     * @return view page
     */
    public function templates_edit(Request $request) {

        try {
            
            $template_details = EmailTemplate::find($request->template_id);

            $template_types = [USER_WELCOME => tr('user_welcome_email'), 
                                ADMIN_USER_WELCOME => tr('admin_created_user_welcome_mail'), 
                                FORGOT_PASSWORD => tr('forgot_password'), 
                                MODERATOR_WELCOME=>tr('moderator_welcome'), 
                                PAYMENT_EXPIRED=>tr('payment_expired'), 
                                PAYMENT_GOING_TO_EXPIRY=>tr('payment_going_to_expiry'), 
                                NEW_VIDEO=>tr('new_video'), 
                                EDIT_VIDEO=>tr('edit_video')];

            if (!$template_details) {

                throw new Exception(tr('template_not_found'), 101);
            }

            return view('admin.email_templates.edit')
                        ->with('page', 'email_templates')
                        ->with('sub_page', 'create_template')
                        ->with('template_details', $template_details)
                        ->with('template_types', $template_types);

        } catch (Exception $e) {

            return back()->with('flash_error',$e->getMessage());
        }
    } 

    /**
     * @method templates_save()
     *
     * @uses To save/update email template based on request details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $template_id, (request) details
     *
     * @return view page
     */
    public function templates_save(Request $request) {

        try {

            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'template_type'=>'required|in:'.USER_WELCOME.','.ADMIN_USER_WELCOME.','.FORGOT_PASSWORD.','.MODERATOR_WELCOME.','. PAYMENT_EXPIRED.','.PAYMENT_GOING_TO_EXPIRY.','.NEW_VIDEO.','.EDIT_VIDEO,
                'subject'=>'required|max:255',
                'description'=>'required',
            ]);

            $template = $request->template_id ? EmailTemplate::find($request->template_id) : new EmailTemplate;

            if($template) {

                $template->subject = $request->subject;
                    
                $template->description = $request->description;

                $template->template_type = $request->template_type;

                $template->status = DEFAULT_TRUE;

                if ($template->save()) {

                    DB::commit();

                    $message = $request->template_id ? tr('admin_template_update_success') : tr('admin_template_create_success'); 

                    return redirect()->route('admin.templates.index')->with('flash_success', $message);

                } else {

                    throw new Exception(tr('admin_template_save_error'), 101);
                }

            } 

            throw new Exception(tr('admin_template_not_found'), 101);
           
        } catch(Exception $e) {

            DB::rollback();
            return back()->with('flash_error', $e->getMessage());
        }
    }

    /**
     * @method templates_view()
     *
     * @uses To disaply email template based on request details
     *
     * @created Anjana H
     *
     * @updated Anjana H
     *
     * @param Integer (request) $template_id
     *
     * @return view page
     */
    public function templates_view(Request $request) {

        try {

            $template_details = EmailTemplate::find($request->template_id);

            if(!$template_details) {

                throw new Exception(tr('admin_template_not_found'), 101);
            }   
            
            return view('admin.email_templates.view')
                        ->with('page', 'email_templates')
                        ->with('sub_page', 'templates')
                        ->with('template_details', $template_details);
            
        } catch (Exception $e) {

            return back()->with('flash_error',$e->getMessage());
        }

    } 


    /**
     * @method sub_admins_index()
     *
     * @uses To list out subadmins (only admin can access this option)
     * 
     * @created Anjana H
     *
     * @updated Anjana H  
     *
     * @param object $request
     *
     * @return view page
     */
    public function sub_admins_index(Request $request) {

        $total_sub_admins = Admin::orderBy('created_at', 'desc')->where('role', SUBADMIN)->count();
       
        $total_approved = Admin::orderBy('created_at', 'desc')->where('role', SUBADMIN)->Where('is_activated', APPROVED)->count();
        
        $total_declined = Admin::orderBy('created_at', 'desc')->where('role', SUBADMIN)->Where('is_activated', DECLINED)->count();
        
        $base_query = Admin::orderBy('created_at', 'desc')->where('role', SUBADMIN);

        $sub_page = 'sub-admins-view';

        $title = tr('sub_admin_view');

        if($request->has('sort')) {

            $sub_page = 'sub-admins-view-declined';

            $title = tr('declined_sub_admins');

            $base_query = $base_query->Where('is_activated', DECLINED);
        }

        if($request->search_key) {

            $base_query->where(function ($query) use ($request) {
                $query->where('admins.name', "like", "%" . $request->search_key . "%");
                $query->orWhere('admins.email', "like", "%" . $request->search_key . "%");
                $query->orWhere('admins.mobile', "like", "%" . $request->search_key . "%");
            });
        }


        if($request->status!=''){

         $base_query->where('admins.is_activated',$request->status);

        }

        
        
        $sub_admins = $base_query->paginate(10);
        
        $sub_admins->total_approved = $total_approved;
        
        $sub_admins->total_declined = $total_declined;
        
        $sub_admins->total_sub_admins = $total_sub_admins;

        return view('admin.sub_admins.index')
                ->with('page', 'sub-admins')
                ->with('sub_page', $sub_page)
                ->with('title', $title)
                ->with('sub_admins', $sub_admins);        
    }


    /**
     * @method sub_admins_create()
     *
     * To create a sub admin only admin can access this option
     * 
     * @created Anjana H
     *
     * @updated Anjana H  
     *
     * @param object $request 
     *
     * @return response of html page with details
     */
    public function sub_admins_create() {

        $sub_admin_details = new Admin();

        return view('admin.sub_admins.create')
                ->with('page', 'sub-admins')
                ->with('sub_page', 'sub-admins-create')
                ->with('sub_admin_details', $sub_admin_details);
    }

    /**
     * @method sub_admins_edit()
     *
     * @uses To edit a sub admin based on subadmin id only  admin can access this option
     * 
     * @created
     *
     * @updated 
     *
     * @param object $request - sub Admin Id
     *
     * @return response of html page with details
     */
    public function sub_admins_edit(Request $request) {

       try {
          
            $sub_admin_details = Admin::find($request->sub_admin_id);

            if(!$sub_admin_details) {

                throw new Exception( tr('admin_sub_admin_not_found'), 101); 
            }

            return view('admin.sub_admins.edit')
                        ->with('page', 'sub-admins')
                        ->with('sub_page', 'sub-admins-view')
                        ->with('sub_admin_details', $sub_admin_details);

        } catch( Exception $e) {
            
            return redirect()->route('admin.sub_admins.index')->with('flash_error', $e->getMessage());
        }
    }

    /**
     * @method sub_admins_view()
     *
     * @uses To view a sub admin based on sub admin id only admin can access this option
     * 
     * @created Anjana H
     *
     * @updated Anjana H  
     *
     * @param object $request - Sub Admin Id
     *
     * @return response of html page with details
     */
    public function sub_admins_view(Request $request) {

        try {
          
            $sub_admin_details = Admin::find($request->sub_admin_id);
            
            if(!$sub_admin_details) {

                throw new Exception( tr('admin_sub_admin_not_found'), 101);
            } 

            return view('admin.sub_admins.view')
                    ->with('page', 'sub-admins')
                    ->with('sub_page', 'sub-admins-view')
                    ->with('sub_admin_details', $sub_admin_details);
       
        } catch( Exception $e) {
            
            return redirect()->route('admin.sub_admins.index')->with('flash_error',$e->getMessage());
        }
    }


    /**
     * @method sub_admins_delete()
     *
     * @uses To delete a sub admin based on sub admin id. only admin can access this option
     * 
     * @created Anjana H
     *
     * @updated Anjana H  
     *
     * @param object $request - Sub Admin Id
     *
     * @return response of html page with details
     */
    public function sub_admins_delete(Request $request) {

         try {

            DB::beginTransaction();
            
            $sub_admin_details = Admin::where('id' , $request->sub_admin_id)->first();

            if(!$sub_admin_details) {  

                throw new Exception(tr('admin_sub_admin_not_found'), 101);
            }
            
            if( $sub_admin_details->delete() ) {

                DB::commit();

                Helper::storage_delete_file($sub_admin_details->picture, SUB_ADMIN_FILE_PATH);

                return redirect()->route('admin.sub_admins.index')->with('flash_success',tr('admin_sub_admin_delete_success'));
            }

            throw new Exception(tr('admin_sub_admin_delete_error'), 101);
            
        } catch (Exception $e) {
            
            DB::rollback();

            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method sub_admins_save()
     *
     * @uses To save the sub admin details
     * 
     * @created Anjana H
     *
     * @updated Anjana H  
     *
     * @param object $request - Sub Admin Id
     *
     * @return response of html page with details
     */
    public function sub_admins_save(Request $request) {

        try {
            
            DB::beginTransaction();

            $validator = Validator::make( $request->all(),array(
                    'name' => 'required|max:100',
                    'email' => $request->sub_admin_id ? 'email:rfc,dns|email|max:255|unique:admins,email,'.$request->sub_admin_id : 'email:rfc,dns|required|email|max:255|unique:admins,email,NULL',
                    'mobile' => 'digits_between:4,16',
                    'address' => 'nullable|max:300',
                    'sub_admin_id' => 'nullable|exists:admins,id',
                    'picture' => 'nullable|mimes:jpeg,jpg,png',
                    'description'=>'nullable|max:255',
                    'password' => $request->sub_admin_id ? '' : 'required|min:6|confirmed',
                )
            );
            
            if($validator->fails()) {

                $error = implode(',', $validator->messages()->all());

                throw new Exception($error, 101);
            } 

            $sub_admin_details = $request->sub_admin_id ? Admin::find($request->sub_admin_id) : new Admin;

            if (!$sub_admin_details) {

                throw new Exception(tr('sub_admin_not_found'), 101);
            }

            $sub_admin_details->name = $request->name ?: $sub_admin_details->name;

            $sub_admin_details->email = $request->email ?: $sub_admin_details->email;

            $sub_admin_details->mobile = $request->mobile ?: $sub_admin_details->mobile;

            $sub_admin_details->description = $request->description ?: '';

            $sub_admin_details->role = SUBADMIN;

            if(!$request->sub_admin_id) {
                
                $sub_admin_details->picture = asset('placeholder.png');

            }

            if($request->hasFile('picture')) {

                if($request->sub_admin_id) {

                    Helper::storage_delete_file($sub_admin_details->picture, SUB_ADMIN_FILE_PATH);
                }
                $sub_admin_details->picture = Helper::storage_upload_file($request->file('picture'), SUB_ADMIN_FILE_PATH);

            }
                
            if (!$sub_admin_details->id) {

                $new_password = $request->password;
                
                $sub_admin_details->password = Hash::make($new_password);
            }

            $sub_admin_details->timezone = $request->timezone;

            $sub_admin_details->token = Helper::generate_token();

            $sub_admin_details->token_expiry = Helper::generate_token_expiry();

            $sub_admin_details->is_activated = DEFAULT_TRUE;

            if($sub_admin_details->save()) {

                DB::commit();

                $message = $request->sub_admin_id ? tr('admin_sub_admin_update_success') : tr('admin_sub_admin_create_success');
                
                return redirect()->route('admin.sub_admins.view', ['sub_admin_id' =>$sub_admin_details->id ])->with('flash_success', $message);

            } 

            throw new Exception(tr('admin_sub_admin_save_error'), 101);
           
        } catch (Exception $e) {
            
            DB::rollback();
            
            return back()->withInput()->with('flash_error',$e->getMessage());
        }
    
    }

    /**
     * @method sub_admins_status()
     *
     * @uses To change the status of the sub admin, based on sub admin id. only admin can access this option
     * 
     * @created Anjana H
     *
     * @updated Anjana H  
     *
     * @param object $request - SubAdmin Id
     *
     * @return response of html page with details
     */
    public function sub_admins_status(Request $request) {

        try {

            DB::beginTransaction();
       
            $sub_admin_details = Admin::find($request->sub_admin_id);

            if(!$sub_admin_details) {  
                
                throw new Exception(tr('admin_sub_admin_not_found'), 101);
            } 
            
            $sub_admin_details->is_activated = $sub_admin_details->is_activated == APPROVED ? DECLINED : APPROVED;

            $message = $sub_admin_details->is_activated == APPROVED ? tr('admin_sub_admin_approve_success') : tr('admin_sub_admin_decline_success');

            if( $sub_admin_details->save() ) {

                DB::commit();

                return back()->with('flash_success', $message);
            } 

            throw new Exception(tr('admin_sub_admin_status_error'), 101);
            
        } catch( Exception $e) {

            DB::rollback();
            
            return redirect()->route('admin.sub_admins.index')->with('flash_error',$e->getMessage());
        }
    }


/**     store module start */

 /**
     * @method store_index()
     *
     * @uses To list out subadmins (only admin can access this option)
     * 
     * @created Anjana H
     *
     * @updated Anjana H  
     *
     * @param object $request
     *
     * @return view page
     */
    public function store_index(Request $request) {

        $total_store = Admin::orderBy('created_at', 'desc')->where('role', STORE)->count();
       
        $total_approved = Admin::orderBy('created_at', 'desc')->where('role', STORE)->Where('is_activated', APPROVED)->count();
        
        $total_declined = Admin::orderBy('created_at', 'desc')->where('role', STORE)->Where('is_activated', DECLINED)->count();
        
        $base_query = Admin::orderBy('created_at', 'desc')->where('role', STORE);

        $sub_page = 'store-view';

        $title = tr('store_view');

        if($request->has('sort')) {

            $sub_page = 'store-view-declined';

            $title = tr('declined_store');

            $base_query = $base_query->Where('is_activated', DECLINED);
        }

        if($request->search_key) {

            $base_query->where(function ($query) use ($request) {
                $query->where('admins.name', "like", "%" . $request->search_key . "%");
                $query->orWhere('admins.email', "like", "%" . $request->search_key . "%");
                $query->orWhere('admins.mobile', "like", "%" . $request->search_key . "%");
            });
        }


        if($request->status!=''){

         $base_query->where('admins.is_activated',$request->status);

        }

        
        
        $store = $base_query->paginate(10);
        
        $store->total_approved = $total_approved;
        
        $store->total_declined = $total_declined;
        
        $store->total_store = $total_store;

        return view('admin.store.index')
                ->with('page', 'store')
                ->with('sub_page', $sub_page)
                ->with('title', $title)
                ->with('store', $store);        
    }


    /**
     * @method store_create()
     *
     * To create a store only admin can access this option
     * 
     * @created Anjana H
     *
     * @updated Anjana H  
     *
     * @param object $request 
     *
     * @return response of html page with details
     */
    public function store_create() {

        $store_details = new Admin();

        return view('admin.store.create')
                ->with('page', 'store')
                ->with('sub_page', 'store-create')
                ->with('store_details', $store_details);    
    }

    /**
     * @method store_edit()
     *
     * @uses To edit a store based on store id only  admin can access this option
     * 
     * @created
     *
     * @updated 
     *
     * @param object $request - store Id
     *
     * @return response of html page with details
     */
    public function store_edit(Request $request) {

       try {
          
            $store_details = Admin::find($request->store_id);

            if(!$store_details) {

                throw new Exception( tr('store_admin_not_found'), 101); 
            }

            return view('admin.store.edit')
                        ->with('page', 'store')
                        ->with('sub_page', 'store-view')
                        ->with('store_details', $store_details);

        } catch( Exception $e) {
            
            return redirect()->route('admin.store.index')->with('flash_error', $e->getMessage());
        }
    }

    /**
     * @method store_view()
     *
     * @uses To view a  store based on  store id only admin can access this option
     * 
     * @created Anjana H
     *
     * @updated Anjana H  
     *
     * @param object $request -  store Id
     *
     * @return response of html page with details
     */
    public function store_view(Request $request) {

        try {
          
            $store_details = Admin::find($request->store_id);
            
            if(!$store_details) {

                throw new Exception( tr('admin_store_not_found'), 101);
            } 

            return view('admin.store.view')
                    ->with('page', 'store')
                    ->with('sub_page', 'store-view')
                    ->with('store_details', $store_details);
       
        } catch( Exception $e) {
            
            return redirect()->route('admin.store.index')->with('flash_error',$e->getMessage());
        }
    }


    /**
     * @method store_delete()
     *
     * @uses To delete a  store based on  store id. only admin can access this option
     * 
     * @created Anjana H
     *
     * @updated Anjana H  
     *
     * @param object $request -  store Id
     *
     * @return response of html page with details
     */
    public function store_delete(Request $request) {

         try {

            DB::beginTransaction();
            
            $store_details = Admin::where('id' , $request->store_id)->first();

            if(!$store_details) {  

                throw new Exception(tr('admin_store_not_found'), 101);
            }
            
            if( $store_details->delete() ) {

                DB::commit();

                Helper::storage_delete_file($store_details->picture, STORE_FILE_PATH);

                return redirect()->route('admin.store.index')->with('flash_success',tr('admin_store_delete_success'));
            }

            throw new Exception(tr('admin_store_delete_error'), 101);
            
        } catch (Exception $e) {
            
            DB::rollback();

            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method store_save()
     *
     * @uses To save the  store details
     * 
     * @created Anjana H
     *
     * @updated Anjana H  
     *
     * @param object $request -  store Id
     *
     * @return response of html page with details
     */
    public function store_save(Request $request) {

        try {
            
            DB::beginTransaction();

            $validator = Validator::make( $request->all(),array(
                    'name' => 'required|max:100',
                    'email' => $request->store_id ? 'email:rfc,dns|email|max:255|unique:admins,email,'.$request->store_id : 'email:rfc,dns|required|email|max:255|unique:admins,email,NULL',
                    'mobile' => 'digits_between:4,16',
                    'address' => 'nullable|max:300',
                    'store_id' => 'nullable|exists:admins,id',
                    'picture' => 'nullable|mimes:jpeg,jpg,png',
                    'description'=>'nullable|max:255',
                    'password' => $request->store_id ? '' : 'required|min:6|confirmed',
                )
            );
            
            if($validator->fails()) {

                $error = implode(',', $validator->messages()->all());

                throw new Exception($error, 101);
            } 

            $store_details = $request->store_id ? Admin::find($request->store_id) : new Admin;

            if (!$store_details) {

                throw new Exception(tr('store_not_found'), 101);
            }

            $store_details->name = $request->name ?: $store_details->name;

            $store_details->email = $request->email ?: $store_details->email;

            $store_details->mobile = $request->mobile ?: $store_details->mobile;

            $store_details->description = $request->description ?: '';

            $store_details->role = STORE;

            if(!$request->store_id) {
                
                $store_details->picture = asset('placeholder.png');

            }

            if($request->hasFile('picture')) {

                if($request->store_id) {

                    Helper::storage_delete_file($store_details->picture, STORE_FILE_PATH);
                }
                $store_details->picture = Helper::storage_upload_file($request->file('picture'), STORE_FILE_PATH);

            }
                
            if (!$store_details->id) {

                $new_password = $request->password;
                
                $store_details->password = Hash::make($new_password);
            }

            $store_details->timezone = $request->timezone;

            $store_details->token = Helper::generate_token();

            $store_details->token_expiry = Helper::generate_token_expiry();

            $store_details->is_activated = DEFAULT_TRUE;

            if($store_details->save()) {

                DB::commit();

                $message = $request->store_id ? tr('admin_store_update_success') : tr('admin_store_create_success');
                
                return redirect()->route('admin.store.view', ['store_id' =>$store_details->id ])->with('flash_success', $message);

            } 

            throw new Exception(tr('admin_store_save_error'), 101);
           
        } catch (Exception $e) {
            
            DB::rollback();
            
            return back()->withInput()->with('flash_error',$e->getMessage());
        }
    
    }

    /**
     * @method store_status()
     *
     * @uses To change the status of the sub admin, based on sub admin id. only admin can access this option
     * 
     * @created Anjana H
     *
     * @updated Anjana H  
     *
     * @param object $request - SubAdmin Id
     *
     * @return response of html page with details
     */
    public function store_status(Request $request) {

        try {

            DB::beginTransaction();
       
            $store_details = Admin::find($request->store_id);

            if(!$store_details) {  
                
                throw new Exception(tr('admin_store_not_found'), 101);
            } 
            
            $store_details->is_activated = $store_details->is_activated == APPROVED ? DECLINED : APPROVED;

            $message = $store_details->is_activated == APPROVED ? tr('admin_store_approve_success') : tr('admin_store_decline_success');

            if( $store_details->save() ) {

                DB::commit();

                return back()->with('flash_success', $message);
            } 

            throw new Exception(tr('admin_store_status_error'), 101);
            
        } catch( Exception $e) {

            DB::rollback();
            
            return redirect()->route('admin.store.index')->with('flash_error',$e->getMessage());
        }
    }


/** end store module **/ 


   /**
     * @method gif_generator()
     *
     * @uses Future, Not now - To create a gif based on 3 images
     *
     * @created Vidhya R
     *
     * @updated Vidhya R
     *
     * @param integer $request - video id
     *
     * @return response of json details
     */
    public function gif_generator(Request $request) {

        try {

            $admin_video_details = AdminVideo::find($request->id);

            if ($admin_video_details) {

                // Gif Generation Based on three images

                $FFmpeg = new \FFmpeg;

                $FFmpeg
                    ->setImage('image2')
                    ->setFrameRate(1)
                    ->input( public_path()."/uploads/images/video_{$request->video_id}_%03d.png")
                    ->setAspectRatio("4:2")
                    ->frameRate(30)
                    ->output(public_path()."/uploads/gifs/video_{$request->video_id}.gif")
                    ->ready();

                $admin_video_details->video_gif_image = Helper::web_url()."/uploads/gifs/video_{$request->video_id}.gif";

                $admin_video_details->save();

                return back()->with('flash_success', tr('gif_generate_success'));
            }

            throw new Exception( tr('gif_generate_failure'), 101);
            
        } catch (Exception $e) {

            return back()->with('flash_error',$e->getMessage());
        }

    }

    /**
     * Function Name admin_videos_index()
     *
     * @uses Get the videos list 
     *
     * @created Anjana H
     *
     * @updated Anjana H 
     *
     * @param 
     *
     * @return Videos list
     */
    public function admin_videos_index(Request $request) {

        $base_query = AdminVideo::orderBy('admin_videos.created_at' , 'desc')
                     ->leftJoin('categories' , 'admin_videos.category_id' , '=' , 'categories.id')
                    ->leftJoin('sub_categories' , 'admin_videos.sub_category_id' , '=' , 'sub_categories.id')
                    ->leftJoin('genres' , 'admin_videos.genre_id' , '=' , 'genres.id')
                    ->leftJoin('video_cast_crews' , 'video_cast_crews.admin_video_id' , '=' , 'admin_videos.id')
                    ->leftJoin('moderators' , 'admin_videos.uploaded_by' , '=' , 'moderators.id');

        $total_videos = AdminVideo::count();

        $total_approved = AdminVideo::Where('admin_videos.is_approved', APPROVED)->count();
        
        $total_declined = AdminVideo::Where('admin_videos.is_approved', DECLINED)->count();

       
        if($request->search_key) {
           
            $search_key = preg_replace("/(?<!\d)(\,|\.)(?!\d)/", "", $request->search_key);

            $base_query->where(function ($query) use ($search_key,$request) {
                $query->where('title','LIKE','%'.$search_key.'%');
                $query->orWhere('categories.name','LIKE','%'.$search_key.'%');
                $query->orWhere('sub_categories.name','LIKE','%'.$search_key.'%');
                $query->orWhere('moderators.name','LIKE','%'.$search_key.'%');
                $query->orWhere('genres.name','LIKE','%'.$search_key.'%');
            });
        }


         
        if($request->status!=''){
            
            $base_query->where('admin_videos.is_approved',$request->status);
 
         }

         if($request->video_type!=''){

            $base_query->where('admin_videos.is_pay_per_view',$request->video_type);

         }


        $query = $base_query
            ->select('admin_videos.id as video_id',
                 'admin_videos.*' ,  
                 'admin_videos.created_at as video_date',
                 'categories.name as category_name' , 
                 'sub_categories.name as sub_category_name' ,
                 'genres.name as genre_name'
            )->withCount('offlineVideos');

        if($request->user_id && $request->downloaded == ENABLED_DOWNLOAD) {

            $user_videos = OfflineAdminVideo::where('user_id', $request->user_id )
                            ->select('admin_video_id')
                            ->get();

            $videos_ids = array_column( $user_videos->toArray(), 'admin_video_id');

            $query->whereIn('admin_videos.id',$videos_ids);

            $sub_page = 'view-videos';

        } else {

            $sub_page = 'view-videos';
        
        }

        if ($request->downloadable == ENABLED_DOWNLOAD) {

            $query->where('download_status', ENABLED_DOWNLOAD);

            $sub_page = 'view-videos-downloadable';

        } else {

            $sub_page = 'view-videos';
        
        }

        if ($request->banner == BANNER_VIDEO) {

            $query->where('is_banner', BANNER_VIDEO);

            $sub_page = 'view-banner-videos';

        } else {

            $sub_page = 'view-videos';
        }

        if ($request->originals == YES) {

            $query->where('is_original_video', ORIGINAL_VIDEO_YES);

            $sub_page = 'original-videos';

        } else {

            $sub_page = 'view-videos';
        }

        $category = $sub_category = $genre = $moderator_details = "";

        if($request->category_id) {

            $query->where('admin_videos.category_id', $request->category_id);

            $category = Category::find($request->category_id);

        }

        if($request->sub_category_id) {

            $query->where('admin_videos.sub_category_id', $request->sub_category_id);

            $sub_category = SubCategory::find($request->sub_category_id);

        }

        if($request->genre_id) {

            $query->where('admin_videos.genre_id', $request->genre_id);

            $genre = Genre::find($request->genre_id);

        }

        if($request->moderator_id) {

            $query->where('admin_videos.uploaded_by', $request->moderator_id);

            $moderator_details = Moderator::find($request->moderator_id);
        }

        if($request->cast_crew_id) {

            $query->where('video_cast_crews.cast_crew_id', $request->cast_crew_id);

        }
      
        $admin_videos = $query->groupby('admin_videos.id')->paginate(10);

        foreach ($admin_videos as $key => $admin_video_details) {
            
            $is_video_eligible_for_download = VideoHelper::check_video_download_eligibility($admin_video_details);

            $admin_video_details->is_video_eligible_for_download = $is_video_eligible_for_download;
        }

        $admin_videos->total_approved = $total_approved;
        
        $admin_videos->total_declined = $total_declined;

        $admin_videos->total_videos = $total_videos;

        return view('admin.videos.index')
                    ->with('page', 'videos')
                    ->with('sub_page',$sub_page)
                    ->with('category' , $category)
                    ->with('sub_category' , $sub_category)
                    ->with('genre' , $genre)
                    ->with('moderator_details' , $moderator_details)
                    ->with('search_key', $request->search_key)
                    ->with('admin_videos' , $admin_videos);   
    }

    /**
     * Function Name admin_videos_create()
     *
     * @uses To display a upload video form
     *
     * @created Vidhya R
     *
     * @updated
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
        
        $admin_video_details = new AdminVideo;
        

        $admin_video_details->trailer_video_resolutions = [];

        $admin_video_details->video_resolutions = [];

        $videoimages = $video_cast_crews = [];

        $cast_crews = CastCrew::select('id', 'name')->where('status', APPROVED)->get();
         
        return view('admin.videos.video-upload')
                ->with('page', 'videos')
                ->with('sub_page', 'admin_videos_create')
                ->with('categories', $categories_data)
                ->with('videoimages', $videoimages)
                ->with('cast_crews', $cast_crews)
                ->with('video_cast_crews', $video_cast_crews)
                ->with('admin_video_details', $admin_video_details);
    }

    /**
     * @method admin_videos_save()
     *
     * @uses To save a new video as well as updated video details
     *
     * @created Vidhya R
     *
     * @updated 
     *
     * @param 
     *
     * @return response of success/failure page
     */
    public function admin_videos_save(Request $request) {

        // Call video save method of common function video repo
        
        $response = VideoRepo::admin_videos_save($request)->getData();
    
        return ['response'=>$response];
    }

    /**
     * @method admin_videos_edit()
     *
     * @uses To display a upload video form
     *
     * @created Vidhya R
     *
     * @updated - 
     *
     * @param object $request - - 
     *
     * @return response of html page with details
     */
    public function admin_videos_edit(Request $request) {



        try {

            $admin_video_details = AdminVideo::where('admin_videos.id' , $request->admin_video_id)->first();

            if (!$admin_video_details) {

                throw new Exception(tr('admin_video_not_found_error'), 101);
            }

            $categories = Category::where('categories.is_approved' , DEFAULT_TRUE)
                                ->select('categories.id as id' , 'categories.name' , 'categories.picture' ,
                                    'categories.is_series' ,'categories.status' , 'categories.is_approved','sub_categories.id as sub_category_id')
                                ->leftJoin('sub_categories' , 'categories.id' , '=' , 'sub_categories.category_id')
                                ->groupBy('sub_categories.category_id')
                                ->where('sub_categories.is_approved' , SUB_CATEGORY_APPROVED)
                                ->havingRaw("COUNT(sub_categories.id) > 0")
                                ->orderBy('categories.name' , 'asc')
                                ->get();

            $categories_data = [];

            foreach ($categories as $key => $categorie_details) {

                if($categorie_details->is_series) {

                    if($gener = Genre::where('category_id',$categorie_details->id)
                        ->where('sub_category_id',$categorie_details->sub_category_id)->first()) {
                        $categories_data[] = $categorie_details;
                    }

                } else {

                    $categories_data[] = $categorie_details;
                }
            }


            $sub_categories = SubCategory::where('category_id', '=', $admin_video_details->category_id)
                                    ->leftJoin('sub_category_images' , 'sub_categories.id' , '=' , 'sub_category_images.sub_category_id')
                                    ->select('sub_category_images.picture' , 'sub_categories.*')
                                    ->where('sub_category_images.position' , 1)
                                    ->where('is_approved' , SUB_CATEGORY_APPROVED)
                                    ->orderBy('name', 'asc')
                                    ->get();

            $admin_video_details->publish_time = $admin_video_details->publish_time ? date('d-m-Y H:i:s', strtotime($admin_video_details->publish_time)) : $admin_video_details->publish_time;

            $videoimages = get_video_image($admin_video_details->id);

            $admin_video_details->video_resolutions = $admin_video_details->video_resolutions ? explode(',', $admin_video_details->video_resolutions) : [];

            $admin_video_details->trailer_video_resolutions = $admin_video_details->trailer_video_resolutions ? explode(',', $admin_video_details->trailer_video_resolutions) : [];

            $video_cast_crews = VideoCastCrew::select('cast_crew_id')
                    ->where('admin_video_id', $request->admin_video_id)
                    ->get()->pluck('cast_crew_id')->toArray();
           
            $cast_crews = CastCrew::select('id', 'name')->get();
            
            return view('admin.videos.video-upload')->with('page', 'videos')
                        ->with('sub_page', 'admin_videos_create')
                        ->with('categories', $categories_data)
                        ->with('admin_video_details', $admin_video_details)
                        ->with('sub_categories', $sub_categories)
                        ->with('videoimages', $videoimages)
                        ->with('cast_crews',$cast_crews)
                        ->with('video_cast_crews', $video_cast_crews);

        } catch (Exception $e) {
                       
            

            return back()->with('flash_error',$e->getMessage()); 
        }

    }

    /**
     * @method admin_videos_view()
     *
     * @uses get the selected video details
     *
     * @created Vidhya R
     *
     * @updated - 
     *
     * @param integer $admin_video_id
     *
     * @return response of html page with details
     */

    public function admin_videos_view(Request $request) {

        try {

            $validator = Validator::make($request->all() , [
                'id' => 'required|exists:admin_videos,id'
            ]);

            if($validator->fails()) {
                
                $error = implode(',', $validator->messages()->all());
                
                throw new Exception($error , 101);                
            } 
    
            $videos = AdminVideo::CommonVideoResponse()->where('admin_videos.id' , $request->id)->first();

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

            $page = 'videos';

            $sub_page = 'admin_videos_view';

            if($videos->is_banner == DEFAULT_TRUE) {

                $sub_page = 'view-banner-videos';
            }

            // Load Video Cast & crews

            $video_cast_crews = VideoCastCrew::select('cast_crew_id', 'name')
                        ->where('admin_video_id', $request->id)
                        ->leftjoin('cast_crews', 'cast_crews.id', '=', 'video_cast_crews.cast_crew_id')
                        ->get()->pluck('name')->toArray();

            return view('admin.videos.view')->with('video' , $videos)
                        ->with('video_images' , $admin_video_images)
                        ->withPage($page)
                        ->with('sub_page',$sub_page)
                        ->with('video_pixels', $video_pixels)
                        ->with('trailer_pixels', $trailer_pixels)
                        ->with('videoStreamUrl', $videoStreamUrl)
                        ->with('trailerstreamUrl', $trailerstreamUrl)
                        ->with('video_cast_crews', $video_cast_crews);
                   
        } catch (Exception $e) {

            return back()->with('flash_error',$e->getMessage()); 

        }
    
    }

    /**
     * @method admin_videos_view()
     *
     * @uses get the selected video details
     *
     * @created Vidhya R
     *
     * @updated - 
     *
     * @param integer $admin_video_id
     *
     * @return response of html page with details
     */

    public function admin_videos_delete(Request $request) {

        try {

            DB::beginTransaction();
            
            $admin_video_details = AdminVideo::where('id' , $request->admin_video_id)->first();

            if(!$admin_video_details) {  

                throw new Exception(tr('admin_video_not_found_error'), 101);
            }

            $main_video = $admin_video_details->video;

            $subtitle = $admin_video_details->subtitle;

            $banner_image = $admin_video_details->banner_image;

            $default_image = $admin_video_details->default_image;

            $video_resize_path = $admin_video_details->video_resize_path;

            $trailer_resize_path = $admin_video_details->trailer_resize_path;

            $position = $admin_video_details->position;
            
            $genre_id = $admin_video_details->genre_id;

            if ($admin_video_details->delete()) {

                if ($genre_id > 0) {

                    $next_videos = AdminVideo::where('genre_id', $genre_id)
                            // ->where('position', '>', $position)
                            ->orderBy('position', 'asc')
                            ->where('is_approved', DEFAULT_TRUE)
                            ->where('status', DEFAULT_TRUE)
                            ->get();
                    
                    if ($next_videos->count() > 0) {

                        foreach ($next_videos as $key => $value) {
                            
                            $value->position = $key + 1;

                            if ($value->save()) {


                            } else {

                                throw new Exception(tr('video_not_saved'));
                                
                            }

                        }

                    }

                }

                Helper::delete_picture($main_video, "/uploads/videos/original/");

                Helper::delete_picture($subtitle, SUBTITLE_PATH); 

                if ($banner_image) {

                    Helper::delete_picture($banner_image, "/uploads/images/");
                }

                Helper::delete_picture($default_image, "/uploads/images/");

                if ($video_resize_path) {

                    $explode = explode(',', $video_resize_path);

                    if (count($explode) > 0) {

                        foreach ($explode as $key => $exp) {

                            Helper::delete_picture($exp, "/uploads/videos/original/");
                        }
                    }    
                }

                if($trailer_resize_path) {

                    $explode = explode(',', $trailer_resize_path);

                    if (count($explode) > 0) {

                        foreach ($explode as $key => $exp) {

                            Helper::delete_picture($exp, "/uploads/videos/original/");
                        }
                    }    
                }

                DB::commit();

                return back()->with('flash_success', 'Video deleted successfully');
            }

            throw new Exception(tr('video_delete_failure'), 101);                
            
        } catch (Exception $e) {

            DB::rollback();

            return back()->with('flash_error',$e->getMessage());
        }
    
    }

    /**
     * @method admin_videos_view()
     *
     * @uses get the selected video details
     *
     * @created Vidhya R
     *
     * @updated - 
     *
     * @param integer $admin_video_id
     *
     * @return response of html page with details
     */

    public function admin_videos_slider_status(Request $request) {

        try {
           
            DB::beginTransaction();

            $admin_video_details = AdminVideo::where('is_home_slider' , DEFAULT_TRUE )->update(['is_home_slider' => DEFAULT_FALSE]); 

            $admin_video_details = AdminVideo::where('id' , $request->admin_video_id)->update(['is_home_slider' => DEFAULT_TRUE ] );

            if($admin_video_details == DEFAULT_TRUE){
                
                DB::commit();

                return back()->with('flash_success', tr('slider_success'));
            
            } else {

                throw new Exception(tr('admin_video_slider_error'), 101);                
            }
            
        } catch (Exception $e) {
            
            DB::rollback();
            return back()->with('flash_error',$e->getMessage());
        }
    
    }

    /**
     * @method admin_videos_status_approve()
     *
     * @uses get the selected video details
     *
     * @created Vidhya R
     *
     * @updated - 
     *
     * @param integer $admin_video_id
     *
     * @return response of html page with details
     */

    public function admin_videos_status_approve(Request $request) {

        try {

            DB::beginTransaction();

            $admin_video_details = AdminVideo::find($request->admin_video_id);

            if (!$admin_video_details) {

                throw new Exception(tr('admin_video_not_found_error'), 101);
            }

            $admin_video_details->is_approved = DEFAULT_TRUE;

            if (empty($admin_video_details->publish_time) || $admin_video_details->publish_time == '0000-00-00 00:00:00') {

                $admin_video_details->publish_time = date('Y-m-d H:i:s');
            }

            // Check the video has genre type or not

            if ($admin_video_details->genre_id > 0) {

                /*
                 * Check is there any videos present in same genre, 
                 * if it is, assign the position with increment of 1
                 */
                $get_video_position = AdminVideo::where('genre_id', $admin_video_details->genre_id)
                                ->orderBy('position', 'desc')
                                ->where('is_approved', DEFAULT_TRUE)
                                ->where('status', DEFAULT_TRUE)
                                ->first();

                if($get_video_position) {

                    $admin_video_details->position = $get_video_position->position + 1;
                }
            }

            // Uncommented by vidhya. with below code the response will error

            if($admin_video_details->is_approved == DEFAULT_TRUE) {

                // Notification::save_notification($admin_video_details->id);                
                $message = tr('admin_not_video_approve');
            
            } else {

                $message = tr('admin_not_video_decline');
            } 

            $admin_video_details->save();

            DB::commit();

            return back()->with('flash_success', $message);

        }catch(Exception $e) {

            DB::rollback();
            return back()->with('flash_error',$e->getMessage());
        }
    
    }

    /**
     * @method admin_videos_status_decline()
     *
     * @uses To Publish the video for user
     *
     * @created Vidhya R
     *
     * @updated - 
     *
     * @param integer $admin_video_id
     *
     * @return response of html page with details
     */

    public function admin_videos_status_decline(Request $request) {

        try {
        
            $admin_video_details = AdminVideo::find($request->admin_video_id);

            if (!$admin_video_details) {

                throw new Exception(tr('admin_video_not_found_error'), 101);
            }

            $admin_video_details->is_approved = DEFAULT_FALSE;

            // Check the video has genre type or not
                   
            if ($admin_video_details->genre_id > 0) {

                /*
                 * Check is there any videos present in same genre, 
                 * if it is, assign the position with decrement of 1.(for all videos)
                 */
                $next_videos = AdminVideo::where('genre_id', $admin_video_details->genre_id)
                                ->where('position', '>', $admin_video_details->position)
                                ->orderBy('position', 'asc')
                                ->where('is_approved', DEFAULT_TRUE)
                                ->where('status', DEFAULT_TRUE)
                                ->get();
                if ($next_videos->count() > 0) {

                    foreach ($next_videos as $key => $value) {
                        
                        $value->position = $value->position - 1;

                        if ($value->save()) {

                        } else {

                            throw new Exception(tr('video_not_saved'));                            
                        }
                    }

                }

                $admin_video_details->position = 0;
            }

            if($admin_video_details->is_approved == DEFAULT_TRUE) {

                $message = tr('admin_not_video_approve');

            } else {

                $message = tr('admin_video_decline');
            }

            DB::commit();

            $admin_video_details->save();

            return back()->with('flash_success', $message);

        } catch (Exception $e) {

            DB::rollback();


            return back()->with('flash_error',$e->getMessage());

        }
    
    }

    /**
     * @method admin_videos_publish()
     *
     * @uses To Publish the video for user
     *
     * @created Vidhya R
     *
     * @updated
     *
     * @param integer $admin_video_id
     *
     * @return response of html page with details
     */

    public function admin_videos_publish(Request $request) {
            
        try {
            
            DB::beginTransaction();

            $admin_video_details = AdminVideo::find($request->admin_video_id);

            if(!$admin_video_details) {  

                throw new Exception(tr('admin_video_not_found_error'), 101);               
            }
            
            $admin_video_details->status = VIDEO_PUBLISHED;
            
            $admin_video_details->publish_time = date('Y-m-d H:i:s');

            if ($admin_video_details->save()) {
                
                DB::commit();

                return back()->with('flash_success', tr('admin_published_video_success'));
            } 

            throw new Exception( tr('admin_published_video_failure'), 101);
        
        } catch (Exception $e) {

            DB::rollback();


            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method admin_videos_ppv_add
     *
     * @uses To save the payment details
     *
     * @created Vidhya R
     *
     * @updated
     *
     * @param integer $admin_video_id
     *
     * @param object  $request Object (Post Attributes)
     *
     * @return flash message
     */

    public function admin_videos_ppv_add($id, Request $request) {

        try {

            if ($request->amount > 0) {

                $admin_video_details = AdminVideo::find($id);

                // Get post attribute values and save the values
                if ($admin_video_details) {

                    $request->request->add([
                        'is_pay_per_view' => PPV_ENABLED
                    ]);

                    if ($data = $request->all()) {
                        // Update the post
                        if (AdminVideo::where('id', $id)->update($data)) {
                            // Redirect into particular value
                            return back()->with('flash_success', tr('payment_added'));       
                        } 
                    }
                }

                throw new Exception(tr('admin_published_video_failure'), 101);
                
            } else {

                throw new Exception(tr('add_ppv_amount'), 101);                
            }

        } catch (Exception $e) {

            return back()->with('flash_error',$e->getMessage());
        }
    
    }

    /**
     * @method admin_videos_ppv_remove
     *
     * @uses To remove pay per view
     *
     * @created
     *
     * @updated vidhya R
     *
     * @param integer $admin_video_id
     * 
     * @return falsh success
     */

    public function admin_videos_ppv_remove(Request $request) {
       
        try {
            
            DB::beginTransaction();

            // Load video model using auto increment id of the table
            $admin_video_details = AdminVideo::find($request->admin_video_id);
           
            if ($admin_video_details) {
                
                $admin_video_details->amount = DEFAULT_FALSE;
                
                $admin_video_details->type_of_subscription = DEFAULT_FALSE;
                
                $admin_video_details->type_of_user = DEFAULT_FALSE;
               
                $admin_video_details->is_pay_per_view = PPV_DISABLED;
               
                if ($admin_video_details->save()) {

                    DB::commit();
                    
                    return back()->with('flash_success' , tr('removed_pay_per_view'));

                } else {

                    throw new Exception(tr('admin_video_published_save_error'), 101);
                }
            }

            return back()->with('flash_error' , tr('admin_published_video_failure'));
                   
        } catch (Exception $e) {

            DB::rollback();
            
            

            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method admin_videos_change_position
     *
     * @uses Change position of the video based on genres
     *
     * @created
     *
     * @updated vidhya R
     *
     * @param integer $admin_video_id
     * 
     * @return falsh success
     */

    public function admin_videos_change_position(Request $request) {

        try {
            
            DB::beginTransaction();

            $admin_video_details = AdminVideo::find($request->admin_video_id);

            if(!$admin_video_details) {  

                throw new Exception(tr('video_not_found'));                
            }

            $changing_row_position = $admin_video_details->position;

            $change_video = AdminVideo::where('position', $request->position)
                    ->where('genre_id', $admin_video_details->genre_id)
                    ->where('is_approved', DEFAULT_TRUE)
                    ->where('status', DEFAULT_TRUE)
                    ->first();

            if(!$change_video) {

                throw new Exception(tr('given_position_not_exits'));
            }          

            $new_row_position = $change_video->position;

            $admin_video_details->position = $new_row_position;

            if($admin_video_details->save()) {

                $change_video->position = $changing_row_position;

                if ($change_video->save()) {

                    DB::commit();

                    if($request->ajax()) {

                        $response = ['success' => true, 'message' => tr('video_position_updated_success')];
                        
                        return response()->json($response, 200);
                    }

                    return back()->with('flash_success', tr('video_position_updated_success'));

                } else {

                    throw new Exception(tr('video_not_saved'));
                }

            } 

            throw new Exception(tr('video_not_saved'));
           
        } catch (Exception $e) {

            DB::rollback();

            if($request->ajax()) {

                $response = ['success' => false, 'error' => $e->getMessage()];

                return response()->json($response, 200);
            }

            return back()->with('flash_error',$e->getMessage());
        }

    }

    /**
     * @method admin_videos_compression_complete()
     *
     * @uses To complete the compressing videos
     *
     * @param integer video id - Video id
     *
     * @created Vidhya R
     *
     * @updated Vidhya R
     *
     * @return response of success/failure message
     */

    public function admin_videos_compression_complete(Request $request) {
        
        try {
            
            $admin_video_details = AdminVideo::find($request->id);

            if(!$admin_video_details) {

                throw new Exception( tr('video_not_found'), 101);                
            }

            // Check the video has compress state or not

            if ($admin_video_details->compress_status <= OVERALL_COMPRESS_COMPLETED) {

                $admin_video_details->compress_status = COMPRESSION_NOT_HAPPEN;

                $admin_video_details->trailer_compress_status = COMPRESS_COMPLETED;

                $admin_video_details->main_video_compress_status = COMPRESS_COMPLETED;

                if($admin_video_details->save()) {
                    
                    DB::commit();

                    return back()->with('flash_success', tr('video_compress_success'));

                } else {

                    throw new Exception(tr('video_not_saved'), 101);
                }

            }
                
            throw new Exception(tr('already_video_compressed'), 101);
                       
        } catch (Exception $e) {
            
            DB::rollback();
            return back()->with('flash_error',$e->getMessage());
        }
    
    }

    /**
     * @method admin_videos_banner_add()
     *
     * @uses Set banner image for video
     *
     * @param object $request - Banner image video details
     *
     * @created Vidhya R
     *
     * @updated Vidhya R
     *
     * @return response of success/failure message details
     */
    public function admin_videos_banner_add(Request $request) {

        try {
            
            DB::beginTransaction();

            $validator = Validator::make( $request->all(), array(
                    'admin_video_id' => 'required|exists:admin_videos,id,is_approved,'.VIDEO_APPROVED.',status,'.VIDEO_PUBLISHED,
                    'banner_image' => 'required_without:mobile_banner_image|mimes:jpeg,jpg,bmp,png',
                    'mobile_banner_image' => 'required_without:banner_image|mimes:jpeg,jpg,bmp,png',
                ), [
                    'admin_video_id.exists' => tr('video_not_exists'),
                ]
            );
           
            if($validator->fails()) {

                $error = implode(',', $validator->messages()->all());

                throw new Exception($error, 101);
            } 

            $admin_video_details = AdminVideo::find($request->admin_video_id);

            if($request->hasFile('banner_image')) {

                if ($admin_video_details->is_banner == BANNER_VIDEO) {

                    Helper::delete_picture($admin_video_details->banner_image, "/uploads/images/");
                }
                
                $admin_video_details->banner_image = Helper::normal_upload_picture($request->file('banner_image'));
            }
            
            if($request->hasFile('mobile_banner_image')) {

                if ($admin_video_details->is_banner == BANNER_VIDEO) {

                    Helper::delete_picture($admin_video_details->mobile_banner_image, "/uploads/images/");
                }
                
                $admin_video_details->mobile_banner_image = Helper::normal_upload_picture($request->file('mobile_banner_image'));
            }

            $admin_video_details->is_banner = BANNER_VIDEO;

            if($admin_video_details->save()) {

                // AdminVideo::where('id', '!=', $admin_video_details->id)->update(['is_banner' => BANNER_VIDEO_REMOVED]);
                
                DB::commit();

                return back()->with('flash_success', tr('video_set_banner_success'));
            } 

            throw new Exception(tr('admin_video_save_error'), 101);
            
        } catch (Exception $e) {
            
            DB::rollback();
            
            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method admin_videos_banner_remove()
     *
     * @uses Remove banner image for video
     *
     * @param object $request - Banner image video details
     *
     * @created Vidhya R
     *
     * @updated Vidhya R
     *
     * @return response of success/failure message details
     */
    public function admin_videos_banner_remove(Request $request) {
        
        try {
            
            DB::beginTransaction();

            $validator = Validator::make( $request->all(), array(
                    'admin_video_id' => 'required|exists:admin_videos,id',
                ), [

                    'admin_video_id.exists' => tr('video_not_exists'),

                ]
            );
           
            if($validator->fails()) {

                $error = implode(',', $validator->messages()->all());

                throw new Exception( $error , 101);
            } 

            $admin_video_details = AdminVideo::find($request->admin_video_id);

            Helper::delete_picture($admin_video_details->banner_image, "/uploads/images/");

            $admin_video_details->is_banner = BANNER_VIDEO_REMOVED;

            if( $admin_video_details->save()) {
            
                DB::commit();

                return back()->with('flash_success', tr('video_remove_banner'));            
            } 

            throw new Exception(tr('admin_video_banner_remove'), 101);
            
        } catch (Exception $e) {
            
            DB::rollback();
            return back()->with('flash_error',$e->getMessage());
        }

    }

    /**
     * Function Name admin_videos_spams()
     *
     * @uses Load all the videos from flag table
     *
     * @created Maheswari
     *
     * @updated vidhya R
     *
     * @param Get the flag details in groupby video_id
     *
     * @return all the spam videos
     */

    public function admin_videos_spams() {

        // Load all the videos from flag table

        $spam_videos = Flag::groupBy('video_id')->paginate(10);

        return view('admin.spam_videos.spam_videos')
                        ->with('page' , 'videos')
                        ->with('sub_page' , 'spam_videos')
                        ->with('spam_videos' , $spam_videos);
    
    }

    /**
     * @method admin_videos_spams_user_reports()
     *
     * @uses Load the flags based on the video id
     *
     * @created Maheswari
     *
     * @updated vithya R
     *
     * @param integer $admin_video_id
     *
     * @return all the spam videos in user reports
    */
    public function admin_videos_spams_user_reports(Request $request) {

        try {

            if(!$request->admin_video_id) {
               
                throw new Exception(tr('spam_video_id_error'), 101);                
            }

            $admin_video_details = AdminVideo::find($request->admin_video_id);

            if(!$admin_video_details) {
                
                throw new Exception(tr('spam_video_id_error'), 101);
            }

            // Load all the users based on the selected 

            $spam_videos = Flag::where('video_id', $request->admin_video_id)->paginate(10);

            return view('admin.spam_videos.user_report')
                        ->with('page' , 'videos')
                        ->with('sub_page' , 'spam_videos')
                        ->with('spam_videos' , $spam_videos)
                        ->with('video_details' , $admin_video_details);   
            
        } catch (Exception $e) {
              
            

            return back()->with('flash_error',$e->getMessage());
        }
    }

    /**
     * Function Name admin_videos_spams_remove() 
     *
     * @uses Delete the spam details
     *
     * @created Maheswari
     *
     * @updated vithya R
     *
     * @param integer $flag_id
     *
     * @return success/failure message
     */   
    public function admin_videos_spams_remove($flag_id) {
       
       try {
            DB::beginTransaction();

            if(!$flag_id) {

                throw new Exception(tr('spam_video_id_error'), 101);
            }

            $flag_details = Flag::find($flag_id);

            if(!$flag_details) {

                throw new Exception(tr('spam_details_not_found'), 101);                
            }

            $flag_details->delete();
            
            DB::commit();

            return back()->with('flash_success',tr('spam_deleted'));
                   
        } catch (Exception $e) {
            
            DB::rollback();
            return back()->with('flash_error',$e->getMessage());
        }
    }

   /**
    * Function Name : offline_videos()
    *
    * @uses To list out offline videos based on users
    *
    * @created Vidhya R
    *
    * @updated
    *
    * @param object $request - user & video details
    *
    * @return response of json details
    */
   public function offline_videos(Request $request) {

        try {

            if (!$request->has('sub_profile_id')) {

                $sub_profile = SubProfile::where('user_id', $request->id)->where('status', DEFAULT_TRUE)->first();

                if ($sub_profile) {

                    $request->request->add([ 

                        'sub_profile_id' => $sub_profile->id,

                    ]);

                } else {

                    throw new Exception(tr('sub_profile_details_not_found'),101);
                }

            } else {

                $subProfile = SubProfile::where('user_id', $request->id)
                            ->where('id', $request->sub_profile_id)->first();

                if (!$subProfile) {

                    throw new Exception(tr('sub_profile_details_not_found'),101);
                }

            }
            
            $validator = Validator::make(
                $request->all(),
                array(
                    'sub_profile_id'=>'nullable|exists:sub_profiles,id',
                ),
                array(
                    'exists' => 'The :attribute doesn\'t exists please provide correct profile',
                )
            );

            if ($validator->fails()) {

                $error = implode(',', $validator->messages()->all());

                $response_array = array('success' => false, 'error' => Helper::get_error_message(101), 'error_code' => 101, 'error_messages'=>$error);

                throw new Exception($error);
            } 

            $user = User::find($request->id);

            $videos = OfflineAdminVideo::select('admin_videos.title', 'offline_admin_videos.*')
                ->leftJoin('admin_videos', 'admin_videos.id', '=', 'offline_admin_videos.admin_video_id')
                ->where('user_id', $request->id)->paginate(10);

            return view('admin.users.offline_videos')->with('videos' , $videos)
                ->withPage('users')
                ->with('sub_page','view-user')
                ->with('user', $user);            

        } catch (Exception $e) {

            return back()->with('flash_error', $e->getMessage());

        }

   }


   /**
    * Function Name : offline_videos_delete()
    *
    * @uses delete local storage file
    *
    * @created Vidhya R
    *
    * @updated
    *
    * @param object $request - user & video details
    *
    * @return response of json details
    */
   public function offline_videos_delete(Request $request) {

        try {
            
            DB::beginTransaction();

            if (!$request->has('sub_profile_id')) {

                $sub_profile = SubProfile::where('user_id', $request->id)->where('status', DEFAULT_TRUE)->first();

                if ($sub_profile) {

                    $request->request->add([ 

                        'sub_profile_id' => $sub_profile->id,

                    ]);

                } else {

                    throw new Exception(tr('sub_profile_details_not_found'));
                }

            } else {

                $subProfile = SubProfile::where('user_id', $request->id)
                            ->where('id', $request->sub_profile_id)->first();

                if (!$subProfile) {

                    throw new Exception(tr('sub_profile_details_not_found'));
                }
            } 

            $validator = Validator::make(
                $request->all(),
                array(
                    'admin_video_id' => 'required|integer|exists:admin_videos,id,status,'.VIDEO_PUBLISHED.',is_approved,'.VIDEO_APPROVED,
                    'sub_profile_id'=>'nullable|exists:sub_profiles,id',
                ),
                array(
                    'exists' => 'The :attribute doesn\'t exists please provide correct video id',
                )
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                $response_array = array('success' => false, 'error' => Helper::get_error_message(101), 'error_code' => 101, 'error_messages'=>$error_messages);

                throw new Exception($error_messages);
            } 

            $offline_admin_video_details = OfflineAdminVideo::where('admin_video_id',$request->admin_video_id)->where('user_id', $request->id)->first();

            if ($offline_admin_video_details) {

                if ($offline_admin_video_details->delete()) {


                } else {

                    throw new Exception(tr('offline_video_not_delete'));
                    
                }

            } else {

                throw new Exception(tr('offline_video_not_save'));
                
            }

            DB::commit();

            $response_array = array('success' => true);

            return back()->with('flash_success', tr('offline_video_delete_success'));

        } catch (Exception $e) {

            DB::rollback();

            return back()->with('flash_error', $e->getMessage());

        }

   }

   /**
     * @method admin_videos_download_status()
     * 
     * @uses used to approve/decline the selected user details
     *
     * @created vidhya R
     *
     * @edited Vidhya R
     *
     * @param - 
     *
     * @return redirect to users management page with success/error response
     */

    public function admin_videos_download_status(Request $request) {

        try {
            
            DB::beginTransaction();

            $admin_video_details = AdminVideo::find($request->admin_video_id);

            if(!$admin_video_details) {

                throw new Exception(tr('video_not_found'), 101);
            }

            // Check the video is eligible for download

            $is_video_eligible_for_download = VideoHelper::check_video_download_eligibility($admin_video_details);

            if($is_video_eligible_for_download == NO) {

                $error = tr('admin_video_not_eligible_for_download');

                return back()->with('flash_error',$error);        
            }

            $admin_video_details->download_status = $admin_video_details->download_status == ENABLED_DOWNLOAD ?  DISABLED_DOWNLOAD : ENABLED_DOWNLOAD;

            if($admin_video_details->save()) {
                
                DB::commit();

                $message = $admin_video_details->download_status == ENABLED_DOWNLOAD ? tr('admin_video_marked_as_downloadable') : tr('admin_video_removed_from_downloadable');

                return back()->with('flash_success', $message);              
            
            } 
                
            throw new Exception(tr('admin_video_download_error'), 101);  
           
        } catch (Exception $e) {
            
            DB::rollback();
            return back()->with('flash_error',$e->getMessage());        
        }
    
    }

    /**
    * Function Name : admin_videos_original_status()
    *
    * @uses update the original page display status for selected video
    *
    * @created Vithya R
    *
    * @updated
    *
    * @param integer admin_video_id
    *
    * @return success/failure message
    */
   public function admin_videos_original_status(Request $request) {

        try {
        
            $validator = Validator::make($request->all(),
                [
                    'admin_video_id' => 'required|integer|exists:admin_videos,id,status,'.APPROVED,
                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);

            }

            DB::beginTransaction();

            // Check the home max count

            $total_original_based_videos = AdminVideo::where('is_original_video', ORIGINAL_VIDEO_YES)->count();

            $max_original_count = Setting::get('max_original_count') ?: 12;

            $admin_video_details = AdminVideo::find($request->admin_video_id);

            if(!$admin_video_details) {

                throw new Exception(tr('admin_video_not_found'), 101);
                
            }
            
            if(($admin_video_details->is_original_video == ORIGINAL_VIDEO_NO) && ($total_original_based_videos > $max_original_count)) {

                throw new Exception(tr('admin_video_original_limit_exceeed'), 101);

            }

            $admin_video_details->is_original_video = $admin_video_details->is_original_video == ORIGINAL_VIDEO_YES ? ORIGINAL_VIDEO_NO : ORIGINAL_VIDEO_YES;

            if($admin_video_details->save()) {

                DB::commit();

                $message = $admin_video_details->is_original_video == ORIGINAL_VIDEO_YES ? tr('admin_video_original_status_added') : tr('admin_video_original_status_removed');

                return back()->with('flash_success', $message);

            } else {

                throw new Exception(tr('admin_video_original_status_error'), 101);
                
            }
            

        } catch (Exception $e) {

            DB::rollback();
            return back()->with('flash_error', $e->getMessage());

        }

   }

      /**
    * Function Name : categories_home_status()
    *
    * @uses update the home page display status for selected category
    *
    * @created Vithya R
    *
    * @updated
    *
    * @param object $request - user & video details
    *
    * @return success/failure message
    */
   public function categories_home_status(Request $request) {

        try {
        
            $validator = Validator::make($request->all(),
                [
                    'category_id' => 'required|integer|exists:categories,id,status,'.APPROVED,
                ]
            );

            if ($validator->fails()) {

                $error_messages = implode(',', $validator->messages()->all());

                throw new Exception($error_messages, 101);

            }

            DB::beginTransaction();

            // Check the home max count

            $total_home_page_categories = Category::where('is_home_display', YES)->count();

            if($total_home_page_categories > Setting::get('max_home_count')) {

                throw new Exception(tr('admin_category_home_limit_exceeed'), 101);

            }

            $category_details = Category::find($request->category_id);

            if(!$category_details) {

                throw new Exception(tr('admin_category_not_found'), 101);
                
            }

            $category_details->is_home_display = $category_details->is_home_display == YES ? NO : YES;

            if($category_details->save()) {

                DB::commit();

                $message = $category_details->is_home_display == YES ? tr('admin_category_home_status_added') : tr('admin_category_home_status_removed');

                return back()->with('flash_success', $message);

            } else {

                throw new Exception(tr('admin_category_home_status_error'), 101);
                
            }
            

        } catch (Exception $e) {

            DB::rollback();

            return back()->with('flash_error', $e->getMessage());

        }

   }

   /**
    * Function Name: ios_control()
    *
    * @uses To update the ios payment subscription status
    *
    * @param settings key value
    *
    * @created Maheswari
    *
    * @updated Maheswari
    *
    * @return response of success / failure message.
    */
    public function ios_control(){

        if(Auth::guard('admin')->check()){

            return view('admin.settings.ios-control')->with('page','ios-control');

        } else {

            return back();
        }
    }

    /**
    * Function Name: ios_control()
    *
    * @uses To update the ios settings value
    *
    * @param settings key value
    *
    * @created Maheswari
    *
    * @updated Maheswari
    *
    * @return response of success / failure message.
    */
    public function ios_control_save(Request $request){

        if(Auth::guard('admin')->check()){

            $settings = Settings::get();

            foreach ($settings as $key => $setting_details) {

                # code...

                $current_key = "";

                $current_key = $setting_details->key;
                
                    if($request->has($current_key)) {

                        $setting_details->value = $request->$current_key;
                    }

                $setting_details->save();
            }

            return back()->with('flash_success',tr('settings_success'));

        } else {

            return back();
        }
    
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
     * @return viwe page.
     */
    public function settings_generate_json(Request $request) {

        Helper::settings_generate_json();

        Helper::home_settings_generate_json();

        $file_path = url("/default-json/settings.json");

        return redirect()->route('admin_control')->with('flash_success', 'Settings file updated successfully.'.$file_path);
        
    }

    /**
     * @method  users_wallet
     *
     * @uses get wallet details about the selected user
     *
     * @created Vidhya
     *
     * @updated Vidhya
     *
     * @param integer $user_id
     * 
     * @return response success/failure message
     *
     */
    public function users_wallet($user_id) {

        try {

            $user_details = User::find($user_id);

            if(!$user_details) {

                throw new Exception(tr('user_not_found'), 101);
                
            }

            $wallet_details = CustomWallet::where('user_id', $user_id)->first();

            if(!$wallet_details) {

                $wallet_details = new CustomWallet;

                $wallet_details->user_id = $user_id;

                $wallet_details->total = $wallet_details->used = $wallet_details->remaining = "0.00";

                $wallet_details->save();
                
            }

            $wallet_histories = CustomWalletHistory::where('user_id', $user_id)
                ->orderBy('updated_at', 'desc')->paginate(10);

            // Not using in the version 5.0. Will be adding this feature in upcoming versions
            // $wallet_payments = CustomWalletPayment::where('user_id', $user_id)->orderBy('updated_at', 'desc')->paginate(10);

            return view('admin.users.wallet')
                    ->with('page' , 'users')
                    ->with('sub_page','view-user')
                    ->with('wallet_details' , $wallet_details)
                    ->with('user_details' , $user_details)
                    ->with('wallet_histories' , $wallet_histories);


        } catch(Exception $e) {
            
            return redirect()->route('admin.users')->with('flash_error', $e->getMessage());

        }

    }

    /**
     * @method admin_videos_set_position()
     * 
     * @uses used to display video position set page
     *
     * @created vidhya R
     *
     * @updated Vidhya R
     *
     * @param - 
     *
     * @return view page
     */

    public function admin_videos_set_position(Request $request) {

        try {

            $categories = Category::where('categories.is_approved' , APPROVED)
                ->select('categories.id as id' , 'categories.name' , 'categories.picture' ,
                    'categories.is_series' ,'categories.status' , 'categories.is_approved')
                ->leftJoin('admin_videos' , 'categories.id' , '=' , 'admin_videos.category_id')
                ->where('categories.is_series', 1)
                ->groupBy('admin_videos.category_id')
                ->havingRaw("COUNT(admin_videos.id) > 0")
                ->orderBy('categories.name' , 'asc')
                ->get();
        
            $categories_data = $category_ids = [];

            foreach ($categories as $key => $category_details) {

                $category_ids[] = $category_details->id;

                $categories_data[] = $category_details;

            }

            $sub_categories = $sub_category_ids = [];

            if($category_ids) {

                $sub_categories = SubCategory::where('categories.is_series', YES)
                            ->leftJoin('categories' , 'categories.id' , '=' , 'sub_categories.category_id')
                            ->select('*', 'sub_categories.name as name', 'sub_categories.id as id')
                            ->whereIn('sub_categories.category_id', $category_ids)
                            ->where('sub_categories.is_approved' , 1)
                            ->orderBy('sub_categories.name' , 'ASC')
                            ->get();

                foreach ($sub_categories as $key => $sub_category_details) {
                    $sub_category_ids[] = $sub_category_details->id;
                }
            }

            $genres = [];

            if($sub_category_ids) {

                $genres = Genre::where('is_approved', GENRE_APPROVED)
                          ->orderBy('name', 'asc')
                          ->whereIn('sub_category_id', $sub_category_ids)
                          ->get();

            }

            $base_query = AdminVideo::orderBy('position','asc')
                        ->whereIn('admin_videos.category_id', $category_ids)
                        ->where('admin_videos.status', VIDEO_PUBLISHED)
                        ->where('admin_videos.is_approved', APPROVED);

            if($request->category_id) {

                $selected_category_ids = array_filter($request->category_id);

                // dd($request->all());

                if($selected_category_ids) {

                    $base_query = $base_query->whereIn('admin_videos.category_id', $selected_category_ids);
                }


            }
            
            if($request->sub_category_id) {

                $selected_sub_category_ids = array_filter($request->sub_category_id);

                if($selected_sub_category_ids) {

                    $base_query = $base_query->whereIn('admin_videos.sub_category_id', $selected_sub_category_ids);
                }

            }

            if($request->genre_id) {

                $selected_genre_ids = array_filter($request->genre_id);

                if($selected_genre_ids) {

                    $base_query = $base_query->whereIn('admin_videos.genre_id', $selected_genre_ids);
                }
            }

            $admin_videos = $base_query->paginate(10);

            return view('admin.videos.set-position')
                        ->with('page', 'admin_videos_set_position')
                        ->with('sub_page', '')
                        ->with('categories', $categories_data)
                        ->with('sub_categories', $sub_categories)
                        ->with('genres', $genres)
                        ->with('admin_videos', $admin_videos);
         
           
        } catch (Exception $e) {
            
            return back()->with('flash_error',$e->getMessage());        
        }
    
    }

    /**
     * @method users_referrals_index()
     *
     * @uses To list out users object details
     *
     * @created Anjana H 
     *
     * @updated Anjana H
     *
     * @param
     *
     * @return View page
     */
    public function users_referrals_index(Request $request) {

        $base_query = ReferralCode::orderBy('id','desc');

        if($request->search_key) {

            $base_query = $base_query
                    ->where('referral_code','LIKE','%'.$request->search_key.'%')

                    ->orWhereHas('userDetails', function($q) use ($request) {

                        return $q->where('users.name','LIKE','%'.$request->search_key.'%');
                    });
        }

        $user_referrals = $base_query->paginate(10);

        return view('admin.users.referrals')
                ->withPage('users')
                ->with('user_referrals' , $user_referrals)
                ->with('sub_page', 'users-view-referrals');
    
    }



    /**
     * @method user_payments_view()
     * 
     * @uses used to list the user_payment_view
     *
     * @created Ganesh
     *
     * @updated Ganesh
     *
     * @param
     *
     * @return view page
     */
    public function user_payments_view(Request $request) {

        $payment_details = UserPayment::where('user_payments.id',$request->payment_id)
                   ->join('users as u','u.id','=','user_payments.user_id')
                   ->join('subscriptions as s','s.id','=','user_payments.subscription_id')
                   ->select('user_payments.*','s.title as subscription_name','u.name as user_name','u.mobile','u.email')
                   ->first();

        if(!$payment_details){

            return redirect()->back()->with('flash_error',tr('payment_not_found_error'));

        }

        return view('admin.payments.user_payments_view')
                ->with('payment_details',$payment_details)
                ->withPage('payments')
                ->with('sub_page','user-payments');
       
    }


    /**
     * @method ppv_payments_view()
     * 
     * @uses used to list the user_payment_view
     *
     * @created Ganesh
     *
     * @updated Vithya
     *
     * @param
     *
     * @return view page
     */
    public function ppv_payments_view(Request $request) {

        $payment_details = PayPerView::where('pay_per_views.id',$request->payment_id)
            ->join('admin_videos as av','av.id','=','pay_per_views.video_id')
            ->join('users as u','u.id','=','pay_per_views.user_id')
            ->select('pay_per_views.*','av.title as video_name','u.name as user_name','u.mobile','u.email')
            ->first();

        if(!$payment_details){

            return redirect()->back()->with('flash_error',tr('payment_not_found_error'));

        }

        return view('admin.payments.ppv_payments_view')
                ->withPage('payments')
                ->with('sub_page','video-subscription')
                ->with('payment_details', $payment_details);
       
    }

    /**
     * @method server_status_view()
     * 
     * @uses used to list the user_payment_view
     *
     * @created vithya
     *
     * @updated Vithya
     *
     * @param
     *
     * @return view page
     */
    public function server_status_view(Request $request) {

        $data = new \stdClass;

        $data->ubuntu_version = shell_exec('lsb_release -a');

        $data->redis_server_version = shell_exec('redis-server --version');

        $data->redis_client_version = shell_exec('redis-cli --version');

        $data->redis_server_status = shell_exec('service redis-server status 2>&1');

        // check folders start

        $folders = ['/uploads/cast_crews', '/uploads/gifs', '/uploads/images', '/uploads/settings', '/uploads/smil', '/uploads/store', '/uploads/subtitles', '/uploads/video-json', '/uploads/videos', '/uploads/videos/original', 'default-json'];

        $folders = (object) $folders;

        foreach ($folders as $key => $folder) {

            $path = public_path($folder);

            if(!\File::isDirectory($path)) {
                \File::makeDirectory($path, 0777, true, true);
            }
        }        
        // check folders end

        return view('admin.settings.server-status')->with('data', $data);
       
    }

    /**
     * @method admin_videos_change_position_all
     *
     * @uses Change position of the video based on genres
     *
     * @created
     *
     * @updated vidhya R
     *
     * @param integer $admin_video_id
     * 
     * @return falsh success
     */

    public function admin_videos_change_position_all(Request $request) {

        try {
            
            DB::beginTransaction();

            foreach ($request->position as $admin_video_id => $position) {

                $admin_video_details = AdminVideo::find($admin_video_id);

                if(!$admin_video_details) {

                    throw new Exception(tr('video_not_found'));                
                }

                $changing_row_position = $admin_video_details->position;

                $change_video = AdminVideo::where('position', $position)
                        ->where('genre_id', $admin_video_details->genre_id)
                        ->where('is_approved', DEFAULT_TRUE)
                        ->where('status', DEFAULT_TRUE)
                        ->first();
                if(!$change_video) {

                    throw new Exception(tr('given_position_not_exits'));
                }          

                $new_row_position = $change_video->position;

                $admin_video_details->position = $new_row_position;

                if($admin_video_details->save()) {

                    $change_video->position = $changing_row_position;

                    $change_video->save();

                }

            }

            DB::commit();

            if($request->ajax()) {

                $response = ['success' => true, 'message' => tr('video_position_updated_success')];
                
                return response()->json($response, 200);
            }

            return back()->with('flash_success', tr('video_position_updated_success'));

            throw new Exception(tr('video_not_saved'));
           
        } catch (Exception $e) {

            DB::rollback();

            if($request->ajax()) {

                $response = ['success' => false, 'error' => $e->getMessage()];

                return response()->json($response, 200);
            }

            return back()->with('flash_error',$e->getMessage());
        }

    }



 /**
     * @method admin_videos_analytics()
     *
     * @uses get the selected video details
     *
     * @created Bhawya N
     *
     * @updated - 
     *
     * @param integer $admin_video_id
     *
     * @return response of html page with details
     */
    public function admin_videos_analytics(Request $request) {

        try {

            $validator = Validator::make($request->all() , [
                'admin_video_id' => 'required|exists:admin_videos,id'
            ]);

            if($validator->fails()) {
                
                $error = implode(',', $validator->messages()->all());
                
                throw new Exception($error , 101);                
            } 

            $video_id = $request->admin_video_id;

            $data = new \stdClass;

            $data->video_details = AdminVideo::find($video_id);

            $data->todays_watch_count = \App\VideoWatchCount::whereDate('created_at','=',date('Y-m-d'))->where('admin_video_id',$video_id)->value('watch_count') ?? 0;

            $data->todays_video_amount = PayPerView::whereDate('created_at','=',date('Y-m-d'))->where('video_id',$video_id)->sum('amount');

            $watch_count = last_x_days_watch_count($video_id,10);

            $earnings_count = last_x_days_earnings_count($video_id,10);

            return view('admin.videos.analytics')
                ->withPage('videos')
                ->with('sub_page', 'view-videos')
                ->with('watch_count',$watch_count)
                ->with('earnings_count',$earnings_count)
                ->with('data',$data);
            

        } catch (Exception $e) {

            return back()->with('flash_error',$e->getMessage()); 

        }
    
    }


     /**
     * @method faqs_index()
     * 
     * @uses To list the FAQs
     *
     * @created Ganesh
     *
     * @updated 
     *
     * @param
     *
     * @return view page
     */
    public function faqs_index(Request $request) {

        $base_query = \App\Faq::orderBy('created_at' , 'desc');

        if($request->search_key) {
           
            $base_query->where(function ($query) use ($request) {
                $query->where('faqs.question','LIKE','%'.$request->search_key.'%');
                
            });
        }
        
        $faqs = $base_query->paginate(10);

        return view('admin.faqs.index')
                    ->with('page','faqs')
                    ->with('sub_page','faqs-view')
                    ->with('faqs',$faqs);
    }

    /**
     * @method faqs_create()
     *
     * @uses To list out faq object details
     *
     * @created Ganesh
     *
     * @updated 
     *
     * @param
     *
     * @return View page
     */
    public function faqs_create() {

        $faq_details = new \App\Faq;

        return view('admin.faqs.create')
                    ->with('page' , 'faqs')
                    ->with('sub_page',"faqs-create")
                    ->with('faq_details', $faq_details);
    }
      
    /**
     * @method faqs_edit()
     *
     * @uses To display and update faqs object details based on the faq id
     *
     * @created  Ganesh
     *
     * @updated 
     *
     * @param Integer (request) $static_page_id
     *
     * @return View page
     */
    public function faqs_edit(Request $request) {

        try {
          
            $faq_details = \App\Faq::find($request->faq_id);

            if(!$faq_details) {

                throw new Exception( tr('admin_page_not_found'), 101);
            } 

            return view('admin.faqs.edit')
                    ->with('page' , 'faqs')
                    ->with('sub_page','faqs-view')
                    ->with('faq_details',$faq_details);

        } catch( Exception $e) {
            
            return redirect()->route('admin.faqs.index')->with('flash_error',$e->getMessage());
        }
    }


    /**
     * @method faqs_save()
     *
     * @uses To save the faq object details of new/existing based on details
     *
     * @created Ganesh
     *
     * @updated 
     *
     * @param Integer (request) $faq_id , (request) faq details
     *
     * @return success/error message
     */
    public function faqs_save(Request $request) {

        try {
            
            DB::beginTransaction();

            $validator = Validator::make($request->all() , array(
                'question'=>'required|max:255',
                'answer' => 'required',
            ));

            if( $validator->fails() ) {

                $error = implode(',',$validator->messages()->all());

                throw new Exception($error, 101);                
            }
            
            
                $faq_details = $request->faq_id ? \App\Faq::find($request->faq_id) : new \App\Faq;

                $faq_details->question = $request->question ?: $faq_details->question;

                $faq_details->answer = $request->answer ?: $faq_details->answer;

                $faq_details->unique_id = rand();

                if($faq_details->save() ) {

                    DB::commit();

                    $message = $request->page_id ? tr('admin_faq_update_success') : tr('admin_faq_create_success');

                    return redirect()->route('admin.faqs.index')->with('flash_success', $message);

                }

                throw new Exception(tr('admin_faq_save_error'), 101);                
            
                
        } catch (Exception $e) {
            
            DB::rollback();

            return back()->withInput()->with('flash_error',$e->getMessage());
        }

    }


      /**
     * @method faqs_view()
     * 
     * @uses To display pages details based on pages id
     *
     * @created Ganesh
     *
     * @updated 
     *
     * @param Integer (request) $faq_id
     *
     * @return view page
     */
    public function faqs_view(Request $request) {

        try {

            $faq_details = \App\Faq::find($request->faq_id);
            
            if(!$faq_details) {

                throw new Exception(tr('admin_faq_not_found'), 101);
            }

            return view('admin.faqs.view')
                    ->with('page' ,'faqs')
                    ->with('sub_page' ,'faqs-view')
                    ->with('faq_details' ,$faq_details);

        } catch (Exception $e) {

            return redirect()->route('admin.faqs.index')->with('flash_error',$e->getMessage());
        }
    }

    /**
     * @method faqs_delete()
     * 
     * @uses To delete the faq object based on faq id
     *
     * @created Ganesh
     *
     * @updated 
     *
     * @param 
     *
     * @return success/failure message
     */
    public function faqs_delete(Request $request) {

        try {

            DB::beginTransaction();
            
            $faq_details = \App\Faq::where('id' , $request->faq_id)->first();

            if(!$faq_details) {  

                throw new Exception(tr('admin_faq_not_found'), 101);
            }

            if($faq_details->delete() ) {

                DB::commit();

                return redirect()->route('admin.faqs.index')->with('flash_success',tr('admin_faq_delete_success'));
            } 

            throw new Exception(tr('admin_faq_delete_error'), 101);               
            
        } catch (Exception $e) {
            
            DB::rollback();

            return back()->with('flash_error',$e->getMessage());
        }
    }

     /**
     * @method moderators_bulk_action()
     * 
     * @uses To delete,approve,decline multiple moderators
     *
     * @created Sakthi
     *
     * @updated 
     *
     * @param 
     *
     * @return success/failure message
     */
    public function moderators_bulk_action(Request $request) {

        $action_name = $request->action_name ;
        $moderator_ids = explode(',', $request->selected_moderators);

       // start delete function
        if($action_name == 'bulk_delete'){

            try {

                DB::beginTransaction();

                Moderator::whereIn('id', $moderator_ids)->chunk(100, function ($moderator) {


                    foreach ($moderator as $key => $moderator_details) {


                        if( $moderator_details->picture ) {

                            Helper::delete_picture($moderator_details->picture , '/uploads/images/moderators');
                        }

                        if( $moderator_details->is_user ) {

                            $user_details = User::where('email',$moderator_details->email)->first();

                            if( $user_details ) {

                                $user_details->is_moderator = NO;

                                if( $user_details->save() ) {

                                    DB::commit();

                                } else {

                                    throw new Exception(tr('admin_moderators_delete_error'), 101);
                                } 
                            }
                        }            

                        if( $moderator_details->id ) {

                            $admin_video_details = AdminVideo::where('uploaded_by',$moderator_details->id)->first();

                            if($admin_video_details) {

                                if ($admin_video_details->delete()) {

                                    DB::commit();

                                } else {

                                    throw new Exception(tr('admin_moderators_delete_error'), 101);
                                }  
                            }         
                        }

                        if ($moderator_details->delete()) {

                            DB::commit();


                        } 
                    }
                });
                return redirect()->back()->with('flash_success',tr('admin_moderators_delete_success'))->with('bulk_action','true');

            } catch (Exception $e) {

                DB::rollback();

                return back()->with('flash_error',$e->getMessage());
            }

        }elseif($action_name == 'bulk_approve'){
         // start approve function

            try {

                DB::beginTransaction();

                $moderators =  Moderator::whereIn('id', $moderator_ids)->chunkById(100, function ($moderators) {
                    $moderators->each->update(['is_activated' => MODERATOR_ACTIVATED]);
                });

                $message =  tr('admin_moderators_activate_success');

                if($moderators) {

                    DB::commit();

                    return back()->with('flash_success',$message)->with('bulk_action','true');

                } 


            } catch( Exception $e) {

                DB::rollback();


                return redirect()->back()->with('flash_error',$e->getMessage());
            }


        }elseif($action_name == 'bulk_decline'){
          // start decline function

            try {

                DB::beginTransaction();

                $moderators =  Moderator::whereIn('id', $moderator_ids)->chunkById(100, function ($moderators) {
                    $moderators->each->update(['is_activated' => MODERATOR_DEACTIVATED]);
                });

                $message =  tr('admin_moderators_deactivate_success');

                if($moderators) {

                    DB::commit();

                    return back()->with('flash_success',$message)->with('bulk_action','true');

                } 


            } catch( Exception $e) {

                DB::rollback();


                return redirect()->back()->with('flash_error',$e->getMessage());
            }


        }


    }


     /**
     * @method store_bulk_action()
     * 
     * @uses To delete,approve,decline multiple store
     *
     * @created Sakthi
     *
     * @updated 
     *
     * @param 
     *
     * @return success/failure message
     */
    public function store_bulk_action(Request $request) {

        $action_name = $request->action_name ;
        $subadmin_ids = explode(',', $request->selected_subadmins);


       // start delete function
        if($action_name == 'bulk_delete'){

            try {

                DB::beginTransaction();

                $store_details = Admin::whereIn('id', $subadmin_ids)->delete();


                    DB::commit();

                    return redirect()->back()->with('flash_success',tr('admin_store_delete_success'));
              

            } catch (Exception $e) {

                DB::rollback();

                return back()->with('flash_error',$e->getMessage());
            }

        }elseif($action_name == 'bulk_approve'){
         // start approve function

            try {

                DB::beginTransaction();
                
                $store_details =  Admin::whereIn('id', $subadmin_ids)->update(['is_activated' => APPROVED]);

                $message =  tr('admin_store_approve_success');

                if($store_details) {

                    DB::commit();

                    return back()->with('flash_success',$message)->with('bulk_action','true');

                } 


            } catch( Exception $e) {

                DB::rollback();


                return redirect()->back()->with('flash_error',$e->getMessage());
            }


        }elseif($action_name == 'bulk_decline'){
          // start decline function

            try {

                DB::beginTransaction();
                
                $store_details =  Admin::whereIn('id', $subadmin_ids)->update(['is_activated' => DECLINED]);

                $message =  tr('admin_store_decline_success');

                if($store_details) {

                    DB::commit();

                    return back()->with('flash_success',$message)->with('bulk_action','true');

                } 


            } catch( Exception $e) {

                DB::rollback();


                return redirect()->back()->with('flash_error',$e->getMessage());
            }


        }


    }

     /**
     * @method users_bulk_action()
     * 
     * @uses To delete,approve,decline multiple users
     *
     * @created Sakthi
     *
     * @updated 
     *
     * @param 
     *
     * @return success/failure message
     */
    public function users_bulk_action(Request $request) {

        $action_name = $request->action_name ;
        $user_ids = explode(',', $request->selected_users);

       // start delete function
        if($action_name == 'bulk_delete'){

            try {

                DB::beginTransaction();


                User::whereIn('id', $user_ids)->chunk(100, function ($users) {


                    foreach ($users as $key => $user_details) {


                        if ($user_details->device_type) {

                          // Load Mobile Registers
                            subtract_count($user_details->device_type);
                        }

                        if( $user_details->picture )
                           // Delete the old pic
                            Helper::delete_picture($user_details->picture, "/uploads/images/users/"); 

                            // After reduce the count from mobile register model delete the user
                        if( $user_details->is_moderator ) {    

                            $moderator = Moderator::where('email',$user_details->email)->first();

                            if($moderator){

                                $moderator->is_user = NO;

                                $moderator->save(); 
                            }
                        }

                        if ($user_details->delete()) {

                            DB::commit();

                        } 
                    } 
                });

                return redirect()->back()->with('flash_success',tr('admin_users_delete_success'));


            } catch (Exception $e) {

                DB::rollback();

                return back()->with('flash_error',$e->getMessage());
            }

        }elseif($action_name == 'bulk_approve'){
// start approve function

            try {

                DB::beginTransaction();

                $user_details =  User::whereIn('id', $user_ids)->update(['is_activated' => USER_APPROVED]);

                $message =  tr('admin_users_approve_success');

                DB::commit();

                return back()->with('flash_success',$message)->with('bulk_action','true');

            } catch( Exception $e) {

                DB::rollback();

                return redirect()->back()->with('flash_error',$e->getMessage());
            }


        }elseif($action_name == 'bulk_decline'){
          // start decline function

            try {

                DB::beginTransaction();
                
                $user_details =  User::whereIn('id', $user_ids)->update(['is_activated' => USER_DECLINED]);

                $message =  tr('admin_users_decline_success');

                DB::commit();

                return back()->with('flash_success',$message)->with('bulk_action','true');



            } catch( Exception $e) {

                DB::rollback();


                return redirect()->back()->with('flash_error',$e->getMessage());
            }


        }


    }

    /**
     * @method admin_videos_audios()
     *
     * @uses get the selected video details
     *
     * @created Bhawya N
     *
     * @updated - 
     *
     * @param integer $admin_video_id
     *
     * @return response of html page with details
     */
    public function admin_videos_audios(Request $request) {

        try {

            $validator = Validator::make($request->all() , [
                'admin_video_id' => 'required|exists:admin_videos,id'
            ]);

            if($validator->fails()) {
                
                $error = implode(',', $validator->messages()->all());
                
                throw new Exception($error , 101);                
            } 

            $video_id = $request->admin_video_id;

            $admin_video = AdminVideo::find($request->admin_video_id);

            $video_audios = AdminVideoAudio::where('video_id',$video_id)->get();

            return view('admin.videos.audios')
                ->withPage('videos')
                ->with('sub_page', 'view-videos')
                ->with('video_id', $video_id)
                ->with('admin_video', $admin_video)
                ->with('video_audios',$video_audios);
            

        } catch (Exception $e) {

            return back()->with('flash_error',$e->getMessage()); 

        }
    
    }

    /**
     * @method admin_videos_audios()
     *
     * @uses get the selected video details
     *
     * @created Bhawya N
     *
     * @updated - 
     *
     * @param integer $admin_video_id
     *
     * @return response of html page with details
     */
    public function admin_videos_audios_save(Request $request) {

        try {

            $inputname = "group-a";
            
            $video_ids = [];

            $is_audio_uploaded = NO;

            foreach ($request->$inputname as $key => $value) {

                $value = (object)$value;
                
                if($value->language) {

                    if(!empty($value->video_audios_id)) {
                                    
                        $video_audios = AdminVideoAudio::find($value->video_audios_id);

                        $video_ids[] = $value->video_audios_id;

                    } else {
                       
                        $video_audios = new AdminVideoAudio;
                    }

                    $video_audios->language = $value->language;

                    $video_audios->language_code = $value->language_code;

                    $video_audios->video_id = $request->video_id;

                    if(isset($value->audio)) {

                        $is_audio_uploaded = YES;

                        $video_audios->audio =  Helper::audio_upload($value->audio);

                    }

                    if(isset($value->subtitle)) {

                        $video_audios->subtitle =  Helper::subtitle_upload($value->subtitle);

                        $video_subtitle_vtt = Setting::get('ANGULAR_SITE_URL').'assets/subtitles/'.get_subtitle_vtt($video_audios->subtitle);

                        $video_audios->subtitle_vtt = $video_subtitle_vtt;

                    }

                    $video_audios->save();

                    $video_ids[] = $video_audios->id;
                }
            
            }
            
            $video_audios_ids = AdminVideoAudio::where('video_id',$request->video_id)->whereNotIn('id',$video_ids)->pluck('id');

            \App\AdminVideoAudio::destroy($video_audios_ids);

            if($is_audio_uploaded == YES) {
                dispatch(new \App\Jobs\NFAudioGenerate($request->video_id));

            }

            DB::commit();

            return back()->with('flash_success', 'Files updated successfully');

        } catch (Exception $e) {

            DB::rollback();

            return back()->with('flash_error',$e->getMessage()); 

        }
    
    }

}
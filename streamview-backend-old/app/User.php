<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use App\Helpers\Helper;

use Setting;

class User extends Authenticatable
{   
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_type','device_type','login_by',
        'picture','is_activated', 'timezone', 'verification_code' , 
        'verification_code_expiry'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cards()
    {
        return $this->hasMany('App\Card');
    }

    /**
     * Get the continueWatchingVideo record associated with the user.
     */
    public function continueWatchingVideo()
    {
        return $this->hasMany('App\ContinueWatchingVideo', 'user_id', 'id');
    }

    /**
     * Get the flag record associated with the user.
     */
    public function userFlag()
    {
        return $this->hasMany('App\Flag', 'user_id', 'id');
    }


    public function likedislikeVideos()
    {
        return $this->hasMany('App\LikeDislikeVideo');
    }

    public function notifications()
    {
        return $this->hasMany('App\Notification');
    }

    /**
     * Get the pay per view record associated with the user.
     */
    public function userVideoSubscription()
    {
        return $this->hasMany('App\PayPerView', 'user_id', 'id');
    }

    public function subProfile()
    {
        return $this->hasMany('App\SubProfile');
    }

    public function coupons()
    {
        return $this->hasMany('App\UserCoupon');
    }

    public function userHistory()
    {
        return $this->hasMany('App\UserHistory');
    }


    public function loggedDevice()
    {
        return $this->hasMany('App\UserLoggedDevice');
    }

    public function userPayment()
    {
        return $this->hasMany('App\UserPayment');
    }


    public function userRating()
    {
        return $this->hasMany('App\UserRating');
    }

    public function userWishlist()
    {
        return $this->hasMany('App\Wishlist');
    }

    // Get User wallet Details
    public function userWallet()
    {
        return $this->hasOne(CustomWallet::class, 'user_id');
    }

    /**
     * Get the Moderator details.
     */

    public function moderator()
    {
        return $this->belongsTo('App\Moderator');
    }


    public function offlineVideos()
    {
        return $this->hasMany('App\OfflineAdminVideo', 'user_id', 'id');
    }

    // Get User wallet Details
    public function userReferralCode()
    {
        return $this->hasOne(ReferralCode::class, 'user_id');
    }

    /**
     * Scope a query to only include active users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCommonResponse($query) {

        return $query->select(
            'users.id',
            // 'users.id as user_id',
            'users.name',
            'users.email as email',
            'users.gender',
            'users.picture as picture',
            'users.mobile as mobile',
            'users.token as token',
            'users.token_expiry as token_expiry',
            'users.social_unique_id as social_unique_id',
            'users.login_by as login_by',
            'users.payment_mode',
            'users.card_id',
            'users.status as user_status',
            'users.email_notification',
            'users.push_status',
            // push_status used for IOS
            // 'users.push_notification_status',
            'users.is_verified',
            'users.user_type',
            'users.created_at',
            'users.updated_at'
            );
    
    }

     /**
     * Boot function for using with User Events
     *
     * @return void
     */

    public static function boot()
    {
        //execute the parent's boot method 
        parent::boot();

        //delete your related models here, for example
        static::deleting(function($user)
        {

            if ($user) {

                if($user->picture) {

                    Helper::storage_delete_file($user->picture , PROFILE_PATH_USER);

                }
            }

            if (($user->cards->count()) > 0) {

                foreach($user->cards as $card)
                {
                    $card->delete();
                } 

            }

            if ($user->continueWatchingVideo->count() > 0) {

                foreach($user->continueWatchingVideo as $continue_watching_video)
                {
                    $continue_watching_video->delete();
                }

            }

            if ($user->userFlag->count() > 0) {

                foreach($user->userFlag as $flag)
                {
                    $flag->delete();
                }

            }

            if ($user->likedislikeVideos->count() > 0) {

                foreach($user->likedislikeVideos as $likedislikeVideo)
                {
                    $likedislikeVideo->delete();
                }

            }

            if ($user->notifications->count() > 0) {

                foreach($user->notifications as $notification)
                {
                    $notification->delete();
                }

            }

            // To Maintain Payment Record

            /*if (count($user->userVideoSubscription) > 0) {

                foreach($user->userVideoSubscription as $video) {

                    $video->delete();

                }
            }*/


            if ($user->subProfile->count() > 0) {

                foreach($user->subProfile as $profile) {
                    
                    Helper::delete_picture($profile->picture , '/uploads/images/');

                    $profile->delete();
                } 
            }
            
            if ($user->coupons->count() > 0) {

                foreach($user->coupons as $userCoupon)

                {
                    $userCoupon->delete();
                } 

            }


            if ($user->userHistory->count() > 0) {

                foreach($user->userHistory as $history)
                {
                    $history->delete();
                } 

            }

            if ($user->loggedDevice->count() > 0) {

                foreach($user->loggedDevice as $logged)
                {
                    $logged->delete();
                } 

            }

            // To Maintain Payment Record

            //  if (count($user->userPayment) > 0) {

            //     foreach($user->userPayment as $payment)
            //     {
            //         $payment->delete();
            //     } 
            // }

            if ($user->userRating->count() > 0) {

                foreach($user->userRating as $rating)
                {
                    $rating->delete();
                } 

            }

            if ($user->userWishlist->count() > 0) {

                foreach($user->userWishlist as $wishlist)
                {
                    $wishlist->delete();
                } 

            }

            if ($user->offlineVideos->count() > 0) {

                foreach($user->offlineVideos as $offlineVideo)
                {
                    $offlineVideo->delete();
                } 

            }

            $user->userWallet()->delete();
          
            
        }); 

        static::creating(function ($model) {

            if (Setting::get('email_verify_control')) { 

                if($model->login_by == MANUAL) {

                    $model->generateEmailCode();

                } else {

                    $model->attributes['is_verified'] = YES;

                }

            } else {

                $model->attributes['is_verified'] = YES;
            }

            $model->attributes['push_status'] = ON;

            $model->attributes['email_notification_status'] = ON;

        });
    }


    /**
     * Generates Token and Token Expiry
     * 
     * @return bool returns true if successful. false on failure.
     */

    protected function generateEmailCode() {

        $this->attributes['verification_code'] = Helper::generate_email_code();

        $this->attributes['verification_code_expiry'] = Helper::generate_email_expiry();

        $this->attributes['is_verified'] = NO;

        return true;
    }


}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubProfile extends Model
{
    //

    public function user() {
        return $this->belongsTo('App\User');
    }


 	public function userHistory()
    {
        return $this->hasMany('App\UserHistory', 'user_id', 'id');
    }

    public function userWishlist()
    {
        return $this->hasMany('App\Wishlist', 'user_id', 'id');
    }

    /**
     * Get the flag record associated with the user.
     */
    public function userFlag()
    {
        return $this->hasMany('App\Flag', 'sub_profile_id', 'id');
    }


    /**
     * Get the continueWatchingVideo record associated with the sub profile.
     */
    public function continueWatchingVideo()
    {
        return $this->hasMany('App\ContinueWatchingVideo', 'sub_profile_id', 'id');
    }

    /**
     * Scope a query to only include active users.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeCommonResponse($query) {

        return $query->select(
            'sub_profiles.id as sub_profile_id',
            'sub_profiles.name',
            'sub_profiles.user_id',
            'sub_profiles.picture',
            'sub_profiles.created_at',
            'sub_profiles.updated_at'
            );
    
    }

    public static function boot()
    {
        //execute the parent's boot method 
        parent::boot();

        //delete your related models here, for example
        static::deleting(function($user)
        {
            if ($user->userHistory->count() > 0) {

                foreach($user->userHistory as $history)
                {
                    $history->delete();
                } 

            }

            if ($user->userWishlist->count() > 0) {

                foreach($user->userWishlist as $wishlist)
                {
                    $wishlist->delete();
                } 

            }

            if ($user->userFlag->count() > 0) {

                foreach($user->userFlag as $flag)
                {
                    $flag->delete();
                }

            }

            if ($user->continueWatchingVideo->count() > 0) {

                foreach($user->continueWatchingVideo as $continue_watching_video)
                {
                    $continue_watching_video->delete();
                }

            }


        }); 

	}
}
